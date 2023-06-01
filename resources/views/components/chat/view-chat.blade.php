@props([
    'customer' => null,
    'fail_load' => false,
])
<div class="chat-details" data-customer-id="{{ $customer->id ?? '' }}">
    <div class="chat-details__backdrop"></div>
    @if ($customer)
        <div class="chat-details__top">
            <div class="chat-details__top-left">
                <button class="chat-details__toggle toggle-sidebar toggle-sidebar--secondary" type="button">
                    <svg class="icon-icon-chevron">
                        <use xlink:href="#icon-chevron"></use>
                    </svg>
                </button>
                <a class="media-item media-item--medium" href="#">
                    <x-chat.avatar :customer="$customer" />
                    <div class="media-item__right">
                        <h5 class="media-item__title font-weight-medium">{{ $customer->name }}</h5>
                        <div class="text-sm text-grey">{{ $customer->last_chat }}</div>
                    </div>
                </a>
            </div>
            <div class="chat-details__top-right">
                <div class="items-more position-relative">
                    <button class="items-more__button">
                        <svg class="icon-icon-more">
                            <use xlink:href="#icon-more"></use>
                        </svg>
                    </button>
                    <div class="dropdown-items dropdown-items--right">
                        <div class="dropdown-items__container">
                            <ul class="dropdown-items__list">
                                <li class="dropdown-items__item">
                                    <a href="{{ route('customer.credit') }}" class="dropdown-items__link">Edit data</a>
                                </li>
                                <li class="dropdown-items__item">
                                    <a class="dropdown-items__link">Arsipkan</a>
                                </li>
                                <li class="dropdown-items__item">
                                    <a href="https://wa.me/{{ $customer->phone }}" class="dropdown-items__link">Hubungi</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <div class="chat-details__content scrollbar-thin scrollbar-hidden" data-simplebar>
        @if ($customer)
            @foreach ($sessions as $session)
            <div class="position-relative">
                <div class="chat-details__date position-sticky py-1" style="top: 0; z-index: 20; background: linear-gradient(180deg, rgba(255,255,255,1) 0%, rgba(255,255,255,0) 100%);">Session #{{ $session->id }} -
                    {{ $session->created_at->isoFormat('LL') }}</div>
                @foreach ($session->chats as $chat)
                    <x-chat.bubble :chat="$chat" :customer="$customer" />
                @endforeach
            </div>
            @endforeach
        @else
            <div class="d-flex justify-content-center align-items-center mt-5 pt-5 flex-column">
                <div class="text-secondary">
                    <x-svgicon link="icon-chat" />
                </div>
                <h2 class="text-black-50">Click on a user to view chatting</h2>
            </div>
        @endif

        @if ($fail_load)
        <div class="d-flex justify-content-center align-items-center mt-5 pt-5 flex-column">
            <div class="text-secondary">
                <x-svgicon link="icon-chat" />
            </div>
            <h2 class="text-black-50">Opps, fail load chats content</h2>
        </div>
        @endif
    </div>

    {{-- place input here --}}
</div>
