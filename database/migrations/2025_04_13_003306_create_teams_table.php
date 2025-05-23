<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('teams', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        DB::table('teams')->insert([
            ['name' => 'Frontend'],
            ['name' => 'Backend'],
            ['name' => 'Tester']
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('teams');
    }
};
