<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->integer('executor_id')->nullable(false)->unsigned();
            $table->integer('jobAssignor_id')->nullable(true)->unsigned();
            $table->integer('manager_id')->nullable(true)->unsigned();
            $table->integer('status_id')->unsigned();
            $table->date('deadline')->useCurrent();
            $table->integer('status_success_id')->unsigned();
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
        Schema::dropIfExists('issues');
    }
};
