<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->renameColumn('name', 'name_en'); // rename existing 'name' to 'name_en'
            $table->string('name_ar')->nullable()->after('name_en'); // add Arabic name
        });
    }

    public function down(): void
    {
        Schema::table('brands', function (Blueprint $table) {
            $table->dropColumn('name_ar');
            $table->renameColumn('name_en', 'name');
        });
    }
};

