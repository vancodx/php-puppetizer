<?php declare(strict_types=1);

namespace VanCodX\Puppetizer\Puppet;

use InvalidArgumentException;
use UnexpectedValueException;

/**
 * @template T of object
 */
class Builder
{
    /**
     * @var class-string<T>
     */
    protected string $class;

    /**
     * @var T|null
     */
    protected ?object $sourceObject = null;

    /**
     * @param class-string<T>|T $classOrObject
     * @return void
     */
    public function __construct(string|object $classOrObject)
    {
        // TODO: check arg
        if (is_object($classOrObject)) {
            $this->class = $classOrObject::class;
            $this->sourceObject = $classOrObject;
        } else {
            $this->class = $classOrObject;
        }
    }

    /**
     * @return class-string<T>
     */
    public function getClass(): string
    {
        return $this->class;
    }

    /**
     * @return bool
     */
    public function hasSourceObject(): bool
    {
        return !is_null($this->sourceObject);
    }

    /**
     * @return T
     */
    public function getSourceObject(): object
    {
        if (!$this->hasSourceObject()) {
            throw new UnexpectedValueException('???');
        }
        /** @phpstan-ignore return.type */
        return $this->sourceObject;
    }

    /**
     * @param T $sourceObject
     * @return void
     */
    public function setSourceObject(object $sourceObject): void
    {
        $class = $this->getClass();
        if (!$sourceObject instanceof $class) {
            throw new InvalidArgumentException('???');
        }
        $this->sourceObject = $sourceObject;
    }

    /**
     * @return void
     */
    public function unsetSourceObject(): void
    {
        $this->sourceObject = null;
    }

    /**
     * @return non-empty-string
     */
    protected function getCode(): string
    {
        $lines = [];

        $class = $this->getClass();

        $lines[] = 'return new class extends ' . $class;
        $lines[] = '{';
        $lines[] = 'public function __construct() {}';
        $lines[] = '};';

        return implode("\n", $lines);
    }

    /**
     * @return T
     */
    public function create(): object
    {
        /** @var T $puppet */
        $puppet = eval($this->getCode());

        if ($this->hasSourceObject()) {
            // TODO: copy values of properties
        }

        return $puppet;
    }
}
