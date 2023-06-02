@extends('layouts.admin')
@section('content')
    <main class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-header__title">Device</h1>
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
                                        href="#"><span>Whatsapp</span>
                                        <svg class="icon-icon-keyboard-right breadcrumbs__arrow">
                                            <use xlink:href="#icon-keyboard-right"></use>
                                        </svg></a>
                                </li>
                                <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Device</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-tools__right">
                    <div class="page-tools__right-row">
                        <div class="page-tools__right-item">
                            <a class="button button--secondary" type="button" href="javascript:void(0)"
                                data-modal="#creditDevice">
                                <span class="button__icon button__icon--left"><svg class="icon-icon-plus">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                </span>
                                <span class="button__text">Tambah Device</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.alerts')
            <div class="card">
                <div class="card__wrapper">
                    <div class="card__container pl-4 pr-4">
                        <div class="card__body">
                            <div class="table-wrapper">
                                <table class="table table--lines" id="datatables-user">
                                    <thead class="table__header">
                                        <tr class="table__header-row text-center">
                                            <th style="width: 50px; text-align: center;"><span>No</span></th>
                                            <th class="" style="text-align: center"><span class="align-middle">Server
                                                    - Handphone</span></th>
                                            <th class="" style="text-align: center"><span
                                                    class="align-middle">User</span></th>
                                            <th class="" style="text-align: center">
                                                <span class="align-middle">Status</span>
                                            </th>
                                            <th class="" style="text-align: center">
                                                <span class="align-middle">Flow Chat Bot</span>
                                            </th>
                                            <th class="table__actions"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($device as $item)
                                            <tr class="table__row text-center">
                                                <td class="table__td"><span class="">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="table__td">
                                                    {{ $item->server->name ?? '-' }} - {{ $item->phone ?? '-' }}
                                                </td>
                                                <td class="table__td"><span
                                                        class="">{{ $item->user->name ?? '-' }}</span>
                                                </td>
                                                <td class="table__td">
                                                    @if ($item->status == 'AUTHENTICATED')
                                                        <div class="table__status"><span
                                                                class="table__status-icon color-green"></span>{{ $item->status }}
                                                        </div>
                                                    @else
                                                        <div class="table__status"><span
                                                                class="table__status-icon color-red"></span>{{ $item->status }}
                                                        </div>
                                                    @endif
                                                </td>
                                                <td class="table__td">
                                                    @if ($item->flow_chat)
                                                        <a href="{{ route('message', ['flow' => $item->flow_chat_id]) }}">{{ $item->flow_chat->name }}</a>
                                                        <button class="btn btn-set-flow btn-sm btn-link" data-id="{{ $item->id }}" data-selected="{{ $item->flow_chat_id }}">
                                                            <i class="fa fa-pencil"></i>
                                                        </button>
                                                    @else
                                                        <button class="btn btn-set-flow btn-sm btn-link" data-id="{{ $item->id }}">
                                                            set flow <i class="fa fa-plus"></i>
                                                        </button>
                                                    @endif
                                                </td>
                                                <td class="table__td d-flex">
                                                    <a class="button button--primary mr-2"
                                                        style="padding: 0 1rem; height: 2rem;"
                                                        href="{{ url('device/detail/' . $item->id) }}">
                                                        <span class="dropdown-items__link-icon">
                                                            <svg class="icon-icon-view">
                                                                <use xlink:href="#icon-view"></use>
                                                            </svg>
                                                        </span>View
                                                    </a>
                                                    <a class="button button--secondary color-red"
                                                        style="padding: 0 1rem; height: 2rem;" href="javascript:void(0)"
                                                        onclick="removeDevice('{{ url('device/remove?id=' . $item->id) }}')">
                                                        <span class="dropdown-items__link-icon">
                                                            <svg class="icon-icon-trash">
                                                                <use xlink:href="#icon-trash"></use>
                                                            </svg>
                                                        </span>Hapus
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="modal modal-account modal-compact scrollbar-thin" id="creditDevice" data-simplebar>
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
                                        <h2 id="title-credit">Tambah Device</h2>
                                    </div>
                                    <form action="{{ url('device/store') }}" method="post">
                                        @csrf
                                        <div class="row row--md">
                                            <div class="col-12 form-group form-group--lg">
                                                <label class="form-label form-label--sm">Label </label>
                                                <div class="input-group">
                                                    <input class="input" name="label" type="text"
                                                        placeholder="Label" required>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group form-group--lg">
                                                <label class="form-label form-label--sm">Nomor Handphone</label>
                                                <div class="input-group">
                                                    <input class="input" name="phone" type="number" minlength="10"
                                                        maxlength="13" placeholder="+62..." required>
                                                </div>
                                            </div>
                                            <div class="col-12 form-group form-group--lg">
                                                <label class="form-label form-label--sm">User</label>
                                                <div class="input-group input-group--append">
                                                    <select class="input js-input-select input--fluid select2"
                                                        data-placeholder="" name="user" id="user" required>
                                                        @foreach ($user as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select><span class="input-group__arrow">
                                                        <svg class="icon-icon-keyboard-down">
                                                            <use xlink:href="#icon-keyboard-down"></use>
                                                        </svg></span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-account__form-submit">
                                            <button class="button button--primary button--load" type="submit"><span
                                                    class="button__icon button__icon--left">
                                                    <svg class="icon-icon-refresh">
                                                        <use xlink:href="#icon-refresh"></use>
                                                    </svg></span><span class="button__text">Simpan</span>
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

    <div class="modal modal-compact scrollbar-thin" id="setFlowChatDevice" data-simplebar>
        <div class="modal__overlay" data-dismiss="modal"></div>
        <div class="modal__wrap">
            <div class="modal__window">
                <div class="modal__content">
                    <button class="modal__close" data-dismiss="modal">
                        <svg class="icon-icon-cross">
                            <use xlink:href="#icon-cross"></use>
                        </svg>
                    </button>
                    <div class="modal__body p-4">
                        <div class="">
                            <div class="modal-account__right tab-content">
                                <div class="modal-account__pane tab-pane fade show active" id="accountDetails">
                                    <div class="modal-account__pane-header">
                                        <h2 id="title-credit">Set Flow Chat</h2>
                                    </div>
                                    <form action="" id="form-set-flow" method="POST">
                                        @csrf
                                        <div class="row row--md">
                                            <div class="col-12 form-group form-group--lg">
                                                <label class="form-label form-label--sm">Label</label>
                                                <div class="input-group">
                                                    <select name="flow_chat_id" id="select-chat-flow" class="form-control"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-account__form-submit">
                                            <button class="button button--primary button--load" type="submit">
                                                <span class="button__icon button__icon--left">
                                                    <svg class="icon-icon-refresh">
                                                        <use xlink:href="#icon-refresh"></use>
                                                    </svg>
                                                </span>
                                                <span class="button__text">Apply</span>
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
    <script>
        $('#datatables-user').DataTable({
            "ordering": false,
            // "scrollX": true,
        });

        $('#user').select2()

        function removeDevice(url) {
            Swal.fire({
                title: 'Ingin menghapus data?',
                text: "Data akan terhapus permanen!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: url,
                        success: function() {
                            Swal.fire(
                                'Terhapus!',
                                'Data berhasil dihapus.',
                                'success'
                            ).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = location.href;
                                }
                            })
                        }
                    });
                }
            })
        }

        $('.btn-set-flow').on('click', async function() {
            const button = $(this)
            $('#select-chat-flow').prop('disable', true)
            await renderOptionFlowChat(button.data('id'), button.data('selected'))
            Modal.toggleClass($('#setFlowChatDevice').get(0))
            $('#form-set-flow').attr('action', '{{ route("device.flows", ["device" => ":device"]) }}'.replace(':device', button.data('id')))
            
            if(button.data('selected')) {
                $('#select-chat-flow').val(button.data('selected'))
            }
            $('#select-chat-flow').prop('disable', false)

            $('#form-set-flow #overwrite-input').remove()
        })

        $('#form-set-flow').on('submit', async function(event) {
            event.preventDefault()
            try {
                const res = await sendForm('form-set-flow')
                Swal.fire({
                    title: res.message,
                    type: "success",
                    timer: 1000
                })
                closeModal('#setFlowChatDevice')
                window.location.reload()
            } catch (error) {
                if (error.status == 422) {
                    return alert(error.responseJSON.message)
                } else if (error.status == 400) {
                    const isOverwrite = await Confirm.fire({
                        title: "Overwrite This",
                        text: error.responseJSON.message,
                        type: "success",
                    }).then(r => r.isConfirmed)

                    if (isOverwrite) {
                        $('#form-set-flow').append('<input type="hidden" name="overwrite" id="overwrite-input" value="1">')
                        return $('#form-set-flow').submit()
                    }


                } else {
                    console.error(error);
                }
            }
        })

        async function renderOptionFlowChat(id, selected) {
            const dataFlowList = await ajaxPromise({
                url: `/device/${id}/flows`,
            }, 'GET')

            $('#select-chat-flow').html('')
            dataFlowList.forEach(flow => {
                $('#select-chat-flow').append(
                    `<option value="${flow.id}">${flow.name} ${flow.device ? ` - (used device: ${flow.device.name})` : ''} </option>`
                )
            })
        }
    </script>
@endsection
