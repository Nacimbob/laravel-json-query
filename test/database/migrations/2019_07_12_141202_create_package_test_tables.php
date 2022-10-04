<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;


return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('test_json')) {
            return ;
        }

        Schema::create('test_json', function (Blueprint $table) {
            $table->longText('json');
        });
    }
};