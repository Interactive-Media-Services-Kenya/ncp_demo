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
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header"><b>Show faq</b>
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <div class="form-group">
                            <a class="btn btn-info" href="{{ route('admin.faqs.index') }}">
                                Back To FAQs
                            </a>
                        </div>
                        <table class="table table-bordered table-striped">
                            <tbody>
                                <tr>
                                    <th>
                                        ID
                                    </th>
                                    <td>
                                        {{ $faq->id }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Question
                                    </th>
                                    <td>
                                        {{ $faq->question }}
                                    </td>
                                </tr>
                                <tr>
                                    <th>
                                        Answer
                                    </th>
                                    <td>
                                        {{ $faq->answer }}
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="form-group">
                            <a class="btn btn-success" href="{{ route('admin.faqs.edit', [$faq->id]) }}">
                                Edit
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
