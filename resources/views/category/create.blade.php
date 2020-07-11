@extends('layouts.app')

@section('styles')
    <style>
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            <div class="col-md-3">
                <div class="col-md-12" >
                    <a  href="{{ route('category.create') }}">Create Category</a><br/>
                    <a href="{{ route('category.updateName') }}">Update Name Category</a><br/>
                    <a  href="{{ route('category.moveNode') }}">Move Node Category</a><br/>
                    <a  href="{{ route('category.delete') }}">Delete Node Category with Child</a><br/><br/>
                    <a href="/" >See tree</a>
                </div>
            </div>

            <div class="col-md-8">
                @if($message = Session::get('error'))
                    <div class="alert alert-danger">
                        <p> {{ $message }}</p>
                    </div>

                @endif
                @if($message = Session::get('success'))
                    <div class="alert alert-success">
                        <p> {{ $message }}</p>
                    </div>

                @endif
                <div class="card">
                    <div class="card-header">
                        Category Create
                    </div>

                    <div class="card-body">
                        <form action="{{ route('category.store') }}" method="post">
                            @csrf
                            <div class="form-group row">
                                <label for="category" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="category" type="text" class="form-control" name="category" value="{{ old('category') }}" required autofocus>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="parent" class="col-md-4 col-form-label text-md-right">
                                    {{ __('Parent Category') }}
                                </label>

                                <div class="col-md-6">
                                    <select id="parent" class="form-control" name="parent" value="{{ old('parent') }}"  autofocus>
                                        <option value="none">No any parents</option>
                                        @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save Category') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>


                </div>
            </div>
        </div>
    </div>



    </div>



@endsection
