<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateNilaisTableAddMataKuliahId extends Migration
{
    public function up()
    {
        Schema::table('nilais', function (Blueprint $table) {
            // Hapus kolom mata_kuliah lama
            $table->dropColumn('mata_kuliah');
            
            // Tambah kolom mata_kuliah_id
            $table->foreignId('mata_kuliah_id')->nullable()->constrained('mata_kuliahs')->onDelete('cascade')->after('mahasiswa_id');
        });
    }

    public function down()
    {
        Schema::table('nilais', function (Blueprint $table) {
            $table->dropForeign(['mata_kuliah_id']);
            $table->dropColumn('mata_kuliah_id');
            $table->string('mata_kuliah', 100)->after('mahasiswa_id');
        });
    }
}