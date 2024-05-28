<?php

namespace Config;

use App\Validation\ParentValidation;
use CodeIgniter\Config\BaseConfig;
use CodeIgniter\Validation\StrictRules\CreditCardRules;
use CodeIgniter\Validation\StrictRules\FileRules;
use CodeIgniter\Validation\StrictRules\FormatRules;
use CodeIgniter\Validation\StrictRules\Rules;

class Validation extends BaseConfig
{
    // --------------------------------------------------------------------
    // Setup
    // --------------------------------------------------------------------

    /**
     * Stores the classes that contain the
     * rules that are available.
     *
     * @var list<string>
     */
    public array $ruleSets = [
        Rules::class,
        FormatRules::class,
        FileRules::class,
        CreditCardRules::class,
        ParentValidation::class, // Em razão do CPF validation
    ];

    /**
     * Specifies the views that are used to display the
     * errors.
     *
     * @var array<string, string>
     */
    public array $templates = [
        'list'                  => 'CodeIgniter\Validation\Views\list',
        'single'                => 'CodeIgniter\Validation\Views\single',
        '_list_custom_errors'   => 'App\Views\layouts\_list_custom_errors',
    ];

    // --------------------------------------------------------------------
    // Rules
    // --------------------------------------------------------------------
}
