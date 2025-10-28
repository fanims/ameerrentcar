<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->integer('km_per_hour')->nullable();
        $table->integer('km_per_day')->nullable();
        $table->integer('km_per_week')->nullable();
        $table->integer('km_per_month')->nullable();
        $table->integer('number_of_bags')->nullable();
        $table->string('gear')->nullable();
    });
}

public function down()
{
    Schema::table('cars', function (Blueprint $table) {
        $table->dropColumn([
            'km_per_hour', 'km_per_day', 'km_per_week', 'km_per_month',
            'number_of_bags', 'gear'
        ]);
    });
}

};
