<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHiEventInfoRequest;
use App\Http\Requests\UpdateHiEventInfoRequest;
use App\Http\Resources\Admin\HiEventInfoResource;
use App\Models\HiEvent;
use App\Models\HiEventInfo;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HiEventInfosApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hi_event_info_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiEventInfoResource(HiEventInfo::with(['event'])->advancedFilter());
    }

    public function store(StoreHiEventInfoRequest $request)
    {
        $hiEventInfo = HiEventInfo::create($request->validated());

        return (new HiEventInfoResource($hiEventInfo))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create(HiEventInfo $hiEventInfo)
    {
        abort_if(Gate::denies('hi_event_info_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [
                'event' => HiEvent::get(['id', 'name']),
            ],
        ]);
    }

    public function show(HiEventInfo $hiEventInfo)
    {
        abort_if(Gate::denies('hi_event_info_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiEventInfoResource($hiEventInfo->load(['event']));
    }

    public function update(UpdateHiEventInfoRequest $request, HiEventInfo $hiEventInfo)
    {
        $hiEventInfo->update($request->validated());

        return (new HiEventInfoResource($hiEventInfo))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(HiEventInfo $hiEventInfo)
    {
        abort_if(Gate::denies('hi_event_info_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new HiEventInfoResource($hiEventInfo->load(['event'])),
            'meta' => [
                'event' => HiEvent::get(['id', 'name']),
            ],
        ]);
    }

    public function destroy(HiEventInfo $hiEventInfo)
    {
        abort_if(Gate::denies('hi_event_info_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hiEventInfo->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
