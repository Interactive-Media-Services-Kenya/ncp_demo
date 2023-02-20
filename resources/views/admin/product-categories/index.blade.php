@extends('layouts.backend')
@section('css')
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <style>
        th.dt-left, td.dt-left {
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
                           {{-- <a href="{{route('admin.categorys.create')}}">
                            <button type="button"
                                class="btn-shadow btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-plus fa-w-20"></i>
                                </span>
                                Add category
                            </button>
                            </a> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Merchandise Categories
                            {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-10 offset-1">
                            <div class="table-responsive mt-3">
                                <table id="DataTables_Table_0 " class="align-middle mb-3 table table-borderless table-striped table-hover data-table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th>Name</th>
                                            <th>Product Count</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $category)
                                            <tr>
                                                <td>{{$category->id}}</td>
                                                <td>{{$category->name}}</td>
                                                <td>{{count($category->products)}}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <p class="lead">No Merchanise Categories!</p>
                                            </tr>
                                        @endforelse

                                    </tbody>
                                </table>
                            </div>
                            {{-- <div class="d-block text-center card-footer">
                                <button class="mr-2 btn-icon btn-icon-only btn btn-outline-danger"><i
                                        class="pe-7s-trash btn-icon-wrapper"> </i></button>
                                <button class="btn-wide btn btn-success">Do Something Else</button>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
@endsection
