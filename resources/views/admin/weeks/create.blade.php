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
    {{-- <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Add Week
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.weeks.store') }}" enctype="multipart/form-data">
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
                        <div class="row form-group mt-5">
                            <div class="col-md-6 mx-auto text-center">
                                <button class="btn btn-lg btn-danger" type="submit">
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> --}}
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">All Weekly Draw
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
                                    <th width="10">

                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Draw Name
                                    </th>
                                    <th>
                                        Start Date
                                    </th>

                                    <th>
                                        End Date
                                    </th>
                                    <th>
                                        Draws Count
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($weeks as $week)
                                    <tr data-entry-id="{{ $week->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $week->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $week->name ?? '' }}
                                        </td>
                                        <td>
                                            {{ $week->start_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $week->end_date ?? '' }}
                                        </td>
                                        <td>
                                            {{ $week->draws->count()}}
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td class="lead text-center" colspan="11">No Weeks Registered</td>
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
{{-- @section('scripts')
    <script>
        $("#item").hide();
        $("#cash").hide();
        $("#prize_type_id").change(function() {
            var id = $(this).children(":selected").attr("id");
            if (id == 1) {
                $("#item").hide();
                $("#item_name").val('');
                $("#cash").show();
            }
            if (id == 2) {
                $("#cash").hide();
                $("#amount").val('');
                $("#item").show();
            }
        });
    </script>
@endsection --}}
