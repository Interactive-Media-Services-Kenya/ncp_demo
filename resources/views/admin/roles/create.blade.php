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
                        <div class="card-header">Add Role
                        </div>
                        <div class="card-body">
                            <div class="col-md-10 offset-1">
                                <form method="POST" action="{{ route("admin.roles.store") }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label class="required" for="title">Title</label>
                                        <input class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" type="text" name="title" id="title" value="{{ old('title', '') }}" required>
                                        @if($errors->has('title'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('title') }}
                                            </div>
                                        @endif
                                        <span class="help-block">Title is Required</span>
                                    </div>
                                    <div class="form-group">
                                        <label class="required" for="permissions">Select Permissions</label>
                                        <div style="padding-bottom: 4px">
                                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Select All</span>
                                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Deselect All</span>
                                        </div>
                                        <select class="form-control select2 {{ $errors->has('permissions') ? 'is-invalid' : '' }}" name="permissions[]" id="permissions" multiple required>
                                            @foreach($permissions as $id => $permission)
                                                <option value="{{ $id }}" {{ in_array($id, old('permissions', [])) ? 'selected' : '' }}>{{ $permission }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('permissions'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('permissions') }}
                                            </div>
                                        @endif
                                        <span class="help-block">Permissions is Required</span>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-danger" type="submit">
                                            Save
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
