<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\BaseController;
use App\Http\Requests\ServerCreateRequest;
use App\Http\Requests\ServerRequest;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use App\Services\ImportService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\View\View;

class ServerController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(ServerRequest $serverRequest)
    {

        $servers = ServerResource::collection(Server::getServers($serverRequest));
        $title = 'Servers catalog';
        $pagination = [20,40,60];
        $filters = [
            'size' => $serverRequest->size ?? 20,
            'providers' => Server::getProviders(),
            'price_min' => $serverRequest->price_min ?? Server::getMinPrice(),
            'price_max' => $serverRequest->price_max ?? Server::getMaxPrice(),
        ];

        return view('admin.servers.index', compact('servers', 'title', 'pagination', 'filters'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.servers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ServerCreateRequest $serverCreateRequest
     * @return Response
     */
    public function store(ServerCreateRequest $serverCreateRequest)
    {
        Server::create([
            'provider' => $serverCreateRequest->provider,
            'brand' => $serverCreateRequest->brand,
            'cpu' => $serverCreateRequest->cpu,
            'location' => $serverCreateRequest->location,
            'drive' => $serverCreateRequest->drive,
            'price' => $serverCreateRequest->price,
        ]);
        return redirect()->route('servers.index');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param $id
     * @return Application|Factory|View
     */
    public function edit($id)
    {
        $server = Server::findOrFail($id);
        $title = "Edit server with id {$server->id}";
        return view('admin.servers.edit', compact('server', 'title'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ServerCreateRequest $serverCreateRequest
     * @param $id
     * @return Response
     */
    public function update(ServerCreateRequest $serverCreateRequest, $id)
    {
        Server::find($id)->update([
            'provider' => $serverCreateRequest->provider,
            'brand' => $serverCreateRequest->brand,
            'cpu' => $serverCreateRequest->cpu,
            'drive' => $serverCreateRequest->drive,
            'price' => $serverCreateRequest->price,
        ]);
        return redirect()->route('servers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id)
    {
        return Server::whereId($id)->delete();

    }

    public function import()
    {
        return ImportService::importFromUrl();
    }
}
