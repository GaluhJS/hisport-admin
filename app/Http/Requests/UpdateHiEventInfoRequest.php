<?php

namespace App\Http\Requests;

use App\Models\HiEventInfo;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;

class UpdateHiEventInfoRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hi_event_info_edit');
    }

    public function rules()
    {
        return [
            'event_id' => [
                'integer',
                'exists:hi_events,id',
                'required',
            ],
            'overview' => [
                'string',
                'nullable',
            ],
            'rules'    => [
                'string',
                'nullable',
            ],
            'price'    => [
                'string',
                'nullable',
            ],
            'location' => [
                'string',
                'nullable',
            ],
            'contact'  => [
                'string',
                'nullable',
            ],
        ];
    }
}
