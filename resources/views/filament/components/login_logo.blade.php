{{-- resources/views/components/filament/logo.blade.php --}}
<a href="{{ url('/') }}" class="inline-flex items-center justify-center">
    {{-- Light theme logo --}}
    <img
        src="{{ asset('images/logo/black.svg') }}"
        alt="Logo"
        class="block dark:hidden h-10 w-auto"
        style="width:200px;heigth:50px;"
    >

    {{-- Dark theme logo --}}
    <img
        src="{{ asset('images/logo/white.svg') }}"
        alt="Logo"
        class="hidden dark:block h-10 w-auto"
        style="width:200px;heigth:50px;"
    >
</a>

