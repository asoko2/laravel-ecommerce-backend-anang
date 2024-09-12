<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\Addresses;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    //index
    public function index(Request $request){
        $addresses = $request->user()->addresses;

        return response()->json([
            'status' => 'success',
            'message' => 'Addresses',
            'data' => $addresses,
        ]);
    }

    //store
    public function store(Request $request){
        $request->validate([
            'address' => 'required|string',
            'country' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'district' => 'required|string',
            'is_default' => 'boolean',
        ]);

        $address = $request->user()->addresses()->create([
            'user_id' => $request->user()->id,
            'address' => $request->address,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'district' => $request->district,
            'is_default' => $request->is_default,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Address created',
            'data' => $address,
        ], 201);
    }

    //update address
    public function update(Request $request, $id){
        $request->validate([
            'address' => 'required|string',
            'country' => 'required|string',
            'province' => 'required|string',
            'city' => 'required|string',
            'postal_code' => 'required|string',
            'district' => 'required|string',
            'is_default' => 'boolean',
        ]);

        $address = $request->user()->addresses()->find($id);
        if(!$address){
            return response()->json([
                'status' => 'error',
                'message' => 'Address not found',
            ], 404);
        }

        $address->update([
            'address' => $request->address,
            'country' => $request->country,
            'province' => $request->province,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'district' => $request->district,
            'is_default' => $request->is_default,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Address updated',
            'data' => $address,
        ]);
    }

    //delete address
    public function destroy(Request $request, $id){
        $address = Address::find($id);
        $address->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Address deleted',
        ]);
    }
}
