<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PropertyAnalyticValidator.
 *
 * @package namespace App\Validators;
 */
class PropertyAnalyticValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        // todo :: add validations to check property and analytics ids
        ValidatorInterface::RULE_CREATE => [
            'property_id' => 'required',
            'analytic_type_id' => 'required',
            'value' => 'required',
        ],
        ValidatorInterface::RULE_UPDATE => [
            'property_id' => 'required',
            'analytic_type_id' => 'required',
            'value' => 'required',
        ],
    ];
}
