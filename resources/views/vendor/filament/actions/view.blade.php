@php
    /** @var \Filament\Actions\EditAction $action */
    $url = $action->getUrl();    // full edit link
    $label = $action->getLabel() ?? 'Edit';
@endphp

<a
    type="button"
    class="custom-button-container right notext"
    href="{{ $url }}">
    <x-custom-icon name="eyeglasses" />
    <span class="label">{{ $label }}</span>
</a>
