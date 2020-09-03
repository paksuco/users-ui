<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserBan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('ban_reasons', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("reason");
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('banned_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->datetime('ban_start');
            $table->datetime('ban_end')->index();
            $table->foreignId("ban_reason_id");
            $table->foreignId("banned_by")->index();
            $table->foreignId("deleted_by")->index();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("user_id")->references("id")->on("users");
            $table->foreign("banned_by")->references("id")->on("users");
            $table->foreign("deleted_by")->references("id")->on("users");
            $table->foreign("ban_reason_id")->references("id")->on("ban_reasons");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('ban_reasons');
        Schema::dropIfExists('banned_users');
        Schema::enableForeignKeyConstraints();
    }
}
