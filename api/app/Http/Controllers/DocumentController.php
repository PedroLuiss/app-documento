<?php

namespace App\Http\Controllers;

use App\Http\Requests\document\DocumentStoreRequest;
use App\Models\DocDocument;
use App\Models\ProProceso;
use App\Models\TipTipoDoc;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function list_document()
    {
        return response(DocDocument::with(['doc_proceso' => function ($query) {
            $query->select('id', 'pro_prefijo','pro_nombre');
        }, 'doc_tipo' => function ($query) {
            $query->select('id', 'tip_prefijo','tip_nombre');
        }])->get());
    }

    public function list_tipo()
    {
        return response(TipTipoDoc::all());
    }

    public function list_proceso()
    {
        return response(ProProceso::all());
    }

    public function edit($id)
    {
        $data = DocDocument::where('id', $id)->first();
        return response($data);
    }


    public function store(DocumentStoreRequest $request)
    {
        $model = $request->id ? DocDocument::findOrFail($request->id) : new DocDocument;

        if (!$request->id) {
            $model->doc_codigo = DocDocument::where('pro_proceso_id', $request->pro_proceso_id)
                ->where('tip_tipo_doc_id', $request->tip_tipo_doc_id)
                ->count() + 1;

            $verificar = DocDocument::where('pro_proceso_id', $request->pro_proceso_id)
            ->where('tip_tipo_doc_id', $request->tip_tipo_doc_id)
            ->where('doc_codigo', $model->doc_codigo)
            ->get();

            if (count($verificar) > 0) {
                $model->doc_codigo = $model->doc_codigo + 1;
            }
        }

        $model->doc_nombre = $request->doc_nombre;
        $model->doc_contenido = $request->doc_contenido;
        $model->pro_proceso_id = $request->pro_proceso_id;
        $model->tip_tipo_doc_id = $request->tip_tipo_doc_id;
        $model->save();

        if ($model->wasChanged(['pro_proceso_id', 'tip_tipo_doc_id'])) {
            $count = DocDocument::where('pro_proceso_id', $request->pro_proceso_id)
                ->where('tip_tipo_doc_id', $request->tip_tipo_doc_id)
                ->orderBy('doc_codigo', 'desc')
                ->get();

            $verificar = DocDocument::where('pro_proceso_id', $request->pro_proceso_id)
                ->where('tip_tipo_doc_id', $request->tip_tipo_doc_id)
                ->where('doc_codigo', count($count))
                ->get();

            if (count($verificar) > 0) {
                $model->doc_codigo = $count->first()->doc_codigo + 1;
            } else {
                $model->doc_codigo = count($count);
            }

            $model->save();
        }

        return response()->json(['message' => "Documento " . ($request->id ? "editado" : "creado") . " correctamente"], 201);
    }

    public function delete_document(Request $request)
    {

        DocDocument::where('id', $request['id'])->delete();
        return response()->json(['success' => 'Documento Eliminado Correctamente.', 'status' => 200,], 201);

    }
}
