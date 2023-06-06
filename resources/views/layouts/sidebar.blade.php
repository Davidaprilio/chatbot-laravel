<aside class="sidebar">
    <div class="sidebar__backdrop"></div>
    <div class="sidebar__container">
        <div class="sidebar__top">
            <div class="container container--sm">
                <a class="sidebar__logo" style="justify-content:center" href="{{ url('dashboard') }}">
                    <img class="sidebar__logo-icon" src="{{ web('web_logo') }}" alt="#" style="width: 50px;" />
                    <div class="sidebar__logo-text" style="font-size: 18px">{{ web('web_title') }}</div>
                </a>
            </div>
        </div>
        <div class="dropdown-menu__divider"></div>
        <div class="sidebar__content" data-simplebar="data-simplebar">
            <nav class="sidebar__nav">
                <ul class="sidebar__menu">
                    <x-menu-item name="Dashboard" :href="route('dashboard')"  :active="Request::is('dashboard*')">
                        <x-slot name="icon">
                            <x-svgicon link="icon-dashboard" />
                        </x-slot>
                    </x-menu-item>
                    <x-menu-item name="Data User" :href="route('user')" :role="auth()->user()->role->slug ?? 'customer'" :active="Request::is('user*')">
                        <x-slot name="icon">
                            <x-svgicon link="icon-user" />
                        </x-slot>
                    </x-menu-item>
                    <x-menu-item name="Chatbot Log" :href="route('chatting')" :active="Request::is('chatting*')">
                        <x-slot name="icon">
                            <x-svgicon link="icon-chat" />
                        </x-slot>
                    </x-menu-item>
                    <x-menu-tree name="Whatsapp" icon="fa-brands fa-whatsapp" :is-open="Request::is(['device*', 'kontak*'])">
                        <x-menu-item name="Device" :active="Request::is('device*')" :href="route('device')" />
                        <x-menu-item name="Kontak" :active="Request::is('kontak*')" :href="route('kontak')" />
                    </x-menu-tree>
                    <x-menu-tree name="Chatbot Setting" icon="fa fa-user" :is-open="Request::is(['chatbot*', 'message*', 'action-replies*', 'setting-web*'])">
                        {{-- <x-menu-item name="Template Bot" :active="Request::is('chatbot*')" :href="route('lihat.demo')" /> --}}
                        <x-menu-item name="Flow chat" :active="Request::is('chatbot*')" :href="route('flowchat.index')" />                        
                        <x-menu-item name="Action Replies" :active="Request::is('action-replies*')" :href="route('action-replies')" />
                        <x-menu-item name="Setting Web" :active="Request::is('setting-web*')" :role="auth()->user()->role->slug ?? 'customer'" :href="route('setting-web')" />
                    </x-menu-tree>
                </ul>
            </nav>
        </div>
    </div>
</aside>
