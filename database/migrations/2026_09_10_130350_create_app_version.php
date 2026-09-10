<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('app_versions', function (Blueprint $table) {
            $table->id();
            $table->string('app', 255)->unique();
            $table->integer('version_code');
            $table->string('version_name', 32);
            $table->timestamps();
        });

        $now = now();

        DB::table('app_versions')->insert([
            [
                'app' => 'ru.nautbekcustom.medreminder',
                'version_code' => 1,
                'version_name' => '0.1.0',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'app' => 'ru.nautbek_custom.mycar',
                'version_code' => 6,
                'version_name' => '1.3.1',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'app' => 'ru.nautbekcustom.nutritionjournal',
                'version_code' => 11,
                'version_name' => '1.3.3',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'app' => 'com.example.trainingdiary',
                'version_code' => 75,
                'version_name' => '2.9.11',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'app' => 'ru.nautbek.custom',
                'version_code' => 3,
                'version_name' => '1.0.2',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('app_versions');
    }
};
