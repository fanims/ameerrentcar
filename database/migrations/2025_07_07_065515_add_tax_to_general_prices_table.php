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
        Schema::table('general_prices', function (Blueprint $table) {
            $table->decimal('tax', 5, 2)->nullable()->after('delivery_outside_fee');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('general_prices', function (Blueprint $table) {
            //
        });
    }
};
