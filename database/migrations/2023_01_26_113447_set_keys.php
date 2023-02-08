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
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('company_id')->nullable(true)->constrained();
        });

        Schema::table('applications', function (Blueprint $table) {
            $table->foreignId('applicant_id')->after('id')->constrained('users')->onDelete('cascade');
            $table->foreignId('scientist_id')->nullable(true)->after('applicant_id')->constrained('users');
        });

        Schema::table('service_requests', function (Blueprint $table) {
            $table->foreignId('application_id')->after('id')->constrained()->onDelete('cascade');
            $table->foreignId('service_type_id')->after('application_id')->constrained()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
