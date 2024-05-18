<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocDocument extends Model
{
    use HasFactory;
    protected $fillable = [
        'doc_nombre',
        'doc_codigo',
        'doc_contenido',
        'pro_proceso_id',
        'tip_tipo_doc_id',
    ];

    public function doc_proceso()
    {
        return $this->belongsTo(ProProceso::class, 'pro_proceso_id');
    }

    public function doc_tipo()
    {
        return $this->belongsTo(TipTipoDoc::class, 'tip_tipo_doc_id');
    }
}
