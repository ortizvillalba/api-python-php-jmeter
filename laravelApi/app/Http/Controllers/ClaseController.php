<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clase;

class ClaseController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/clases",
     *     summary="Mostrar todas las clases",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas las clases."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index()
    {
        $clases = Clase::all();
        return response()->json($clases);
    }

    /**
     * @OA\Get(
     *     path="/api/clases/{id}",
     *     summary="Mostrar detalle de una clase",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la clase",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar detalle de una clase."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function show($id)
    {
        $clase = Clase::findOrFail($id);
        return response()->json($clase);
    }

    /**
     * @OA\Post(
     *     path="/api/clases",
     *     summary="Crear una nueva clase",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "descripcion", "profesor", "horario", "sala"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="profesor", type="string"),
     *             @OA\Property(property="horario", type="string"),
     *             @OA\Property(property="sala", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Clase creada exitosamente"
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
            'descripcion' => 'required|string',
            'profesor' => 'required|string',
            'horario' => 'required|string',
            'sala' => 'required|string'
        ]);

        $clase = Clase::create($request->all());

        return response()->json($clase, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/clases/{id}",
     *     summary="Actualizar una clase existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la clase a actualizar",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "descripcion", "profesor", "horario", "sala"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="descripcion", type="string"),
     *             @OA\Property(property="profesor", type="string"),
     *             @OA\Property(property="horario", type="string"),
     *             @OA\Property(property="sala", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Clase actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Clase no encontrada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $clase = Clase::findOrFail($id);

        $request->validate([
            'nombre' => 'string',
            'descripcion' => 'string',
            'profesor' => 'string',
            'horario' => 'string',
            'sala' => 'string'
        ]);

        $clase->update($request->all());

        return response()->json($clase, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/clases/{id}",
     *     summary="Eliminar una clase existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la clase",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Clase eliminada exitosamente."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function destroy($id)
    {
        $clase = Clase::findOrFail($id);
        $clase->delete();
        return response()->json(null, 204);
    }
}
