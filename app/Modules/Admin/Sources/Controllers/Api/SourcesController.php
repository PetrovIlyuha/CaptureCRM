<?php

namespace App\Modules\Admin\Sources\Controllers\Api;

use App\Modules\Admin\Sources\Models\Source;
use App\Modules\Admin\Sources\Requests\SourcesRequest;
use App\Modules\Admin\Sources\Services\SourcesService;
use App\Services\Responses\ResponseService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SourcesController extends Controller
{
    private $service;

    function __construct(SourcesService $sourcesService) {
        $this->service = $sourcesService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->authorize('view', new Source());
        return ResponseService::sendJsonResponse(true, 200, [],
            ["sources" => $this->service->getSources()]
        );
    }

    /**
     * Create of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(SourcesRequest $request)
    {
        $source = $this->service->save($request, new Source());
        return ResponseService::sendJsonResponse(true, 200, [], [
            'source' => $source->toArray()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Source $source)
    {
        return ResponseService::sendJsonResponse(true, 200, [], ['source' => $source]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Modules\Admin/Sources\Models\Source  $source
     * @return \Illuminate\Http\Response
     */
    public function edit(Source $source)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(SourcesRequest $request, Source $source)
    {
        $source = $this->service->save($request, $source);
        return ResponseService::sendJsonResponse(true, 200, [], [
            'source' => $source->toArray()
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Modules\Admin\Sources\Models\Source  $source
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Source $source)
    {
        $source->delete();
        return ResponseService::sendJsonResponse(true, 200, [], [
            'source' => $source->toArray()
        ]);
    }
}
