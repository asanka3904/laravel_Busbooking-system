<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\bus_schedule_bookings;
use App\Http\Requests\StoreFormBooking;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return bus_schedule_bookings::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreFormBooking $request)
    {
        return bus_schedule_bookings::create($request->all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return bus_schedule_bookings::find($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $bus_schedule_bookings=bus_schedule_bookings::find($id);
        $bus_schedule_bookings=bus_schedule_bookings::update($request->all());

        return $bus_schedule_bookings;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return bus_schedule_bookings::destroy($id);
    }
}
