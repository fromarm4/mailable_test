@extends('layouts.app')

@section('content')
<example></example>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            @include('_alert')
        @foreach($posts as $post)
            @include('_post_panel')
        @endforeach
            <div class="text-center">{{ $posts->links() }}</div>
        </div>
    </div>
</div>
@endsection
