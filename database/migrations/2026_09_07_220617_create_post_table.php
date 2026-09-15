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
        Schema::create('post', function (Blueprint $table) {
            $table->id();
            $table->string('post_title');
            $table->longText('post_content');
            $table->foreignId('userId')
                ->constrained('users', 'userId');
            $table->timestamps();
        });
    }
    /* or say $table->foreign('userId')
          ->references('userId')
          ->on('users');   for foreign key declaration */

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post');
    }
};
