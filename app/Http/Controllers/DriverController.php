<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    public function index()
    {
        $drivers = Driver::all();
        return response($drivers, 200);
    }

    public function show($id)
    {
        $driver = Driver::find($id);
        return response($driver, 200);
    }

    public function create(Request $request)
    {
        // $requestData = $request->all();
        $driver = Driver::create($request->all());
        return response($driver, 200);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::find($id);
        $driver->update($request->all());
        return response($driver, 200);

    }

    public function destroy($id)
    {
        $driver = Driver::find($id);
        $driver->delete();
        return response($driver, 200);
    }
}