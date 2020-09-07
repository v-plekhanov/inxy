<?php

namespace App\Models;

use App\Http\Requests\ServerRequest;
use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['provider','brand','cpu','drive','price', 'location'];

    /**
     * Get price in dollars.
     *
     * @param  string  $value
     * @return string
     */
    public function getPriceAttribute($value)
    {
        return $value / 100;
    }

    /**
     * Set price in cents.
     *
     * @param  string  $value
     * @return string
     */
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] =  $value * 100;
    }


    public static function getServers(ServerRequest $serverRequest)
    {
        $servers = self::query();

        if(isset($serverRequest->provider)){
            $servers->whereProvider($serverRequest->provider);
        }

        if(isset($serverRequest->price_min)){
            $servers->where('price', '>=', $serverRequest->price_min * 100);
        }

        if(isset($serverRequest->price_max)){
            $servers->where('price', '<=', $serverRequest->price_max * 100);
        }

        $size = isset($serverRequest->size) ? $serverRequest->size : 20;


        return $servers->paginate($size);
    }

    public static function getProviders()
    {
        return self::select('provider')->distinct()->pluck('provider');
    }

    public static function getMinPrice()
    {
        return self::select('price')->min('price') / 100;
    }

    public static function getMaxPrice()
    {
        return self::select('price')->max('price') / 100;
    }
}
