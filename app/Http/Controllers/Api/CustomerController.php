<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    public function index(){
        $customers = Customer::all();
        return response()->json($customers);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers|max:255',
            'dob' => 'required|date',
        ]);
        $customer = Customer::create($validatedData);
        return response()->json($customer, 201);
    }
    public function update(Request $request, $id){
        $customer = Customer::findOrFail($id);
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => [
                'sometimes',
                'email',
                Rule::unique('customers', 'email')->ignore($customer->id)
            ],
            'dob' => 'sometimes|date',
        ]);
        $customer->update($validatedData);
        return response()->json($customer);
    }
    public function destroy(Request $request, $id){
        $customer = Customer::findOrFail($id);
        $customer->delete();
        return response()->json(null, 204);
    }
    public function show($id){
        $customer = Customer::findOrFail($id);
        return response()->json($customer);
    }
}
