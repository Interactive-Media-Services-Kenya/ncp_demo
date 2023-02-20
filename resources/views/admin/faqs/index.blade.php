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
                        {{-- <div>{{ env('APP_NAME') }}
                            <div class="page-title-subheading"> This is the Backend UI for {{ env('APP_NAME') }}
                            </div>
                        </div> --}}
                    </div>
                    <div class="page-title-actions">
                        {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button> --}}
                        <div class="d-inline-block dropdown">
                        <a href="{{route('admin.faqs.create')}}">
                            <button type="button"
                                class="btn-shadow btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-plus fa-w-20"></i>
                                </span>
                                Add FAQ
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">FAQs
                            {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-10 offset-1">
                            <div class="table-responsive mt-3">
                                <table class="align-middle mb-3 table table-bordered table-striped table-hover datatable datatable-faq">
                                    <thead>
                                        <tr>
                                            <th width="10">

                                            </th>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Question
                                            </th>
                                            <th>
                                                Answer
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($faqs as $key => $faq)
                                            <tr data-entry-id="{{ $faq->id }}">
                                                <td>

                                                </td>
                                                <td>
                                                    {{ $faq->id ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $faq->question ?? '' }}
                                                </td>
                                                <td>
                                                    {{ Str::limit($faq->answer,100) ?? '' }}
                                                </td>
                                                <td>
                                                    @can('faq_show')
                                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.faqs.show', $faq->id) }}">
                                                            View
                                                        </a>
                                                    @endcan

                                                    @can('faq_edit')
                                                        <a class="btn btn-xs btn-info" href="{{ route('admin.faqs.edit', $faq->id) }}">
                                                            Edit
                                                        </a>
                                                    @endcan

                                                    @can('faq_delete')
                                                        <form action="{{ route('admin.faqs.destroy', $faq->id) }}" method="POST" onsubmit="return confirm('Are You Sure?');" style="display: inline-block;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                                        </form>
                                                    @endcan

                                                </td>

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
@endsection
