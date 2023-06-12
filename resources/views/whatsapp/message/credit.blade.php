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
                <h1 class="page-header__title">{{ $title ?? 'Tambah Pesan' }}</h1>
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
                                        href="#"><span>Data Pesan</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg></a>
                                </li>
                                <li class="breadcrumbs__item active"><span
                                        class="breadcrumbs__link">{{ $title ?? 'Tambah Pesan' }}</span>
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
                            <form action="{{ url('message/store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $message->id ?? '' }}"
                                        class="form-control">
                                    <div class="form-group col-12 mb-4">
                                        <label for="">Judul Pesan</label>
                                        <input class="input" type="text" value="{{ $message->title ?? '' }}"
                                            placeholder="Judul Pesan" name="title" id="title">
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-10">
                                                <label for="">Pesan</label>
                                            </div>
                                            <div class="col-2">
                                                <div class="">
                                                    <div class="form-group form-group--inline">
                                                        <label class="mr-3">Type : </label>
                                                        <div class="">
                                                            <select class="input form-control" name="type">
                                                                <option value="prompt"
                                                                    {{ ($message->type ?? '') == 'prompt' ? 'selected' : '' }}>
                                                                    Prompt</option>
                                                                <option value="chat"
                                                                    {{ ($message->type ?? '') == 'chat' ? 'selected' : '' }}>
                                                                    Chat</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <textarea name="text" id="text" cols="30" rows="5" class="form-control input">{{ $message->text ?? '' }}</textarea>
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <label for="">Pesan Lanjutan</label>
                                        <select class="input form-control mb-2" name="next_message" id="list_message">
                                            @foreach ($list_message as $item)
                                                <option
                                                    value="{{ $item->id }}"{{ ($message->next_message ?? '') == $item->id ? 'selected' : '' }}>
                                                    {{ $item->title }}</option>
                                            @endforeach
                                        </select>
                                        <textarea name="text2" id="text2" cols="30" rows="5" class="form-control input" readonly></textarea>
                                    </div>
                                    <div class="auth-card__submit d-flex">
                                        <button class="button button--primary button--block mr-3" type="submit"><span
                                                class="button__text">Simpan</span></button>
                                        <a href="{{ url('message') }}"
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
        $('.select2').select2();

        $('#list_message').on('change', function() {
            $.ajax({
                url: location.origin + "/message/credit?id=" + this.value,
                success: function(res) {
                    $('textarea#text2').val(res.text);
                }
            });
        });

        $(document).ready(function() {
            let id_list_message = $('#list_message').val()
            $.ajax({
                url: location.origin + "/message/credit?id=" + id_list_message,
                success: function(res) {
                    $('textarea#text2').val(res.text);
                }
            });
        })
    </script>
@endsection
