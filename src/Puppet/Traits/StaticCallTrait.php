<?php declare(strict_types=1);

namespace VanCodX\Puppetizer\Puppet\Traits;

/**
 * @phpstan-ignore trait.unused
 */
trait StaticCallTrait
{
    /**
     * @param non-empty-string $name
     * @param list<mixed> $arguments
     * @return mixed
     */
    protected static function puppetStaticCall(string $name, array $arguments): mixed
    {
        return null;
    }
}
