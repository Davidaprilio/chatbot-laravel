@extends('layouts.admin')
<style>
    .select2-selection__rendered {
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

    .select2-selection--single {
        border: none !important;
    }
</style>
@section('content')
    <main class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-header__title">{{ $title }}</h1>
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
                                        href="#"><span>Data Kontak</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg></a>
                                </li>
                                <li class="breadcrumbs__item active"><span
                                        class="breadcrumbs__link">{{ $title }}</span>
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
                            <form action="{{ url('kontak/store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Informasi Kontak</h6>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $kontak->id ?? '' }}"
                                        class="form-control">
                                    <div class="form-group col-lg-3 col-12 mb-4">
                                        <label for="">Sapaan</label>
                                        @php
                                            $option = ['Mbak', 'Mas', 'Ibu', 'Bapak'];
                                        @endphp
                                        <select name="sapaan" id="sapaan" class="form-control input">
                                            @foreach ($option as $item)
                                                <option value="{{ $item }}"
                                                    {{ $item == ($kontak->sapaan ?? '') ? 'selected' : '' }}>
                                                    {{ $item }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Nama Panggilan</label>
                                        <input class="input" type="text" value="{{ $kontak->panggilan ?? '' }}"
                                            placeholder="Nama Panggilan" name="panggilan" id="panggilan">
                                    </div>
                                    <div class="form-group col-lg-5 col-12 mb-4">
                                        <label for="">Nama Lengkap</label>
                                        <input class="input" type="text" value="{{ $kontak->nama ?? '' }}"
                                            placeholder="Nama Lengkap" name="nama" id="nama">
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Nomor Handphone</label>
                                        <input class="input" type="text" value="{{ $kontak->phone ?? '' }}"
                                            placeholder="Nomor Handphone" name="phone" id="phone">
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Email</label>
                                        <input class="input" type="email" value="{{ $kontak->email ?? '' }}"
                                            placeholder="Email" name="email" id="email">
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Kategori</label>
                                        <input list="kategoris" value="{{ $kontak->kategori ?? '' }}"
                                            class="form-control input" name="kategori">
                                        <datalist id="kategoris">
                                            @foreach ($kategori as $item)
                                                <option value="{{ $item->kategori }}">
                                            @endforeach
                                        </datalist>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Jenis Kelamin</label>
                                        @php
                                            $jkel = ['Laki-laki', 'Perempuan'];
                                        @endphp
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control input">
                                            @foreach ($jkel as $jk)
                                                <option value="{{ $jk }}"
                                                    {{ ($kontak->jenis_kelamin ?? '') == $jk ? 'selected' : '' }}>
                                                    {{ $jk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Tanggal Lahir</label>
                                        <input class="input" type="date" value="{{ $kontak->tanggal_lahir ?? '' }}"
                                            placeholder="Tanggal Lahir" name="tanggal_lahir" id="tanggal_lahir">
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Agama</label>
                                        <input class="input" type="text" value="{{ $kontak->agama ?? '' }}"
                                            placeholder="Agama" name="agama" id="agama">
                                    </div>
                                    <div class="col-12 mt-4">
                                        <h6>Alamat Kontak</h6>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Provinsi</label>
                                        <select name="provinsi" id="prov"
                                            class="form-control input select2"></select>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Kabupaten / Kota</label>
                                        <select name="kota" id="kab"
                                            class="form-control input select2"></select>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Kecamatan</label>
                                        <select name="kecamatan" id="kec"
                                            class="form-control input select2"></select>
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control input">{{ $kontak->alamat ?? '' }}</textarea>
                                    </div>
                                    <div class="auth-card__submit d-flex">
                                        <button class="button button--primary button--block mr-3" type="submit"><span
                                                class="button__text">Simpan</span></button>
                                        <a href="{{ url('kontak') }}"
                                            class="button button--secondary button--block color-red" type="button"><span
                                                class="button__text">Cancel</span></a>
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
            provinsi: {
                id: 'prov',
                value: 'name',
                selected: '{{ $kontak->provinsi ?? '' }}'
            },
            kabupaten: {
                id: 'kab',
                value: 'name',
                text: 'full_name',
                selected: '{{ $kontak->kota ?? '' }}'
            },
            kecamatan: {
                id: 'kec',
                value: 'name',
                selected: '{{ $kontak->kecamatan ?? '' }}'
            },
        })
    </script>
@endsection
