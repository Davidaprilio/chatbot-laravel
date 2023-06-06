@extends('layouts.admin')
@section('content')
    <main class="page-content">
        <div class="container">
            <div class="widgets">
                <div class="widgets__row row gutter-bottom-xl">
                    <div class="col-12 col-md-6 col-xl-3 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">

                                    <div class="widget__left">
                                        <h3 class="widget__title">Total User</h3>
                                        {{-- <div class="widget__status-title text-grey">Total User</div> --}}
                                        <div class="widget__trade"><span
                                                class="widget__trade-count">{{ $total_user }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">Total Device</h3>
                                        {{-- <div class="widget__status-title text-grey">Total Conversation</div> --}}
                                        <div class="widget__trade"><span
                                                class="widget__trade-count">{{ $total_device }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">Total Kontak</h3>
                                        {{-- <div class="widget__status-title text-grey">Total Message</div> --}}
                                        <div class="widget__trade"><span
                                                class="widget__trade-count">{{ $total_kontak }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-xl-3 d-flex">
                        <div class="widget">
                            <div class="widget__wrapper">
                                <div class="widget__row">
                                    <div class="widget__left">
                                        <h3 class="widget__title">Flow Chat</h3>
                                        {{-- <div class="widget__status-title text-grey">Total visits today</div> --}}
                                        <div class="widget__trade"><span class="widget__trade-count">{{ $total_flow }}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <section class="section">
                <div class="section__title d-none">
                    <h2>Section</h2>
                </div>
                <div class="row justify-content-center gutter-bottom-xl">

                    <div class="col-12 col-lg-7 col-xl-4 d-flex">
                        <div class="card">
                            <div class="card__wrapper">
                                
                                    <div class="card__header">
                                        <h3 class="card__header-title">User</h3>
                                        <div class="card__header-left">
                                        </div>
                                    </div>
                                    
                                
                                
                                <table class="table table--lines" id="datatables-user">
                                    <thead class="table__header">
                                        <tr class="table__header-row text-center">
                                            <th style="width: 50px;"><span>No</span></th>
                                            <th class="" style="text-align: center"><span
                                                    class="align-middle">Nama</span></th>
                                            <th class="" style="text-align: center"><span
                                                    class="align-middle">Kontak</span></th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($user as $item)
                                            <tr class="table__row text-center">
                                                <td class="table__td"><span class="text-grey">{{ $loop->iteration }}</span>
                                                </td>
                                                <td class="table__td">{{ $item->name ?? '-' }}</td>
                                                <td class="table__td"><span class="text-grey">{{ $item->email ?? '-' }} <br>
                                                        {{ $item->phone ?? '-' }}</span>
                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>

                    <div class="col-12 col-lg-7 col-xl-4 d-flex">
                        <div class="card">
                            <div class="card__wrapper">
                                
                                    <div class="card__header">
                                        <h3 class="card__header-title">Flow Chat</h3>
                                        <div class="card__header-left">
                                        </div>
                                    </div>
                                    
                                
                                
                <table class="table table--lines" id="datatables-user">
                    <thead class="table__header">
                        <tr class="table__header-row">
                            <th class="d-none d-lg-table-cell" style="width: 90px">
                                <span>ID</span>
                            </th>
                            <th class="table__th-sort">
                                <span class="align-middle">Name</span>
                            </th>
                            <th class="table__th-sort">
                                <span class="align-middle">Description</span>
                            </th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($flows as $flow)
                        <tr class="table__row">
                            <td class="d-none d-lg-table-cell table__td">
                                <span class="text-grey">{{ $flow->id }}</span>
                            </td>
                            <td class="table__td">
                                <a href="{{ route('message',['flow' => $flow->id]) }}">{{ $flow->name }}</a>
                            </td>
                            <td class="table__td">
                                <span class="text-grey">{{ $flow->description ?? 'no description...' }}</span>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                            </div>
                            
                        </div>
                    </div>


                    <div class="col-12 col-lg-5 col-xl-4 d-flex">
                        <div class="card">
                            <div class="card__wrapper">
                                <div class="card__container">
                                    <div class="card__header mb-0">
                                        <div class="card__header-left">
                                            <h3 class="card__header-title">Last Chat</h3>
                                        </div>
                                    </div>
                                    <div class="chat-users__content scrollbar-thin scrollbar-hidden" data-simplebar>
                                        <ul class="chat-users__list">
                                            @foreach ($customers as $customer)
                                                <li class="chat-users__list-item">
                                                    <x-chat.list-item :customer="$customer" data-id="{{ $customer->id }}" class="user-chat-item" />
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
