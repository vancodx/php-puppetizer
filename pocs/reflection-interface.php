<?php declare(strict_types=1);

namespace ProofOfConcepts;

use ReflectionClass;

// phpcs:disable PSR1.Classes.ClassDeclaration

interface TestInterface
{
    /**
     * @return void
     */
    public static function staticMethod(): void;

    /**
     * @return void
     */
    public function regularMethod(): void;
}

abstract class AbstractTest implements TestInterface
{
}

// phpcs:disable PSR1.Files.SideEffects

//------------------------------------------------------------------------------
echo str_repeat('-', 80), "\n";

$refClass1 = new ReflectionClass(TestInterface::class);

echo '$refClass1->getName(): ', var_export($refClass1->getName()), "\n";
echo '$refClass1->isInterface(): ', var_export($refClass1->isInterface()), "\n";
echo '$refClass1->isAbstract(): ', var_export($refClass1->isAbstract()), "\n";
echo "\n";

foreach ($refClass1->getMethods() as $refClass1Method) {
    echo '$refClass1Method->getName(): ', var_export($refClass1Method->getName()), "\n";
    echo '$refClass1Method->isStatic(): ', var_export($refClass1Method->isStatic()), "\n";
    echo '$refClass1Method->isAbstract(): ', var_export($refClass1Method->isAbstract()), "\n";
    echo "\n";
}

//------------------------------------------------------------------------------
echo str_repeat('-', 80), "\n";

$refClass2 = new ReflectionClass(AbstractTest::class);

echo '$refClass2->getName(): ', var_export($refClass2->getName()), "\n";
echo '$refClass2->isInterface(): ', var_export($refClass2->isInterface()), "\n";
echo '$refClass2->isAbstract(): ', var_export($refClass2->isAbstract()), "\n";
echo "\n";

foreach ($refClass2->getMethods() as $refClass2Method) {
    echo '$refClass2Method->getName(): ', var_export($refClass2Method->getName()), "\n";
    echo '$refClass2Method->isStatic(): ', var_export($refClass2Method->isStatic()), "\n";
    echo '$refClass2Method->isAbstract(): ', var_export($refClass2Method->isAbstract()), "\n";
    echo "\n";
}
