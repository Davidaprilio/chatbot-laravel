@props([
    'name' => 'Untitled Menu',
    'id' => null,
    'isOpen' => false,
    'icon'
])

@php
    $id = $id ?? (Str::slug($name).'-'.Str::random(5));
@endphp

<li class="sidebar__menu-item">
    <a class="sidebar__link {{ $isOpen ? '' : 'collapsed' }}" href="#" data-toggle="collapse" data-target="#{{ $id }}" aria-expanded="{{ $isOpen ? 'true' : 'false' }}">
        <span class="sidebar__link-icon">
            @if ($icon instanceof \Illuminate\Support\HtmlString)
                {{ $icon }}
            @else
                <i class="{{ $icon }}"></i>
            @endif
        </span>
        <span class="sidebar__link-text">{{ $name }}</span>
        <span class="sidebar__link-arrow">
            <svg class="icon-icon-keyboard-down">
                <use xlink:href="#icon-keyboard-down"></use>
            </svg>
        </span>
    </a>
    <div class="collapse {{ $isOpen ? 'show' : '' }}" id="{{ $id }}" style="">
        <ul class="sidebar__collapse-menu">
            {{ $slot }}
        </ul>
    </div>
</li>