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
            {{-- <div class="app-page-question">
                <div class="page-question-wrapper">
                    <div class="page-question-heading">
                        <div class="page-question-icon">
                            <i class="pe-7s-note2 icon-gradient bg-mean-fruit">
                            </i>
                        </div>
                        <div>{{ env('APP_NAME') }}
                            <div class="page-question-subheading"> This is the Backend UI for {{ env('APP_NAME') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="main-card mb-3 card">
                        <div class="card-header">Edit Details for: {{ $faq->question }}
                        </div>
                        <div class="card-body">
                            <form method="POST" action="{{ route("admin.faqs.update", [$faq->id]) }}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf
                                <div class="form-group">
                                    <label class="required" for="question">Question</label>
                                    <input class="form-control {{ $errors->has('question') ? 'is-invalid' : '' }}" type="text" name="question" id="question" value="{{ old('question', $faq->question) }}" required>
                                    @if($errors->has('question'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('question') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Question is Required</span>
                                </div>
                                <div class="form-group">
                                    <label class="required" for="question">Answer</label>
                                    <textarea class="form-control {{ $errors->has('answer') ? 'is-invalid' : '' }}" type="text" name="answer" id="answer"  required>{{ $faq->answer }}</textarea>
                                    @if($errors->has('answer'))
                                        <div class="invalid-feedback">
                                            {{ $errors->first('answer') }}
                                        </div>
                                    @endif
                                    <span class="help-block">Answer is Required</span>
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
@endsection
