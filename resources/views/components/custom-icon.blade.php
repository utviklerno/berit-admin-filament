@props(['name'])

@php
    $path = public_path("images/icons/icons05/{$name}.svg");
    $url = asset("images/icons/icons05/{$name}.svg");
@endphp

@if (file_exists($path))
    <span
        {{ $attributes->merge(['class' => 'icon']) }}
        style="--icon-color:#000;--icon-url: url({{ $url }});">
    </span>
@endif
