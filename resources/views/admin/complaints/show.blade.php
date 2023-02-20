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
                    {{-- <div class="page-title-actions">
                        <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button>
                        <div class="d-inline-block dropdown">
                            <button type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                class="btn-shadow dropdown-toggle btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-building fa-w-20"></i>
                                </span>
                                Download List Format
                            </button>
                            <div tabindex="-1" role="menu" aria-hidden="true" class="dropdown-menu dropdown-menu-right">
                                <ul class="nav flex-column">
                                    <li class="nav-item">
                                        <a href="{{route('generate.pdf')}}" class="nav-link" target="_blank">
                                            <i class="nav-link-icon lnr-inbox"></i>
                                            <span>
                                                PDF
                                            </span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="{{route('generate.csv')}}" class="nav-link" target="_blank">
                                            <i class="nav-link-icon lnr-book"></i>
                                            <span>
                                                EXCEL (csv)
                                            </span>
                                        </a>
                                        <a href="{{route('generate.excel')}}" class="nav-link" target="_blank">
                                            <i class="nav-link-icon lnr-book"></i>
                                            <span>
                                                EXCEL
                                            </span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header"><b>Show Complaint</b>
                            {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="form-group">
                                    <a class="btn btn-info" href="{{ route('admin.complaints.index') }}">
                                        Back To complaint List
                                    </a>
                                </div>
                                <table class="table table-bordered table-striped">
                                    <tbody>
                                        <tr>
                                            <th>
                                                Date Registered
                                            </th>
                                            <td>
                                                {{ $complaint->created_at }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                ID
                                            </th>
                                            <td>
                                                {{ $complaint->id }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Title
                                            </th>
                                            <td>
                                                {{ strtoupper($complaint->title) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Description
                                            </th>
                                            <td>
                                                {{ strtoupper($complaint->description) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Assigned to
                                            </th>
                                            <td>
                                                {{ strtoupper($complaint->company->name) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Level
                                            </th>
                                            <td>
                                                {{ strtoupper($complaint->level) }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Status
                                            </th>
                                            <td class="{{$complaint->status == 0 ? 'text-danger': 'text-success'}}">
                                                {{ strtoupper($complaint->status == 0? 'Not Resolved': 'Resolved') }}
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>
                                                Phone
                                            </th>
                                            <td>
                                                {{ $complaint->phone }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <div class="form-group">
                                    <a class="btn btn-info" href="{{ route('admin.complaints.index') }}">
                                        Back
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
