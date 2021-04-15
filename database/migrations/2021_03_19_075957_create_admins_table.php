<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins', function (Blueprint $table) {
            $table->id();
            $table->string('fname');
            $table->string('lname');
            $table->string('mobno');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->date('birthdate');
            $table->date('joining_date');
            $table->int('gender');
            $table->enum('role', ['Admin', 'Employee']);
            $table->int('salary_type');
            $table->float('salary_amount');
            $table->string('address');
            $table->string('image');
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('admins');
    }
}
