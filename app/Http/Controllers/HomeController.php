<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Memo;

class HomeController extends Controller
{
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('create');
    }

    // postの場合、引数にRequestファサードを定義する（インスタンス化）（メソッド内で使えるようにする）
    public function store(Request $request)
    {
        $posts = $request->all();  // postされてきたすべてのものを取得

        // dd($posts);  // submitしたときにデータが表示される

        // \Auth::id() → ログインしている人のidを取得できる
        Memo::insert(['content' => $posts['content'], 'user_id' => \Auth::id()]);

        return redirect(route('home'));
    }
}
