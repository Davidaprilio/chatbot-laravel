@props([
    'title' => 'Title',
    'breadcrumbs' => [],
])


<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">{{ $title }}</h1>
        </div>
        <div class="page-tools">
            <div class="page-tools__breadcrumbs">
                <div class="breadcrumbs">
                    <div class="breadcrumbs__container">
                        <ol class="breadcrumbs__list">
                            @foreach ($breadcrumbs as $text => $url)
                            @php
                            if ($text == strip_tags($text)) $text = Str::limit($text, 30);
                            @endphp
                            <li @class([
                                'breadcrumbs__item', 
                                'active' => $loop->last,
                                'disabled' => $url == '#'
                            ])>
                                @if (!$loop->last)
                                    <a class="breadcrumbs__link" href="{{ $url }}">
                                        <span>{!! $text !!}</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg>
                                    </a>
                                @else
                                    <span class="breadcrumbs__link">{!! $text !!}</span>
                                @endif
                            </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
            </div>
            <div class="page-tools__right">
                <div class="page-tools__right-row">
                    @stack('page-tools-right')
                </div>
            </div>
        </div>
        @include('layouts.alerts')
        
        {{ $slot }}
    </div>
</main>
