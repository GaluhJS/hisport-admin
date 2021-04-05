<?php

namespace App\Http\Requests;

use App\Models\HiVenue;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHiVenueRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hi_venue_edit');
    }

    public function rules()
    {
        return [
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
            'iframe'     => [
                'string',
                'nullable',
            ],
            'address'    => [
                'string',
                'nullable',
            ],
            'long'       => [
                'string',
                'nullable',
            ],
            'lat'        => [
                'string',
                'nullable',
            ],
        ];
    }
}
