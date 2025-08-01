<?php

namespace App\Http\Controllers\Informatica;

use App\Http\Controllers\Controller;
use App\Models\Tbl_tokens_asignado;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class TokensasignadosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('procesos.informatica.tokens.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function exportarPDF($id)
    {
        $instanciaTbl = Tbl_tokens_asignado::findOrFail($id);

        $pdf = Pdf::loadView('pdf.informatica.token-acta', compact('instanciaTbl'));

        //Mostrar PDF
        return $pdf->stream('token_'.$instanciaTbl->dni.'.pdf');
        
        //Descargar PDF
        // return response()->streamDownload(function () use ($pdf) {
        //     echo $pdf->stream();
        // }, 'spijweb_'.$userspijweb->dni.'.pdf');
    }
}
