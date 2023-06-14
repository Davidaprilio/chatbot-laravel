@extends('layouts.admin')
@section('content')
<style>
    #datatables-kontak_wrapper {
        min-height: 250px
    }
</style>
    <main class="page-content">
        <div class="container">
            <div class="page-header">
                <h1 class="page-header__title">Data Kontak</h1>
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
                                <li class="breadcrumbs__item active"><span class="breadcrumbs__link">Data Kontak</span>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="page-tools__right">
                    <div class="page-tools__right-row">
                        <div class="page-tools__right-item">
                            <a class="button button--secondary" type="button" href="{{ url('kontak/credit') }}">
                                <span class="button__icon button__icon--left"><svg class="icon-icon-plus">
                                        <use xlink:href="#icon-plus"></use>
                                    </svg>
                                </span>
                                <span class="button__text">Tambah Kontak</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.alerts')

            <div class="bg-white p-3 rounded mb-3">
                <div class="d-flex align-items-center">
                    <div class="items-more mr-3">
                        <button class="items-more__button button-icon active">
                            <x-svgicon link="icon-list" />
                        </button>
                        <div class="dropdown-items">
                            <div class="dropdown-items__container">
                                <ul class="dropdown-items__list" style="max-height: 60vh; overflow-y:auto;">
                                    @foreach (array_merge(['No'], $column_names, ['Action']) as $column)
                                        <li class="dropdown-items__item">
                                            <a class="dropdown-items__link toggle-column-item" data-column="{{ $loop->index }}">
                                                <span class="dropdown-items__link-icon" style="width: 35px; height: 17px">
                                                    <span class="circle-check">
                                                        <i class="fa-regular fa-circle-check"></i>
                                                    </span>
                                                    <span class="circle d-none">
                                                        <i class="fa-regular fa-circle"></i>
                                                    </span>
                                                </span>
                                                <span>{!! str_replace(' ', '&nbsp;', $column) !!}</span>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div>
                        <a href="#" id="export_data" class="btn btn-sm btn-primary mr-3">
                            <i class="fa-solid fa-download"></i>
                            Export
                        </a>
                    </div>
                    <div>
                        <a href="#" id="export_data" class="btn btn-sm btn-primary">
                            <i class="fa-solid fa-plus"></i>
                            Add Column
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card__wrapper">
                    <div class="card__container pl-4 pr-4">
                        <div class="card__body">
                            <div class="table-wrapper table-responsive">
                                <table class="table table--lines w-100" id="datatables-kontak">
                                    <thead class="table__header">
                                        <tr class="table__header-row text-center">
                                            <th style="width: 50px;">
                                                <span>No</span>
                                            </th>
                                            @foreach ($column_names as $column)
                                                <th class="" style="text-align: center">
                                                    <span class="align-middle">{!! str_replace(' ', '&nbsp;', $column) !!}</span>
                                                </th>
                                            @endforeach
                                            <th class="table__actions">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody style="min-height: 300px"></tbody>
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
        const tableContact = $('#datatables-kontak').DataTable({
            // ordering: false,
            responsive: true,
            processing: true,
            serverSide: true,
            // scrollX: true,
            ajax: {
                url: url(),
                type: "GET",
            },
            columns: [{
                    data: '_no_iteration',
                    name: '_no_iteration',
                    className: 'text-center',
                    searchable: false,
                    orderable: false,
                    render: function(data, type, row, meta) {
                        return meta.row + meta.settings._iDisplayStart + 1;
                    }
                },
                @foreach ($column_names as $column => $_)
                    {
                        data: '{{ $column }}',
                        name: '{{ $column }}',
                        defaultContent: '-',
                        className: 'text-center'
                    },
                @endforeach {
                    data: '_action',
                    name: '_action',
                    className: 'text-center table__td table__actions',
                    searchable: false,
                    orderable: false
                },
            ]
        });

        $('.toggle-column-item').on('click', function(e) {
            e.preventDefault();
            const anchor = $(this)
            const column = tableContact.column(anchor.attr('data-column'));
            anchor.find('span.dropdown-items__link-icon span').addClass('d-none')
            if (column.visible()) {
                anchor.find('span.circle').removeClass('d-none')
            } else {
                anchor.find('span.circle-check').removeClass('d-none')
            }
            column.visible(!column.visible());

            
            const columns = changeExportUrl()
            /// save to local storage
            localStorage.setItem('columns_visible_tale_contact', columns.join(','))
        });

        function changeExportUrl() {
            const columns_visible = getVisibilityColumnData()
            $('#export_data').attr('href', url('/kontak/export?columns=' + columns_visible.join(',')))
            return columns_visible
        }
        
        function getVisibilityColumnData() {
            return tableContact.columns().visible().toArray().map((visibility, index) => ({
                data: tableContact.init().columns[index].data,
                visibility
            })).filter(column => column.visibility === true).map(column => column.data)
        }

        $(document).ready(function() {
            // get visibility column from local storage
            const columns_visible = localStorage.getItem('columns_visible_tale_contact')
            if (columns_visible) {
                $('span.dropdown-items__link-icon span.circle').addClass('d-none')
                const columns = columns_visible.split(',')
                tableContact.columns().visible(false)
                console.log(columns);
                columns.forEach(column => {
                    const index = tableContact.column(column + ':name').index()
                    tableContact.column(index).visible(true)
                    const anchor = $('.toggle-column-item[data-column="' + index + '"]')
                    anchor.find('span.circle-check').removeClass('d-none')
                })
            }
            const column = changeExportUrl()
        })

        function removeKontak(url) {
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
