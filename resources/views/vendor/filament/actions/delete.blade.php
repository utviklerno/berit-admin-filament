@php
    $recordKey = $getRecord()?->getKey();
@endphp

<button
    type="button"
    class="custom-button-container right notext"
    wire:click="callAction('delete', { record: '{{ $recordKey }}' })">
    <x-custom-icon name="trash" />
    <span class="label">Delete</span>
</button>
