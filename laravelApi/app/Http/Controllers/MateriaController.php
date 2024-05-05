<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Materia;

class MateriaController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/materias",
     *     summary="Mostrar todas las materias",
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar todas las materias."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function index()
    {
        $materias = Materia::all();
        return response()->json($materias);
    }

    /**
     * @OA\Get(
     *     path="/api/materias/{id}",
     *     summary="Mostrar detalle de una materia",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la materia",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Mostrar detalle de una materia."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function show($id)
    {
        $materia = Materia::findOrFail($id);
        return response()->json($materia);
    }

    /**
     * @OA\Post(
     *     path="/api/materias",
     *     summary="Crear una nueva materia",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "nivel"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="nivel", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Materia creada exitosamente"
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
            'nivel' => 'required|string'
        ]);

        $materia = Materia::create($request->all());

        return response()->json($materia, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/materias/{id}",
     *     summary="Actualizar una materia existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID de la materia a actualizar",
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             required={"nombre", "nivel"},
     *             @OA\Property(property="nombre", type="string"),
     *             @OA\Property(property="nivel", type="string")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Materia actualizada exitosamente"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Materia no encontrada"
     *     )
     * )
     */
    public function update(Request $request, $id)
    {
        $materia = Materia::findOrFail($id);

        $request->validate([
            'nombre' => 'string',
            'nivel' => 'string'
        ]);

        $materia->update($request->all());

        return response()->json($materia, 200);
    }

    /**
     * @OA\Delete(
     *     path="/api/materias/{id}",
     *     summary="Eliminar una materia existente",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="ID de la materia",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Materia eliminada exitosamente."
     *     ),
     *     @OA\Response(
     *         response="default",
     *         description="Ha ocurrido un error."
     *     )
     * )
     */
    public function destroy($id)
    {
        $materia = Materia::findOrFail($id);
        $materia->delete();
        return response()->json(null, 204);
    }
}
