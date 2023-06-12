@extends('layouts.admin')
@php(
    $breadcrums = [
        '<i class="fa fa-home"></i>' => url('/'),
        'Chatting' => '#',
        'Topic' => '#',
    ]
)

@section('content')
    <x-page-content title="Topic" :breadcrumbs="$breadcrums">

        <div class="order-notes">
            {{-- pinned --}}
            <div class="order-notes__top">
                
            </div>

            {{-- other topic --}}
            

        </div>
    </x-page-content>
@endsection
