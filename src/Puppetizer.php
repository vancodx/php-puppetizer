<?php declare(strict_types=1);

namespace VanCodX\Puppetizer;

use VanCodX\Puppetizer\Puppet\Builder;

class Puppetizer
{
    /**
     * @template T of object
     * @param class-string<T>|T $classOrObject
     * @return T
     */
    public static function createPuppet(string|object $classOrObject): object
    {
        $builder = new Builder($classOrObject);
        return $builder->create();
    }
}
