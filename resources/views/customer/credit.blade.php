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
                <h1 class="page-header__title">{{ $title ?? 'Tambah Customer' }}</h1>
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
                                        href="#"><span>Data Customer</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg></a>
                                </li>
                                <li class="breadcrumbs__item active"><span
                                        class="breadcrumbs__link">{{ $title ?? 'Tambah Customer' }}</span>
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
                            <form action="{{ url('customer/store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <div class="col-12">
                                        <h6>Informasi Customer</h6>
                                    </div>
                                    <input type="hidden" name="id" value="{{ $customer->id ?? '' }}"
                                        class="form-control">
                                    <div class="form-group col-lg-6 col-12 mb-4">
                                        <label for="">Nama Lengkap</label>
                                        <input class="input" type="text" value="{{ $customer->name ?? '' }}"
                                            placeholder="Nama Lengkap" name="name" id="name">
                                    </div>
                                    <div class="form-group col-lg-6 col-12 mb-4">
                                        <label for="">Nomor Handphone</label>
                                        <input class="input" type="text" value="{{ $customer->phone ?? '' }}"
                                            placeholder="Nama Panggilan" name="phone" id="phone">
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Usia</label>
                                        <input class="input" type="number" min="1"
                                            value="{{ $customer->usia ?? '' }}" placeholder="12" name="usia"
                                            id="usia">
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Golongan Darah</label>
                                        @php
                                            $goldar = ['A', 'B', 'AB', 'O'];
                                        @endphp
                                        <select name="golongan_darah" id="golongan_darah" class="form-control input">
                                            @foreach ($goldar as $darah)
                                                <option value="{{ $darah }}"
                                                    {{ ($customer->golongan_darah ?? '') == $darah ? 'selected' : '' }}>
                                                    {{ $darah }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-lg-4 col-12 mb-4">
                                        <label for="">Jenis Kelamin</label>
                                        @php
                                            $jkel = ['L', 'P'];
                                        @endphp
                                        <select name="jenis_kelamin" id="jenis_kelamin" class="form-control input">
                                            @foreach ($jkel as $jk)
                                                <option value="{{ $jk }}"
                                                    {{ ($customer->jenis_kelamin ?? '') == $jk ? 'selected' : '' }}>
                                                    {{ $jk }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <label for="">Alamat</label>
                                        <textarea name="alamat" id="alamat" cols="30" rows="5" class="form-control">{{ $customer->alamat ?? '' }}</textarea>
                                    </div>
                                    <div class="auth-card__submit d-flex">
                                        <button class="button button--primary button--block mr-3" type="submit"><span
                                                class="button__text">Simpan</span></button>
                                        <a href="{{ url('customer') }}"
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
                selected: '{{ $customer->provinsi ?? '' }}'
            },
            kabupaten: {
                id: 'kab',
                value: 'name',
                text: 'full_name',
                selected: '{{ $customer->kota ?? '' }}'
            },
            kecamatan: {
                id: 'kec',
                value: 'name',
                selected: '{{ $customer->kecamatan ?? '' }}'
            },
        })
    </script>
@endsection
