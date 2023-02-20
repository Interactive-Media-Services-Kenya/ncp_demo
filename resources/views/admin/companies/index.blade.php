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
                           <a href="{{route('admin.companies.create')}}">
                            <button type="button"
                                class="btn-shadow btn btn-info">
                                <span class="btn-icon-wrapper pr-2 opacity-7">
                                    <i class="fa fa-plus fa-w-20"></i>
                                </span>
                                Add Company
                            </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Companies
                            {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                        </div>
                        <div class="col-md-10 offset-1">
                            <div class="table-responsive mt-3">
                                <table class="align-middle mb-3 table table-bordered table-striped table-hover datatable datatable-company">
                                    <thead>
                                        <tr>
                                            <th width="10">

                                            </th>
                                            <th>
                                                ID
                                            </th>
                                            <th>
                                                Title
                                            </th>
                                            <th>
                                                Industry
                                            </th>
                                            <th>
                                                Email
                                            </th>
                                            <th>
                                                Phone
                                            </th>
                                            <th>
                                                Actions
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($companies as $key => $company)
                                            <tr data-entry-id="{{ $company->id }}">
                                                <td>

                                                </td>
                                                <td>
                                                    {{ $company->id ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $company->name ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $company->industry->title ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $company->email ?? '' }}
                                                </td>
                                                <td>
                                                    {{ $company->phone ?? '' }}
                                                </td>
                                                <td>
                                                    @can('company_show')
                                                        <a class="btn btn-xs btn-primary" href="{{ route('admin.companies.show', $company->id) }}">
                                                            View
                                                        </a>
                                                    @endcan

                                                    @can('company_edit')
                                                        <a class="btn btn-xs btn-info" href="{{ route('admin.companies.edit', $company->id) }}">
                                                            Edit
                                                        </a>
                                                    @endcan

                                                    @can('company_delete')
                                                        <form action="{{ route('admin.companies.destroy', $company->id) }}" method="POST" onsubmit="return confirm('Are You Sure?');" style="display: inline-block;">
                                                            <input type="hidden" name="_method" value="DELETE">
                                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                            <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                                        </form>
                                                    @endcan

                                                </td>

                                            </tr>
                                        @empty
                                            <tr>
                                                <td class="lead text-center" colspan="7">No Companies Registered</td>
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
