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
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Run Draw
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.draws.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row form-group">
                            <div class="col-md-6">
                                <label class="required" for="start_date">From (Date)</label>
                                <input type="date" name="start_date" id="start_date" class="form-control">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">Draw Start Date Required *</span>
                            </div>
                            <div class="col-md-6">
                                <label class="required" for="description">To (Date)</label>
                                <input type="date" name="end_date" id="end_date" class="form-control">
                                @if ($errors->has('description'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('description') }}
                                    </div>
                                @endif
                                <span class="help-block">Draw End Date Required *</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-9 mx-auto">
                            <label class="required" for="prize">Select Prize Type</label>
                            <select class="form-control {{ $errors->has('prize') ? 'is-invalid' : '' }}"
                                name="prize" id="prize" required>
                                <option value="" selected disabled>Click to Select</option>
                                @foreach ($prizes as $prize)
                                    <option value="{{ $prize->value }}" id="{{ $prize->id }}">{{ $prize->name }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('prize'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('prize') }}
                                </div>
                            @endif
                            <span class="help-block">Prize Type is Required</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-9 mx-auto">
                            <label class="required" for="region">Select Region</label>
                            <select class="form-control {{ $errors->has('region') ? 'is-invalid' : '' }}"
                                name="region" id="region" required>
                                <option value="" selected disabled>Click to Select</option>
                                @foreach ($regions as $region)
                                    <option value="{{ $region->id }}" id="{{ $region->id }}">{{ $region->title }}
                                    </option>
                                @endforeach
                            </select>
                            @if ($errors->has('region'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('region') }}
                                </div>
                            @endif
                            <span class="help-block">Region is Required</span>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-md-9 mx-auto">
                                <label class="required" for="from">Number of Winners</label>
                                <input class="form-control {{ $errors->has('no_winners') ? 'is-invalid' : '' }}" min="1"
                                    type="number" name="no_winners" id="no_winners" value="{{ old('no_winners', '') }}" required>
                                @if ($errors->has('no_winners'))
                                    <div class="invalid-feedback">
                                        {{ $errors->first('no_winners') }}
                                    </div>
                                @endif
                                <span class="help-block">Number of Winners Draw Required for the Range *</span>
                            </div>

                        </div>
                        <div class="row form-group mt-5">
                            <div class="col-md-6 mx-auto text-center">
                                <button class="btn btn-lg btn-danger" type="submit">
                                    Run Draw
                                </button>
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
                                                class="align-middle mb-3 table table-bordered table-striped table-hover datatable datatable-draw"
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
                                                        <th>Region</th>
                                                        <th>
                                                            Prize Type
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
                                                            <td>{{ \DB::table('regions')->where('id',\DB::table('messages_incoming')->where('message',$draw_winner->code)->value('region'))->value('title') ?? 'No Region'}}</td>
                                                            <td>
                                                                {{ \DB::table('prices')->where('value', $draw_winner->draw->prize)->value('name')}}
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
                                                            <td class="lead text-center" colspan="8">No Draw Winners
                                                                Registered</td>
                                                        </tr>
                                                    @endforelse
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
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
                        title: 'Draw_Winners_Per_Draw_list',
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
