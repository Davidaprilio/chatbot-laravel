@extends('layouts.admin')
@section('content')
    <main class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-header__title">Setting Web</h1>
            </div>
            <div class="page-tools">
                <div class="page-tools__breadcrumbs">
                    <div class="breadcrumbs">
                        <div class="breadcrumbs__container">
                            <ol class="breadcrumbs__list">
                                <li class="breadcrumbs__item">
                                    <a class="breadcrumbs__link" href="index.html">
                                        <svg class="icon-icon-home breadcrumbs__icon">
                                            <use xlink:href="#icon-home"></use>
                                        </svg>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg>
                                    </a>
                                </li>
                                <li class="breadcrumbs__item disabled"><a class="breadcrumbs__link"
                                        href="#"><span>Chatbot Setting</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg></a>
                                </li>
                                <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Setting Web</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <!-- User Profile Content -->
            <div class="row">
                <div class="col-lg-2"></div>
                <div class="col-xl-8 col-lg-8 col-md-5">
                    <div class="card mb-4">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__body">
                                    <div class="row align-items-center">
                                        <div class="col-lg-6">
                                            <h6 class="card-text text-uppercase">About
                                                {{ $web->web_title ?? 'Nama Website' }}</h6>
                                        </div>
                                        <div class="col-lg-6 text-right">
                                            <a class="button-icon" href="#" data-modal="#webEdit">
                                                <span class="button-icon__icon">
                                                    <svg class="icon-icon-task">
                                                        <use xlink:href="#icon-task"></use>
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="dropdown-menu__divider"></div>
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <image width="200" height="200"
                                                src="{{ $web->web_logo ?? url('/assets/img/content/humans-2/item-1.jpg') }}">
                                            </image>
                                        </div>
                                        <div class="col-lg-8">
                                            <ul class="list-unstyled mb-4 mt-3">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <li class="d-flex align-items-center mb-3">
                                                            <i class="ti ti-user"></i>
                                                            <span class="fw-bold mx-2">Nama Website :</span>
                                                            <span>{{ $web->web_title ?? 'Nama Website' }}</span>
                                                        </li>
                                                    </div>
                                                </div>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ User Profile Content -->
        </div>
    </main>

    <div class="modal modal-account modal-compact scrollbar-thin" id="webEdit" data-simplebar>
        <div class="modal__overlay" data-dismiss="modal"></div>
        <div class="modal__wrap">
            <div class="modal__window">
                <div class="modal__content">
                    <button class="modal__close" data-dismiss="modal">
                        <svg class="icon-icon-cross">
                            <use xlink:href="#icon-cross"></use>
                        </svg>
                    </button>
                    <div class="modal__body">
                        <div class="">
                            <div class="modal-account__right tab-content">
                                <div class="modal-account__pane tab-pane fade show active" id="accountDetails">
                                    <div class="modal-account__pane-header">
                                        <h2 id="title-credit">Edit Web</h2>
                                    </div>
                                    <form action="{{ url('/setting-web/store') }}" class="row g-3" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id_web" id="id_web" class="form-control"
                                            value="{{ $web->id }}">
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="web_logo">Logo Website</label>
                                            <input type="file" id="web_logo" name="web_logo" class="form-control input"
                                                placeholder="Doe" />
                                            <input type="hidden" id="logo_text" name="logo_text" class="form-control input"
                                                value="{{ $web->web_logo }}" />
                                        </div>
                                        <div class="col-12 mb-3">
                                            <label class="form-label" for="web_title">Nama Website</label>
                                            <input type="text" id="web_title" name="web_title" class="form-control input"
                                                placeholder="Nama Website" value="{{ $web->web_title }}" />
                                        </div>
                                        <div class="col-12 text-center">
                                            <button type="submit" id="submit-btn"
                                                class="btn btn-primary me-sm-3 me-1">Simpan</button>
                                            <button type="reset" class="btn btn-label-secondary"
                                                data-bs-dismiss="modal" aria-label="Close">
                                                Cancel
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script></script>
@endsection
