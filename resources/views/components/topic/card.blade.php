@props([
    'topic'
])
<div class="order-notes__item">
    <div class="order-note">
        <div class="order-note__container">
            <div class="order-note__top">
                <div class="order-note__date">
                    <time datetime="2018-07-12">{{ $topic->created_at->isoFormat('LLL') }}</time>
                    • from {{ $topic->chat_session_id }}
                </div>
                <div class="order-note__top-right">
                    <a class="order-note__button-push" href="#">
                        <x-svgicon link="icon-pushpin" />
                    </a>
                </div>
            </div>
            <div class="order-note__content">
                <h3 class="order-note__title"><span>{{ $topic->name }}</span></h3>
                <div class="order-note__description">
                    <p>{{ $topic->description }}</p>
                </div>
            </div>
        </div>
    </div>
</div>