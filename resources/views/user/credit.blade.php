@extends('layouts.admin')
<style>
    .select2-selection__rendered{
        display: flex !important;
        width: 100%;
        height: 42px;
        padding: 11px var(--input-gutter-x);
        font-weight: 400;
        font-size: 16px;
        line-height: 18/16*1em;
        font-family: var(--font-family-default);
        color: inherit;
        background-color: var(--background-primary-color);
        border-radius: 5px;
        border: 1px solid transparent;
        outline: none;
        transition: var(--t-base);
        transition-property: border-color, transform, background-color, opacity;
        align-items: center !important;
    }
    .select2-selection--single{
        border: none !important;
    }
</style>
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
        @include('layouts.alerts')
        <div class="card">
            <div class="card__wrapper">
                <div class="card__container">
                    <div class="card__body">
                        <form action="{{ url('user/store') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="col-12">
                                    <h6>Informasi User</h6>
                                </div>
                                <input type="hidden" name="id" value="{{ $user->id ?? '' }}" class="form-control">
                                <div class="form-group col-lg-3 col-12 mb-4">
                                    <label for="">Sapaan</label>
                                    @php $sapaan = ['Mbak', 'Mas', 'Ibu', 'Bapak'] @endphp
                                    <select name="sapaan" id="sapaan" class="form-control input">
                                        @foreach ($sapaan as $item)
                                            <option value="{{ $item }}" {{ $item == ($user->sapaan ?? '') ? 'selected' : '' }}>{{ $item }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4 col-12 mb-4">
                                    <label for="">Nama Panggilan</label>
                                    <input class="input" type="text" value="{{ $user->panggilan ?? '' }}" placeholder="Nama Panggilan" name="panggilan" id="panggilan">
                                </div>
                                <div class="form-group col-lg-5 col-12 mb-4">
                                    <label for="">Nama Lengkap</label>
                                    <input class="input" type="text" value="{{ $user->name ?? '' }}" placeholder="Nama Lengkap" name="name" id="name">
                                </div>
                                <div class="form-group col-lg-3 col-12 mb-4">
                                    <label for="">Email</label>
                                    <input class="input" type="email" value="{{ $user->email ?? '' }}" placeholder="example@mail.com" name="email" id="email">
                                </div>
                                <div class="form-group col-lg-3 col-12 mb-4">
                                    <label for="">Nomor Handphone</label>
                                    <input class="input" type="number" min="1" minlength="10" maxlength="13" value="{{ $user->phone ?? '' }}" placeholder="+62....." name="phone" id="phone">
                                </div>
                                <div class="form-group col-lg-3 col-12 mb-4">
                                    <label for="">Role</label>
                                    <select name="role" id="role" class="form-control input">
                                        <option value="1" {{ ($user->role_id ?? '') == 1 ? 'selected' : '' }}>Admin</option>
                                        <option value="2" {{ ($user->role_id ?? '') == 2 ? 'selected' : '' }}>Client</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3 col-12 mb-4">
                                    <label for="">Status</label>
                                    <select name="status" id="status" class="form-control input">
                                        <option value="0" {{ ($user->status ?? '') == 0 ? 'selected' : '' }}>Tidak Aktif</option>
                                        <option value="1" {{ ($user->status ?? '') == 1 ? 'selected' : '' }}>Aktif</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <div class="dropdown-menu__divider"></div>
                                    <h6>Alamat</h6>
                                </div>
                                <div class="form-group col-lg-4 col-12 mb-4">
                                    <label for="">Provinsi</label>
                                    <select name="prov" id="prov" class="form-control input select2"></select>
                                </div>
                                <div class="form-group col-lg-4 col-12 mb-4">
                                    <label for="">Kabupaten / Kota</label>
                                    <select name="kab" id="kab" class="form-control input select2"></select>
                                </div>
                                <div class="form-group col-lg-4 col-12 mb-4">
                                    <label for="">Kecamatan</label>
                                    <select name="kec" id="kec" class="form-control input select2"></select>
                                </div>
                                <div class="auth-card__submit d-flex">
                                    <button class="button button--primary button--block mr-3" type="submit"><span class="button__text">Simpan</span></button>
                                    <a href="{{ url('user') }}" class="button button--secondary button--block color-red" type="button"><span class="button__text">Cancel</span></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
@section('js')
    <script>
        $('#prov, #kab, #kec').select2();
        const apiDaerah = new ApiDaerah({
            supportSelectValue: true, // untuk mengambil data dari attr value select
            provinsi:  {
                id: 'prov',
                value: 'name',
                selected: '{{ $user->provinsi ?? '' }}'
            },
            kabupaten:  {
                id: 'kab',
                value: 'name',
                text: 'full_name',
                selected: '{{ $user->kota ?? '' }}'
            },
            kecamatan:  {
                id: 'kec',
                value: 'name',
                selected: '{{ $user->kecamatan ?? '' }}'
            },
        })
    </script>
@endsection