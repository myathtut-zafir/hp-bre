<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rules = [
            [
                'result_status' => true,
                'types' => 'LOAN_AMOUNT',
                'message' => 'approve',
                'rules' => [
                    'rules' => [
                        'amount' => ' 100..800',
                    ],
                    'operator' => null,
                ],
            ],
            [
                'result_status' => true,
                'types' => 'TENURE',
                'message' => 'approve',
                'rules' => [
                    'rules' => [
                        'tenure' => ' 3..9',
                    ],
                    'operator' => null,
                ],
            ],
            [
                'result_status' => false,
                'types' => 'TENURE',
                'message' => 'reject',
                'rules' => [
                    'rules' => [
                        'tenure' => ' >9',
                    ],
                    'operator' => null,
                ],
            ],
            [
                'result_status' => true,
                'types' => 'TYPE_AGE_PROPERTY_TENURE',
                'message' => 'approve',
                'rules' => [
                    'rules' => [
                        'age' => ' 0..7',
                        'tenure' => ' 1..9',
                    ],
                    'operator' => ' && ',
                ],
            ],
            //            [
            //                "result_status" => true,
            //                "types" => "TYPE_AGE_PROPERTY_TENURE",
            //                "message" => "approve",
            //                "rules" => [
            //                    "rules" => [
            //                        "age" => " 1..3",
            //                        "tenure" => " 8..10",
            //                    ],
            //                    "operator" => " && ",
            //                ],
            //            ],
            [
                'result_status' => true,
                'types' => 'TYPE_AGE_PROPERTY_TENURE',
                'message' => 'approve',
                'rules' => [
                    'rules' => [
                        'age' => ' 8..10',
                        'tenure' => ' 1..3',
                    ],
                    'operator' => ' && ',
                ],
            ], [
                'result_status' => false,
                'types' => 'TYPE_AGE_PROPERTY_TENURE',
                'message' => 'reject',
                'rules' => [
                    'rules' => [
                        'age' => ' 8..10',
                        'tenure' => ' 1..9',
                    ],
                    'operator' => ' && ',
                ],
            ], [
                'result_status' => true,
                'types' => 'TYPE_AGE_PROPERTY_TENURE',
                'message' => 'approve',
                'rules' => [
                    'rules' => [
                        'age' => ' 11..15',
                        'tenure' => ' 1..2',
                    ],
                    'operator' => ' && ',
                ],
            ], [
                'result_status' => false,
                'types' => 'TYPE_AGE_PROPERTY_TENURE',
                'message' => 'reject',
                'rules' => [
                    'rules' => [
                        'age' => ' 11..15',
                        'tenure' => ' 1..9',
                    ],
                    'operator' => ' && ',
                ],
            ],
        ];

        DB::table('rules')->truncate();
        foreach ($rules as $key => $value) {
            Rule::create([
                'result_status' => $value['result_status'],
                'types' => $value['types'],
                'message' => $value['message'],
                'rules' => $value['rules'],
            ]);
        }
    }
}
