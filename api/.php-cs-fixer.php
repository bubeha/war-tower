<?php

declare(strict_types=1);

return
    (new PhpCsFixer\Config())
        ->setCacheFile(__DIR__ . '/var/cache/.php_cs')
        ->setFinder(
            PhpCsFixer\Finder::create()
                ->in([
                    __DIR__ . '/bin',
                    __DIR__ . '/config',
                    __DIR__ . '/public',
                    __DIR__ . '/src',
                    __DIR__ . '/tests',
                ])
                ->append([
                    __FILE__,
                ]),
        )
        ->setRules([
            '@PSR12' => true,
            '@PSR12:risky' => true,
            '@PHP80Migration:risky' => true,
            '@PHP81Migration' => true,
            '@PHPUnit84Migration:risky' => true,
            '@PhpCsFixer' => true,
            '@PhpCsFixer:risky' => true,
            'ordered_imports' => ['imports_order' => ['class', 'function', 'const']],
            'concat_space' => ['spacing' => 'one'],
            'cast_spaces' => ['space' => 'none'],
            'binary_operator_spaces' => false,
            'phpdoc_to_comment' => false,
            'phpdoc_separation' => false,
            'phpdoc_types_order' => ['null_adjustment' => 'always_last'],
            'phpdoc_align' => false,
            'phpdoc_add_missing_param_annotation' => false,
            'operator_linebreak' => false,
            'return_assignment' => false,
            'global_namespace_import' => [
                'import_classes' => true,
                'import_constants' => false,
                'import_functions' => false,
            ],
            'blank_line_before_statement' => [
                'statements' => [
                    'continue',
                    'declare',
                    'default',
                    'return',
                    'throw',
                    'try',
                    'while',
                ],
            ],
            'method_chaining_indentation' => false,
            'blank_line_between_import_groups' => false,
            'braces' => [
                'allow_single_line_anonymous_class_with_empty_body' => true,
                'allow_single_line_closure' => true,
            ],
            'date_time_immutable' => true,
            'multiline_whitespace_before_semicolons' => ['strategy' => 'new_line_for_chained_calls'],
            'no_break_comment' => false,
            'no_superfluous_phpdoc_tags' => ['remove_inheritdoc' => true],
            'no_trailing_whitespace_in_string' => false,
            'nullable_type_declaration_for_default_null_value' => true,
            'ordered_class_elements' => ['order' => [
                'use_trait',
                'case',
                'constant_public',
                'constant_protected',
                'constant_private',
                'property_public_static',
                'property_protected_static',
                'property_private_static',
                'property_public',
                'property_protected',
                'property_private',
                'construct',
                'destruct',
                'phpunit',
                'method_public_static',
                'method_public_abstract_static',
                'method_protected_static',
                'method_protected_abstract_static',
                'method_private_static',
                'method_public',
                'method_public_abstract',
                'method_protected',
                'method_protected_abstract',
                'method_private',
            ]],
            'fopen_flags' => ['b_mode' => true],
            'php_unit_strict' => false,
            'php_unit_test_class_requires_covers' => false,
            'php_unit_test_case_static_method_calls' => ['call_type' => 'self'],
            'yoda_style' => ['equal' => false, 'identical' => false, 'less_and_greater' => false],
            'final_class' => true,
            'final_public_method_for_abstract_class' => true,
            'self_static_accessor' => true,
            'static_lambda' => true,
            'native_function_invocation' => [
                'include' => [
                    '@internal',
                    '@compiler_optimized',
                ],
                'scope' => 'namespaced',
                'strict' => true,
            ],
            'single_line_comment_style' => ['comment_types' => ['hash']],
            'trailing_comma_in_multiline' => ['after_heredoc' => true, 'elements' => ['arrays', 'arguments', 'parameters']],
        ])
    ;
