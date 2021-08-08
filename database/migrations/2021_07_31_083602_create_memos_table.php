<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMemosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('memos', function (Blueprint $table) {
            $table->unsignedBigInteger('id', true);  //  BigInteger→桁数の大きい数値型のカラム、unsigned→符号なし（外部キー制約を使うためにはunsignedをつけないといけない）
            $table->longText('content');  //内容は長いテキスト
            $table->unsignedBigInteger('user_id');
            $table->softDeletes();  // 論理削除を定義→deleted_at(削除された時間)を自動生成、deleted_atをデフォルト空で定義、値が入ればデータベースにデータは入っているが、形式上削除されている（復活可能）
            $table->timestamp('updated_at')->default(\DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));  // timestampと書いてしまうと、レコード挿入時、更新時に値が入らないので、DB::rawで直接書いてます
            $table->timestamp('created_at')->default(\DB::raw('CURRENT_TIMESTAMP'));
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('memos');
    }
}
