@extends('layouts.admin')
@section('content')
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">{{ $title ?? 'Tambah User' }}</h1>
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
                                    href="#"><span>Data User</span>
                                    <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                        <use xlink:href="#icon-keyboard-right"></use>
                                    </svg></a>
                            </li>
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">{{ $title ?? 'Tambah User' }}</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card__wrapper">
                <div class="card__container">
                    <div class="card__body">
                        <div class="row">
                            <div class="col-12">
                                <h6>Informasi User</h6>
                            </div>
                            <div class="form-group col-lg-3 col-12 mb-4">
                                <label for="">Sapaan</label>
                                @php $sapaan = ['Mbak', 'Mas', 'Ibu', 'Bapak'] @endphp
                                <select name="sapaan" id="sapaan" class="form-control input">
                                    @foreach ($sapaan as $item)
                                        <option value="{{ $item }}">{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Nama Panggilan</label>
                                <input class="input" type="text" placeholder="Nama Panggilan" name="panggilan" id="panggilan">
                            </div>
                            <div class="form-group col-lg-5 col-12 mb-4">
                                <label for="">Nama Lengkap</label>
                                <input class="input" type="text" placeholder="Nama Lengkap" name="name" id="name">
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Email</label>
                                <input class="input" type="email" placeholder="example@mail.com" name="email" id="email">
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Nomor Handphone</label>
                                <input class="input" type="number" min="1" minlength="10" maxlength="13" placeholder="+62....." name="phone" id="phone">
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Role</label>
                                <select name="role" id="role" class="form-control input">
                                    <option value="Admin">Admin</option>
                                    <option value="Client">Client</option>
                                </select>
                            </div>
                            <div class="col-12">
                                <div class="dropdown-menu__divider"></div>
                                <h6>Alamat</h6>
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Provinsi</label>
                                <select name="prov" id="prov" class="form-control input"></select>
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Kabupaten / Kota</label>
                                <select name="kab" id="kab" class="form-control input"></select>
                            </div>
                            <div class="form-group col-lg-4 col-12 mb-4">
                                <label for="">Kecamatan</label>
                                <select name="kec" id="kec" class="form-control input"></select>
                            </div>
                            <div class="auth-card__submit">
                                <button class="button button--primary button--block" type="button"><span class="button__text">Create
                                        account</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('js')
    <script>
    </script>
@endsection