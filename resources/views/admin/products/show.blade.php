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
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header"><b>Show Merchandise</b>
                            {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <a class="btn btn-info" href="{{ route('admin.products.remaining') }}">
                                        Back To Remaining Merchandise
                                    </a>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <td>
                                                {{ $product->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Title
                                            </th>
                                            <td>
                                                {{ $product->serial }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                `Batch
                                            </th>
                                            <td>
                                                {{ $product->batch->batch_code }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Company
                                            </th>
                                            <td>
                                                {{ $product->company->name }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <a class="btn btn-info" href="{{ route('admin.products.remaining') }}">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
