<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdRequest extends FormRequest
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
           'title' => 'required|string|max:200',
           'description' => 'required|string|max:1000',
           'photos' => 'array|max:3',
           'price' => 'numeric'
        ];
    }

    /**
     * @return string[]
     */
    public function attributes(): array
    {
        return [
            'title' => 'Название объявления',
            'description' => 'Описание объявления',
            'photos' => 'Фотографии',
            'price' => 'Цена'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            '*.required' => 'Поле :attribute обязательно для заполнения',
            'title.max' => 'Максимальная длина названия 200 символов',
            'description.max' => 'Максимальная длина описания 1000 символов',
            'price.numeric' => 'Сумма должна быть числом',
            'photos.max' => 'Приложите не более трех ссылок на фотографии',
        ];
    }
}
