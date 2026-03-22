<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
{
    Schema::create('books', function (Blueprint $table) {
        $table->id();
        // Menghubungkan ke tabel categories
        $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
        $table->string('judul');      // Sesuai validasi di controller [cite: 40]
        $table->string('penulis');    // Sesuai validasi di controller [cite: 41]
        $table->integer('tahun_terbit'); // Sesuai validasi di controller [cite: 42]
        $table->integer('stok');      // Sesuai validasi di controller [cite: 43]
        $table->timestamps();
        $table->string('cover')->nullable(); // Menghasilkan kolom untuk menyimpan nama file gambar [cite: 12]
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
