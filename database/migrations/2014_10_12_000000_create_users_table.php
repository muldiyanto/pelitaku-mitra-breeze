<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

// php artisan migrate --path=/database/migrations/2020_04_01_064006_create_posts_table.php
// php artisan migrate --path=/database/migrations/2023_09_27_014608_create_isi_materis_table.php
// php artisan migrate --path=/database/migrations/2023_09_21_091355_create_pelatihans_table.php
//php artisan migrate:rollback --path=/database/migrations/2023_09_21_091355_create_pelatihans_table.php
//php artisan migrate --path=/database/migrations/2023_09_21_091355_create_pelatihans_table.php

//php artisan migrate:rollback --path=/database/migrations/2023_09_21_091355_create_pelatihans_table.php
//php artisan migrate --path=/database/migrations/2023_09_21_091355_create_pelatihans_table.php

//php artisan migrate:rollback --path=/database/migrations/2023_09_21_103248_create_kategoris_table.php
//php artisan migrate --path=/database/migrations/2023_09_21_103248_create_kategoris_table.php

//php artisan migrate:rollback --path=/database/migrations/2023_09_28_055937_create_materis_table.php
//php artisan migrate:rollback --path=/database/migrations/2023_09_27_014608_create_isi_materis_table.php
//php artisan migrate --path=/database/migrations/2023_09_27_014608_create_isi_materis_table.php
