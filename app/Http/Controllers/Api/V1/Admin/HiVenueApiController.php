<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHiVenueRequest;
use App\Http\Requests\UpdateHiVenueRequest;
use App\Http\Resources\Admin\HiVenueResource;
use App\Models\HiVenue;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Models\Media;

class HiVenueApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hi_venue_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiVenueResource(HiVenue::advancedFilter());
    }

    public function store(StoreHiVenueRequest $request)
    {
        $hiVenue = HiVenue::create($request->validated());

        if ($media = $request->input('image', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $hiVenue->id]);
        }

        return (new HiVenueResource($hiVenue))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create(HiVenue $hiVenue)
    {
        abort_if(Gate::denies('hi_venue_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [],
        ]);
    }

    public function show(HiVenue $hiVenue)
    {
        abort_if(Gate::denies('hi_venue_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiVenueResource($hiVenue);
    }

    public function update(UpdateHiVenueRequest $request, HiVenue $hiVenue)
    {
        $hiVenue->update($request->validated());

        $hiVenue->updateMedia($request->input('image', []), 'hi_venue_image');

        return (new HiVenueResource($hiVenue))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(HiVenue $hiVenue)
    {
        abort_if(Gate::denies('hi_venue_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new HiVenueResource($hiVenue),
            'meta' => [],
        ]);
    }

    public function destroy(HiVenue $hiVenue)
    {
        abort_if(Gate::denies('hi_venue_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hiVenue->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['hi_venue_create', 'hi_venue_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model         = new HiVenue();
        $model->id     = $request->input('model_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));

        return response()->json($media, Response::HTTP_CREATED);
    }
}
