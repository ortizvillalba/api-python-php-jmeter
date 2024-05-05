<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inscripcion;

class InscripcionController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/inscripciones",
     *     summary="Mostrar todas las inscripciones",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas las inscripciones."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index()
    {
        $inscripciones = Inscripcion::all();
        return response()->json($inscripciones);
    }

    /**
     * @OA\Get(
     *     path="/api/inscripciones/{id}",
     *     summary="Mostrar detalle de una inscripción",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la inscripción",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar detalle de una inscripción."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function show($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        return response()->json($inscripcion);
    }

    /**
     * @OA\Post(
     *     path="/api/inscripciones",
     *     summary="Crear una nueva inscripción",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"alumno_id", "clase_id", "materia_id", "estado_pago"},
     *             @OA\Property(property="alumno_id", type="integer"),
     *             @OA\Property(property="clase_id", type="integer"),
     *             @OA\Property(property="materia_id", type="integer"),
     *             @OA\Property(property="estado_pago", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Inscripción creada exitosamente"
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
            'alumno_id' => 'required|integer',
            'clase_id' => 'required|integer',
            'materia_id' => 'required|integer',
            'estado_pago' => 'boolean'
        ]);

        $inscripcion = Inscripcion::create($request->all());

        return response()->json($inscripcion, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/inscripciones/{id}",
     *     summary="Actualizar una inscripción existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la inscripción a actualizar",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"alumno_id", "clase_id", "materia_id", "estado_pago"},
     *             @OA\Property(property="alumno_id", type="integer"),
     *             @OA\Property(property="clase_id", type="integer"),
     *             @OA\Property(property="materia_id", type="integer"),
     *             @OA\Property(property="estado_pago", type="boolean")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inscripción actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Inscripción no encontrada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $inscripcion = Inscripcion::findOrFail($id);

        $request->validate([
            'alumno_id' => 'integer',
            'clase_id' => 'integer',
            'materia_id' => 'integer',
            'estado_pago' => 'boolean'
        ]);

        $inscripcion->update($request->all());

        return response()->json($inscripcion, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/inscripciones/{id}",
     *     summary="Eliminar una inscripción existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la inscripción",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Inscripción eliminada exitosamente."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function destroy($id)
    {
        $inscripcion = Inscripcion::findOrFail($id);
        $inscripcion->delete();
        return response()->json(null, 204);
    }
}
