<?php

namespace App\Http\Requests;

use App\Enum\Lable;
use App\Enum\Priority;
use App\Enum\Status;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreBoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->user();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:100',
            'description' => 'required|string|max:500',
            'color' => ['required', 'string', new Enum(Lable::class)],
            'status' => ['required', 'string', new Enum(Status::class)],
            'due_date' => 'nullable|date',
            'priority' => ['required', 'string', new Enum(Priority::class)],
            'complate_at' => 'nullable|date'
        ];
    }
}
