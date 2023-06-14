<div class="items-more">
    <button class="items-more__button">
        <svg class="icon-icon-more">
            <use xlink:href="#icon-more"></use>
        </svg>
    </button>
    <div class="dropdown-items dropdown-items--right">
        <div class="dropdown-items__container">
            <ul class="dropdown-items__list">
                <li class="dropdown-items__item">
                    <a class="dropdown-items__link" href="{{ url('kontak/credit?id=' . $customer->id) }}">
                        <span class="dropdown-items__link-icon">
                            <svg class="icon-icon-view">
                                <use xlink:href="#icon-view"></use>
                            </svg>
                        </span>Edit
                    </a>
                </li>
                <li class="dropdown-items__item">
                    <a class="dropdown-items__link" href="javascript:void(0)"
                        onclick="removeKontak('{{ url('kontak/remove?id=' . $customer->id) }}')">
                        <span class="dropdown-items__link-icon">
                            <svg class="icon-icon-trash">
                                <use xlink:href="#icon-trash"></use>
                            </svg>
                        </span>Delete
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
