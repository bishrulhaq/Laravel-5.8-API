<?php

namespace App\Http\Controllers;

use App\Data;
use Illuminate\Http\Request;

class DataController extends Controller
{
    public function index()
    {
        $data = Data::all();
        return response()->json($data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required'
        ]);

        $data = Data::create($request->all());

        return response()->json([
            'message' => 'Data Successfully Stored!',
            'data' => $data
        ]);
    }

    public function show(Data $data)
    {
        return $data;
    }

    public function update(Request $request, Data $data)
    {
        $request->validate([
            'title'       => 'nullable',
            'description' => 'nullable'
        ]);

        $data->update($request->all());

        return response()->json([
            'message' => 'Data Successfully Updated!',
            'data' => $data
        ]);
    }

    public function destroy(Data $data)
    {
        $data->delete();

        return response()->json([
            'message' => 'Data Successfully deleted!'
        ]);
    }
}
