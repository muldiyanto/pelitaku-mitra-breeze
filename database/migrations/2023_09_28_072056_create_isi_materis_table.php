<?php

use App\Models\Team;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('isi_materis', function (Blueprint $table) {

            $table->id();
            $table->foreignIdFor(Team::class)->index();

            // $table->foreignId('pelatihan_id')->references('id')->on('pelatihans')->onDelete('cascade');
            $table->foreignId('materi_id')->references('id')->on('materis')->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->integer('jamlat');

            $table->string('bahanajar');
            $table->text('video');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('isi_materis');
    }
};
