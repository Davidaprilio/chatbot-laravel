<aside class="sidebar">
    <div class="sidebar__backdrop"></div>
    <div class="sidebar__container">
        <div class="sidebar__top">
            <div class="container container--sm">
                <a class="sidebar__logo" href="index.html">
                    <img class="sidebar__logo-icon" src="{{ url('/') }}/assets/img/content/logotype.svg"
                        alt="#" width="44" />
                    <div class="sidebar__logo-text">Chatbot</div>
                </a>
            </div>
        </div>
        <div class="sidebar__content" data-simplebar="data-simplebar">
            <nav class="sidebar__nav">
                <ul class="sidebar__menu">
                    <li class="sidebar__menu-item"><a
                            class="sidebar__link {{ Request::is('dashboard*') ? 'active' : '' }}"
                            href="{{ url('dashboard') }}" aria-expanded="true"><span class="sidebar__link-icon">
                                <svg class="icon-icon-dashboard">
                                    <use xlink:href="#icon-dashboard"></use>
                                </svg></span><span class="sidebar__link-text">Dashboard</span></a>
                    </li>
                    <li class="sidebar__menu-item"><a class="sidebar__link {{ Request::is('user*') ? 'active' : '' }}"
                            href="{{ url('user') }}" aria-expanded="false"><span class="sidebar__link-icon">
                                <svg class="icon-icon-user">
                                    <use xlink:href="#icon-user"></use>
                                </svg></span><span class="sidebar__link-text">Data User</span></a>
                    </li>
                    <li class="sidebar__menu-item"><a
                            class="sidebar__link {{ Request::is('graph-message*') ? 'active' : '' }}"
                            href="{{ url('graph-message') }}" aria-expanded="false" target="_chatbottemplate"><span
                                class="sidebar__link-icon">
                                <svg class="icon-icon-chat">
                                    <use xlink:href="#icon-chat"></use>
                                </svg></span><span class="sidebar__link-text">Chatbot Template</span></a>
                    </li>
                    <li class="sidebar__menu-item"><a
                            class="sidebar__link {{ Request::is('device*') ? '' : 'collapsed' }}" href="#"
                            data-toggle="collapse" data-target="#Auth"
                            aria-expanded="{{ Request::is('device*') ? 'true' : 'false' }}"><span
                                class="sidebar__link-icon">
                                <svg class="icon-icon-password">
                                    <use xlink:href="#icon-password"></use>
                                </svg></span><span class="sidebar__link-text">Whatsapp</span><span
                                class="sidebar__link-arrow">
                                <svg class="icon-icon-keyboard-down">
                                    <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span></a>
                        <div class="collapse {{ Request::is('device*') ? 'show' : '' }}" id="Auth" style="">
                            <ul class="sidebar__collapse-menu">
                                <li class="sidebar__menu-item"><a class="sidebar__link"
                                        href="{{ url('device') }}"><span class="sidebar__link-signal"></span><span
                                            class="sidebar__link-text">Device</span></a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li class="sidebar__menu-item"><a
                            class="sidebar__link {{ Request::is('customer*') ? 'active' : '' }}"
                            href="{{ url('customer') }}" aria-expanded="false"><span class="sidebar__link-icon">
                                <svg class="icon-icon-list">
                                    <use xlink:href="#icon-list"></use>
                                </svg></span><span class="sidebar__link-text">Customer</span></a>
                    </li>
                    <x-menu-tree name="Chatbot Setting" icon="fa fa-user" :is-open="Request::is('chatbot*')">
                        <x-menu-item name="Flow chat" :href="route('flowchat.index')" />
                        <x-menu-item name="Messages" :href="route('message')" />
                        <x-menu-item name="Action Replies" :href="route('action-replies')" />
                    </x-menu-tree>
                </ul>
            </nav>
        </div>
    </div>
</aside>
