<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Capsule;

class CapsulesAPIController extends Controller
{
    public function get_all_data(Request $request) {
        // Get data by status column in the database if has status query string
        if($request->query('status')) $all_data = Capsule::ofStatus($request->query('status'))->get();

        // Get all capsules data if hasn't status query string
        else $all_data = Capsule::all();

        // Return capsules data with unescaped slashed encoding (ex. \/)
        return response()->json($all_data,200)->setEncodingOptions(JSON_UNESCAPED_SLASHES);
    }

    public function get_with_serial(Request $request, $capsule_serial) {
        // Get data by capsule_serial
        $capsule = Capsule::where('capsule_serial',$capsule_serial)->first();

        // Return capsules data with unescaped slashed encoding (ex. \/)
        return response()->json($capsule,200)->setEncodingOptions(JSON_UNESCAPED_SLASHES);;
    }
}
