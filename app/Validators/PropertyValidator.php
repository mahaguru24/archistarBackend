<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PropertyValidator.
 *
 * @package namespace App\Validators;
 */
class PropertyValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'suburb' => 'required',
            'state' => 'required',
            'country' => 'required'
        ],
        ValidatorInterface::RULE_UPDATE => [
            'suburb' => 'required',
            'state' => 'required',
            'country' => 'required'
        ],
    ];
}
