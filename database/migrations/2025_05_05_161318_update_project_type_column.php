<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the old type column
            $table->dropColumn('type');
        });

        Schema::table('projects', function (Blueprint $table) {
            // Add new type column with updated enum values
            $table->enum('type', ['design', 'programming'])->after('description');
        });
    }

    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            // Drop the new type column
            $table->dropColumn('type');
        });

        Schema::table('projects', function (Blueprint $table) {
            // Restore the old type column
            $table->enum('type', ['design', 'programming'])->after('description');
        });
    }
}; 