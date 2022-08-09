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
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('name') -> nullable();
            $table->string('email') -> unique() -> nullable();
            $table->string('mobile') -> unique() -> nullable();
            $table->string('password') -> nullable();
            $table->string('photo') -> nullable();
            $table->string('blood_group') -> nullable();
            $table->integer('age') -> nullable();
            $table->string('date_of_birth') -> nullable();
            $table->text('address') -> nullable();
            $table->string('country') -> nullable();
            $table->string('city') -> nullable();
            $table->string('access_token') -> nullable();
            $table->string('oauth_id') -> nullable();
            $table->boolean('status') -> default(false);
            $table->boolean('trash') -> default(false);
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
        Schema::dropIfExists('doctors');
    }
};
