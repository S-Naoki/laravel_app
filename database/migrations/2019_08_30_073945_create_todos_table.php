<?php
//SQLコマンドを打つことなく、データベーステーブルを自動生成してくれるマイグレーションファイル。
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTodosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() //テーブルを作成する処理
    {
        Schema::create('todos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //テーブルを破棄する処理
    {
        Schema::dropIfExists('todos');
    }
}
