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
        Schema::create('banned_users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->datetime('ban_start');
            $table->datetime('ban_end')->index();
            $table->text("reason");
            $table->foreignId("banned_by")->index();
            $table->timestamps();

            $table->foreign("user_id")->references("id")->on("users")->cascadeOnDelete();
            $table->foreign("banned_by")->references("id")->on("users")->cascadeOnDelete();
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
        Schema::dropIfExists('banned_users');
        Schema::enableForeignKeyConstraints();
    }
}
