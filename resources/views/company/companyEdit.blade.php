@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Company</h1>
        <form action="{{ route("company.edit.company.submit") }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ $company->name }}" required>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <input type="text" class="form-control" id="description" name="description" value="{{ $company->description }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $company->email }}" required>
            </div>
            <div class="mb-3">
                <label for="logo" class="form-label">Logo</label>
                <input type="file" class="form-control" id="logo" name="logo">
            </div>
{{--            <div class="mb-3 form-check">--}}
{{--                <input type="checkbox" class="form-check-input" id="active" name="active" {{ $company->active ? 'checked' : '' }}>--}}
{{--                <label class="form-check-label" for="active">Active</label>--}}
{{--            </div>--}}
            <button type="submit" class="btn btn-primary">Update Company</button>
        </form>
    </div>
@endsection