@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                        <a href="/">See tree</a><br/>
                        <a href="{{ route('category.create') }}">Create Category</a><br/>
                        <a href="{{ route('category.updateName') }}">Update Name Category</a><br/>
                        <a  href="{{ route('category.moveNode') }}">Move Node Category</a><br/>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
