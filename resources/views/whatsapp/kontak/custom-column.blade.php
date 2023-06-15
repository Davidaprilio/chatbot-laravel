@extends('layouts.admin')
@php
    $breadcrums = [
        '<i class="fa fa-home"></i>' => url('/'),
        'Whatsapp' => '#',
        'Kontak' => route('kontak'),
        'Kustom Kolom' => '#',
    ];
@endphp

@section('content')
    <x-page-content title="Kustom Kolom Kontak" :with-alert="false" :breadcrumbs="$breadcrums">
        <div class="row justify-content-center">
            <div class="col-12 col-md-10 col-lg-8">
                @include('layouts.alerts')

                <div class="card p-0 rounded-md border mb-3">
                    <div class="card__wrapper">
                        <div class="card__container p-0">
                            <div class="card__body p-2">
                                <form action="{{ route('kontak.custom_column') }}" method="POST" id="form-save-column">
                                    @csrf
                                    <div class="row align-items-center justify-content-between">
                                        <div class="form-group mb-0 col">
                                            <input required class="input" type="text" placeholder="Nama Kolom" name="new_column" id="column_name">
                                        </div>
                                        <div class="text-right">
                                            <button type="button" class="btn btn-link text-secondary m-0 px-0 d-none" id="btn-reset">
                                                <i class="fa fa-times m-0"></i>
                                            </button>
                                        </div>
                                        <div class="text-right">
                                            <button class="btn btn-primary m-0 btn-save">Simpan</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card p-0 rounded-md border">
                    <div class="card__wrapper">
                        <div class="card__container p-0">
                            <div class="card__body p-0">
                                {{-- list groups --}}
                                <table class="table table-sm rounded-top table--lines table-striped table-hover mb-0 table">
                                    <thead class="rounded-top">
                                        <tr class="thead-light rounded-top">
                                            <th class="table__th">Nama Kolom</th>
                                            <th class="table__th">Alias</th>
                                            <th class="table__th">Data</th>
                                            <th class="table__th"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($columns) === 0)
                                        <tr>
                                            <td colspan="4" class="text-center py-3">Tidak ada data</td>
                                        </tr>
                                        @else
                                        @foreach ($columns as $column_name => $data_count)
                                        <tr class="table__row">
                                            <td class="table__td">{{ $column_name }}</td>
                                            <td class="table__td">{!! str_replace(' ', '&nbsp;', Str::headline($column_name)) !!}</td>
                                            <td class="table__td">
                                                <span class="badge badge-primary badge-pill">{{ $data_count }}</span>
                                            </td>
                                            <td class="table__td text-right">
                                                <button data-column="{{ $column_name }}" class="text-primary mr-4 btn-edit">
                                                    <i class="fa fa-pen"></i>
                                                </button>
                                                <form action="{{ route('kontak.custom_column') }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input type="hidden" value="{{ $column_name }}" name="column_name" />
                                                    <button type="button" class="text-danger btn-remove">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </x-page-content>
@endsection


@section('js')
    <script>
        // on removed
        $('.btn-remove').on('click', function() {
            const button = $(this);
            Swal.fire({
                title: 'Hapus Kolom?',
                text: "Kolom akan dihapus dari database dan tidak dapat dikembalikan lagi! dan Semua data yang ada di kolom tersebut akan dihapus juga!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Hapus',
                cancelButtonText: 'Batal',
            }).then((result) => {
                if (result.isConfirmed) {
                    button.closest('form').submit();
                }
            });
        });

        // on edit
        $('.btn-edit').on('click', async function() {
            const column = $(this).data('column');

            // confirm
            const confirmed = await Swal.fire({
                title: 'Ubah Kolom?',
                text: "Variabel kolom akan tidak berfungsi jika anda telah menggunakannya di template pesan!, segera ubah template pesan yang menggunakan variabel kolom setelah mengubah kolom!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Saya mengerti',
                cancelButtonText: 'Batal',
            }).then((result) => result.isConfirmed);

            if (!confirmed) return;

            // remove hidden input column name if exist
            $('#form-save-column input[name="column_name"]').remove();
            // add hidden input column name
            $('#form-save-column').append(`<input type="hidden" name="column_name" value="${column}" />`);
            // set value input
            $('#column_name').val(column);
            // show reset button
            $('#btn-reset').removeClass('d-none');
            $('#form-save-column .btn-save').text('Ubah ' + column);
        })


        // on reset
        $('#btn-reset').on('click', function() {
            $('#form-save-column input[name="column_name"]').remove();
            $('#column_name').val('');
            $('#form-save-column .btn-save').text('Simpan');
            $('#btn-reset').addClass('d-none');
        })
    </script>
@endsection