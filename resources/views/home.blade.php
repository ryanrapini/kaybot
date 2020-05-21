@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @if (session('status'))
        <div class="col-md-12">
            <div class="alert alert-success" role="alert">
                {{ session('status') }}
            </div>
        </div>
        @endif
        <div class="col-md-8">
            <pending-tweets-table class="mb-3"></pending-tweets-table>
            <live-tweets-table class="mb-3"></live-tweets-table>

        </div>
        <div class="col-md-4">
            <tweet-button class="mb-3"></tweet-button>
            <tweet-loader class="mb-3"></tweet-loader>
        </div>
    </div>
</div>
@endsection
