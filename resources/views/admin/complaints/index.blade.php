@extends('layouts.backend')
@section('css')
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
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
            <div class="page-title-actions">
                {{-- <button type="button" data-toggle="tooltip" title="Example Tooltip" data-placement="bottom"
                            class="btn-shadow mr-3 btn btn-dark">
                            <i class="fa fa-star"></i>
                        </button> --}}
                <div class="d-inline-block dropdown">
                    <a href="{{ route('admin.complaints.create') }}">
                        <button type="button" class="btn-shadow btn btn-info">
                            <span class="btn-icon-wrapper pr-2 opacity-7">
                                <i class="fa fa-plus fa-w-20"></i>
                            </span>
                            Add complaint
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="main-card mb-3 card">
                <div class="card-header">Complaints
                    {{-- <div class="btn-actions-pane-right">
                                <div role="group" class="btn-group-sm btn-group">
                                    <button class="active btn btn-focus" onclick="window.print()">Print</button>
                                </div>
                            </div> --}}
                </div>
                <div class="col-md-10 offset-1">
                    <div class="table-responsive mt-3">
                        <table
                            class="align-middle mb-3 table table-bordered table-striped table-hover datatable datatable-complaint"
                            id="complaintsTable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        Date Registered
                                    </th>
                                    <th>
                                        ID
                                    </th>
                                    <th>
                                        Title
                                    </th>

                                    <th>
                                        Phone
                                    </th>
                                    <th>
                                        Level
                                    </th>
                                    <th>
                                        Assigned To
                                    </th>
                                    <th>
                                        Actions
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($complaints as $key => $complaint)
                                    <tr data-entry-id="{{ $complaint->id }}">
                                        <td>

                                        </td>
                                        <td>
                                            {{ $complaint->created_at ?? '' }}
                                        </td>
                                        <td>
                                            {{ $complaint->id ?? '' }}
                                        </td>
                                        <td>
                                            {{ $complaint->title ?? '' }}
                                        </td>
                                        <td>
                                            {{ $complaint->phone ?? '' }}
                                        </td>
                                        <td>
                                            {{ strtoupper($complaint->level ?? 'Not Assigned') }}
                                        </td>
                                        <td>
                                            {{-- @if ($complaint->company)
                                                <ul>
                                                    @foreach ($complaint->company as $company)
                                                        <li>{{ $company->name }}</li>
                                                    @endforeach
                                                </ul>
                                            @endif --}}
                                            {{ $complaint->company->name }}
                                        </td>

                                        <td>
                                            @can('complaint_access')
                                                @if ($complaint->status == 0)
                                                    <a class="btn btn-xs btn-warning"
                                                        href="{{ route('admin.complaints.resolve', $complaint->id) }}">
                                                        Resolve
                                                    </a>
                                                @else
                                                    <a class="btn btn-xs btn-success" href="#">
                                                        Resolved
                                                    </a>
                                                @endif

                                                {{-- <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                        <div class="modal-header">
                                                          <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                          </button>
                                                        </div>
                                                        <div class="modal-body">
                                                          ...
                                                        </div>
                                                        <div class="modal-footer">
                                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                          <button type="button" class="btn btn-primary">Understood</button>
                                                        </div>
                                                      </div>
                                                    </div>
                                                </div> --}}
                                            @endcan
                                            @can('complaint_show')
                                                <a class="btn btn-xs btn-primary"
                                                    href="{{ route('admin.complaints.show', $complaint->id) }}">
                                                    View
                                                </a>
                                            @endcan

                                            @can('complaint_edit')
                                                <a class="btn btn-xs btn-info"
                                                    href="{{ route('admin.complaints.edit', $complaint->id) }}">
                                                    Edit
                                                </a>
                                            @endcan

                                            @can('complaint_delete')
                                                <form action="{{ route('admin.complaints.destroy', $complaint->id) }}"
                                                    method="POST" onsubmit="return confirm('Are You Sure?');"
                                                    style="display: inline-block;">
                                                    <input type="hidden" name="_method" value="DELETE">
                                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                    <input type="submit" class="btn btn-xs btn-danger" value="Delete">
                                                </form>
                                            @endcan

                                        </td>

                                    </tr>
                                @empty
                                    <tr>
                                        <td class="lead text-center" colspan="7">No complaints Registered</td>
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
@section('scripts')
    <script>
        $(document).ready(function() {
            $('#complaintsTable').DataTable({
                dom: 'lBfrtip',
                pageLength: 100,
                buttons: [
                    'copy',
                    {
                        extend: 'excelHtml5',
                        title: 'Complaints_list',
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5]
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Complaints_list',
                        exportOptions: {

                        }
                    },
                    'colvis'
                ]
            });
        });
    </script>
@endsection
