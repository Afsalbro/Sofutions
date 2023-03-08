@extends('layouts.app')


@push('css')
@endpush
{{-- {{dd($companies)}} --}}
@section('content')
    <div class="card">
        <div class="card-header d-flex justify-content-between">
            <h3 class="card-title">Company Table</h3>
            <a type="button" class="btn btn-primary ml-auto" href="{{route('companies.create')}}">Add Company</a>
          </div>
        <!-- /.card-header -->
        <div class="card-body">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th style="width: 10px">ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Website</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($companies as $company)
                    <tr>
                        <td>{{$company->id}}</td>
                        <td>{{$company->name}}</td>
                        <td>{{$company->email}}</td>
                        <td><img src="{{ asset('storage/' . $company->logo) }}" style="max-height: 50px"></td>
                        <td>{{$company->website}}</td>
                        <td>
                            <form action="{{ route('companies.destroy',$company->id) }}" method="Post">
                                <a class="btn btn-primary" href="{{ route('companies.edit',$company->id) }}">Edit</a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            {!! $companies->links() !!}
        </div>
        <!-- /.card-body -->
       
    </div>
@endsection

@push('scripts')
@endpush
