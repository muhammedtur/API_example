<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbl01sTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tbl_01', function (Blueprint $table) {
            $table->increments('id');
            $table->string('capsule_serial');
            $table->string('capsule_id')->nullable();
            $table->string('status')->nullable();
            $table->string('original_launch')->nullable();
            $table->integer('original_launch_unix')->nullable();
            $table->json('missions')->nullable();
            $table->integer('landings')->default(0);
            $table->string('type')->nullable();
            $table->string('details')->nullable();
            $table->integer('reuse_count')->default(0);
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
        Schema::dropIfExists('tbl_01');
    }
}
