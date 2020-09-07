<?php
namespace App\Services;

use App\Models\Server;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ImportService
{
    public static function importFromUrl()
    {
        try{
            $response = Http::get(env('IMPORT_URL', 'https://old.my.inxy.com/json/servers_catalog.json'))->body();
            $data = json_decode($response)->data;
        } catch (ConnectionException $e){
            Log::critical($e->getMessage());
            return false;
        }

        $dataToSave = [];
        $timestamp = date('Y-m-d H-s-i');
        foreach ($data as $item){
            $server = [];
            $server['provider'] = $item->provider;
            $server['brand'] = $item->brand;
            $server['location'] = $item->location;
            $server['cpu'] = $item->cpu;
            $server['drive'] = $item->drive_label;
            $server['price'] = $item->price * 100;
            $server['created_at'] = $timestamp;
            $server['updated_at'] = $timestamp;

            $dataToSave[] = $server;
        }
        Server::truncate();
        Server::insert($dataToSave);
        return true;
    }
}
