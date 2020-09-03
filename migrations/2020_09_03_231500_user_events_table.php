<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UserEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /**
         * User has triggered the system event, the event is used
         * in a reward point, the event details, for example transaction id,
         * liked id etc.
         */
        Schema::create('user_events', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->foreignId("user_id")->index();
            $table->string("event_type")->index();
            $table->boolean("event_rewarded")->default(0)->index();
            $table->text("event_params")->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign("user_id")->references("id")->on("users");
        });

        /**
         * How many system events are required per user to
         * give the user the point?
         */
        Schema::create('event_points', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string("event_type")->index();
            $table->foreignId("point_definition_id");
            $table->integer("events_for_point");
            $table->integer("point_limit");
            $table->timestamps();
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
        Schema::dropIfExists('user_events');
        Schema::dropIfExists('event_points');
        Schema::enableForeignKeyConstraints();
    }
}
