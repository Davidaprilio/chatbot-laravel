@props([
    'signal' => true,
    'customer' => null,
])
<div class="chat-users__item-avatar color-orange-dark">
    <div class="chat-users__item-avatar-text"></div>
    @if ($signal)
        @if ($customer->session_active === null)
            <span class="badge-signal badge-signal--red" title="obrolan selesai"></span>
        @else
            <span class="badge-signal badge-signal--green" title="sedang berlangsung"></span>
        @endif
    @endif
    @if ($customer)
        <x-svgicon link="icon-user" class="chat-users__item-avatar-icon" />
        <img src="{{ $customer->photo }}" alt="#">
    @endif
</div>