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
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Draw Winners List
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable datatable-draw"
                            id="drawsTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    {{-- <th>
                                        ID
                                    </th> --}}
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Code
                                    </th>
                                    <th>
                                        Draw
                                    </th>
                                    <th>
                                        Date
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($draw_winners as $key => $draw_winner)
                                    <tr data-entry-id="{{ $draw_winner->id }}">
                                        <td>

                                        </td>
                                        {{-- <td>
                                            {{ $draw_winner->id ?? '' }}
                                        </td> --}}
                                        <td>
                                            {{ $draw_winner->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ $draw_winner->code ?? '' }}
                                        </td>
                                        <td>
                                            {{ strtoupper(DB::table('draws')->where('id', $draw_winner->draw_id)->value('name')) ?? '' }}
                                        </td>
                                        <td>
                                            {{ $draw_winner->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('draw_show')
                                                @if ($draw_winner->status == 0)
                                                    <a class="btn btn-xs btn-success"
                                                        href="{{ route('admin.draws.draw-winner-confirm', $draw_winner->id) }}" onclick="return confirm('Are you sure?')">
                                                        Confirm
                                                    </a>
                                                @endif
                                                @if ($draw_winner->status == 1)
                                                    <a class="btn btn-xs btn-danger"
                                                        href="{{ route('admin.draws.draw-winner-reject', $draw_winner->id) }}">
                                                        Reject
                                                    </a>
                                                @endif
                                            @endcan


                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="lead text-center" colspan="6">No Draw Winners Registered</td>
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
                        title: 'DrawWinners_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'DrawWinners_list',
                        exportOptions: {

                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
