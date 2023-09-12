<?php

return PhpCsFixer\Config::create()
    ->setRules([
        '@PSR2' => true,
        'array_syntax' => ['syntax' => 'short'],
        'binary_operator_spaces' => ['operators' => ['=>' => 'align_single_space_minimal']],
        'blank_line_after_namespace' => true,
        'blank_line_after_opening_tag' => true,
        'braces' => ['allow_single_line_closure' => true],
        // Agrega más reglas según tus preferencias
    ]);
