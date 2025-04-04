<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WebinarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'webinar.title' => ['required'],
            'webinar.description' => ['nullable'],
            'webinar.video_url' => ['nullable'],
            'webinar.rtmp_url' => ['nullable'],
            'webinar.start_time' => ['nullable'],
            'webinar.status' => ['nullable'],
            'webinar.price' => ['nullable'],
        ];
    }
}
