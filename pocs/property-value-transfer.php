<?php declare(strict_types=1);

namespace ProofOfConcepts;

use ReflectionClass;

// phpcs:disable PSR1.Classes.ClassDeclaration

class TestLevel1
{
    /** @var int */
    private int $x;

    /** @var int */
    protected int $y;

    /** @var int */
    public int $z;

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return void
     */
    public function __construct(int $x, int $y, int $z)
    {
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @return void
     */
    public function print(): void
    {
        echo __METHOD__, sprintf("(): X = %d, Y = %d, Z = %d\n", $this->x, $this->y, $this->z);
    }
}

class TestLevel2 extends TestLevel1
{
    /** @var int */
    private int $x;

    /** @var int */
    protected int $y;

    /** @var int */
    public int $z;

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return void
     */
    public function __construct(int $x, int $y, int $z)
    {
        parent::__construct($x, $y, $z);
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @return void
     */
    public function print(): void
    {
        parent::print();
        echo __METHOD__, sprintf("(): X = %d, Y = %d, Z = %d\n", $this->x, $this->y, $this->z);
    }
}

class TestLevel3 extends TestLevel2
{
    /** @var int */
    private int $x;

    /** @var int */
    protected int $y;

    /** @var int */
    public int $z;

    /**
     * @param int $x
     * @param int $y
     * @param int $z
     * @return void
     */
    public function __construct(int $x, int $y, int $z)
    {
        parent::__construct($x, $y, $z);
        $this->x = $x;
        $this->y = $y;
        $this->z = $z;
    }

    /**
     * @return void
     */
    public function print(): void
    {
        parent::print();
        echo __METHOD__, sprintf("(): X = %d, Y = %d, Z = %d\n", $this->x, $this->y, $this->z);
    }
}

// phpcs:disable PSR1.Files.SideEffects

$test1 = new TestLevel3(1, 2, 3);
$test2 = new TestLevel3(10, 20, 30);

//------------------------------------------------------------------------------
echo str_repeat('-', 80), "\n";

$test1->print();
echo '$test1 == $test2: ', var_export($test1 == $test2), "\n\n";

//------------------------------------------------------------------------------
echo str_repeat('-', 80), "\n";

/** @var ReflectionClass<TestLevel3> $refClassL3 */
$refClassL3 = new ReflectionClass(TestLevel3::class);
foreach ($refClassL3->getProperties() as $refClassL3Property) {
    $refClassL3Property->setValue($test1, $refClassL3Property->getValue($test2));
}

$test1->print();
echo '$test1 == $test2: ', var_export($test1 == $test2), "\n\n";

//------------------------------------------------------------------------------
echo str_repeat('-', 80), "\n";

/** @var ReflectionClass<TestLevel2> $refClassL2 */
$refClassL2 = $refClassL3->getParentClass();
foreach ($refClassL2->getProperties() as $refClassL2Property) {
    if ($refClassL2Property->isPrivate()) {
        $refClassL2Property->setValue($test1, $refClassL2Property->getValue($test2));
    }
}

$test1->print();
echo '$test1 == $test2: ', var_export($test1 == $test2), "\n\n";

//------------------------------------------------------------------------------
echo str_repeat('-', 80), "\n";

/** @var ReflectionClass<TestLevel1> $refClassL1 */
$refClassL1 = $refClassL2->getParentClass();
foreach ($refClassL1->getProperties() as $refClassL1Property) {
    if ($refClassL1Property->isPrivate()) {
        $refClassL1Property->setValue($test1, $refClassL1Property->getValue($test2));
    }
}

$test1->print();
echo '$test1 == $test2: ', var_export($test1 == $test2), "\n\n";
