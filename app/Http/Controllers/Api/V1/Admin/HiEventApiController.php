<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHiEventRequest;
use App\Http\Requests\UpdateHiEventRequest;
use App\Http\Resources\Admin\HiEventResource;
use App\Models\HiEvent;
use App\Models\HiGame;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Models\Media;

class HiEventApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hi_event_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiEventResource(HiEvent::with(['game'])->advancedFilter());
    }

    public function store(StoreHiEventRequest $request)
    {
        $hiEvent = HiEvent::create($request->validated());

        if ($media = $request->input('event_banner', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $hiEvent->id]);
        }

        return (new HiEventResource($hiEvent))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create(HiEvent $hiEvent)
    {
        abort_if(Gate::denies('hi_event_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'game'        => HiGame::get(['id', 'name']),
                'game_type'   => HiEvent::GAME_TYPE_RADIO,
                'game_level'  => HiEvent::GAME_LEVEL_RADIO,
                'player_type' => HiEvent::PLAYER_TYPE_RADIO,
            ],
        ]);
    }

    public function show(HiEvent $hiEvent)
    {
        abort_if(Gate::denies('hi_event_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiEventResource($hiEvent->load(['game']));
    }

    public function update(UpdateHiEventRequest $request, HiEvent $hiEvent)
    {
        $hiEvent->update($request->validated());

        $hiEvent->updateMedia($request->input('event_banner', []), 'hi_event_event_banner');

        return (new HiEventResource($hiEvent))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(HiEvent $hiEvent)
    {
        abort_if(Gate::denies('hi_event_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new HiEventResource($hiEvent->load(['game'])),
            'meta' => [
                'game'        => HiGame::get(['id', 'name']),
                'game_type'   => HiEvent::GAME_TYPE_RADIO,
                'game_level'  => HiEvent::GAME_LEVEL_RADIO,
                'player_type' => HiEvent::PLAYER_TYPE_RADIO,
            ],
        ]);
    }

    public function destroy(HiEvent $hiEvent)
    {
        abort_if(Gate::denies('hi_event_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hiEvent->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['hi_event_create', 'hi_event_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model         = new HiEvent();
        $model->id     = $request->input('model_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));

        return response()->json($media, Response::HTTP_CREATED);
    }
}
