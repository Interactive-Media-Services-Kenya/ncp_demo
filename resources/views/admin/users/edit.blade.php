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
                        <div class="card-header">Edit Details for: {{ $user->first_name }} {{ $user->last_name }}
                        </div>
                        <div class="card-body">
                            <div class="col-md-10 offset-1">
                                <form method="POST" action="{{ route('admin.users.update',[$user->id]) }}" class="form-horizontal" enctype="multipart/form-data">
                                    @method('PUT')
                                    @csrf
                                    <div class="form-row">
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="exampleEmail11"
                                                    class="">Email</label><input name="email"
                                                    id="exampleEmail11" placeholder="somebody@example.com" type="email"
                                                    class="form-control" value="{{ old('email', $user->email) }}" required>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword11"  class="">First Name</label>
                                                <input name="first_name" id="examplePassword11" placeholder="First Name"  type="text" class="form-control" value="{{$user->first_name}}">
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="position-relative form-group">
                                                <label for="examplePassword11"  class="">Last Name</label>
                                                <input name="last_name" id="examplePassword11" placeholder="First Name"  type="text" class="form-control" value="{{$user->last_name}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="position-relative form-group"><label for="exampleAddress2"
                                            class="">Phone</label><input name="phone"
                                            id="exampleAddress2" placeholder="" type="text"
                                            class="form-control" value="{{ old('phone', $user->phone) }}" required>
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
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="exampleCity"
                                                    class="">Company</label>
                                                    <select class="form-control select2 {{ $errors->has('roles') ? 'is-invalid' : '' }}" name="company_id" id="roles" multiple required>
                                                        @foreach($companies as $id => $company)
                                                            <option value="{{ $id }}">{{ $company}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('roles'))
                                                        <div class="invalid-feedback">
                                                            {{ $errors->first('roles') }}
                                                        </div>
                                                    @endif
                                                    <span class="help-block">Role is Required</span>
                                                </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="position-relative form-group"><label for="exampleState"
                                                    class="">Designation</label><input name="state"
                                                    id="exampleState" type="text" class="form-control"></div>
                                        </div>
                                        {{-- <div class="col-md-2">
                                            <div class="position-relative form-group"><label for="exampleZip"
                                                    class="">Zip</label><input name="zip" id="exampleZip"
                                                    type="text" class="form-control"></div>
                                        </div> --}}
                                    </div>
                                    {{-- <div class="position-relative form-check"><input name="check" type="checkbox"
                                            class="form-check-input"><label for="exampleCheck"
                                            class="form-check-label">Check me out</label></div> --}}
                                    <button class="mt-2 btn btn-success" type="submit">Update</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
