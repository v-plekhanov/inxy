<?php

namespace App\Http\Controllers;

use App\Http\Requests\ServerRequest;
use App\Http\Resources\ServerResource;
use App\Models\Server;
use Illuminate\Contracts\Support\Renderable;

class HomeController extends BaseController
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Renderable
     */
    public function index(ServerRequest $serverRequest)
    {
        $servers = ServerResource::collection(Server::getServers($serverRequest));
        $pagination = [20,40,60];
        $filters = [
            'size' => $serverRequest->size ?? 20,
            'providers' => Server::getProviders(),
            'price_min' => $serverRequest->price_min ?? Server::getMinPrice(),
            'price_max' => $serverRequest->price_max ?? Server::getMaxPrice(),
        ];

        return view('index', compact('servers', 'pagination', 'filters'));
    }
}
