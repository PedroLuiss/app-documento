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
        Schema::create('doc_documents', function (Blueprint $table) {
            $table->id();
            $table->string('doc_nombre',60)->nullable();
            $table->integer('doc_codigo');
            $table->longText('doc_contenido');

            $table->unsignedBigInteger('pro_proceso_id');
            $table->foreign('pro_proceso_id')->references('id')->on('pro_procesos')->onDelete('cascade');

            $table->unsignedBigInteger('tip_tipo_doc_id');
            $table->foreign('tip_tipo_doc_id')->references('id')->on('tip_tipo_docs')->onDelete('cascade');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doc_documents');
    }
};
