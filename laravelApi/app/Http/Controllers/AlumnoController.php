<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumno;

class AlumnoController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/alumnos",
     *     summary="Mostrar todos los alumnos",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todos los alumnos."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index()
    {
        $alumnos = Alumno::all();
        return response()->json($alumnos);
    }

    /**
     * @OA\Get(
     *     path="/api/alumnos/{id}",
     *     summary="Mostrar detalle de un alumno",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del alumno",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar detalle de un alumno."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function show($id)
    {
        $alumno = Alumno::findOrFail($id);
        return response()->json($alumno);
    }

    /**
     * @OA\Post(
     *     path="/api/alumnos",
     *     summary="Crear un nuevo alumno",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "edad", "correo", "direccion", "telefono"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="edad", type="integer"),
     *             @OA\Property(property="correo", type="string"),
     *             @OA\Property(property="direccion", type="string"),
     *             @OA\Property(property="telefono", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Alumno creado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Error de validación"
     *     )
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string',
            'edad' => 'required|integer',
            'correo' => 'required|string|unique:alumnos',
            'direccion' => 'required|string',
            'telefono' => 'required|string'
        ]);

        $alumno = Alumno::create($request->all());

        return response()->json($alumno, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/alumnos/{id}",
     *     summary="Actualizar un alumno existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID del alumno a actualizar",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "edad", "correo", "direccion", "telefono"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="edad", type="integer"),
     *             @OA\Property(property="correo", type="string"),
     *             @OA\Property(property="direccion", type="string"),
     *             @OA\Property(property="telefono", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alumno actualizado exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Alumno no encontrado"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $alumno = Alumno::findOrFail($id);

        $request->validate([
            'nombre' => 'string',
            'edad' => 'integer',
            'correo' => 'string|unique:alumnos,correo,' . $id,
            'direccion' => 'string',
            'telefono' => 'string'
        ]);

        $alumno->update($request->all());

        return response()->json($alumno, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/alumnos/{id}",
     *     summary="Eliminar un alumno existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID del alumno",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Alumno eliminado exitosamente."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function destroy($id)
    {
        $alumno = Alumno::findOrFail($id);
        $alumno->delete();
        return response()->json(null, 204);
    }
}
