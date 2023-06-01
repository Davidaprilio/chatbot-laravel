<a {{ $attributes->class(['chat-users__item'])->merge(['href' => '#']) }} >
    <x-chat.avatar :customer="$customer" />
    <div class="chat-users__item-right">
        <h5 class="chat-users__item-name">{{ $customer->name ?? $customer->pushname }}</h5>
        <div class="chat-users__item-right-group">
            <span class="chat-users__item-time">{{ $customer->last_chat }}</span>
        </div>
        <div class="chat-users__item-message">
            <p class="chat-users__item-text">{{ Str::limit($customer->last_chat, 100, '...') ?? 'Belum ada pesan' }}</p>
        </div>
    </div>
</a>
