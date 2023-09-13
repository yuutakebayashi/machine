<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExeptImageRequest extends FormRequest
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
            "name" => "required|max:20",
            "maker" => "required|integer",
            "price" => "required|integer",
            "count" => "required|integer",
            "comment" => "required",
        ];
    }

    public function attributes()
{
    return [
            "name" => "商品名",
            "maker" => "メーカー名",
            "price" => "価格",
            "count" => "個数",
            "comment" => "コメント",
    ];
}

/**
 * エラーメッセージ
 *
 * @return array
 */
public function messages() {
    return [
        'name.required' => ':attributeを入力してください。',
        'maker.integer' => ':attributeを選択してください。',
        'price.required' => ':attributeを数値で入力してください。',
        'count.required' => ':attributeを数値で入力してください。',
        'comment.required' => ':attributeを入力してください。',
    ];
}
}
