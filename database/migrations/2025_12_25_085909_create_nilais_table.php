<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNilaisTable extends Migration
{
    public function up()
    {
        Schema::create('nilais', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mahasiswa_id')->constrained('mahasiswas')->onDelete('cascade');
            $table->foreignId('mata_kuliah_id')->constrained('mata_kuliahs')->onDelete('cascade');
            $table->decimal('nilai_uts', 5, 2);
            $table->decimal('nilai_uas', 5, 2);
            $table->decimal('nilai_tugas', 5, 2);
            $table->decimal('nilai_akhir', 5, 2);
            $table->char('grade', 2);
            $table->timestamps();
            
            // Unique constraint: mahasiswa tidak bisa mengambil mata kuliah yang sama 2x
            $table->unique(['mahasiswa_id', 'mata_kuliah_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('nilais');
    }
}