<?php

namespace App\Enums;

enum RuleTypes: string
{
    case LOAN_AMOUNT = 'LOAN_AMOUNT';
    case TENURE = 'TENURE';
    case TYPE_AGE_PROPERTY_TENURE = 'TYPE_AGE_PROPERTY_TENURE';
    case DOWN_PAYMENT = 'DOWN_PAYMENT';

}
