@php
    $recordKey = $getRecord()?->getKey();
@endphp

<a
    type="button"
    class="custom-button-container right notext"
    wire:click="mountAction('delete', [], { table: true, recordKey: @js($recordKey) })">
    <x-custom-icon name="trash" />
    <span class="label">Delete</span>
</a>
