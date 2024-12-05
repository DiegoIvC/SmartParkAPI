<?php

namespace App\Http\Controllers;

use App\Models\AccesoRFID;
use App\Models\EspacioEstacionamiento;
use App\Models\User;
use Illuminate\Http\Request;

class EspaciosEstacionamientoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
        'numero_espacio' => 'required|string|max:50',
        'estatus' => 'required|integer',
        'id_sensor' => 'required|integer',
        ]);

        $espacio = EspacioEstacionamiento::create([
            'numero_espacio' => $request->numero_espacio,
            'estatus' => $request->estatus,
            'id_sensor' => $request->id_sensor,
        ]);

        return response()->json([
            'message' => 'Epacio registrado con exito!',
            'espacio estacionamiento' => $espacio
        ], 201);
    }

    public function index()
    {
        $espacios = EspacioEstacionamiento::all();
        return response()->json($espacios);
    }

    public function show($id)
    {
        $espacio = EspacioEstacionamiento::find($id);
        if(!$espacio){
            return response()->json([
                'message' => 'Epacio no encontrado'
            ]);
        }
        else{
            return response()->json($espacio);
        }
    }

    public function sensorStatus(Request $request){
        $request->validate([
            'estado' => 'required|boolean',
            'id_sensor' => 'required|integer'
        ]);
        //Recibir el id del sensor y buscar el espacio de estacionamiento en el que está localizado el sensor
        $id_sensor  = $request->id_sensor;
//        dd($id_sensor);
        $espacio = EspacioEstacionamiento::where('id_sensor', $id_sensor)->first();
        //dd($espacio);
        if($espacio){
            //NOTA, SE ENVIARÁ UN BOOLEANO DEPENDIENDO DEL ESTADO DEL SENSOR INFRARROJO
            //POR LO QUE SE RECIBE EL BOOLEANO Y CAMBIA EL STATUS
            $estado = $request->input('estado');
            if ($estado === false) {
                $estatus = 0; // libre
            }elseif($estado === true) {
            $estatus = 1; // ocupado
            } else {
                $estatus = 0; //libre
            }
            $espacio->estatus = $estatus;
            $espacio->save();
            return response()->json([
                'message' => 'Estatus actualizado correctamente',
                'espacio' => $espacio
            ], 200);
        }
        else{
            return response()->json([
                'message' => 'El sensor no existe o no tiene un espacio asignado'
            ]);
        }
    }
}
