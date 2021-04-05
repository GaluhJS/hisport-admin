<?php

namespace App\Http\Requests;

use App\Models\HiGame;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class StoreHiGameRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hi_game_create');
    }

    public function rules()
    {
        return [
            'type'       => [
                'string',
                'nullable',
            ],
            'name'       => [
                'string',
                'nullable',
            ],
            'image'      => [
                'array',
                'nullable',
            ],
            'image.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'slug'       => [
                'string',
                'nullable',
            ],
        ];
    }
}
