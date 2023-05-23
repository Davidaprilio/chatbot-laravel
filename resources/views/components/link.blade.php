@props([
    'href' => '#',
    'icon' => null,
    'method' => 'GET',
    'id' => null,
])

@php
    $method = strtoupper($method);
    $id = $id ?? Str::random(10).'-form';
@endphp

<a href="{{ $href }}" {{ $attributes->merge([
    'prevent-default' => $method != 'GET' ? 'on' : false,
    'data-target' => $method != 'GET' ? '#'.$id : false,
]) }}>
    {{ $slot }}
</a>
@if ($method != 'GET')
<x-form action="{{ $href }}" :method="$method" class="d-none" :id="$id" {{ $attributes->except([
    'href',
    'icon',
    'prevent-default',
    'data-target',
]) }}>
    <button type="submit">submit</button>
</x-form>
@endif