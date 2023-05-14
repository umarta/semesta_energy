<?php

namespace App\Http\Requests;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    protected function failedAuthorization(): array
    {
        if ($this->hasMissingClientId) {
            throw new AuthorizationException('User has to be assigned to specific client.');
        }
        parent::failedAuthorization();
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
