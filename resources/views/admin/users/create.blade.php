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
                        <div class="card-header">Add User
                        </div>
                        <div class="card-body">
                            <div class="col-md-10 offset-1">
                                <form method="POST" action="{{ route("admin.users.store") }}" class="form-horizontal" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="exampleEmail11"
                                                    class="">First Name</label><input name="first_name"
                                                    id="exampleEmail11" type="text"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword11"  class="">Last Name</label>
                                                <input name="last_name" id="examplePassword11"  type="text" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="exampleEmail11"
                                                    class="">Email</label><input name="email"
                                                    id="exampleEmail11" placeholder="with a placeholder" type="email"
                                                    class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword11"  class="">Password</label>
                                                <input name="password" id="examplePassword11" placeholder="Type Your Password"  type="password" class="form-control">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative form-group"><label for="exampleAddress2"
                                            class="">Phone</label><input name="phone"
                                            id="exampleAddress2" placeholder="2547 XXX XXX XX" type="text"
                                            class="form-control"  required>
                                    </div>

                                    <div class="position-relative form-group">
                                        <label class="required" for="roles">Role</label>
                                        <div style="padding-bottom: 4px">
                                            <span class="btn btn-info btn-xs select-all" style="border-radius: 0">Select All</span>
                                            <span class="btn btn-info btn-xs deselect-all" style="border-radius: 0">Deselect All</span>
                                        </div>
                                        <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="roles[]" id="roles" multiple required>
                                            @foreach($roles as $id => $role)
                                                <option value="{{ $id }}" {{ in_array($id, old('roles', [])) ? 'selected' : '' }}>{{ $role }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('roles'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('roles') }}
                                            </div>
                                        @endif
                                        <span class="help-block">Role is Required</span>
                                    </div>
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="position-relative form-group">
                                                <label class="required" for="roles">Company</label>

                                        <select class="form-control select2 {{ $errors->has('company_id') ? 'is-invalid' : '' }}" name="company_id" id="company_id" multiple required>
                                            @foreach($companies as  $company)
                                                <option value="{{ $company->id }}">{{ $company->name }}</option>
                                            @endforeach
                                        </select>
                                        @if($errors->has('company_id'))
                                            <div class="invalid-feedback">
                                                {{ $errors->first('company_id') }}
                                            </div>
                                        @endif
                                        <span class="help-block">Company is Required</span>
                                            </div>
                                        </div>


                                    <button class="mt-2 btn btn-success" type="submit">Save</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
