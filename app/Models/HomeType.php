<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    public function rules(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'home_type_rules');
    }

    public function scopeHomeRule($query, $homeType)
    {
        return $query->where('type', $homeType)->with(['rules' => function ($q): void {
            $q->orderBy('result_status', 'asc');
        }]);
    }
}
