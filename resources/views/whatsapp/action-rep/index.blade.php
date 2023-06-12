@extends('layouts.admin')
@section('content')
    <main class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-header__title">Data Action Replies</h1>
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
                                <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Data Action
                                        Replies</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-tools__right">
                    <div class="page-tools__right-row">
                        <div class="page-tools__right-item">
                            <a class="button button--secondary" type="button" href="{{ url('action-replies/credit') }}">
                                <span class="button__icon button__icon--left"><svg class="icon-icon-plus">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                </span>
                                <span class="button__text">Tambah Action Replies</span>
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
                                <table class="table table--lines" id="datatables-action-replies">
                                    <thead class="table__header">
                                        <tr class="table__header-row text-center">
                                            <th style="width: 50px;"><span>No</span></th>
                                            <th class="" style="text-align: center"><span
                                                    class="align-middle">Judul</span></th>
                                            <th class="" style="text-align: center; max-width: 200px;"><span
                                                    class="align-middle">Action Replies</span></th>
                                            <th class="" style="text-align: center"><span class="align-middle">Tipe
                                                    Action Replies</span></th>
                                            <th class="table__actions"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($action_rep as $item)
                                            <tr class="table__row text-center">
                                                <td class="table__td"><span class="text-grey">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="table__td">{{ $item->title ?? '-' }}</td>
                                                <td class="table__td text-truncate" style="max-width: 200px;">
                                                    <small>
                                                        {{ $item->prompt_response ?? '-' }}
                                                    </small>
                                                </td>
                                                <td class="table__td">
                                                    <small>{{ $item->type ?? '-' }}</small>
                                                </td>
                                                <td class="table__td table__actions">
                                                    <div class="items-more">
                                                        <button class="items-more__button">
                                                            <svg class="icon-icon-more">
                                                                <use xlink:href="#icon-more"></use>
                                                            </svg>
                                                        </button>
                                                        <div class="dropdown-items dropdown-items--right">
                                                            <div class="dropdown-items__container">
                                                                <ul class="dropdown-items__list">
                                                                    <li class="dropdown-items__item">
                                                                        <a class="dropdown-items__link"
                                                                            href="{{ url('action-replies/credit?id=' . $item->id) }}">
                                                                            <span class="dropdown-items__link-icon">
                                                                                <svg class="icon-icon-view">
                                                                                    <use xlink:href="#icon-view"></use>
                                                                                </svg>
                                                                            </span>Edit
                                                                        </a>
                                                                    </li>
                                                                    <li class="dropdown-items__item">
                                                                        <a class="dropdown-items__link"
                                                                            href="javascript:void(0)"
                                                                            onclick="removeAR('{{ url('action-replies/remove?ar=1&id=' . $item->id) }}')">
                                                                            <span class="dropdown-items__link-icon">
                                                                                <svg class="icon-icon-trash">
                                                                                    <use xlink:href="#icon-trash"></use>
                                                                                </svg>
                                                                            </span>Delete
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
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
@endsection
@section('js')
    <script>
        $('#datatables-action-replies').DataTable({
            ordering: false,
            // scrollX: true,
        });

        function removeAR(url) {
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
    </script>
@endsection
