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
                <h1 class="page-header__title">{{ $title ?? 'Tambah Action Replies' }}</h1>
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
                                        href="#"><span>Data Action Replies</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg></a>
                                </li>
                                <li class="breadcrumbs__item active"><span
                                        class="breadcrumbs__link">{{ $title ?? 'Tambah Action Replies' }}</span>
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
                            <form action="{{ url('action-replies/store') }}" method="post">
                                @csrf
                                <div class="row">
                                    <input type="hidden" name="id" value="{{ $action_rep->id ?? '' }}"
                                        class="form-control">
                                    <div class="form-group col-12 mb-4">
                                        <label for="">Judul Action Replies</label>
                                        <input class="input" type="text" value="{{ $action_rep->title ?? '' }}"
                                            placeholder="Judul Action Replies" name="title" id="title">
                                    </div>
                                    <div class="form-group col-12 mb-4">
                                        <div class="row mb-4 align-items-center">
                                            <div class="col-9">
                                                <label class="mb-0" for="">Action Replies</label>
                                            </div>
                                            <div class="col-3">
                                                <div class="ml-3 pl-4">
                                                    <div class="form-group form-group--inline">
                                                        <label class="mr-3 mb-0">Type : </label>
                                                        @php
                                                            $type = ['prompt_await', 'button_selected', 'option_selected', 'auto_reply', 'skip_message'];
                                                        @endphp
                                                        <div class="">
                                                            <select class="input form-control" name="type">
                                                                @foreach ($type as $item)
                                                                    <option value="{{ $item }}"
                                                                        {{ ($action_rep->type ?? '') == $item ? 'selected' : '' }}>
                                                                        {{ upperCase($item) }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <textarea name="prompt_response" id="text" cols="30" rows="5" class="form-control input">{{ $action_rep->prompt_response ?? '' }}</textarea>
                                    </div>
                                    <div class="auth-card__submit d-flex">
                                        <button class="button button--primary button--block mr-3" type="submit"><span
                                                class="button__text">Simpan</span></button>
                                        <a href="{{ url('action-replies') }}"
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

        $('#list_action-replies').on('change', function() {
            console.log(this.value);
            $.ajax({
                url: location.origin + "/action-replies/credit?id=" + this.value,
                success: function(res) {
                    $('textarea#text2').val(res.text);
                }
            });
        });
    </script>
@endsection
