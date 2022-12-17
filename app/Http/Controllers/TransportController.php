<?php

namespace App\Http\Controllers;

use App\Models\Driver;
use App\Models\Transport;
use Illuminate\Http\Request;

class TransportController extends Controller
{

    public function index()
    {
        // $transports = Transport::all();
        $transports = Transport::with('driver')->get();
        return response($transports, 200);
    }

    public function show($id)
    {
        $transport = Transport::find($id);
        return response($transport, 200);
    }

    public function create(Request $request)
    {
        $driver = Driver::find($request->driver_id);
        $transport = new Transport();
        $transport->type = $request->type;
        $transport->status = $request->status;
        $transport->model = $request->model;
        $transport->firm = $request->firm;
        $driver->transports()->save($transport);

        return response($transport, 200);
    }

    public function update(Request $request, $id)
    {
        $driver = Driver::find($request->driver_id);
        $transport = Transport::find($id);
        $transport->update($request->all());
        $transport->driver()->associate($driver)->save();
        return response($transport, 200);
    }

    public function destroy($id)
    {
        $transport = Transport::find($id);
        $transport->delete();
        return response($transport, 200);
    }

}