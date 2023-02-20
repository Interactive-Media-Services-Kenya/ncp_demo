@extends('layouts.backend')
@section('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        th.dt-left,
        td.dt-left {
            text-align: left;
        }

        .preloader {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('/backend/assets/images/loader.gif') 50% 50% no-repeat rgb(255, 253, 253);
            opacity: 1.0;

        }
    </style>
@endsection

@section('content')
    <div id="preloaders" class="preloader"></div>
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

        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header justify-content-center"><b>Show Draw: {{ $draw->name ?? '' }} </b>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-info" href="{{ route('admin.draws.index') }}">
                                Back To draw List
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        Draw Name
                                    </th>
                                    <td>
                                        {{ $draw->name ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <td>
                                        {{ $draw->id ?? '' }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Draw Date
                                    </th>
                                    <td>
                                        {{ strtoupper($draw->created_at->format('d-m-Y') ?? '') }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Date Range (Start to End)
                                    </th>
                                    <td>
                                        <b>From: </b> {{ $draw->start_date ?? '' }} <b>To:</b> {{ $draw->end_date ?? '' }}
                                    </td>
                                </tr>
                                {{-- <tr>
                                            <th>
                                                Participant Range (Start to End)
                                            </th>
                                            <td>
                                               <b>From: </b> {{ $draw->from??'' }}  <b>To:</b>  {{ $draw->to??'' }}
                                            </td>
                                        </tr> --}}
                                {{-- <tr>
                                            <th>
                                                Region
                                            </th>
                                            <td>
                                               {{ strtoupper($draw->region->title?? '')}}
                                            </td>
                                        </tr> --}}
                                <tr>
                                    <th>
                                        Created by
                                    </th>
                                    <td>
                                        {{ strtoupper($draw->user->email ?? '') }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-info" href="{{ route('admin.draws.index') }}">
                                Back
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Draw Winers List
                    {{-- <div class="btn-actions-pane-right">
                                        <div role="group" class="btn-group-sm btn-group">
                                            <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                        </div>
                                    </div> --}}
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable ajaxDatatable datatable-draw"
                            id="drawsTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        ID
                                    </th>
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
                                        <td>
                                            {{ $draw_winner->id ?? '' }}
                                        </td>
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
                                                        href="{{ route('admin.draws.draw-winner-confirm', $draw_winner->id) }}"
                                                        onclick="return confirm('Are you sure?')">
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
                                        <td class="lead text-center" colspan="7">No Draw Winners Registered</td>
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
            pageLength: 10,
            buttons: [
                'copy',
                {
                    extend: 'excelHtml5',
                    title: 'Draw_Winner',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                // {
                //     extend: 'pdfHtml5',
                //     title: 'Draw_Winners_Per_Draw_list',
                //     exportOptions: {

                //     }
                // },
                'colvis'
            ]
        });
    });
</script>
<script>
    setTimeout(() => {
        document.querySelector("#preloaders").style.visibility = "hidden";
    }, 3000);
    document.querySelector("#preloaders").style.visibility = "visible";
</script>
@endsection
