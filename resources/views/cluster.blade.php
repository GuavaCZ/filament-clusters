<x-dynamic-component
    :component="$getFieldWrapperView()"
    :field="$field"
>
    <x-filament::input.wrapper
        @class([
            "guava-fi-cl-cluster",
            ...$field->getResponsiveClasses(),
        ])
    >
        {{ $getChildComponentContainer() }}
    </x-filament::input.wrapper>

    <div class="flex flex-col">
        @foreach($field->getChildComponents() as $child)
            @if ($childStatePath = $child->getStatePath())
                @if($errors->has($childStatePath) )
                    <x-filament-forms::field-wrapper.error-message>
                        {{ $errors->first($childStatePath) }}
                    </x-filament-forms::field-wrapper.error-message>
                @endif
            @endif
        @endforeach
    </div>
</x-dynamic-component>
