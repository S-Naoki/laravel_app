<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

//この Model を継承したfileというのが DB への操作を可能にするfileとなります。
//$fillableには複数代入したいモデルの属性(DBで言う所のカラム名)を指定

class Todo extends Model
{
    protected $fillable = [
        'title',
        'user_id'
    ];
    //user_idをもとにuserのtodo情報を取得している。
    public function getByUserId($id)
    {

        return $this->where('user_id', $id)->get();
    }
}

    //where()はデータの抽出条件を指定するwhere句
    //where()は3つの引数を受け取り、第一引数がカラム名、第二引数が演算子（省略可能）、第三引数が第一引数のカラム名に対する値。
    //DBに保存する際に保存対象として許可することで、特定のカラムの値を保存することが可能になる。
    //そして、get()によってユーザーに紐づいたデータを取得する。

