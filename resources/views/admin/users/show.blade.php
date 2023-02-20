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
                        <div class="card-header"><b> {{strtoupper($user->first_name) }}  {{strtoupper($user->last_name) }}</b>
                            {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-body">
                            <div class="col-md-6 offset-3">
                                 <div class="card">
                                     <div class="card-header">{{strtoupper($user->first_name) }} {{strtoupper($user->last_name) }}</div>
                                     <div class="card-body">
                                         <ul style="list-style-type: none;">
                                             <li><b>Email :</b> {{ $user->email }}</li>
                                             <li><b>Company :</b> {{ $user->company->name }}</li>
                                             <li><b>Phone :</b> {{ $user->phone }}</li>
                                             <li><b>Roles :</b> @foreach ($user->roles as $roles){{$roles->title}}@endforeach</li>
                                         </ul>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
