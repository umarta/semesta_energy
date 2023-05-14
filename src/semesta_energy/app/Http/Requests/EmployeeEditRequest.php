<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeEditRequest extends FormRequest
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

    public function rules()
    {
        return [
            'name' => 'required|string',
            'id_card' => 'required|string',
            'gender' => 'required|in:male,female',
            'religion' => 'required|in:islam,kristen,protestan,hundu,budha,lainnya',
            'photo' => 'required|active_url',
            'address' => 'required|string',
            'handphone' => 'required|string',
            'job_position_id' => 'required|exists:positions,id'
        ];
    }
}
