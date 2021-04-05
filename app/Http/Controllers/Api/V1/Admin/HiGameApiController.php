<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHiGameRequest;
use App\Http\Requests\UpdateHiGameRequest;
use App\Http\Resources\Admin\HiGameResource;
use App\Models\HiGame;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Spatie\MediaLibrary\Models\Media;

class HiGameApiController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('hi_game_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiGameResource(HiGame::advancedFilter());
    }

    public function store(StoreHiGameRequest $request)
    {
        $hiGame = HiGame::create($request->validated());

        if ($media = $request->input('image', [])) {
            Media::whereIn('id', data_get($media, '*.id'))
                ->where('model_id', 0)
                ->update(['model_id' => $hiGame->id]);
        }

        return (new HiGameResource($hiGame))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function create(HiGame $hiGame)
    {
        abort_if(Gate::denies('hi_game_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'meta' => [],
        ]);
    }

    public function show(HiGame $hiGame)
    {
        abort_if(Gate::denies('hi_game_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new HiGameResource($hiGame);
    }

    public function update(UpdateHiGameRequest $request, HiGame $hiGame)
    {
        $hiGame->update($request->validated());

        $hiGame->updateMedia($request->input('image', []), 'hi_game_image');

        return (new HiGameResource($hiGame))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function edit(HiGame $hiGame)
    {
        abort_if(Gate::denies('hi_game_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return response([
            'data' => new HiGameResource($hiGame),
            'meta' => [],
        ]);
    }

    public function destroy(HiGame $hiGame)
    {
        abort_if(Gate::denies('hi_game_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $hiGame->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeMedia(Request $request)
    {
        abort_if(Gate::none(['hi_game_create', 'hi_game_edit']), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->has('size')) {
            $this->validate($request, [
                'file' => 'max:' . $request->input('size') * 1024,
            ]);
        }

        $model         = new HiGame();
        $model->id     = $request->input('model_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('file')->toMediaCollection($request->input('collection_name'));

        return response()->json($media, Response::HTTP_CREATED);
    }
}
