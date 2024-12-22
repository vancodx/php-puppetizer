<?php declare(strict_types=1);

use VanCodX\CodingStyle\PhpCsFixer\ConfigCreator;

$config = ConfigCreator::create();
$config->getFinder()->in(__DIR__);
return $config;
