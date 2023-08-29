<?php

namespace App\Http\Requests;

use App\Rules\MatchCurrentPassword;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rules\Password;

class UpdatePasswordRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return $this->user()->can('user_detail.change_password') || $this->user()->id === cleanNumber($this->get('id'));
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $userId = cleanNumber($this->get('id'));
        return [
            'currentPassword' => ['required', new MatchCurrentPassword($userId)],
            'newPassword' => ['required', Password::min(8)->letters()->numbers(), 'confirmed'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            JsonResponse::create([
                'status' => false,
                'message' => $validator->errors()->first(),
                'errors' => $validator->errors(),
            ], JsonResponse::HTTP_BAD_REQUEST)
        );
    }
}
