<?php

namespace App\Http\Requests\Admin\Post;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
            'preview_image' => 'required|file',
            'main_image' => 'required|file',
            'category_id' => 'required|integer|exists:categories,id',
            'tag_ids' => 'nullable|array',
            'tag_ids.*' => 'nullable|integer|exists:tags,id',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Цей поле необнідно заповнити',
            'title.string' => 'Дані повинні бути типу string',
            'content.required' => 'Цей поле необнідно заповнити',
            'content.string' => 'Дані повинні бути типу string',
            'preview_image.required' => 'Цей поле необнідно заповнити',
            'preview_image.file' => 'Необхідно вибрати файл',
            'main_image.required' => 'Цей поле необнідно заповнити',
            'main_image.file' => 'Необхідно вибрати файл',
            'category_id.required' => 'Цей поле необнідно заповнити',
            'category_id.integer' => 'ID категорія має бути число',
            'category_id.exists' => 'ID категорія має бути в БД',
            'tag_ids.array' => 'Необхідно відправити масив даних',
        ];
    }
}
