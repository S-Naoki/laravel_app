<?php
//コントローラーによってURLごとにどのような処理を行うのかを記述している。
//名前空間:クラスを階層的に整理している。
namespace App\Http\Controllers;

use Illuminate\Http\Request;
// この記述をすることによって app/Todo.php を使用することができます。
use App\Todo;
use Auth;

class TodoController extends Controller
{
    //middleware('auth')でこのコントローラ内の全アクションを、認証済みユーザーだけがアクセスできるようにする
    private $todo;

    public function __construct(Todo $instanceClass)
    {
        $this->middleware('auth');
        $this->todo = $instanceClass;

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    //編集画面のinputタグ内に一覧画面で選択したTodoを表示する処理。
    //Auth::idでログインしているユーザーを取得している。
    public function index()
    {
        $todos = $this->todo->getByUserId(Auth::id());
        return view('todo.index', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // DB上に格納する処理
    public function store(Request $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id(); //現在ログインしているユーザーを（のID取得）を取得
        $this->todo->fill($input)->save(); //INSERT INTO todos (title) VALUE (入力内容)
        return redirect()->to('todo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $todo = $this->todo->find($id); //select * from todos where id = :id
        return view('todo.edit', compact('todo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $request->all();
        $this->todo->find($id)->fill($input)->save();
        //update todos set title = :title where id = :id;
        return redirect()->to('todo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->todo->find($id)->delete(); //delete from todos where id = :id
        return redirect()->to('todo');
    }
}
