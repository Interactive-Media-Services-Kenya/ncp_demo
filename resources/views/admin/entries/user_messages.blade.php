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
                <div class="card-header">All Participation Details
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="col-md-12">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable ajaxTable datatable-blacklist"
                            id="blacklistsTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Date & Time Received
                                    </th>
                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Entry Type
                                    </th>
                                    <th>
                                        Message
                                    </th>
                                    <th>
                                        Network
                                    </th>
                                    <th>
                                        Reply Message
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($phoneMessages as $message)
                                    <tr data-blacklist-id="{{ $message->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $message->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->timereceived ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->originator ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->secondary_status ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->message ?? '' }}
                                        </td>
                                        <td>
                                            {{ $message->network == 2
                                                ? 'SAFARICOM'
                                                : ($message->network == 3
                                                    ? 'AIRTEL'
                                                    : ($message->network == 4
                                                        ? 'TELKOM'
                                                        : ($message->network == 5
                                                            ? 'AIRTEL_BULK'
                                                            : ($message->network == 6
                                                                ? 'TELKOM_BULK'
                                                                : ($message->network == 9
                                                                    ? 'SAFARICOM_BULK'
                                                                    : ''))))) }}
                                        </td>
                                        <td>
                                            {{ $message->replyMessage ?? '' }}
                                        </td>


                                    </tr>
                                @empty
                                <tr >
                                    <td colspan="8" class="text-center">No Entries</td>
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
