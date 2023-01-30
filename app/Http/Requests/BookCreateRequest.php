<?php

namespace App\Http\Requests;

use App\Models\Book;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BookCreateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['required'],
            'page' => ['required', 'max:255'],
            'author' => ['required'],
            'price' => ['required', 'max:255']
            // 'email' => ['required', 'email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
        ];
    }

    public function messages() {
        return [
            'title' => '제목을 입력하세요.',
            'page' => '페이지 수를 입력하세요.',
            'author' => '저자를 입력하세요.',
            'price' => '가격을 입력하세요.',
        ];
    }
}