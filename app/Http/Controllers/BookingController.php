<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
// Model
use App\Models\Booking;
// Errors
use App\Exceptions\ValidationException;

class BookingController extends Controller
{
    /**
     * return all Booking in storage.
     *
     * @return send json
     */
    public function show(Request $request){
        $bookings = Booking::all();

        return response()->json([
            'data'=> $bookings,
        ], Response::HTTP_OK);
    }
    /**
     * return Booking by id.
     *
     * @return send json
     */
    public function find(Request $request){
        $data['id'] = $request->id;
        $rules = [
            'id'=>'required|numeric|exists:bookings'
        ];
        $validator = Validator::make($data,$rules);

        if($validator->fails()){
            throw new ValidationException([$validator->errors()]);
        }
        $booking = Booking::find($request->id);

        return response()->json([
            'data'=> $booking,
        ], Response::HTTP_OK);
    }
    /**
     * craate Booking .
     *
     * @return send json
     */
    public function store(Request $request){
        $data = $request->only(['status','description']);
        $rules = [
            'status'=>'required|string',
            'description'=>'required|string|min:2|max:50'
        ];
        $validator = Validator::make($data,$rules);

        if($validator->fails()){
            throw new ValidationException([$validator->errors()]);
        }

        $booking = Booking::create($data);


        return response()->json([
            'message'=>'Booking created',
            'booking'=> $booking,
        ], Response::HTTP_CREATED);
    }
    /**
     * update Booking by id.
     *
     * @return send json
     */
    public function update(Request $request){
        $data = $request->only(['status','description']);
        $data['id'] = $request->id;
        $rules = [
            'status'=>'nullable|string',
            'description'=>'nullable|string|min:2|max:50',
            'id'=>'required|numeric|exists:bookings'
        ];
        $validator = Validator::make($data,$rules);

        if($validator->fails()){
            throw new ValidationException([$validator->errors()]);
        }
        $booking = Booking::find($request->id);

        $booking->update($data);

        return response()->json([
            'data'=> $booking,
        ], Response::HTTP_OK);
    }
    /**
     * delete Booking by id.
     *
     * @return send json
     */
    public function delete(Request $request){
        $data['id'] = $request->id;
        $rules = [
            'id'=>'required|numeric|exists:bookings'
        ];
        $validator = Validator::make($data,$rules);

        if($validator->fails()){
            throw new ValidationException([$validator->errors()]);
        }
        Booking::destroy($request->id);

        return response()->json([
            'data'=> 'Booking deleted.',
        ], Response::HTTP_OK);
    }
}
