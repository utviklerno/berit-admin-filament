@props(['name', 'class' => '', 'dataActive' => null])

@php
    $path = public_path("images/icons/icons05/{$name}.svg");
    $url = asset("images/icons/icons05/{$name}.svg");
    $hasData = filled($dataActive);
@endphp

@if (file_exists($path))
    <div class="custom-icon-container {{ $class }}">
        <span
            {{ $attributes->merge([
                'class' => 'icon' . ($hasData ? ' active' : ' inactive'),
            ]) }}
            style="--icon-url:url({{ $url }});{{ $hasData ? '--icon-color:' . ($dataActive === 'active' ? '#339933;' : '#33333322;') : '' }}">
        </span>
    </div>
@endif
