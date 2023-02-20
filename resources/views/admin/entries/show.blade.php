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
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header"><b>ID: {{ $entry->id }}</b>

                </div>
                <div class="card-body">
                    <div class="col-md-6 offset-3">
                        <div class="card">
                            <div class="card-header">Phone: {{ $entry->originator }}</div>
                            <div class="card-body">
                                <ul style="list-style-type: none;">
                                    <li><b>Message : </b> {{ $entry->message }}</li>
                                    <li><b>Destination Point: </b>{{ $entry->destination }}</li>
                                    <li><b>Network : </b>
                                        {{ $entry->network == 2
                                            ? 'SAFARICOM_MO'
                                            : ($entry->network == 3
                                                ? 'AIRTEL_MO'
                                                : ($entry->network == 4
                                                    ? 'TELKOM_MO'
                                                    : ($entry->network == 5
                                                        ? 'AIRTEL_BULK'
                                                        : ($entry->network == 6
                                                            ? 'TELKOM_BULK'
                                                            : ($entry->network == 9
                                                                ? 'SAFARICOM_BULK'
                                                                : ''))))) }}
                                    </li>
                                    <li><b>ReplyMessage : </b> {{ $entry->replyMessage }}</li>
                                </ul>
                            </div>
                            <div class="card-footer">
                                <a href="{{route('admin.entries.index')}}" class="btn btn-primary">Back To Entries</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
