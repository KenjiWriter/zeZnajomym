<?php

namespace App\Http\Livewire;

use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Livewire\Component;

class Createrequest extends Component
{
    public $profile, $finish = false, $total_cost, $total_distance, $isSubmitting = false;
    public $from_postcode, $from_city, $from_street;
    public $to_postcode, $to_city, $to_street;

    public function submit()
    {
        $this->isSubmitting = true;
        $from_location = $this->geocodeAddress($this->from_street, $this->from_city, $this->from_postcode);
        $to_location = $this->geocodeAddress($this->to_street, $this->to_city, $this->to_postcode);
        $driver_location = $this->geocodeAddress($this->profile->street, $this->profile->city, $this->profile->postcode);

        // calc how far driver is from the friendo
        $from_driver_distance = round($this->calculateDistance($driver_location, $from_location) * 1.38, 2);
        $from_to_location = round($this->calculateDistance($from_location, $to_location) * 1.38, 2);

        $cost_from_driver = 0;
        $cost_to_destination = 0;

        switch ($this->profile->price_type) {
            case 1:
                $cost_from_driver = $from_driver_distance * $this->profile->price_per_km;
                $cost_to_destination = $from_to_location * $this->profile->price_per_km;
                break;
            case 2:
                $spent_fuel = ($from_driver_distance / 100) * $this->profile->avg_fuel_con;
                $cost_from_driver = $spent_fuel * $this->profile->fuel_price;
                $spent_fuel = ($from_to_location / 100) * $this->profile->avg_fuel_con;
                $cost_to_destination = $spent_fuel * $this->profile->fuel_price;
                break;
        }

        $current_zone = null;

        if ($this->profile->zones != null && $this->profile->zones != 'null') {
            $zones = json_decode($this->profile->zones, true);
            foreach ($zones as $zone) {
                if ($from_driver_distance > $zone['from_range']) {
                    $current_zone = $zone;
                    switch ($this->profile->price_type) {
                        case 1:
                            $distance_from_zone = $from_driver_distance - $zone['from_range'];
                            $cost_from_driver += $distance_from_zone * $this->profile->price_per_km;
                            break;
                        case 2:
                            $spent_fuel = ($from_driver_distance / 100) * $this->profile->avg_fuel_con;
                            $cost_from_driver += $spent_fuel * $this->profile->fuel_price;
                            break;
                    }
                }
            }
        }

        $current_zone_to = null;

        if ($this->profile->zones != null && $this->profile->zones != 'null') {
            $zones = json_decode($this->profile->zones, true);
            foreach ($zones as $zone) {
                if ($from_to_location > $zone['from_range']) {
                    $current_zone_to = $zone;
                    switch ($this->profile->price_type) {
                        case 1:
                            $distance_from_zone = $from_to_location - $zone['from_range'];
                            $cost_to_destination += $distance_from_zone * $this->profile->price_per_km;
                            break;
                        case 2:
                            $spent_fuel = ($from_to_location / 100) * $this->profile->avg_fuel_con;
                            $cost_to_destination += $spent_fuel * $this->profile->fuel_price;
                            break;
                    }
                }
            }
        }
        $this->finish = true;
        $this->total_cost = round($cost_from_driver + $cost_to_destination, 2);
        $this->total_distance = $from_driver_distance + $from_to_location;
        $this->isSubmitting = false;
    }

    public function geocodeAddress($street, $city, $postcode)
    {
        $client = new Client();
        $url = 'https://www.mapquestapi.com/geocoding/v1/address';

        $data = [
            'key' => 'dtXPUDiD8g9gE9DAtKFyrScs6riK11TO',
            'location' => [
                'street' => $street,
                'city' => $city,
                'postalCode' => $postcode,
                'country' => 'Poland'
            ]
        ];

        $response = $client->post($url, [
            'json' => $data
        ]);

        $body = $response->getBody()->getContents();
        $result = json_decode($body, true);
        $latitude = $result['results'][0]['locations'][0]['latLng']['lat'];
        $longitude = $result['results'][0]['locations'][0]['latLng']['lng'];

        return ['lat' => $latitude, 'lon' => $longitude];
    }

    function calculateDistance($point1, $point2)
    {
        $lat1 = deg2rad($point1['lat']);
        $lon1 = deg2rad($point1['lon']);
        $lat2 = deg2rad($point2['lat']);
        $lon2 = deg2rad($point2['lon']);

        $earthRadius = 6371;

        $deltaLat = $lat2 - $lat1;
        $deltaLon = $lon2 - $lon1;

        $a = sin($deltaLat / 2) * sin($deltaLat / 2) + cos($lat1) * cos($lat2) * sin($deltaLon / 2) * sin($deltaLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $earthRadius * $c;

        return $distance;
    }

    public function render()
    {
        return view('livewire.createrequest');
    }
}
