@extends('layouts.admin')

@section('content')
    <style>
        .chat-details__content {
            height: calc(100vh - var(--header-height) - var(--chat-top-height));
        }
    </style>
    <main class="page-content page-content--full">
        <div class="chat-grid">
            <div class="chat-users">
                <div class="chat-users__top">
                    <form class="chat-users__search" method="GET">
                        <div class="input-group input-group--prepend">
                            <div class="input-group__prepend">
                                <x-svgicon link="icon-search" />
                            </div>
                            <input class="input" type="text" placeholder="Search...">
                        </div>
                    </form>
                    <div class="chat-users__top-right">
                        <button class="chat-users__button-add-users button-icon button-icon--small"
                            data-toggle="users-add-list">
                            <span class="button-icon__icon">
                                <x-svgicon link="icon-plus" />
                            </span>
                            <span class="button-icon__icon">
                                <x-svgicon link="icon-chevron" />
                            </span>
                        </button>
                    </div>
                </div>
                <div class="chat-users__add-content scrollbar-thin scrollbar-hidden" data-simplebar>
                    <ul class="chat-users__list">
                        <li class="chat-users__list-header">B</li>
                        <li class="chat-users__list-item">
                            <a class="chat-users__item" href="#">
                                <div class="chat-users__item-avatar color-teal">
                                    <div class="chat-users__item-avatar-text">BH</div>
                                    <img src="img/content/humans/item-8.jpg" alt="#">
                                </div>
                                <div class="chat-users__item-right">
                                    <h5 class="chat-users__item-name">Billy Hicks</h5>
                                    <div class="text-sm text-grey">Hi there! I'm using chat</div>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="chat-users__content scrollbar-thin scrollbar-hidden" data-simplebar>
                    <ul class="chat-users__list">
                        @foreach ($customers as $customer)
                            <li class="chat-users__list-item">
                                <x-chat.list-item :customer="$customer" data-id="{{ $customer->id }}" class="user-chat-item" />
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div id="chat-detail">
                <x-chat.view-chat />
            </div>
        </div>
    </main>
@endsection


@push('script')
    <script>
        $('.chat-grid').on('click', '.user-chat-item', async function() {
            let id = $(this).data('id');
            showLoading()
            const htmlChatBody = await ajaxPromise({
                url: route('chatting.view', {
                    customer: id
                }),
            }, 'GET')

            $('#chat-detail').html(htmlChatBody);
            // scroll to bottom .chat-details__content.scrollbar-thin
            $('.chat-details__content.scrollbar-thin').scrollTop($('.chat-details__content.scrollbar-thin')[0].scrollHeight);
        })

        function showLoading() {
            $('#chat-detail').html(`<div class="d-flex justify-content-center align-items-center mt-5 pt-5 flex-column">
                <div class="text-secondary mb-4">
                    <i class="fas fa-spinner fa-spin fa-5x"></i>
                </div>
                <h2 class="text-black-50">Loading</h2>
            </div>`);
        }
    </script>
@endpush
