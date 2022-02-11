<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use function request;
use function response;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $collection = Customer::orderBy('name')->get([
            'name',
            'email',
            'phone',
            'address'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customers listed with success',
            'data' => $collection
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $data = request()->all();
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'address' => 'required|array',
            'address.number' => 'integer',
            'address.city' => 'string',
            'address.state' => 'string',
            'address.country' => 'string'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator
            ], 400);
        }

        $collection = Customer::create($data);

        return response()->json([
            'success' => true,
            'message' => 'Customers stored with success',
            'data' => $collection
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show($id)
    {
        $collection = Customer::find($id, [
            'name',
            'email',
            'phone',
            'address'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer display with success',
            'data' => $collection
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param int $id
     * @return Response
     */
    public function update($id)
    {
        $data = request()->all();
        $rules = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:15',
            'address' => 'required|array',
            'address.number' => 'integer',
            'address.city' => 'string',
            'address.state' => 'string',
            'address.country' => 'string'
        ];
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return response()->json([
                'error' => true,
                'message' => $validator
            ], 400);
        }

        Customer::where(['id' => $id])->update($data);
        $collection = Customer::find($id, [
            'name',
            'email',
            'phone',
            'address'
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customers updated with success',
            'data' => $collection
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $deleted = Customer::destroy($id);
        return response()->json([
            'success' => true,
            'message' => 'Customers deleted with success',
            'deleted' => $deleted
        ], 200);
    }
}
