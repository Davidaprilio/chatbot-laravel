@extends('layouts.admin')

@push('head')
@viteReactRefresh
@vite(['resources/js/app.jsx', "resources/js/Pages/{$page['component']}.jsx"])
@inertiaHead
@routes
@endpush

@section('content')
<main @class(['page-content', ($main_class ?? '') => isset($main_class)]) @style(collect($main_style)->map(fn($v, $k) => "$k: $v")->implode(';'))>
    @inertia
</main>
@endsection