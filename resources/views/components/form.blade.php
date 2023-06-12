@props([
    'model' => null,
    'method' => 'GET',
    'file' => false,
])

<form {{ $attributes->merge([
    'enctype' => $file ? 'multipart/form-data' : false,
    'method' => $method != 'GET' ? 'POST' : false,
]) }}>
    @if ($method != 'GET')
        @csrf
        @if ($method != 'POST')
            @method($method)
        @endif
    @endif
    {{ $slot }}    
</form>