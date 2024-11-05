<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Support\Facades\Validator;

class ControladorCliente extends Controller
{
    public function lista()
    {
        $clientes = Cliente::all();


        if ($clientes->isEmpty()) {
            $data = [
                'mensaje' => 'No se encontraron clientes',
                'estado' => 200
            ];
            return response()->json($data, 204);
        };
        return response()->json($clientes, 200);
    }

    public function cliente($id)
    {
        $contacto = Cliente::find($id);

        if (!$contacto) {
            $data = [
                'message' => 'Estudiante no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $data = [
            'contacto' => $contacto,
            'status' => 200
        ];
        return response()->json($data, 200);
    }

    public function crear(Request $request)
    {

        $validador = Validator::make($request->all(), [
            'nombre' => 'required | max:255',
            'correo' => 'required | email',
            'telefono' => 'required'
        ]);

        if ($validador->fails()) {
            $data = [
                'mensaje' => 'Error en la validación de datos',
                'errores' => $validador->errors(),
                'estado' => 400
            ];
            return response()->json($data, 400);
        }


        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'correo' => $request->correo,
            'telefono' => $request->telefono
        ]);


        if (!$cliente) {
            $data = [
                'mensaje' => 'Error al crear el cliente',
                'estado' => 500
            ];
            return response()->json($data, 500);
        }
        $data = [
            'Cliente' => $cliente,
            'estado' => 201
        ];
    }

    public function actualizar(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $validador = Validator::make($request->all(), [
            'nombre' => 'required | max:255',
            'correo' => 'required | email',
            'telefono' => 'required'
        ]);

        if ($validador->fails()) {
            $data = [
                'mensaje' => 'Error en la validación de datos',
                'errores' => $validador->errors(),
                'estado' => 400
            ];
            return response()->json($data, 400);
        }

        $cliente->nombre = $request->nombre;
        $cliente->correo = $request->correo;
        $cliente->telefono = $request->telefono;

        $cliente->save();

        $data = [
            'Mensaje' => 'Cliente Actualizado',
            'Cliente' => $cliente,
            'Estado' => 200
        ];

        return response()->json($data, 200);
    }

    public function eliminar($id){
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        $cliente -> delete();
        $data = [
            'mensaje' => 'cliente eliminado',
            'estado' => 200
        ];


        return response() -> json($data,200);
    }

    public function actualizardato(Request $request, $id){
        $cliente = Cliente::find($id);

        if (!$cliente) {
            $data = [
                'message' => 'Cliente no encontrado',
                'status' => 404
            ];
            return response()->json($data, 404);
        }

        if($request -> has ('nombre')){
            $cliente -> nombre = $request -> nombre;
        }
        if($request -> has ('correo')){
            $cliente -> correo = $request -> correo;
        }
        if($request -> has ('telefono')){
            $cliente -> telefono = $request -> telefono;
        }
        $cliente -> save();


        $data = [
            'Mensaje' => 'Cliente Actualizado',
            'Cliente' => $cliente,
            'Estado' => 200
        ];


        return response() -> json($data,200);
    }
}