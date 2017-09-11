<?php

namespace App\Http\Controllers;

use Auth;
use App\Post;
use App\Mail\SendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

use App\Events\PublicAlertCreated;
use App\Events\PersonalAlertCreated;

class HomeController extends Controller
{
    private $types = [
        'like'     => 'いいね',
        'dislike'  => 'やだね',
        'whatever' => 'どうでもいい',
        'yourname' => '君の名は？',
    ];

    private $triggered_user = null;
    private $data = null;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::latest('updated_at')
                            ->paginate(5);
        return view(
                        'home',
                        compact('posts')
                    );
    }

    public function posts(Post $post)
    {
        return view(
                        'post',
                        compact('post')
                    );
    }

    private function setAlertData($request) {
        $this->triggered_user = Auth::user();

        $this->data = [
            'type' => $this->types[$request->type],
        ];
    }

    public function sendLike(Request $request, Post $post)
    {
        $this->setAlertData($request);

        // いいねのときはユーザー全員に知らせる
        event(new PublicAlertCreated($post, $this->triggered_user, $this->data));
        
        // Mail::to($post->user)
        //         ->send(new SendMail($post, $this->triggered_user, $this->data));

        return response()->json(['status' => 0]);
    }

    public function sendDislike(Request $request, Post $post)
    {
        $this->setAlertData($request);

        // やだねのときは本人だけに知らせる
        event(new PersonalAlertCreated($post, $this->triggered_user, $this->data));

        // Mail::to($post->user)
        //         ->send(new SendMail($post, $this->triggered_user, $this->data));

        return response()->json(['status' => 0]);
    }
    public function sendWhatever(Request $request, Post $post)
    {
        $this->setAlertData($request);

        // どうでもいいときは誰にも知らせない
        
        return response()->json(['status' => 0]);
    }
    public function sendYourname(Request $request, Post $post)
    {
        $this->setAlertData($request);

        // 君の名は？のときは本人だけに知らせる
        event(new PersonalAlertCreated($post, $this->triggered_user, $this->data));

        // Mail::to($post->user)
        //         ->send(new SendMail($post, $this->triggered_user, $this->data));

        return response()->json(['status' => 0]);
    }
}
