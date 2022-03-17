<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHrRecruitmentsTable extends Migration
{
    public function up()
    {
        Schema::table('hr_recruitments', function (Blueprint $table) {
            $table->unsignedBigInteger('department_id')->nullable();
            $table->foreign('department_id', 'department_fk_6218920')->references('id')->on('departments');
        });
    }
}
