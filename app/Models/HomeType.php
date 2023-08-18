<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HomeType extends Model
{
    public function rules(): \Illuminate\Database\Eloquent\Relations\BelongsToMany
    {
        return $this->belongsToMany(Rule::class, 'home_type_rules');
    }
}
