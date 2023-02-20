@extends('layouts.backend')
@section('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        th.dt-left,
        td.dt-left {
            text-align: left;
        }

    </style>
@endsection

@section('content')
    <div class="app-page-title">
        <div class="page-title-wrapper">
            <div class="page-title-heading">
                <div class="page-title-icon">
                    <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                    </i>
                </div>
                <div>{{ env('APP_NAME') }}
                    <div class="page-title-subheading"> This is the Backend UI for {{ env('APP_NAME') }}
                    </div>
                </div>
            </div>
            <div class="page-title-actions">
                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button> --}}
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.draws.create') }}">
                        <button type="button" class="btn-shadow btn btn-info">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-plus fa-w-20"></i>
                            </span>
                            Add draw
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Draws
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable ajaxTable datatable-draw" id="drawsTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    {{-- <th>
                                        ID
                                    </th> --}}
                                    <th>
                                        Phone Number
                                    </th>
                                    <th>
                                        Draw
                                    </th>
                                    <th>
                                        Rejected By
                                    </th>
                                    <th>
                                        Date
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                @forelse($rejected_winners as $reject)
                                    <tr data-entry-id="{{ $reject->id }}">
                                        <td>

                                        </td>
                                        {{-- <td>
                                            {{ $draw->id ?? '' }}
                                        </td> --}}
                                        <td>
                                            {{ $reject->drawWinner->phone ?? 'No Phone' }}
                                        </td>
                                        <td>
                                            {{ $reject->drawWinner->draw->name?? 'Draw Name Not Found or Draw Was Removed'}}
                                        </td>
                                        <td>
                                            {{ $reject->user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $reject->created_at ?? '' }}
                                        </td>


                                    </tr>
                                @empty
                                    <tr>
                                        <td class="lead text-center" colspan="4">No Rejected Users</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#drawsTable').DataTable({
                dom: 'lBfrtip',
                pageLength: 100,
                buttons: [
                    'copy',
                    {
                        extend: 'excelHtml5',
                        title: 'Rejects_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Rejects_list',
                        exportOptions: {

                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
