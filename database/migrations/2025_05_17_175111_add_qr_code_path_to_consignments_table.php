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
    Schema::table('consignments', function (Blueprint $table) {
        $table->string('qr_code_path')->nullable()->after('consignment_code');
    });
}

public function down()
{
    Schema::table('consignments', function (Blueprint $table) {
        $table->dropColumn('qr_code_path');
    });
}

};
