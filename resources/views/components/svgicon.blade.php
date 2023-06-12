@props([
    'link'
])
<svg class="icon-{{ $link }}">
    <use xlink:href="#{{ $link }}"></use>
</svg>