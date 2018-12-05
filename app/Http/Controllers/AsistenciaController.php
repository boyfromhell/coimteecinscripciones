<?php

namespace App\Http\Controllers;

use App\Asistencia;
use App\Assistant;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index(){
        return view('asistencia');
    }

    public function registrar(Request $request){
        $asistant = Assistant::find($request->codigo);

        $asistencia = new Asistencia();
        $asistencia->assistant_id = $asistant->id;
        $asistencia->fecha_registro = Carbon::today();
        $asistencia->save();

        return response()->json(['Registrado']);
    }
}
