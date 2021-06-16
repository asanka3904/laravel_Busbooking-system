<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFormBooking extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'bus_seate_id'=>'required',
            'user_id'=>'required',
            'bus_schedule_id'=>'required',
            'seat_number'=>'required',
            'price'=>'required',
            'status'=>'required'
        ];
    }
}
