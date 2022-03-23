<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Capsule;

class CapsulesAPIController extends Controller
{
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
