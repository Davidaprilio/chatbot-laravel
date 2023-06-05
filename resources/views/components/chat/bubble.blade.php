@php
    // parse text \n to <br>
    $text = str_replace("\n", "<br>", $chat->text ?? $slot);
@endphp


<div @class(['chat-message', 'chat-message--answer' => $chat->from_me])>
    @if ($chat->from_me)
        <div class="chat-message__content">
            <a class="chat-message__icon color-teal" href="#">
                <div class="chat-message__icon-text">DP</div>
            </a>
            <div class="chat-message__right">
                <div class="chat-message__messages">
                    <div class="chat-message__message-group">
                        @if ($chat->reference_message)
                            <a href="{{ url("message/{$chat->reference_message->flow_chat_id}/credit?id={$chat->reference_message->id}") }}">
                                <small>{{ $chat->reference_message->title }}</small>
                            </a>
                        @endif
                        <div class="chat-message__message-item">
                            <p class="chat-message__item-text">{!! $text !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="chat-message__content">
            <a class="chat-message__icon color-teal" href="#">
                <div class="chat-message__icon-text"></div>
                <img src="{{ $customer->photo }}" alt="#" />
            </a>
            <div class="chat-message__right">
                <div class="chat-message__messages">
                    <div class="chat-message__message-group">
                        <div class="chat-message__message-item">
                            <p class="chat-message__item-text">{!! $text !!}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="chat-message__bottom">
        <div class="chat-message__time">{{ $chat->created_at->diffForHumans() }}</div>
        @if ($chat->image)
        <div class="chat-message__files">
            <div class="chat-message__files-items">
                <div class="chat-message__file">
                    <img src="{{ $chat->image }}" width="56" alt="#" />
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
