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
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(true);
            $table->string('sample_type');
            $table->string('sample_name');
            $table->string('sample_submission');
            $table->date('appointment_date')->nullable(true);
            $table->string('tracking_num')->nullable(true);
            $table->string('status')->default('Pending');
            $table->longText('reason')->nullable(true);
            $table->date('created_at')->default(now(new DateTimeZone('Asia/Singapore')));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('application');
    }
};
