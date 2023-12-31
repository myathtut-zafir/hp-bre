<?php

namespace App\Http\Controllers;

use App\Enums\RuleTypes;
use App\Models\HomeType;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Inertia\Inertia;
use stdClass;
use Symfony\Component\ExpressionLanguage\ExpressionLanguage;

class HomeController extends Controller
{
    public array $fail;

    public array $success;

    public array $results;

    public function index(Request $request)
    {
        $this->fail = [];
        $this->success = [];
        $this->results = [];

        $flattenedRequestData = Arr::dot($request->all());
        $expressionLanguage = new ExpressionLanguage();
        $propertyRules = HomeType::homeRule($flattenedRequestData['property_type'])->firstOrFail();
        $rules = $propertyRules->rules;//get rules json obj

        foreach ($rules as $rule) {
            $condition = $this->getCondition($rule);

            $values = [
                RuleTypes::LOAN_AMOUNT->value => [
                    'amount' => $flattenedRequestData['property_value'],
                ], RuleTypes::TENURE->value => [
                    'tenure' => $flattenedRequestData['tenure'],
                ], RuleTypes::TYPE_AGE_PROPERTY_TENURE->value => [
                    'tenure' => $flattenedRequestData['tenure'],
                    'age' => $flattenedRequestData['property_age'],
                ],
            ][$rule->types->value];

            $expressionResult = $this->validateRule($values, $expressionLanguage, $condition);

            $this->showResults($expressionResult, $rule, $condition);
        }

        $this->composeResults();
        $completeResponse = array_merge([
            'data' => $this->results,
        ], $this->composeSummary());
        //    return  $completeResponse;
        return Inertia::render(
            'Home',
            [
                'data' => $completeResponse,
                'summary_status' => $completeResponse['summary_status'],
            ]
        );
    }

    public function showResults(bool $expressionResult, mixed $rule, string $condition): void
    {
        if ($expressionResult == false && $rule->result_status == true) {
            $this->failRule($rule, $condition);
        } elseif ($expressionResult == true && $rule->result_status == false) {
            $this->failRule($rule, $condition);
        } elseif ($expressionResult == true && $rule->result_status == true) {
            $this->successRule($condition, $rule);
        } else {
            $this->failRule($rule, $condition);
        }
    }

    public function validateRule(array $values, ExpressionLanguage $expressionLanguage, string $condition): mixed
    {
        if (! empty($values)) {
            $expressionResult = $expressionLanguage->evaluate(
                $condition,
                $values
            );
        }

        return $expressionResult;
    }

    public function composeResults(): void
    {
        $mergeResults = array_merge($this->success, $this->fail);

        foreach ($mergeResults as $resultData) {
            $this->results[] = $resultData;
        }

        //for sorting purpose
        $resultCollection = collect($this->results);
        $this->results = $resultCollection->sortBy('types')->all();
    }

    public function composeSummary(): array
    {
        return [
            'summary_status' => count($this->fail) == 0,
            'total_rules' => count($this->results),
            'total_fail_rules' => count($this->fail),
        ];
    }

    public function getCondition(mixed $rule): string
    {
        $condition = '';
        $object = new stdClass();
        $i = 1;
        $count = count($rule->rules['rules']);

        foreach ($rule->rules['rules'] as $key => $value) {
            if (str_contains($value, '..') || $rule['rules']['operator'] === ' in ' || str_contains($value, '[')) {
                $object->{$key} = ' in'.$value;
            } else {
                $object->{$key} = $value;
            }

            $condition .= $key.''.$object->{$key};
            if ($count != $i) {
                $condition .= $rule->rules['operator'];
            }

            $i++;
        }

        return $condition;
    }

    public function failRule(mixed $rule, string $condition): void
    {
        if (! array_key_exists($rule->types->value, $this->fail)) {
            $this->fail[$rule->types->value] = ['status' => 'Rejected', 'rule' => $condition, 'rule_id' => $rule->id, 'types' => $rule->types->value, 'message' => 'Rejected'];
        }

        $this->removeResultInFailResults($rule);
    }

    public function successRule(string $condition, mixed $rule): void
    {
        if (! array_key_exists($rule->types->value, $this->success)) {
            $this->success[$rule->types->value] = ['status' => 'Approved', 'rule' => $condition, 'rule_id' => $rule->id, 'types' => $rule->types->value, 'message' => $rule->message];
        }

        $this->removeResultInFailResults($rule);
    }

    public function removeResultInFailResults(mixed $rule): void
    {
        $array = $this->success;
        if (isset($array[$rule->types->value])) {
            unset($this->fail[$rule->types->value]);
        }
    }
}
