@extends('layouts.admin')
@php(
    $breadcrumbs = [
        '<i class="fa fa-home"></i>' => url('/'),
        'Home' => '#',
        'Message' => url('/message'),
        'Form' => url()->current(),
    ]
)

@section('content')
    <x-page-content title="Form Message" :breadcrumbs="$breadcrumbs">
        <div class="row">
            <div class="col-lg-7 col-md-10 col-sm-10">
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
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-8">
                                                    <label for="">Pesan</label>
                                                </div>
                                                <div class="col-4">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-group form-group--inline">
                                                            <label class="mr-3">Type:</label>
                                                            <div class="">
                                                                <select class="input form-control form-control-sm"
                                                                    name="type" id="type">
                                                                    <option value="">Pilih Type</option>
                                                                    <option value="prompt"
                                                                        {{ ($message->type ?? '') == 'prompt' ? 'selected' : '' }}>
                                                                        Pertanyaan
                                                                    </option>
                                                                    <option value="chat"
                                                                        {{ ($message->type ?? '') == 'chat' ? 'selected' : '' }}>
                                                                        Teks
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea name="text" id="text" cols="30" rows="5" class="form-control input">{{ $message->text ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row d-none" id="type-jawaban">
                                        <div class="col-12">
                                            <div class="form-group form-group--inline">
                                                <label class="form-label">Simpan Jawaban:</label>
                                                <div class="input-group">
                                                    <label class="checkbox-toggle is-active">
                                                        <input type="checkbox" checked><span
                                                            class="checkbox-toggle__range"></span>
                                                    </label>
                                                </div>
                                                {{-- <input type="text" class="form-group" placeholder="Kolom name"> --}}
                                            </div>
                                        </div>
                                        <div class="form-group col-12 mb-4">
                                            <div class="row justify-content-betweens">
                                                <div class="col-6">
                                                    <label for="">Type Pesan Jawaban</label>
                                                    <select class="input form-control mb-2" name="next_message"
                                                        id="list_message">
                                                        <option value="">Pilih type pesan jawaban</option>
                                                        <option value="button">Pesan Tombol</option>
                                                        <option value="list">Pesan List</option>
                                                        <option value="custom">Kustom Pesan List</option>
                                                    </select>
                                                </div>
                                                {{-- <div class="col text-right">
                                                    <button class="btn btn-sm btn-primary" type="button"
                                                        onclick="addActionReply()">Tambah jawaban</button>
                                                </div> --}}
                                            </div>
                                        </div>
                                        {{-- <div class="col-12 d-none" id="button">
                                            <div class="row" id="custom-option-message">
                                                <div id="form-reply-1" class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label>Nama Button</label>
                                                            <input type="text" class="form-control" name="button_name[]"
                                                                placeholder="">
                                                        </div>
                                                        <div class="col-5">
                                                            <label>Respon Pesan</label>
                                                            <select type="text" class="form-control" name="respon[]">
                                                                @foreach (range(1, 5) as $item)
                                                                    <option value="">Message {{ $item }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-1"
                                                            style="margin-top: 26px;justify-content: center;display: flex;">
                                                            <button class="button-add button-add--blue color-red"
                                                                type="button" style="background-color: red;"
                                                                onclick="removeReply(1)"><span class="button-add__icon">
                                                                    <svg class="icon-icon-trash">
                                                                        <use xlink:href="#icon-trash"></use>
                                                                    </svg></span><span class="button-add__text"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        {{-- <div class="col-12 d-none" id="list">
                                            <div class="row" id="custom-option-message">
                                                <div id="form-reply-1" class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label>Nama List</label>
                                                            <input type="text" class="form-control" name="list_name[]"
                                                                placeholder="">
                                                        </div>
                                                        <div class="col-5">
                                                            <label>Respon Pesan</label>
                                                            <select type="text" class="form-control" name="respon[]">
                                                                @foreach (range(1, 5) as $item)
                                                                    <option value="">Message {{ $item }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-1"
                                                            style="margin-top: 26px;justify-content: center;display: flex;">
                                                            <button class="button-add button-add--blue color-red"
                                                                type="button" style="background-color: red;"
                                                                onclick="removeReply(1)"><span class="button-add__icon">
                                                                    <svg class="icon-icon-trash">
                                                                        <use xlink:href="#icon-trash"></use>
                                                                    </svg></span><span class="button-add__text"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="row" id="custom-option-message">
                                                <div id="form-reply-1" class="col-12">
                                                    <div class="row">
                                                        <div class="col-6">
                                                            <label id="label-option">Button</label>
                                                            <input type="text" class="form-control" name="button[]"
                                                                placeholder="">
                                                        </div>
                                                        <div class="col-5">
                                                            <label>Respon Pesan</label>
                                                            <select type="text" class="form-control" name="respon[]">
                                                                @foreach (range(1, 5) as $item)
                                                                    <option value="">Message {{ $item }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col-1"
                                                            style="margin-top: 26px;justify-content: center;display: flex;">
                                                            <button class="button-add button-add--blue color-red"
                                                                type="button" style="background-color: red;"
                                                                onclick="removeReply(1)"><span class="button-add__icon">
                                                                    <svg class="icon-icon-trash">
                                                                        <use xlink:href="#icon-trash"></use>
                                                                    </svg></span><span class="button-add__text"></span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-2 mt-4">
                                            <a class="button button--secondary" type="button" id="add-response">
                                                <span class="button__icon button__icon--left"><svg class="icon-icon-plus">
                                                        <use xlink:href="#icon-plus"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Tambah Respon</span>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="auth-card__submit d-flex">
                                        <button class="button button--primary button--block mr-3" type="submit">
                                            <span class="button__text">Simpan</span>
                                        </button>
                                        <a href="{{ url('message') }}"
                                            class="button button--secondary button--block color-red" type="button">
                                            <span class="button__text">Cancel</span>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-page-content>
@endsection

@push('modals')
    <div class="modal modal-compact modal-add-event scrollbar-thin" id="formActionReply" data-simplebar>
        <div class="modal__overlay" data-dismiss="modal"></div>
        <div class="modal__wrap">
            <div class="modal__window">
                <div class="modal__content">
                    <button class="modal__close" data-dismiss="modal">
                        <svg class="icon-icon-cross">
                            <use xlink:href="#icon-cross"></use>
                        </svg>
                    </button>
                    <div class="modal__header">
                        <div class="modal__container">
                            <h2 class="modal__title">Jawaban Pesan</h2>
                        </div>
                    </div>
                    <div class="modal__body">
                        <div class="modal__container">
                            <form method="POST">
                                <div class="row">
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label form-label--sm">Title</label>
                                        <div class="input-group">
                                            <input class="input" type="text" required>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label form-label--sm">Pola jawaban</label>
                                            <label class="form-label form-label--sm" data-modal="#help-action-reply">
                                                <i class="fa fa-question-circle"></i>
                                            </label>
                                        </div>
                                        <div class="input-group">
                                            <textarea class="input" rows="6" required></textarea>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg">
                                        <label class="form-label form-label--sm">Event type</label>
                                        <div class="input-events">
                                            <label class="input-events__item color-red" data-tippy-content="Important"
                                                data-tippy-placement="top">
                                                <input type="radio" name="add-event"><span
                                                    class="input-events__item-marker"></span>
                                            </label>
                                            <label class="input-events__item color-teal" data-tippy-content="Meeting"
                                                data-tippy-placement="top">
                                                <input type="radio" name="add-event"><span
                                                    class="input-events__item-marker"></span>
                                            </label>
                                            <label class="input-events__item color-green" data-tippy-content="Event"
                                                data-tippy-placement="top">
                                                <input type="radio" name="add-event"><span
                                                    class="input-events__item-marker"></span>
                                            </label>
                                            <label class="input-events__item color-orange" data-tippy-content="Work"
                                                data-tippy-placement="top">
                                                <input type="radio" name="add-event"><span
                                                    class="input-events__item-marker"></span>
                                            </label>
                                            <label class="input-events__item color-grey-light" data-tippy-content="Other"
                                                data-tippy-placement="top">
                                                <input type="radio" name="add-event"><span
                                                    class="input-events__item-marker"></span>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group form-group--lg">
                                        <label class="form-label form-label--sm">Start date</label>
                                        <div class="input-group input-group--prepend">
                                            <div class="input-group__prepend input-group__prepend--default">
                                                <svg class="icon-icon-calendar">
                                                    <use xlink:href="#icon-calendar"></use>
                                                </svg>
                                            </div>
                                            <input class="input" type="text" value="02.11.19" readonly><span
                                                class="input-group__arrow">
                                                <svg class="icon-icon-keyboard-down">
                                                    <use xlink:href="#icon-keyboard-down"></use>
                                                </svg></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group form-group--lg">
                                        <label class="form-label form-label--sm">Start time</label>
                                        <div class="input-group input-group--prepend">
                                            <div class="input-group__prepend input-group__prepend--default">
                                                <svg class="icon-icon-clock">
                                                    <use xlink:href="#icon-clock"></use>
                                                </svg>
                                            </div>
                                            <input class="input" type="time" required><span
                                                class="input-group__arrows"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group form-group--lg">
                                        <label class="form-label form-label--sm">End date</label>
                                        <div class="input-group input-group--prepend">
                                            <div class="input-group__prepend input-group__prepend--default">
                                                <svg class="icon-icon-calendar">
                                                    <use xlink:href="#icon-calendar"></use>
                                                </svg>
                                            </div>
                                            <input class="input" type="text" value="03.11.19" readonly><span
                                                class="input-group__arrow">
                                                <svg class="icon-icon-keyboard-down">
                                                    <use xlink:href="#icon-keyboard-down"></use>
                                                </svg></span>
                                        </div>
                                    </div>
                                    <div class="col-12 col-md-6 form-group form-group--lg">
                                        <label class="form-label form-label--sm">End time</label>
                                        <div class="input-group input-group--prepend">
                                            <div class="input-group__prepend input-group__prepend--default">
                                                <svg class="icon-icon-clock">
                                                    <use xlink:href="#icon-clock"></use>
                                                </svg>
                                            </div>
                                            <input class="input" type="time" required><span
                                                class="input-group__arrows"></span>
                                        </div>
                                    </div>
                                    <div class="col-12 form-group form-group--lg form-group--inline">
                                        <label class="form-label form-label--append">All day</label>
                                        <label class="checkbox-toggle">
                                            <input type="checkbox"><span class="checkbox-toggle__range"></span>
                                        </label>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="modal__footer pt-0">
                        <div class="modal__container">
                            <div class="modal__footer-buttons">
                                <div class="modal__footer-button"></div>
                                <div class="modal__footer-button">
                                    <button class="button button--primary button--block" type="submit"><span
                                            class="button__icon button__icon--left">
                                            <svg class="icon-icon-plus">
                                                <use xlink:href="#icon-plus"></use>
                                            </svg></span><span class="button__text">Add Event</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-compact modal-xl scrollbar-thin" id="help-action-reply" data-simplebar>
        <div class="modal__overlay" data-dismiss="modal"></div>
        <div class="modal__wrap">
            <div class="modal__window">
                <div class="modal__content">
                    <button class="modal__close" data-dismiss="modal">
                        <svg class="icon-icon-cross">
                            <use xlink:href="#icon-cross"></use>
                        </svg>
                    </button>
                    <div class="modal__header">
                        <div class="modal__container">
                            <h2 class="modal__title">Bantuan</h2>
                        </div>
                    </div>
                    <div class="modal__body">
                        <div class="modal__container">
                            Format jawaban:
                            <ul>
                                <li>
                                    Untuk membuat pesan yang hanya cocok jika sama persis tapi tidak sensitif dengan capital
                                    case, gunakan teks biasa tanpa tambahan formatting. Contohnya: "Halo" akan cocok dengan
                                    "Halo" dan "halo" tapi tidak dengan "Halo!" atau "Halo, apa kabar?" lalu akan
                                    mengirimkan pesan balasan ketika pesan balasan cocok.
                                </li>
                                <li>
                                    Untuk membuat pesan yang berisi sekumpulan format, dapat dimasukkan lebih dari 1 format
                                    dan fixed value lalu setiap pesan dipisahkan dengan ||. Contohnya:
                                    "Halo||Hai||Siang||Sore||Malam, jika ada pesan balasan cocok dengan salah satunya akan
                                    mengirim pesan anda: apa yang bisa saya bantu?"
                                </li>
                                <li>
                                    Untuk membuat pesan yang cocok dengan semua nilai yang dimasukkan, gunakan tanda
                                    asterisk (*) di dalam kurung kurawal. Contohnya: "{*}" lalu semua pesan akan dianggap
                                    cocok dan pesan pertanyaan akan selesai
                                </li>
                                <li>
                                    Untuk membuat pesan yang tidak cocok dengan semua nilai yang dimasukkan, gunakan tanda
                                    seru (!) sebelum tanda asterisk (*) di dalam kurung kurawal. Contohnya: "{!*}" pesan
                                    yang tidak cocok akan dibalas dengan pesan balasan yang telah ditentukan dan pesan
                                    pertanyaan akan tetap aktif menerima jawaban
                                </li>
                            </ul>
                            Penting untuk diingat bahwa tipe {*} dan {!*} tidak dapat diaplikasikan ke pesan pertanyaan yang
                            sama, Anda harus memilih salah satunya. Semoga penjelasan ini membantu!
                        </div>
                    </div>
                    <div class="modal__footer pt-0">
                        <div class="modal__container">
                            <div class="modal__footer-buttons">
                                <div class="modal__footer-button"></div>
                                <div class="modal__footer-button">
                                    <button class="button button--primary button--block" type="submit"><span
                                            class="button__icon button__icon--left">
                                            <svg class="icon-icon-plus">
                                                <use xlink:href="#icon-plus"></use>
                                            </svg></span><span class="button__text">Add Event</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endpush

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

        var i = 1;
        var length;
        $('#add-response').on('click', function() {
            i++;
            if ($(this).attr("tipe-list") == 'button') {
                label = 'Nama Button';
                if (i == 3) {
                    $("#add-response").addClass('d-none')
                }
            }
            if ($(this).attr("tipe-list") == 'list') {
                label = 'List Button';
                if (i == 5) {
                    $("#add-response").addClass('d-none')
                }
            }
            if ($(this).attr("tipe-list") == 'custom') {
                label = 'Custom Response';
            }
            let html = `
            <div id="form-reply-${i}" class="col-12">
                <div class="row">
                    <div class="col-6 mt-4">
                        <label>${label}</label>
                        <input type="text" name="button[]" class="form-control" placeholder="">
                    </div>
                    <div class="col-5 mt-4">
                        <label>Respon Pesan</label>
                        <select type="text" class="form-control" name="respon[]">
                            @foreach (range(1, 5) as $item)
                                <option value="">Message {{ $item }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1"
                        style="margin-top: 52px;justify-content: center;display: flex;">
                        <button class="button-add button-add--blue color-red" type="button"
                            style="background-color: red;" onclick="removeReply(${i})"><span
                                class="button-add__icon">
                                <svg class="icon-icon-trash">
                                    <use xlink:href="#icon-trash"></use>
                                </svg></span><span class="button-add__text"></span>
                        </button>
                    </div>
                </div>
            </div>`
            $('#custom-option-message').append(html)
        })

        function removeReply(id) {
            $('#form-reply-' + id).remove()
        }

        $('#list_message').on('change', function() {
            if (this.value == 'button') {
                $('#add-response').attr('tipe-list', 'button')
                document.getElementById('label-option').innerHTML = 'Button Option'
                // $('#button').removeClass('d-none')
                // $('#list').addClass('d-none')
                // $('#custom').addClass('d-none')
            }
            if (this.value == 'list') {
                $('#add-response').attr('tipe-list', 'list')
                document.getElementById('label-option').innerHTML = 'Button List'
                // $('#button').addClass('d-none')
                // $('#list').removeClass('d-none')
                // $('#custom').addClass('d-none')
            }
            if (this.value == 'custom') {
                $('#add-response').attr('tipe-list', 'custom')
                document.getElementById('label-option').innerHTML = 'Custom Response'
                // $('#button').addClass('d-none')
                // $('#list').addClass('d-none')
                // $('#custom').removeClass('d-none')
            }
        })

        $('#type').on('click', function() {
            if (this.value == 'prompt') {
                $('#type-jawaban').removeClass('d-none')
            }
            if (this.value == 'chat') {
                $('#type-jawaban').addClass('d-none')
            }
        })
    </script>
@endsection
