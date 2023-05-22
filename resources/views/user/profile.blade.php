@extends('layouts.admin')
<link rel="stylesheet" href="{{ url('/') }}/assets/css/demo.css" />
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css" integrity="sha512-SbiR/eusphKoMVVXysTKG/7VseWii+Y3FdHrt0EpKgpToZeemhqHeZeLWLhJutz/2ut2Vw1uQEj2MbRF+TVBUA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.min.js" integrity="sha512-1/RvZTcCDEUjY/CypiMz+iqqtaoQfAITmNSJY17Myp4Ms5mdxPS5UV7iOfdZoxcGhzFbOm6sntTKJppjvuhg4g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
@section('content')
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">Profile {{ auth()->user()->name ?? 'User' }}</h1>
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
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Profile {{ auth()->user()->name ?? 'User' }}</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card mb-4 p-0">
                    <div class="card__wrapper">
                        <div class="card__container p-0">
                            <div class="card__body">
                                <div class="profile-cover">
                                    <div class="profile-cover-wrap">
                                        <img class="profile-cover-img" src="" alt="Profile Cover">
                                        <div class="cover-content">
                                            <div class="custom-file-btn">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="_token" value="BAFP6g4lgyzCUL4mNuSjkNabC4ECLivDn2Q2Rdvr">                                        <input type="hidden" name="cover" value="cover">
                                                    <input type="file" class="custom-file-btn-input" name="image" id="cover_upload">
                                                    <label class="custom-file-btn-label btn btn-sm btn-white waves-effect waves-light" for="cover_upload">
                                                        <i class="fas fa-camera"></i>
                                                        <span class="d-none d-sm-inline-block ms-1">Update Cover</span>
                                                    </label>
                                                    <button type="submit" id="submit_cover" style="display: none;"></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="text-center mb-1">
                                    <label class="avatar avatar-xxl profile-cover-avatar" for="avatar_upload">
                                        <img class="avatar-img avatar-img-custom" src="https://billing.tokalink.id/JDNN.png" alt="Profile Image">
                                        <form action="" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="_token" value="BAFP6g4lgyzCUL4mNuSjkNabC4ECLivDn2Q2Rdvr">                                <input type="file" id="image_profile" name="image">
                                            <label class="avatar-edit" for="image_profile">
                                                <i class="fas fa-pen"></i>
                                            </label>
                                            <button type="submit" id="submit_profile" style="display: none;"></button>
                                        </form>
                                    </label>
                                </div>
                                <div class="user-profile-header d-flex flex-column flex-sm-row text-sm-center text-center mb-4 mt-4">
                                    <div class="flex-grow-1">
                                        <div class="align-items-md-end align-items-sm-start align-items-center justify-content-md-between justify-content-start mx-4 flex-md-row flex-column gap-4">
                                            <div class="user-profile-info">
                                                <h4>LIFEFORWIN ( Seller )</h4>
                                                <ul class="list-inline mb-0 align-items-center flex-wrap justify-content-sm-start justify-content-center gap-2">
                                                    <li class="list-inline-item"><i class="ti ti-phone-call"></i>
                                                        085604480115</li>
                                                    <li class="list-inline-item"><i class="ti ti-map-pin"></i> KABUPATEN MALINAU
                                                    </li>
                                                    <li class="list-inline-item"><i class="ti ti-mail"></i> majumapanjuara43@gmail.com
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <div class="row">
                                    <div class="col-lg-6">
                                        <h6 class="card-text text-uppercase">About</h6>
                                    </div>
                                    <div class="col-lg-6 text-end">
                                        <a class="button-icon" href="#" data-modal="#accountEdit"><span class="button-icon__icon">
                                        <svg class="icon-icon-task">
                                            <use xlink:href="#icon-task"></use>
                                        </svg></span>
                                        </a>
                                        {{-- <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#accountEdit"><i
                                                class="fa fa-pen"></i>&nbsp;Edit Profile</button>
                                        <button class="btn btn-warning btn-sm" onclick="pass()"><i class="fa fa-key"></i>&nbsp;Edit Password</button> --}}
                                    </div>
                                </div>
                                <div class="dropdown-menu__divider"></div>
                                <ul class="list-unstyled mb-4 mt-3">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-user"></i><span class="fw-bold mx-2">Nama Lengkap :</span>
                                                <span>{{ $user->nama ?? 'User' }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-phone"></i><span class="fw-bold mx-2">Nomor Handphone :</span> 
                                                <span >{{ $user->phone }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-mail"></i><span class="fw-bold mx-2">Email :</span> 
                                                <span >{{ $user->email }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-crown"></i><span class="fw-bold mx-2">Role :</span>
                                                <span>{{ $user->role->name ?? 'Member' }}</span>
                                            </li>
                                        </div>
                                        <div class="col-lg-6">
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-user"></i><span class="fw-bold mx-2">Provinsi :</span>
                                                <span>{{ $user->provinsi ?? 'User' }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-phone"></i><span class="fw-bold mx-2">Kota :</span> 
                                                <span >{{ $user->kota }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-mail"></i><span class="fw-bold mx-2">Kecamatan :</span> 
                                                <span >{{ $user->kecamatan }}</span>
                                            </li>
                                            <li class="d-flex align-items-center mb-3">
                                                <i class="ti ti-crown"></i><span class="fw-bold mx-2">Alamat :</span>
                                                <span>{{ $user->alamat ?? 'Member' }}</span>
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
        <!--/ User Profile Content -->
    </div>
</main>

<div class="modal modal-account modal-compact scrollbar-thin" id="accountEdit" data-simplebar>
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
                    <div class="modal-account__content">
                        <div class="modal-account__left">
                            <div class="modal-account__upload profile-upload js-profile-upload">
                                <input class="profile-upload__input" type="file" name="file_upload" accept="image/png, image/jpeg">
                                <svg class="profile-upload__thumbnail" viewBox="0 0 252 272" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                    <g filter="url(#filter0)">
                                        <path d="M55 199H197V221C197 221 153.752 224 126 224C98.248 224 55 221 55 221V199Z" fill="white" />
                                    </g>
                                    <g filter="url(#filter1)">
                                        <path d="M18.235 43.2287C19.2494 23.1848 35.1848 7.24941 55.2287 6.23501C76.8855 5.13899 104.551 4 126 4C147.449 4 175.114 5.13898 196.771 6.23501C216.815 7.24941 232.751 23.1848 233.765 43.2287C234.861 64.8855 236 92.5512 236 114C236 135.449 234.861 163.114 233.765 184.771C232.751 204.815 216.815 220.751 196.771 221.765C175.114 222.861 147.449 224 126 224C104.551 224 76.8855 222.861 55.2287 221.765C35.1848 220.751 19.2494 204.815 18.235 184.771C17.139 163.114 16 135.449 16 114C16 92.5512 17.139 64.8855 18.235 43.2287Z"
                                        fill="url(#pattern1)" />
                                    </g>
                                    <path class="profile-upload__overlay" opacity="0.6" d="M18.235 43.2287C19.2494 23.1848 35.1848 7.24941 55.2287 6.23501C76.8855 5.13899 104.551 4 126 4C147.449 4 175.114 5.13899 196.771 6.23501C216.815 7.24941 232.751 23.1848 233.765 43.2287C234.861 64.8855 236 92.5512 236 114C236 135.449 234.861 163.114 233.765 184.771C232.751 204.815 216.815 220.751 196.771 221.765C175.114 222.861 147.449 224 126 224C104.551 224 76.8855 222.861 55.2287 221.765C35.1848 220.751 19.2494 204.815 18.235 184.771C17.139 163.114 16 135.449 16 114C16 92.5512 17.139 64.8855 18.235 43.2287Z"
                                    fill="#44566C" />
                                    <defs>
                                        <filter id="filter0" x="23" y="183" width="206" height="89" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                            <feOffset dy="8" />
                                            <feGaussianBlur stdDeviation="8" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                            <feOffset dy="16" />
                                            <feGaussianBlur stdDeviation="16" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0" />
                                            <feBlend mode="normal" in2="effect1_dropShadow" result="effect2_dropShadow" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect2_dropShadow" result="shape" />
                                        </filter>
                                        <filter id="filter1" x="0" y="0" width="252" height="252" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
                                            <feFlood flood-opacity="0" result="BackgroundImageFix" />
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                            <feOffset dy="12" />
                                            <feGaussianBlur stdDeviation="8" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.2 0" />
                                            <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow" />
                                            <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" />
                                            <feOffset dy="2" />
                                            <feGaussianBlur stdDeviation="2" />
                                            <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.05 0" />
                                            <feBlend mode="normal" in2="effect1_dropShadow" result="effect2_dropShadow" />
                                            <feBlend mode="normal" in="SourceGraphic" in2="effect2_dropShadow" result="shape" />
                                        </filter>
                                        <pattern id="pattern1" patternContentUnits="objectBoundingBox" width="1" height="1">
                                            <use xlink:href="#profileImageAddPlaceholder" transform="scale(0.00142857)" />
                                            <use xlink:href="#profileImageAdd" transform="scale(0.00142857)" />
                                        </pattern>
                                        <image id="profileImageAddPlaceholder" width="700" height="700" xlink:href='img/content/upload-placeholder.svg' />
                                        <image id="profileImageAdd" class="profile-upload__image" width="700" height="700" xlink:href='' />
                                    </defs>
                                </svg>
                                <div class="profile-upload__label">
                                    <svg class="icon-icon-camera" width="50px" height="50px">
                                        <use xlink:href="#icon-camera"></use>
                                    </svg>
                                    <p class="mb-0">Click & Drop
                                        <br>to change photo</p>
                                </div>
                            </div>
                            <div class="modal-account__tabs nav">
                                <a class="modal-account__tab active" data-toggle="tab" href="#accountDetails">
                                    <svg class="icon-icon-details">
                                        <use xlink:href="#icon-details"></use>
                                    </svg>Account Details</a>
                                <a class="modal-account__tab" data-toggle="tab" href="#accountShippingAddress">
                                    <svg class="icon-icon-truck">
                                        <use xlink:href="#icon-truck"></use>
                                    </svg>Shipping Address</a>
                                <a class="modal-account__tab" data-toggle="tab" href="#accountPayment">
                                    <svg class="icon-icon-credit-card">
                                        <use xlink:href="#icon-credit-card"></use>
                                    </svg>Payment Methods</a>
                            </div>
                        </div>
                        <div class="modal-account__right tab-content">
                            <div class="modal-account__pane tab-pane fade show active" id="accountDetails">
                                <div class="modal-account__pane-header">
                                    <h2>Account details</h2>
                                </div>
                                <form>
                                    <div class="row row--md">
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">First Name: *</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="" value="Felecia" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Last Name: *</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="" value="Burke" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">E-Mail: *</label>
                                            <div class="input-group">
                                                <input class="input" type="email" placeholder="" value="example@mail.com" required>
                                            </div>
                                        </div>
                                        <div class="col-12">
                                            <label class="form-label form-label--sm">Date of Birth (optional):</label>
                                            <div class="row row--md">
                                                <div class="col-12 col-lg-4 form-group form-group--lg">
                                                    <div class="input-group input-group--append">
                                                        <select class="input js-input-select input--fluid" data-placeholder="">
                                                            <option value="1" selected="selected">1
                                                            </option>
                                                            <option value="2">2
                                                            </option>
                                                            <option value="3">3
                                                            </option>
                                                            <option value="4">4
                                                            </option>
                                                            <option value="5">5
                                                            </option>
                                                            <option value="6">6
                                                            </option>
                                                            <option value="7">7
                                                            </option>
                                                            <option value="8">8
                                                            </option>
                                                            <option value="9">9
                                                            </option>
                                                            <option value="10">10
                                                            </option>
                                                            <option value="11">11
                                                            </option>
                                                            <option value="12">12
                                                            </option>
                                                            <option value="13">13
                                                            </option>
                                                            <option value="14">14
                                                            </option>
                                                            <option value="15">15
                                                            </option>
                                                            <option value="16">16
                                                            </option>
                                                            <option value="17">17
                                                            </option>
                                                            <option value="18">18
                                                            </option>
                                                            <option value="19">19
                                                            </option>
                                                            <option value="20">20
                                                            </option>
                                                            <option value="21">21
                                                            </option>
                                                            <option value="22">22
                                                            </option>
                                                            <option value="23">23
                                                            </option>
                                                            <option value="24">24
                                                            </option>
                                                            <option value="25">25
                                                            </option>
                                                            <option value="26">26
                                                            </option>
                                                            <option value="27">27
                                                            </option>
                                                            <option value="28">28
                                                            </option>
                                                        </select><span class="input-group__arrow">
                                <svg class="icon-icon-keyboard-down">
                                <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4 form-group form-group--lg">
                                                    <div class="input-group input-group--append">
                                                        <select class="input js-input-select input--fluid" data-placeholder="">
                                                            <option value="1" selected="selected">January
                                                            </option>
                                                            <option value="2">February
                                                            </option>
                                                            <option value="3">March
                                                            </option>
                                                            <option value="4">April
                                                            </option>
                                                            <option value="5">May
                                                            </option>
                                                            <option value="6">June
                                                            </option>
                                                            <option value="7">July
                                                            </option>
                                                            <option value="8">August
                                                            </option>
                                                            <option value="9">September
                                                            </option>
                                                            <option value="10">October
                                                            </option>
                                                            <option value="11">November
                                                            </option>
                                                            <option value="12">December
                                                            </option>
                                                        </select><span class="input-group__arrow">
                                <svg class="icon-icon-keyboard-down">
                                <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-lg-4 form-group form-group--lg">
                                                    <div class="input-group input-group--append">
                                                        <select class="input js-input-select input--fluid" data-placeholder="">
                                                            <option value="1" selected="selected">1990
                                                            </option>
                                                            <option value="2">1991
                                                            </option>
                                                            <option value="3">1992
                                                            </option>
                                                            <option value="4">1993
                                                            </option>
                                                            <option value="5">1994
                                                            </option>
                                                        </select><span class="input-group__arrow">
                                <svg class="icon-icon-keyboard-down">
                                <use xlink:href="#icon-keyboard-down"></use>
                                </svg></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Gender (optional):</label>
                                            <div class="input-group input-group--append">
                                                <select class="input js-input-select input--fluid" data-placeholder="">
                                                    <option value="1" selected="selected">Female
                                                    </option>
                                                    <option value="2">Male
                                                    </option>
                                                </select><span class="input-group__arrow">
                            <svg class="icon-icon-keyboard-down">
                            <use xlink:href="#icon-keyboard-down"></use>
                            </svg></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-account__form-submit">
                                        <button class="button button--primary button--load" type="submit"><span class="button__icon button__icon--left">
                        <svg class="icon-icon-refresh">
                            <use xlink:href="#icon-refresh"></use>
                        </svg></span><span class="button__text">Update</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-account__pane tab-pane fade" id="accountShippingAddress">
                                <div class="modal-account__pane-header">
                                    <h2>Shipping Address</h2>
                                </div>
                                <form>
                                    <div class="row row--md">
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Country: *</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="" value="Chine" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">City: *</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="" value="Beijing" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">House Number and Street: *</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="" value="898 Joanne Lane street" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">ZIP Code: *</label>
                                            <div class="input-group">
                                                <input class="input js-zip-code" type="text" placeholder="" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Phone Number: *</label>
                                            <div class="input-group">
                                                <input class="input js-phone-number" type="text" placeholder="+1 (070) 123-4567" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-account__form-submit">
                                        <button class="button button--primary button--load" type="submit"><span class="button__icon button__icon--left">
                        <svg class="icon-icon-refresh">
                            <use xlink:href="#icon-refresh"></use>
                        </svg></span><span class="button__text">Update</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <div class="modal-account__pane tab-pane fade" id="accountPayment">
                                <div class="modal-account__pane-header">
                                    <h2>Payment methods</h2>
                                </div>
                                <form>
                                    <div class="row row--md">
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Name on Card: *</label>
                                            <div class="input-group">
                                                <input class="input" type="text" placeholder="Felecia Burke" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Card Number: *</label>
                                            <div class="input-group input-group--append">
                                                <input class="input js-card-number" type="text" placeholder="****   ****   ****   1234" required><span class="input-group__append"><img class="add-card__input-number-logo" src="img/content/visa-logo.png" alt="#"></span>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">Expire Date</label>
                                            <div class="input-group">
                                                <input class="input js-card-date" type="text" placeholder="12/2020" required>
                                            </div>
                                        </div>
                                        <div class="col-12 form-group form-group--lg">
                                            <label class="form-label form-label--sm">CVV Code <span class="badge-help" data-tippy-content="CVV Code" data-tippy-placement="top">
                            <svg class="icon-icon-help">
                            <use xlink:href="#icon-help"></use>
                            </svg></span>
                                            </label>
                                            <div class="input-group"></div>
                                            <input class="input js-card-cvv" type="text" placeholder="***" required>
                                        </div>
                                    </div>
                                    <div class="modal-account__form-submit">
                                        <button class="button button--primary button--load" type="submit"><span class="button__icon button__icon--left">
                        <svg class="icon-icon-refresh">
                            <use xlink:href="#icon-refresh"></use>
                        </svg></span><span class="button__text">Update</span>
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

<!-- Edit User Modal -->
<div class="modal fade" id="editUser" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h4 class="mb-2">Edit Profil</h4>
                    {{-- <p class="text-muted">Updating user details will receive a privacy audit.</p> --}}
                </div>
                <form id="editUserForm" class="row g-3" onsubmit="return false">
                    <input type="hidden" name="idUser" value="{{ $user->id }}" id="idUser"
                        class="form-control">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserFirstName">Sapaan</label>
                        <select id="sapaan" name="sapaan" class="form-select"
                            aria-label="Default select example">
                            <option selected>Pilih Sapaan</option>
                            <option value="Pak" {{ $user->sapaan == 'Pak' ? 'selected' : '' }}>Pak</option>
                            <option value="Bu" {{ $user->sapaan == 'Bu' ? 'selected' : '' }}>Bu</option>
                            <option value="Mbak" {{ $user->sapaan == 'Mbak' ? 'selected' : '' }}>Mbak</option>
                            <option value="Mas" {{ $user->sapaan == 'Mas' ? 'selected' : '' }}>Mas</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="panggilan">Nama Panggilan</label>
                        <input type="text" id="panggilan" name="panggilan" class="form-control"
                            placeholder="Doe" value="{{ $user->panggilan }}" />
                    </div>
                    <div class="col-12">
                        <label class="form-label" for="username">Nama Lengkap</label>
                        <input type="text" id="nama" name="nama" class="form-control"
                            placeholder="john.doe.007" value="{{ $user->nama }}" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="email">Email</label>
                        <input type="text" id="email" name="email" class="form-control"
                            placeholder="example@domain.com" value="{{ $user->email }}" />
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="status">Status</label>
                        <select id="status" name="status" class="form-select"
                            aria-label="Default select example">
                            <option value="Aktif">Aktif</option>
                            <option value="Nonaktif">Nonaktif</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" class="form-control phone-number-mask"
                            placeholder="+628xxx" value="{{ $user->phone }}" />
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label" for="provinsi">Provinsi</label>
                        <select id="prov" name="provinsi" class="form-select">
                            {{-- <option value="{{ $user->provinsi }}">{{ $user->provinsi }}</option> --}}
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label" for="kota">Kota/Kabupaten</label>
                        <select id="kab" name="kota" class="form-select">
                            {{-- <option value="{{ $user->kota }}">{{ $user->kota }}</option> --}}
                        </select>
                    </div>
                    <div class="col-12 col-md-4 mb-3">
                        <label class="form-label" for="kecamatan">Kecamatan</label>
                        <select id="kec" name="kecamatan" class="form-select">
                            {{-- <option value="{{ $user->kecamatan }}">{{ $user->kecamatan }}</option> --}}
                        </select>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" id="submit-btn" class="btn btn-primary me-sm-3 me-1">Save</button>
                        <button type="reset" class="btn btn-label-secondary" data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--/ Edit User Modal -->

<!-- Edit Password -->
<div class="modal fade" id="editPassword" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h4 class="mb-2">Edit Profil</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/ Edit Password -->
@endsection
@section('js')
    <script>
        //update profile
        $('#image_profile').change(function() {
            $('#submit_profile').click();
        });
        //update cover
        $('#cover_upload').change(function() {
            $('#submit_cover').click();
        });

        async function oke(val) {
            const {
                value: file
            } = await Swal.fire({
                title: 'Select image',
                input: 'file',
                inputAttributes: {
                    'accept': 'image/*',
                    'aria-label': 'Upload your profile picture'
                }
            })
            if (file) {
                const reader = new FileReader()
                reader.onload = (e) => {
                    Swal.fire({
                        title: 'Your uploaded picture',
                        imageUrl: e.target.result,
                        imageAlt: 'The uploaded picture'
                    })
                }
                reader.readAsDataURL(file)
            }
        }

        async function pass() {
            const {
                value: password
            } = await Swal.fire({
                title: 'Masukan Password Baru',
                input: 'password',
                inputPlaceholder: 'Enter your password',
                confirmButtonText: 'Simpan',
                cancelButtonText: 'Batal',
                showCancelButton: true,
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            })
            if (password) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('profile.edit_password') }}",
                    data: {
                        password: password,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        $('#form_password').hide();
                        $('#password').val('');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Password diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(result) {
                        Swal.fire({
                            position: 'center',
                            icon: 'danger',
                            title: 'Password tidak valid',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        }

        $(document).ready(function(e) {
            $('#imageupload').on('submit', (function(e) {
                e.preventDefault();
                var image = new FormData(this);
                $.ajax({
                    type: 'POST',
                    url: $(this).attr('action'),
                    data: image,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        console.log("success");
                        console.log(data);
                    },
                    error: function(data) {
                        console.log("error");
                        console.log(data);
                    }
                });
            }));
            $("#ImageBrowse").on("change", function() {
                $("#imageUploadForm").submit();
            });
        });

        $('#submit-btn').on('click', function() {
            let url = location.origin + '/profile/store'
            let data = {
                id: $('#idUser').val(),
                sapaan: $('#sapaan').val(),
                panggilan: $('#panggilan').val(),
                nama: $('#nama').val(),
                email: $('#email').val(),
                phone: $('#phone').val(),
                status: $('#status').val(),
                provinsi: $('#prov').val(),
                kota: $('#kab').val(),
                kecamatan: $('#kec').val(),
            }
            // console.log(url,data);
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    data: data
                },
                success: function(res) {
                    $('#editUser').modal('hide')
                    toastr.success(res);
                    // window.location.reload()
                },
                error: function(err) {
                    toastr.error(err.responseJSON.message ?? 'Something went wrong');
                    console.log(err)
                }
            })
        })

        const apiDaerah = new ApiDaerah({
            provinsi: {
                id: 'prov',
                selected: '{{ $user->provinsi }}' || null,
                value: 'name',
            },
            kabupaten: {
                id: 'kab',
                selected: '{{ $user->kota }}' || null,
                value: 'full_name',
                text: 'full_name'
            },
            kecamatan: {
                id: 'kec',
                selected: '{{ $user->kecamatan }}' || null,
                value: 'name',
            },
        })

        async function pass() {
            const {
                value: password
            } = await Swal.fire({
                title: 'Masukan Password Baru',
                input: 'password',
                inputPlaceholder: 'Enter your password',
                confirmButtonText: 'Simpan',
                showCancelButton: true,
                inputAttributes: {
                    maxlength: 10,
                    autocapitalize: 'off',
                    autocorrect: 'off'
                }
            })
            if (password) {
                $.ajax({
                    type: "POST",
                    url: "{{ route('profile.edit_password') }}",
                    data: {
                        password: password,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(result) {
                        $('#form_password').hide();
                        $('#password').val('');
                        Swal.fire({
                            position: 'center',
                            icon: 'success',
                            title: 'Password diperbarui',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    },
                    error: function(result) {
                        Swal.fire({
                            position: 'center',
                            icon: 'danger',
                            title: 'Password tidak valid',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    }
                });
            }
        }
    </script>
@endsection