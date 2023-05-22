<aside class="sidebar">
    <div class="sidebar__backdrop"></div>
    <div class="sidebar__container">
        <div class="sidebar__top">
            <div class="container container--sm">
                <a class="sidebar__logo" href="index.html">
                    <img class="sidebar__logo-icon" src="assets/img/content/logotype.svg" alt="#" width="44" />
                    <div class="sidebar__logo-text">Chatbot</div>
                </a>
            </div>
        </div>
        <div class="sidebar__content" data-simplebar="data-simplebar">
            <nav class="sidebar__nav">
                <ul class="sidebar__menu">
                    <li class="sidebar__menu-item"><a class="sidebar__link {{ Request::is('dashboard*') ? 'active' : '' }}" href="{{ url('dashboard') }}"
                            aria-expanded="true"><span class="sidebar__link-icon">
                                <svg class="icon-icon-dashboard">
                                    <use xlink:href="#icon-dashboard"></use>
                                </svg></span><span class="sidebar__link-text">Dashboard</span></a>
                    </li>
                    <li class="sidebar__menu-item"><a class="sidebar__link {{ Request::is('user*') ? 'active' : '' }}" href="{{ url('user') }}"
                            aria-expanded="false"><span class="sidebar__link-icon">
                                <svg class="icon-icon-user">
                                    <use xlink:href="#icon-user"></use>
                                </svg></span><span class="sidebar__link-text">Data User</span></a>
                    </li>
                    <li class="sidebar__menu-item"><a class="sidebar__link {{ Request::is('chat*') ? 'active' : '' }}" href="{{ url('chat') }}"
                            aria-expanded="false"><span class="sidebar__link-icon">
                                <svg class="icon-icon-chat">
                                    <use xlink:href="#icon-chat"></use>
                                </svg></span><span class="sidebar__link-text">Chat</span></a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
</aside>