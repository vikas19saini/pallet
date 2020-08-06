<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\GeoLocationAPI;
use Log;

class GeoLocation 
{
    public static function mapper_geo_location($obj) {
        if(!is_object($obj)) 
            $obj = json_decode($obj); 
        return [
            'country'       => $obj->country,
            'city'          => $obj->city,
            'countryCode'   => $obj->countryCode,
            'isp'           => $obj->isp,
            'lat'           => $obj->lat,
            'lon'           => $obj->lon,
            'ip'            => $obj->query,
            "timezone"      => $obj->timezone,
        ];
    }

   function fetch_geo($ip) 
   {
       if($ip == "127.0.0.1" || env('LOCAL_SYSTEM',false) == true) 
            $ip = "223.190.8.190"; 

        $geoLocation = GeoLocationAPI::where('ip',$ip)->first(); 
        if($geoLocation) { 
            return self::mapper_geo_location(json_decode($geoLocation->data));
        }

        try {

            $url = "http://ip-api.com/json/$ip"; 
            $client = file_get_contents($url); 

            $geoLocation = new GeoLocationAPI; 
            $geoLocation->ip = $ip; 
            $geoLocation->data = ($client);
            $geoLocation->save(); 

            return self::mapper_geo_location(json_decode($client)); 
            Log::info("E",$location);
        }  catch(\Exception $e)  {
            Log::error('GEO_LOCATION_API',[$e]);
        }
   }

   public function handle($request, Closure $next, $guard = null)
   {
       $ip = $request->ip(); // "46.52.136.212";  

       $resp = $this->fetch_geo($ip); 

       if($resp) 
       {
           $request->request->add(['__geo_ip__' => $resp]); 
       }

        return $next($request);
   }
}
