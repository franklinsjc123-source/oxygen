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
        Schema::create('staffother', function (Blueprint $table) {
            $table->id();
            $table->integer('employee_id');
            $table->string('username');
            $table->string('fullname');
            $table->string('dob');
            $table->string('department');
            $table->string('designation');
            $table->string('mobileno');
            $table->string('a_mobileno');
            $table->string('email');
            $table->string('qualification');
            $table->string('exprience');
            $table->string('bloodgroup');
            $table->string('doj');
            $table->string('permanant_addr');
            $table->string('curr_addr');
            $table->string('password');
            $table->string('profileimage');
            $table->string('aatherimage');
            $table->string('pancard');
            $table->string('otherdoc');
            $table->string('monthlysalary');
            $table->string('ctc');
            $table->string('dailytarget');
            $table->string('monthlytarget');
            $table->string('zone_id');
            $table->string('route_id');
            $table->string('flag');
            $table->string('createdBy');
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
        Schema::dropIfExists('staffother');
    }
};
