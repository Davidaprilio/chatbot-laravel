@extends('layouts.admin')
@section('content')
<main class="page-content">
    <div class="container">
        <div class="page-header">
            <h1 class="page-header__title">Data User</h1>
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
                            <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Data User</span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="page-tools__right">
                <div class="page-tools__right-row">
                    <div class="page-tools__right-item">
                        <a class="button button--secondary" type="button" href="{{ url('user/credit') }}">
                            <span class="button__icon button__icon--left"><svg class="icon-icon-plus">
                                <use xlink:href="#icon-plus"></use></svg>
                            </span>
                            <span class="button__text">Tambah User</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card__wrapper">
                <div class="card__container pl-2 pr-2">
                    <div class="card__body">
                        <div class="table-wrapper">
                            <table class="table table--lines" id="datatables-user">
                                <thead class="table__header">
                                    <tr class="table__header-row text-center">
                                        <th style="width: 50px;"><span>No</span></th>
                                        <th class="table__th-sort d-none d-lg-table-cell"><span class="align-middle">Nama</span></th>
                                        <th class="table__th-sort d-none d-lg-table-cell"><span class="align-middle">Kontak</span></th>
                                        <th class="table__th-sort"><span class="align-middle">Status</span></th>
                                        <th class="table__th-sort d-none d-lg-table-cell">
                                            <span class="align-middle">Role</span>
                                        </th>
                                        <th class="table__actions"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($user as $item)
                                    <tr class="table__row text-center">
                                        <td class="table__td"><span class="text-grey">{{ $loop->iteration }}</span>
                                        </td>
                                        <td class="table__td d-none d-lg-table-cell">{{ $item->name ?? '-' }}</td>
                                        <td class="table__td d-none d-lg-table-cell"><span class="text-grey">{{ $item->email ?? '-' }} <br> {{ $item->phone ?? '-' }}</span>
                                        </td>
                                        <td class="d-none d-sm-table-cell table__td">
                                            @if ($item->status == 1)
                                                <div class="table__status"><span class="table__status-icon color-green"></span>Aktif</div>
                                            @else
                                                <div class="table__status"><span class="table__status-icon color-red"></span>Tidak Aktif</div>
                                            @endif
                                        </td>
                                        <td class="table__td">
                                            @if ($item->status == 1)
                                                <div class="label label--primary">Admin</div>
                                            @else
                                                <div class="label label--teal text-white color-teal">Client</div>
                                            @endif
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
                                                                <a class="dropdown-items__link" href="{{ url('user/credit?id='.$item->id) }}">
                                                                    <span class="dropdown-items__link-icon">
                                                                        <svg class="icon-icon-view">
                                                                            <use xlink:href="#icon-view"></use>
                                                                        </svg>
                                                                    </span>Edit
                                                                </a>
                                                            </li>
                                                            <li class="dropdown-items__item">
                                                                <a class="dropdown-items__link" href="{{ url('user/remove?id='.$item->id) }}">
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
        $('#example').DataTable({
            "ordering": false
        });
        // Users datatable
        // var table_user = $('#datatables-user').DataTable({
        //     processing: 'Loading...',
        //     serverSide: true,
        //     deferRender: true,
        //     ajax: document.location.href,
        //     columns: [{
        //             defaultContent: '-',
        //             className: 'text-center',
        //         },
        //         {
        //             data: 'title',
        //             defaultContent: '-',
        //             render: (data, type, row, meta) => {
        //                 return `<div class="d-flex flex-column" style="width: 150px;">
        //             ${row.title ?? '-'}
        //             </div>`
        //             }
        //         },
        //         {
        //             data: 'komisi',
        //             defaultContent: '-',
        //             className: 'text-center',
        //             render: (data, type, row, meta) => {
        //                 return `<div class="d-flex flex-column" style="max-width: 600px;">
        //                 Rp. ${new Intl.NumberFormat().format(row.komisi) ?? '-'}
        //             </div>`
        //             }
        //         },
        //         {
        //             data: 'note',
        //             defaultContent: '-',
        //             className: 'text-center',
        //             render: (data, type, row, meta) => {
        //                 return `<div class="d-flex flex-column" style="max-width: 600px;">
        //                 <span class="text-truncate">${row.note ?? '-'}</span>
        //             </div>`
        //             }
        //         },
        //         {
        //             className: 'text-center',
        //             render: (data, type, row, meta) => {
        //                 return `<div class="w-100 text-center"><div class="btn-group ms-auto">
        //                 <a type="button" href="{{ url('setting/komisi/credit?id=${row.id}') }}" class="btn btn-sm btn-primary waves-effect waves-light text-white edit-record" data-bs-target="#offcanvasAddUser" data-bs-toggle="offcanvas">
        //                     Edit <i class="fa-solid fa-pen-to-square p-1"></i>
        //                 </a>
        //                 <a type="button" href="{{ url('setting/komisi/remove?id=${row.id}') }}" class="btn btn-danger btn-sm text-white delete-record">Delete <i class="fa-solid fa-trash p-1"></i></a>
        //             </div>
        //             </div>`
        //             }
        //         },
        //     ],
        // });

        // table_user.on('draw.dt', function() {
        //     var PageInfo = $('#datatables-user').DataTable().page.info();
        //     table_user.column(0, {
        //         page: 'current'
        //     }).nodes().each(function(cell, i) {
        //         cell.innerHTML = i + 1 + PageInfo.start;
        //     });
        // });
    </script>
@endsection