@extends('layouts.app')


@push('css')
    <style>
        input[type="file"] {
            height: 50px;
        }

        input[type="file"]::-webkit-file-upload-button {
            height: 50px;
        }
    </style>
@endpush
{{-- {{dd($company)}} --}}
@section('content')
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Edit the Company</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form action="{{ route('companies.update', ['company' => $company->id]) }}" method="POST"
            enctype="multipart/form-data">
           @csrf
            @method('PUT')
            <div class="card-body">
                <input type="hidden" name="id" value="{{$company->id}}">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" value="{{ $company->name }}" name="name"
                        placeholder="Enter Name">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">email</label>
                    <input type="text" class="form-control" name="email" value="{{ $company->email }}"
                        placeholder="Email">
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input"  id="exampleInputFile" name="logo">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                    </div>
                    <div id="logoPreview" style="margin-top: 10px;">
                        <img src="{{ asset('storage/' . $company->logo) }}" alt="Company Logo" width="150">
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Website</label>
                    <input type="text" class="form-control" value="{{ $company->website }}" name="website"
                        placeholder="Website">
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection

@push('scripts')
@endpush
