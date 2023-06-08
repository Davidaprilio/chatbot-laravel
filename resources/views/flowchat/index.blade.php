@extends('layouts.admin')
@php(
    $breadcrums = [
        '<i class="fa fa-home"></i>' => url('/'),
        'Chatbot Setting' => '#',
        'FlowChat' => '#',
    ]
)

@section('content')
    <x-page-content title="FlowChat" :breadcrumbs="$breadcrums">
        <x-button-tools icon="fa fa-plus" class="button-add button-add--blue" title="Add Flow" data-modal="#addFlowchat" />

        <div class="table-wrapper">
            <div class="table-wrapper__content table-collapse scrollbar-thin scrollbar-visible" >
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
                            <th class="table__th-sort">
                                <span class="align-middle">Usage</span>
                            </th>
                            <th class="table__actions"></th>
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
                            <td class="table__td">
                                @if ($flow->device)
                                    <a class="text-blue" href="{{ url('device/detail/' . $flow->device->id) }}">{{ $flow->device->label }} ({{ $flow->device->id }})</a>
                                @else
                                    <span class="text-grey">Draft</span>
                                @endif
                            </td>
                            <td class="table__td table__actions">
                                <div class="items-more">
                                    <button class="items-more__button">
                                        <svg class="icon-icon-more">
                                            <use xlink:href="#icon-more"></use>
                                        </svg>
                                    </button>
                                    <div @class(['dropdown-items dropdown-items--right', 'dropdown-items--up' => $loop->iteration > ($flows->count() - 6)])>
                                        <div class="dropdown-items__container">
                                            <ul class="dropdown-items__list">
                                                <li class="dropdown-items__item">
                                                    <a class="dropdown-items__link" href="{{ route('message',['flow' => $flow->id]) }}">
                                                        <span class="dropdown-items__link-icon"><x-svgicon link="icon-view" /></span>
                                                        Open Messages
                                                    </a>
                                                </li>
                                                <li class="dropdown-items__item">
                                                    <a class="dropdown-items__link" href="{{ route('flowchat.graph', ['flowChat' => $flow->id]) }}">
                                                        <span class="dropdown-items__link-icon">
                                                            <i class="fa fa-diagram-project"></i>
                                                        </span>
                                                        Open&nbsp;Flow&nbsp;Graph
                                                    </a>
                                                </li>
                                                <li class="dropdown-items__item">
                                                    <a class="dropdown-items__link" onclick="getDetails('{{ $flow->id }}')">
                                                        <span class="dropdown-items__link-icon"><i class="fa fa-pen"></i></span>
                                                        Edit
                                                    </a>
                                                </li>
                                                <li class="dropdown-items__item">
                                                    <x-link class="dropdown-items__link" href="{{ route('flowchat.delete', ['flowChat' => $flow->id]) }}" method="DELETE" confirm>
                                                        <span class="dropdown-items__link-icon"><x-svgicon link="icon-trash" /></span>
                                                        Delete
                                                    </x-link>
                                                    {{-- <a class="" onclick="">
                                                    </a> --}}
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @if ($flows->count() == 0)
                            <tr>
                                <td colspan="5" class="text-center">
                                    <div class="py-4 text-center">
                                        <i class="fa fa-info-circle fa-2x text-grey"></i>
                                        <p class="text-grey">No data available</p>
                                    </div>
                                </td>
                            </tr>                           
                        @endif
                    </tbody>
                </table>
            </div>
        </div>

    </x-page-content>
@endsection


@push('modals')
<div class="modal modal--panel modal--right" id="addFlowchat">
    <div class="modal__overlay" data-dismiss="modal"></div>
    <div class="modal__wrap">
        <div class="modal__window scrollbar-thin" data-simplebar>
            <div class="modal__content">
                <div class="modal__header">
                    <div class="modal__container">
                        <h2 class="modal__title">Form Flow Chat</h2>
                    </div>
                </div>
                <form method="POST" action="{{ route('flowchat.save') }}">
                    @csrf
                    <input type="hidden" name="id_flow_input">
                    <div class="modal__body">
                        <div class="modal__container">
                            <div class="row row--md">
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Flow chat name</label>
                                    <div class="input-group">
                                        <input class="input" name="name_flow_input" type="text" placeholder="Enter name of Flow Chat" required>
                                    </div>
                                </div>
                                <div class="col-12 form-group form-group--lg">
                                    <label class="form-label">Description</label>
                                    <div class="input-editor">
                                        <textarea class="input" name="desc_flow_input" rows="5" cols="5" placeholder="Enter description of this flow"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal__footer">
                        <div class="modal__container">
                            <div class="modal__footer-buttons">
                                <div class="modal__footer-button">
                                    <button class="button button--primary button--block" type="submit">
                                        <span class="button__text">Save</span>
                                    </button>
                                </div>
                                <div class="modal__footer-button">
                                    <button type="button" class="button button--secondary button--block" data-dismiss="modal" onclick="clearFormFlow()">
                                        <span class="button__text">Cancel</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endpush

@section('js')
    <script>
        async function getDetails(id) {
            try {
                const flow = await ajaxPromise({
                    url: url('/chatbot/flow/' + id),
                })
                $('[name="id_flow_input"]').val(flow.id)
                $('[name="name_flow_input"]').val(flow.name)
                $('[name="desc_flow_input"]').val(flow.description)
                Modal.toggleClass($('#addFlowchat').get(0))
            } catch (error) {
                console.error(error);
                swal.fire('Opps ada masalah', undefined, 'error')
            }
        }

        function clearFormFlow() {
            $('[name="id_flow_input"]').val('')
            $('[name="name_flow_input"]').val('')
            $('[name="desc_flow_input"]').val('')
        }

        function confirmDelete(event) {
            event.preventDefault()
            swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
            }).then((result) => {
                if (result.isConfirmed) {
                    event.target.submit()
                }
            })
        }
    </script>
@endsection
