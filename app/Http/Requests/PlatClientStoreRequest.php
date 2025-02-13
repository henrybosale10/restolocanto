<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlatClientStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules()
{
    return [
        'nom' => 'required|string|max:255',
        'description' => 'nullable|string',
        'prix' => 'required|numeric',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
        'plat_id' => 'required|exists:plats,id',
    ];
}

}
