@props([
    'icon' => 'fa fa-plus',
    'href' => '#',
    'as' => 'a'
])

@push('page-tools-right')
<div class="page-tools__right-item">
    <{{ $as }} {{ $attributes->merge(['href' => $href])->class(['btn']) }}>
        <span class="button-icon__icon">
            <i class="{{ $icon }}"></i>
        </span>
        {{ $slot }}
    </{{ $as }}>
</div>
@endpush