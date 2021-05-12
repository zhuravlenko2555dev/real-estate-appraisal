<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealEstatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('real_estates', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('worker_id');
            $table->unsignedTinyInteger('action_type');
            $table->unsignedTinyInteger('area_type');
            $table->string('title');
            $table->string('description');
            $table->unsignedSmallInteger('area');
            $table->boolean('appraised')->default(false);
            $table->decimal('price_per_square_meter',9,3);
            $table->timestamps();

            $table->foreign('worker_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('real_estates');
    }
}
