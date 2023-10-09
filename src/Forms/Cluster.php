<?php

namespace Guava\FilamentClusters\Forms;

use Filament\Forms\Components\Component;
use Filament\Forms\Components\Concerns\BelongsToContainer;
use Filament\Forms\Components\Concerns\CanBeAutofocused;
use Filament\Forms\Components\Concerns\CanBeMarkedAsRequired;
use Filament\Forms\Components\Concerns\CanBeValidated;
use Filament\Forms\Components\Concerns\HasChildComponents;
use Filament\Forms\Components\Concerns\HasHelperText;
use Filament\Forms\Components\Concerns\HasHint;
use Filament\Forms\Components\Concerns\HasName;
use Filament\Forms\Components\Field;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\HasInlineLabels;
use Illuminate\Support\Arr;

class Cluster extends Component
{
    use CanBeAutofocused;
    use CanBeMarkedAsRequired;
    use CanBeValidated;
    use HasHelperText;
    use HasHint;
    use HasName;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    protected string $viewIdentifier = 'field';

    protected string $view = 'filament-clusters::cluster';

    public function getChildComponents(): array
    {
        return Arr::map(
            parent::getChildComponents(),
            function (Component $component) {
                return $component
                    ->fieldWrapperView('filament-clusters::field-wrapper');
            });
    }

    public static function make(array $schema = []): static
    {

        $component = app(static::class, [
            'name' => 'cluster',
        ])
            ->when(
                !empty($schema),
                fn(Component $component) => $component->schema($schema)
            )
            ->required(fn(Cluster $component) => Arr::first(
                    $component->getChildComponents(),
                    fn(Component $component) => $component instanceof Field && $component->isRequired()
                ) !== null
            );

        return $component
            ->columns(count($component->getChildComponents()));
    }

}
