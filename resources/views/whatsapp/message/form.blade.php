@extends('layouts.admin')
@php
    $breadcrumbs = [
        '<i class="fa fa-home"></i>' => url('/'),
        'Chatbot Setting' => '#',
        'FlowChat' => route('flowchat.index'),
        $flow->name => route('message',['flow' => $flow->id]),
    ];
    if (isset($message)) {
        $breadcrumbs[$message->title] = route('message.credit', ['flow' => $flow->id, 'id' => $message->id]);
        $breadcrumbs['Edit'] = '#';
    } else {
        $breadcrumbs['Create'] = '#';
    }
@endphp

@section('content')
    <x-page-content title="Form Message" :breadcrumbs="$breadcrumbs">
        <form action="{{ route('message.store', ['flow' => $flow->id]) }}" method="post">
            @csrf
            <div class="row">
                <div class="col-lg-6 col-12 mb-3">
                    <div class="card">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__body">
                                    <div class="row">
                                        <input type="hidden" name="id" value="{{ $message->id ?? '' }}"
                                            class="form-control">
                                        <div class="form-group col-6 mb-4">
                                            <label for="">Judul Pesan</label>
                                            <input class="input" type="text" required value="{{ old('title', $message->title ?? '') }}"
                                                placeholder="Judul Pesan" name="title" id="title">
                                        </div>
                                        <div class="form-group col-6 mb-4">
                                            <label for="">Hook</label>
                                            @php
                                                $hooks = [
                                                    'welcome', 
                                                    // 'custom_condition', 
                                                    // 'anon_customer', 
                                                    // 'before_send_menu', 
                                                    // 'after_send_menu', 
                                                    // 'after_give_name', 
                                                    'dont_understand', 
                                                    // 'end_menu', 
                                                    'end_chat', 
                                                    'confirm_not_response', 
                                                    'close_chat_not_response'
                                                ];
                                            @endphp
                                            <select class="input form-control form-control-sm" name="hook"
                                                id="hook">
                                                <option
                                                    value=""{{ $message && $message->hook == null ? 'selected' : '' }}>
                                                    Tanpa Hook</option>
                                                @foreach ($hooks as $hook)
                                                    <option
                                                        value="{{ $hook }}"{{ $message && $message->hook == $hook ? 'selected' : '' }}>
                                                        {{ ucwords(str_replace('_', ' ', $hook)) }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group col-12 mb-4">
                                            <div class="row mb-2 align-items-center">
                                                <div class="col-6">
                                                    <label for="">Pesan</label>
                                                </div>
                                                <div class="col-6">
                                                    <div class="d-flex justify-content-end">
                                                        <div class="form-group form-group--inline">
                                                            <label class="mr-3">Type:</label>
                                                            <div class="">
                                                                <select class="input form-control form-control-sm"
                                                                    name="type" id="type" required>
                                                                    <option value="chat"
                                                                        {{ ($message->type ?? '') == 'chat' ? 'selected' : '' }}>
                                                                        Teks
                                                                    </option>
                                                                    <option value="prompt"
                                                                        {{ ($message->type ?? '') == 'prompt' ? 'selected' : '' }}>
                                                                        Pertanyaan
                                                                    </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <textarea required name="text" id="text" cols="30" rows="5" class="form-control input">{{ $message->text ?? '' }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-5 mt-4">
                                            <label for="">Lanjut kirim pesan</label>
                                            <select type="text" class="form-control" name="next_msg">
                                                <option value="">Tidak</option>
                                                @foreach ($list_message as $msg_reply)
                                                    <option value="{{ $msg_reply->id }}"
                                                        {{ $message && $message->next_message === $msg_reply->id ? 'selected' : '' }}>
                                                        ({{ $msg_reply->type }})
                                                        | {{ $msg_reply->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="enableCondition" id="enableCondition"
                                                    {{ $message && $message->condition != null ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="enableCondition">
                                                    Tambah Kondisi
                                                </label>
                                            </div>

                                            <div class="row" id="condition-container">
                                                <div class="col-4">
                                                    <label for="">Format Kondisi</label>
                                                    <input type="text" name="format_condition" class="form-control"
                                                        placeholder="Masukan Kondisi" value="{{ $message->condition ?? '' }}">
                                                </div>
                                                <div class="col-4">
                                                    <label for="">Aksi Jika Benar</label>
                                                    <select class="form-control" name="type_condition" id="type_condition">
                                                        <option value="skip_to_message" {{ $message && $message->condition_type == 'skip_to_message' ? 'selected' : '' }}>
                                                            Lewati Dan Kirim Pesan Lain
                                                        </option>
                                                        <option value="skip_to_next_message" {{ $message && $message->condition_type == 'skip_to_next_message' ? 'selected' : '' }}>
                                                            Lewati dan kirim pesan selanjutnya
                                                        </option>
                                                    </select>
                                                </div>
                                                <div class="col-4" id="condition_value_col">
                                                    <label for="">Pesan yang dikirim</label>
                                                    <select class="form-control" name="condition_value">
                                                        @foreach ($list_message as $msg_reply)
                                                            <option value="{{ $msg_reply->id }}"
                                                                {{ $message && $message->condition_value == $msg_reply->id ? 'selected' : '' }}>
                                                                ({{ $msg_reply->type }})
                                                                | {{ $msg_reply->title }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <div class="custom-control custom-switch">
                                                <input type="checkbox" class="custom-control-input" name="enableEventTrigger" id="enableEventTrigger"
                                                    {{ $message && $message->trigger_event != null ? 'checked' : '' }}>
                                                <label class="custom-control-label" for="enableEventTrigger">
                                                    Tambah Pemicu Event
                                                </label>
                                            </div>

                                            <div class="row" id="triggerevent-container">
                                                <div class="col-4">
                                                    <label for="">Pilih Pemicu Event</label>
                                                    <select class="form-control" name="type_trigger_event" id="type_trigger_event">
                                                        <option value="close_chat" {{ $message && $message->trigger_event == 'close_chat' ? 'selected' : '' }}>Akhiri Obrolan</option>
                                                        <option value="save_response" {{ $message && $message->trigger_event == 'save_response' ? 'selected' : '' }}>Simpan jawaban</option>
                                                    </select>
                                                </div>
                                                <div class="col-4" id="select_event_value_column">
                                                    <label for="">Simpan ke kolom</label>
                                                    @php($columns = explode(',', 'name,location'))
                                                    <select class="form-control" name="event_value" id="event_value">
                                                        @foreach ($columns as $column)
                                                            <option value="{{ $column }}" {{ $message && $message->event_value === $column ? 'selected' : '' }}>{{ strtoupper($column) }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="card {{ $message && $message->type == 'prompt' ? '' : 'd-none' }}" id="type-jawaban">
                        <div class="card__wrapper">
                            <div class="card__container">
                                <div class="card__body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h4 class="text-dark">Pesan Balasan</h4>
                                            {{-- <div class="form-group form-group--inline">
                                                <label class="form-label">Simpan Jawaban:</label>
                                                <div class="input-group">
                                                    <label class="checkbox-toggle is-active">
                                                        <input type="checkbox" checked><span
                                                            class="checkbox-toggle__range"></span>
                                                    </label>
                                                </div>
                                            </div> --}}
                                        </div>
                                        {{-- <div class="form-group col-12">
                                            <div class="row justify-content-betweens">
                                                <div class="col-6">
                                                    <label for="">Type Pesan Jawaban</label>
                                                        $types = [
                                                            'Pesan Tombol' => $message && $message->buttons !== null,
                                                            'Pesan List' => $message && $message->lists !== null,
                                                            'Kostum Pesan List' => $message && $message->buttons == null && $message->buttons == null,
                                                        ];
                                                    <select class="input form-control mb-2" name="type_button"
                                                        id="type_button">
                                                        <option value="">Pilih type pesan jawaban</option>
                                                        @foreach ($types as $text => $selected)
                                                            <option {{ $selected ? 'selected' : '' }} >{{ $text }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div> --}}
                                        <div class="col-12">
                                            <div class="row" id="custom-option-message">
                                                {{-- @dump($button) --}}
                                                <?php $j = 0; ?>
                                                @if ($button != null)
                                                    @foreach ($button as $reply)
                                                        {{-- @dump(count($value)) --}}
                                                        <div class="col-12 reply-row" data-reply-id="{{ $reply->id }}">
                                                            <!-- id="form-reply-${i}" -->
                                                            <input type="hidden" name="action[]"
                                                                value="{{ $reply->id }}">
                                                            <div class="row">
                                                                <div class="col-6 mt-4">
                                                                    <label>Response {{ $loop->iteration }}</label>
                                                                    <input type="text" name="button[]"
                                                                        class="form-control"
                                                                        value="{{ $reply->response_text_as_string }}">
                                                                </div>
                                                                <div class="col-5 mt-4">
                                                                    <label>Pesan Balasan</label>
                                                                    <select type="text" class="form-control"
                                                                        name="respon[]">
                                                                        @foreach ($list_message as $msg_reply)
                                                                            <option value="{{ $msg_reply->id }}"
                                                                                {{ $reply->reply_message_id === $msg_reply->id ? 'selected' : '' }}>
                                                                                {{ $msg_reply->title }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-1"
                                                                    style="margin-top: 52px;justify-content: center;display: flex;">
                                                                    <button class="button-add button-add--blue color-red"
                                                                        type="button" style="background-color: red;"
                                                                        onclick="removeReply(this)">
                                                                        <span class="button-add__icon">
                                                                            <svg class="icon-icon-trash">
                                                                                <use xlink:href="#icon-trash"></use>
                                                                            </svg>
                                                                        </span>
                                                                        <span class="button-add__text"></span>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <button class="button button--secondary" type="button" id="add-response">
                                                <span class="button__icon button__icon--left"><svg class="icon-icon-plus">
                                                        <use xlink:href="#icon-plus"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Tambah Respon</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <div class="auth-card__submit d-flex">
                        <a href="{{ route('message', ['flow' => $flow->id]) }}"
                            class="button button--secondary button--block color-red mr-3" type="button">
                            <span class="button__text">Cancel</span>
                        </a>
                        <input class="button button--primary button--block mr-3" type="submit" name="saveAndBack"
                            value="Simpan dan kembali">
                        <button class="button button--primary button--block" type="submit">
                            <span class="button__text">Simpan</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
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
        let i = 1;
        var length;
        // $( document ).ready(function() {
        //     let childElementCount = document.getElementById("custom-option-message").childElementCount;
        //     if ('{{ $message->type ?? '' }}' == 'prompt') {
        //         $('#type-jawaban').removeClass('d-none')
        //         $('#custom-option-message').removeClass('d-none')
        //     }
        //     if ('{{ $message->type_button ?? '' }}' == 'button') {
        //         label = 'Button Option';
        //         if (childElementCount == 2) {
        //             $("#add-response").addClass('d-none')
        //         }
        //     }
        //     if ('{{ $message->type_button ?? '' }}' == 'list') {
        //         label = 'Button List';
        //         if (childElementCount == 4) {
        //             $("#add-response").addClass('d-none')
        //         }
        //     }
        //     if ('{{ $message->type_button ?? '' }}' == 'custom') {
        //         label = 'Custom Response';
        //     }
        // });




        function showHideConditionCol() {
            const select = $('#enableCondition').get(0)
            if (select.checked) {
                $('#condition-container').removeClass('d-none')
            } else {
                $('#condition-container').addClass('d-none')
            }
        }
        $('#enableCondition').on('change', showHideConditionCol)
        showHideConditionCol()

        function showHideConditionValue() {
            $('#condition_value_col').addClass('d-none')
            if ($('#type_condition').val() === 'skip_to_message') {
                $('#condition_value_col').removeClass('d-none')
            }
        }

        $('#type_condition').on('change', showHideConditionValue)
        showHideConditionValue()

        function showHideTriggerEventCol() {
            const select = $('#enableEventTrigger').get(0)
            if (select.checked) {
                $('#triggerevent-container').removeClass('d-none')
            } else {
                $('#triggerevent-container').addClass('d-none')
            }
            
        }
        $('#enableEventTrigger').on('change', showHideTriggerEventCol)
        showHideTriggerEventCol()

        function showAndHideSelectColumn() {
            $('#select_event_value_column').addClass('d-none')
            if ($('#type_trigger_event').val() === 'save_response') {
                $('#select_event_value_column').removeClass('d-none')
            }
        }
        $('#type_trigger_event').on('change', showAndHideSelectColumn)
        showAndHideSelectColumn()


        $('#add-response').on('click', function() {
            let childElementCount = document.getElementById("custom-option-message").childElementCount;
            console.log(childElementCount);
            // if ($(this).attr("tipe-list") == 'button') {
            //     label = 'Button Option';
            //     if (childElementCount == 2) {
            //         $("#add-response").addClass('d-none')
            //     }
            // }
            // if ($(this).attr("tipe-list") == 'list') {
            //     label = 'Button List';
            //     if (childElementCount == 4) {
            //         $("#add-response").addClass('d-none')
            //     }
            // }
            // if ($(this).attr("tipe-list") == 'custom') {
            //     label = 'Custom Response';
            // }
            let html = `
            <div class="col-12 reply-row">
                <input type="hidden" name="action[]" value="null">
                <div class="row">
                    <div class="col-6 mt-4">
                        <label>Response ${childElementCount + 1}</label>
                        <input type="text" name="button[]" class="form-control">
                    </div>
                    <div class="col-5 mt-4">
                        <label>Pesan Balasan</label>
                        <select type="text" class="form-control" name="respon[]">
                            <option selected value="null">Pilih pesan balasan</option>
                            @foreach ($list_message as $msg_reply)
                                <option value="{{ $msg_reply->id }}">{{ $msg_reply->title }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-1" style="margin-top: 52px;justify-content: center;display: flex;">
                        <button class="button-add button-add--blue color-red" type="button"
                            style="background-color: red;" onclick="removeReply(this)">
                            <span class="button-add__icon">
                                <svg class="icon-icon-trash">
                                    <use xlink:href="#icon-trash"></use>
                                </svg>
                            </span>
                            <span class="button-add__text"></span>
                        </button>
                    </div>
                </div>
            </div>`
            $('#custom-option-message').append(html)
        })

        function removeReply(elButton) {
            const wrap = $(elButton).closest('.reply-row')
            wrap.remove()
        }

        // $('#type_button').on('change', function() {
        //     $('#custom-option-message').removeClass('d-none')
        //     $('#add-response').removeClass('d-none')
        //     let childElement = document.getElementById("custom-option-message")
        //     while (childElement.firstChild) {
        //         childElement.removeChild(childElement.lastChild);
        //     }
        //     if (this.value == 'button') {
        //         $('#add-response').attr('tipe-list', 'button')
        //         document.getElementById('label-option').innerHTML = 'Button Option'
        //     }
        //     if (this.value == 'list') {
        //         $('#add-response').attr('tipe-list', 'list')
        //         document.getElementById('label-option').innerHTML = 'Button List'
        //     }
        //     if (this.value == 'custom') {
        //         $('#add-response').attr('tipe-list', 'custom')
        //         document.getElementById('label-option').innerHTML = 'Custom Response'
        //     }
        //     if (this.value == '') {
        //         $('#custom-option-message').addClass('d-none')
        //         $('#add-response').addClass('d-none')
        //     }
        // })

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
