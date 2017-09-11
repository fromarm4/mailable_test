<div>{{ $to_user['name'] }}さんへのお知らせです。</div>
<div>{{ $triggered_user->name }}さんが「{{ $post->title }}」という投稿に{{ $data['type'] }}しました！</div>
<br>
<div>▼投稿を確認する</div>
{{ route('posts.detail', ['post' => $post->id]) }}