<?php

declare(strict_types=1);

use PHP_CodeSniffer\Standards\Generic\Sniffs\CodeAnalysis\AssignmentInConditionSniff;
use PhpCsFixer\Fixer\Operator\NotOperatorWithSuccessorSpaceFixer;
use PhpCsFixer\Fixer\Phpdoc\PhpdocNoEmptyReturnFixer;
use Quartetcom\StaticAnalysisKit\EasyCodingStandard\Config;
use Symplify\EasyCodingStandard\Config\ECSConfig;

return function (ECSConfig $ecsConfig): void {
    Config::use($ecsConfig);

    $ecsConfig->paths(array_map(fn (string $path) => __DIR__ . $path, [
        '/src',
        '/tests',
    ]));

    $ecsConfig->skip([
        AssignmentInConditionSniff::class,
        NotOperatorWithSuccessorSpaceFixer::class,
        PhpdocNoEmptyReturnFixer::class => [
            __DIR__ . '/src/Internal/Assert.php',
        ],
    ]);
};
