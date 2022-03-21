<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Capsule;

class CapsulesAPIController extends Controller
{
    /**
     * Capsules API
     * @OA\Get (
     *     path="/api/capsules",
     *     tags={"Capsules"},
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *              type="array",
     *              @OA\Items(
     *                  @OA\Property(property="capsule_serial", type="string", example="C101"),
     *                  @OA\Property(property="capsule_id", type="string", example="dragon1"),
     *                  @OA\Property(property="status", type="string", example="retired"),
     *                  @OA\Property(property="original_launch", type="string", example="2010-12-08T15:43:00.000Z"),
     *                  @OA\Property(property="original_launch_unix", type="number", example=1291822980),
     *                  @OA\Property(property="missions", type="array", @OA\Items(type="object", example={"name":"COTS 1","flight":7})),
     *                  @OA\Property(property="landings", type="number", example=1),
     *                  @OA\Property(property="type", type="string", example="Dragon 1.0"),
     *                  @OA\Property(property="details", type="string", example="Reentered after three weeks in orbit"),
     *                  @OA\Property(property="reuse_count", type="number", example=0)
     *              )
     *         )
     *     )
     * )
     */
    public function get_all_data(Request $request) {
        if($request->query('status')) $all_data = Capsule::ofStatus($request->query('status'))->get();
        else $all_data = Capsule::all();

        return response()->json($all_data,200)->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }

    public function get_with_serial(Request $request, $capsule_serial) {
        $capsule = Capsule::where('capsule_serial',$capsule_serial)->first();
        return response()->json($capsule,200)->setEncodingOptions(JSON_UNESCAPED_SLASHES);;
    }
}
