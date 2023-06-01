@props([
    'active' => false,
    'href' => '#',
    'name' => 'Untitled Menu',
    'icon' => null,
])

<li class="sidebar__menu-item">
    <a @class(['sidebar__link', 'active' => $active]) href="{{ $href }}" aria-expanded="false">
        @if ($icon === null)
            <span class="sidebar__link-signal"></span>
        @else
        <span class="sidebar__link-icon">
            @if ($icon instanceof \Illuminate\View\ComponentSlot)
                {!! $icon !!}
            @else
                <i class="{{ $icon }}"></i>
            @endif
        </span>
        @endif
        <span class="sidebar__link-text">{{ $slot->isNotEmpty() ? $slot : $name }}</span>
    </a>
</li>
