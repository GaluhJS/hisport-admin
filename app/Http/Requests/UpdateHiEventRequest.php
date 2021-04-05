<?php

namespace App\Http\Requests;

use App\Models\HiEvent;
use Gate;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Response;
use Illuminate\Support\Arr;

class UpdateHiEventRequest extends FormRequest
{
    public function authorize()
    {
        return Gate::allows('hi_event_edit');
    }

    public function rules()
    {
        return [
            'game_id'           => [
                'integer',
                'exists:hi_games,id',
                'required',
            ],
            'name'              => [
                'string',
                'required',
            ],
            'event_banner'      => [
                'array',
                'required',
            ],
            'event_banner.*.id' => [
                'integer',
                'exists:media,id',
            ],
            'game_type'         => [
                'required',
                'in:' . implode(',', Arr::pluck(HiEvent::GAME_TYPE_RADIO, 'value')),
            ],
            'game_level'        => [
                'nullable',
                'in:' . implode(',', Arr::pluck(HiEvent::GAME_LEVEL_RADIO, 'value')),
            ],
            'price'             => [
                'integer',
                'min:-2147483648',
                'max:2147483647',
                'nullable',
            ],
            'player_type'       => [
                'required',
                'in:' . implode(',', Arr::pluck(HiEvent::PLAYER_TYPE_RADIO, 'value')),
            ],
            'start_date'        => [
                'date_format:' . config('project.datetime_format'),
                'required',
            ],
            'finish_date'       => [
                'date_format:' . config('project.datetime_format'),
                'nullable',
            ],
            'format'            => [
                'string',
                'nullable',
            ],
            'information'       => [
                'string',
                'nullable',
            ],
            'venue'             => [
                'string',
                'nullable',
            ],
            'fee'               => [
                'numeric',
                'nullable',
            ],
        ];
    }
}
