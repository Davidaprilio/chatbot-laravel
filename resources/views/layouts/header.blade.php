<header class="header">
    <div class="header__inner">
        <div class="container-fluid">
            <div class="header__row row justify-content-between">
                <div class="header__col-left col d-flex align-items-center">
                    <div class="header__left-toggle">
                        <button class="header__toggle-menu toggle-sidebar" type="button">
                            <svg class="icon-icon-menu">
                                <use xlink:href="#icon-menu"></use>
                            </svg>
                        </button>
                        {{-- <button class="header__toggle-search toggle-search">
                            <svg class="icon-icon-search">
                                <use xlink:href="#icon-search"></use>
                            </svg>
                        </button> --}}
                    </div>
                    {{-- <div class="header__search">
                        <form class="form-search" action="#" method="GET">
                            <div class="form-search__container"><span class="form-search__icon-left">
                                    <svg class="icon-icon-search">
                                        <use xlink:href="#icon-search"></use>
                                    </svg></span>
                                <input class="form-search__input" type="text" placeholder="Search..." />
                            </div>
                        </form>
                    </div> --}}
                </div>
                <div class="header__col-right col d-flex align-items-center">
                    <div class="header__language dropdown">
                        <a href="{{ route('graph-message') }}" class="header__toggle-language btn btn-sm border"
                            type="button" data-tippy-content="Open&nbsp;Graph&nbsp;Message"
                            data-tippy-placement="bottom">
                            <i class="fa fa-diagram-project"></i>
                        </a>
                    </div>
                    <div class="header__tools">
                        <div class="header__notes header__tools-item">
                            <a class="header__tools-toggle header__tools-toggle--message" href="#"
                                data-tippy-content="Notifications" data-tippy-placement="bottom" data-toggle="dropdown">
                                <svg class="icon-icon-message">
                                    <use xlink:href="#icon-message"></use>
                                </svg> <span class="badge-signal"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu__top dropdown-menu__item"><span
                                        class="dropdown-menu__title">Notifications</span><span
                                        class="badge badge--red">5</span><a class="dropdown-menu__clear-all"
                                        href="#" role="button">Clear All</a>
                                </div>
                                <div class="dropdown-menu__items scrollbar-thin scrollbar-visible"
                                    data-simplebar="data-simplebar">
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__note" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-green">
                                                    <svg class="icon-icon-cart">
                                                        <use xlink:href="#icon-cart"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <h4 class="dropdown-menu__item-title">New Order Received</h4><span
                                                    class="dropdown-menu__item-time">25 min ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__note" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-orange">
                                                    <svg class="icon-icon-bill">
                                                        <use xlink:href="#icon-bill"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <h4 class="dropdown-menu__item-title">New invoice received</h4><span
                                                    class="dropdown-menu__item-time">5 hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__note" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-teal">
                                                    <svg class="icon-icon-truck">
                                                        <use xlink:href="#icon-truck"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <h4 class="dropdown-menu__item-title">new batch is shipped</h4><span
                                                    class="dropdown-menu__item-time">10 hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__note" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-green">
                                                    <svg class="icon-icon-cart">
                                                        <use xlink:href="#icon-cart"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <h4 class="dropdown-menu__item-title">New Order Received</h4><span
                                                    class="dropdown-menu__item-time">25 min ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__note" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-orange">
                                                    <svg class="icon-icon-bill">
                                                        <use xlink:href="#icon-bill"></use>
                                                    </svg>
                                                </div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <h4 class="dropdown-menu__item-title">New invoice received</h4><span
                                                    class="dropdown-menu__item-time">5 hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-menu__divider"></div><a
                                    class="dropdown-menu__item dropdown-menu__link-all" href="#">View all
                                    Notifications
                                    <svg class="icon-icon-keyboard-right">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </div>
                        </div>
                        <div class="header__messages header__tools-item">
                            <a class="header__tools-toggle header__tools-toggle--bell" href="#"
                                data-tippy-content="Messages" data-tippy-placement="bottom" data-toggle="dropdown">
                                <svg class="icon-icon-bell">
                                    <use xlink:href="#icon-bell"></use>
                                </svg> <span class="badge-signal"></span>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-menu__top dropdown-menu__item"><span
                                        class="dropdown-menu__title">Messages</span><span
                                        class="badge badge--red">7</span><a class="dropdown-menu__clear-all"
                                        href="#" role="button">Clear All</a>
                                </div>
                                <div class="dropdown-menu__items scrollbar-thin scrollbar-visible"
                                    data-simplebar="data-simplebar">
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-teal">
                                                    <div class="dropdown-menu__item-icon-text">MA</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-4.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal badge-signal--green"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">
                                                        {{ auth()->user()->nama ?? 'User' }}</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">25 min ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-orange-dark">
                                                    <div class="dropdown-menu__item-icon-text">JT</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-1.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal badge-signal--green"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">Jennifer Tang</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">3 hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-orange">
                                                    <div class="dropdown-menu__item-icon-text">SA</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-5.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">Stephen Allen</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">10 hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-red">
                                                    <div class="dropdown-menu__item-icon-text">WS</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-6.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal badge-signal--red"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">Walter Sanders</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">30 min ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-blue">
                                                    <div class="dropdown-menu__item-icon-text">SA</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-5.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal badge-signal--green"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">Stephen Allen</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">2h hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-green">
                                                    <div class="dropdown-menu__item-icon-text">JH</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-7.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">John Hendrix</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">8 hours ago</span>
                                            </div>
                                        </a>
                                    </div>
                                    <div class="dropdown-menu__item">
                                        <a class="dropdown-menu__item-remove" href="#">
                                            <svg class="icon-icon-cross">
                                                <use xlink:href="#icon-cross"></use>
                                            </svg>
                                        </a>
                                        <a class="dropdown-menu__item-block dropdown-menu__message" href="#">
                                            <div class="dropdown-menu__item-left">
                                                <div class="dropdown-menu__item-icon color-orange">
                                                    <div class="dropdown-menu__item-icon-text">RH</div>
                                                    <img src="{{ url('/') }}/assets/img/content/humans/item-8.jpg"
                                                        alt="#" />
                                                </div>
                                                <div class="badge-signal badge-signal--red"></div>
                                            </div>
                                            <div class="dropdown-menu__item-right">
                                                <div class="dropdown-menu__item-column">
                                                    <h4 class="dropdown-menu__item-title">Ryan Henderson</h4>
                                                    <p class="dropdown-menu__text">Nemo enim ipsam voluptatem Nemo enim
                                                        ipsam voluptatem</p>
                                                </div><span class="dropdown-menu__item-time">5 min ago</span>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                                <div class="dropdown-menu__divider"></div><a
                                    class="dropdown-menu__item dropdown-menu__link-all" href="#">View all
                                    Messages
                                    <svg class="icon-icon-keyboard-right">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </div>
                        </div>
                    </div>
                    <div class="header__profile dropdown">
                        <a class="header__profile-toggle dropdown__toggle" href="#" data-toggle="dropdown">
                            <div class="header__profile-image"><span class="header__profile-image-text">MA</span>
                                <img src="{{ url('/') }}/assets/img/content/humans/item-4.jpg" alt="#" />
                            </div>
                            <div class="header__profile-text"><span>{{ auth()->user()->name ?? 'User' }}</span>
                            </div><span class="icon-arrow-down">
                                <svg class="icon-icon-arrow-down">
                                    <use xlink:href="#icon-arrow-down"></use>
                                </svg></span>
                        </a>
                        <div class="profile-dropdown dropdown-menu dropdown-menu--right">
                            <a class="profile-dropdown__item dropdown-menu__item" href="{{ url('profile') }}"
                                tabindex="0"><span class="profile-dropdown__icon">
                                    <svg class="icon-icon-user">
                                        <use xlink:href="#icon-user"></use>
                                    </svg></span><span>My Profile</span></a>
                            <a class="profile-dropdown__item dropdown-menu__item" href="#" tabindex="0"><span
                                    class="profile-dropdown__icon">
                                    <svg class="icon-icon-chat">
                                        <use xlink:href="#icon-chat"></use>
                                    </svg></span><span>My chat</span></a>
                            <a class="profile-dropdown__item dropdown-menu__item" href="{{ route('logout') }}"
                                tabindex="0">
                                <span class="profile-dropdown__icon">
                                    <svg class="icon-icon-logout">
                                        <use xlink:href="#icon-logout"></use>
                                    </svg>
                                </span>
                                <span>Logout</span></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
