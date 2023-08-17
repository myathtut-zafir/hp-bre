<?php

namespace App\Models;

use App\Enums\RuleTypes;
use Illuminate\Database\Eloquent\Model;

class Rule extends Model
{

    protected $casts = [
        'rules' => 'collection',
        'types' => RuleTypes::class,
    ];
}
