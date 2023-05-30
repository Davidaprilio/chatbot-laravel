@extends('layouts.admin')

@push('head')
@viteReactRefresh
@vite(['resources/js/appAdmin.jsx', "resources/js/Pages/{$page['component']}.jsx"])
@inertiaHead
@routes
@endpush

@section('content')
<x-page-content :title="$title ?? ''" :breadcrumbs="$breadcrumbs">
    <main @class([($main_class ?? '') => isset($main_class)]) @style(collect($main_style ?? [])->map(fn($v, $k) => "$k: $v")->implode(';'))>
        @inertia
    </main>
</x-page-content>
@endsection