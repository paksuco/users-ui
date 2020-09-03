<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserPoints extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('point_definitions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 100);
            $table->string('slug');
            $table->string('description', 512)->nullable()->default('');
            $table->integer('earn_count')->default(1);
            $table->integer('points');
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('user_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId('user_id');
            $table->foreignId('point_id');
            $table->string('point_source_model')->nullable();
            $table->foreignId('point_source_id')->nullable();
            $table->integer('point_effect');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign("point_id")->references("id")
                ->on("point_definitions")->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
