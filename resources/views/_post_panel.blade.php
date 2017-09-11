<div class="panel panel-default js-post" data-post_id="{{ $post->id }}">
    <div class="panel-heading">{{ $post->title }}</div>
    <div class="panel-body">
        <p class="small text-right">{{ $post->user->name }} {{ $post->updated_at->format('Y-m-d') }}</p>
        {!! nl2br(e($post->content)) !!}
    </div>
    <div class="panel-footer text-center">
        <button class="btn btn-primary js-send-stamp" data-type="like" type="button">いいねする</button>
        <button class="btn btn-danger js-send-stamp" data-type="dislike" type="button">やだねする</button>
        <button class="btn btn-info js-send-stamp" data-type="whatever" type="button">どうでもいい</button>
        <button class="btn btn-warning js-send-stamp" data-type="yourname" type="button">君の名は？</button>
    </div>
</div>

