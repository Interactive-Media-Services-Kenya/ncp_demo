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
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable datatable-draw" id="drawsTable">
                            <thead>
                                <tr>
                                    <th width="8">

                                    </th>
                                    {{-- <th>
                                        ID
                                    </th> --}}
                                    <th>
                                        Draw Name
                                    </th>
                                    <th>Prize Type</th>
                                    <th>
                                        Start Date
                                    </th>
                                    <th>
                                        End Date
                                    </th>
                                    <th>
                                        Draw Run Winner
                                    </th>
                                    <th>
                                        Created By
                                    </th>
                                    <th>
                                        Date Created
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($draws as $key => $draw)
                                    <tr data-entry-id="{{ $draw->id }}">
                                        <td>

                                        </td>
                                        {{-- <td>
                                            {{ $draw->id ?? '' }}
                                        </td> --}}
                                        <td>
                                            {{ $draw->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ \DB::table('prices')->where('value', $draw->prize)->value('name')}}
                                        </td>
                                        <td>
                                            {{ $draw->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $draw->end_date ?? '' }}
                                        </td>
                                        {{-- <td>@php
                                            $rejectedWinnersIDs = \App\Models\RejectWinner::select('draw_winner_id')->cursor();
                                        @endphp
                                            {{ count(DB::table('draw_winners')->where('draw_id',$draw->id)->whereNotIn('id',$rejectedWinnersIDs)->get())}}
                                        </td> --}}
                                        <td>
                                            @php
                                            $rejectedWinnersIDs = \App\Models\RejectWinner::select('draw_winner_id')->cursor();
                                        @endphp
                                            {{-- {{ DB::table('draw_winners')->where('draw_id',$draw->id)->whereNotIn('id',$rejectedWinnersIDs)->value('phone')??'No Winner' }} --}}
                                            {{ DB::table('draw_winners')->where('draw_id',$draw->id)->whereNotIn('id',$rejectedWinnersIDs)->count()??'No Winner' }}
                                        </td>
                                        <td>
                                            {{ $draw->user->email ?? '' }}
                                        </td>
                                        <td>
                                            {{ $draw->created_at ?? '' }}
                                        </td>
                                        <td>
                                            @can('draw_show')
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('admin.draws.show', $draw->id) }}">
                                                    View
                                                </a>
                                            @endcan

                                            @can('draw_edit')
                                                <a class="btn btn-xs btn-info"
                                                    href="{{ route('admin.draws.redraw', $draw->id) }}">
                                                    Rerun Draw
                                                </a>
                                            @endcan

                                            @can('draw_delete')
                                                <form action="{{ route('admin.draws.destroy', $draw->id) }}"
                                                    method="POST" onsubmit="return confirm('Are You Sure?');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="lead text-center" colspan="11">No Draws Registered</td>
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
                        title: 'Complaints_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Entries_list',
                        exportOptions: {

                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
