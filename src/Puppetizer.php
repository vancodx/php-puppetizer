<?php declare(strict_types=1);

namespace VanCodX\Puppetizer;

use VanCodX\Puppetizer\Puppet\Builder;

class Puppetizer
{
    /**
     * @template T of object
     * @param class-string<T>|T $classOrObject
     * @return Builder<T>
     */
    public static function createPuppetBuilder(string|object $classOrObject): Builder
    {
        return new Builder($classOrObject);
    }

    /**
     * @template T of object
     * @param class-string<T>|T $classOrObject
     * @return T
     */
    public static function createPuppet(string|object $classOrObject): object
    {
        $builder = static::createPuppetBuilder($classOrObject);
        return $builder->create();
    }
}
