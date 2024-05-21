<?php

namespace Guava\FilamentClusters\Forms\Concerns;

use Closure;
use Illuminate\View\ComponentAttributeBag;

/**
 * Class copied from from here:
 * https://github.com/filamentphp/filament/blob/v3.2.80/packages/forms/src/Components/Concerns/HasExtraFieldWrapperAttributes.php
 *
 * See more here:
 * https://github.com/GuavaCZ/filament-clusters/pull/11
 */
trait HasExtraFieldWrapperAttributes
{
    /**
     * @var array<array<mixed> | Closure>
     */
    protected array $extraFieldWrapperAttributes = [];

    /**
     * @param  array<mixed> | Closure  $attributes
     */
    public function extraFieldWrapperAttributes(array | Closure $attributes, bool $merge = false): static
    {
        if ($merge) {
            $this->extraFieldWrapperAttributes[] = $attributes;
        } else {
            $this->extraFieldWrapperAttributes = [$attributes];
        }

        return $this;
    }

    /**
     * @return array<mixed>
     */
    public function getExtraFieldWrapperAttributes(): array
    {
        $temporaryAttributeBag = new ComponentAttributeBag();

        foreach ($this->extraFieldWrapperAttributes as $extraFieldWrapperAttributes) {
            $temporaryAttributeBag = $temporaryAttributeBag->merge($this->evaluate($extraFieldWrapperAttributes));
        }

        return $temporaryAttributeBag->getAttributes();
    }

    public function getExtraFieldWrapperAttributesBag(): ComponentAttributeBag
    {
        return new ComponentAttributeBag($this->getExtraFieldWrapperAttributes());
    }
}
