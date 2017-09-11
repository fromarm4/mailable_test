@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('_alert')
            
            @include('_post_panel')
        </div>
    </div>
</div>
@endsection