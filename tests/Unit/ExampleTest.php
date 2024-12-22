<?php declare(strict_types=1);

namespace Tests\Unit;

use VanCodX\Testing\PHPUnit\TestCase;

class ExampleTest extends TestCase
{
    /**
     * @return void
     */
    public function testExample(): void
    {
        $this->assertGreaterThan(1, time());
    }
}
