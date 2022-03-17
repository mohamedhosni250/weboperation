<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHrRecruitmentsTable extends Migration
{
    public function up()
    {
        Schema::create('hr_recruitments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('mobilenumber');
            $table->string('email')->nullable();
            $table->string('called')->nullable();
            $table->string('status')->nullable();
            $table->datetime('interview_date')->nullable();
            $table->longText('comments')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
