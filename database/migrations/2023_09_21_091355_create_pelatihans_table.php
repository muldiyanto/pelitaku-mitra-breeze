<?php

use App\Models\Kategori;
use App\Models\Team;
use App\Models\PemilikProgram;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pelatihans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignIdFor(PemilikProgram::class)->index();
            $table->foreignIdFor(Team::class)->index();
            $table->foreignIdFor(Kategori::class)->index();
            $table->integer('jamlat')->required();
            $table->integer('hari')->required();
            $table->date('tgl_mulai')->required();
            $table->date('tgl_akhir')->required();
            $table->integer('jml_peserta')->required();
            $table->text('keterangan')->required();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelatihans');
    }
};
