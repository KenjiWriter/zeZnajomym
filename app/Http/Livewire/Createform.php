<?php

namespace App\Http\Livewire;

use App\Models\DriversProfile;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Createform extends Component
{
    public $city, $driver_name, $street, $postcode, $price_per_km, $zones, $zonesInfo, $price_type, $avg_fuel_con, $fuel_price;

    protected $rules = [
        'city' => 'required',
        'postcode' => 'required',
        'driver_name' => 'required',
        'street' => 'required',
        'price_per_km' => 'numeric',
        'price_type' => 'required',
    ];

    public function mount()
    {
        $this->zones = 0;
        $this->price_type = 1;
    }

    public function customValidation()
    {
        $valid = true;
        if ($this->price_type == 1) {
            if (empty($this->price_per_km)) {
                $valid = false;
                dd('1');
            }
        } else {
            if (empty($this->avg_fuel_con) or empty($this->fuel_price)) {
                $valid = false;
                dd('2');
            }
        }
        return $valid;
    }


    public function submit()
    {
        $this->validate();
        if ($this->customValidation() == true) {
            $numbers = range(0, 9);
            shuffle($numbers);
            $fourDigits = array_slice($numbers, 0, 4);

            $code = implode('', $fourDigits);
            $zones = json_encode($this->zonesInfo);
            DriversProfile::create([
                'name' => $this->driver_name,
                'code' => $code,
                'postcode' => $this->postcode,
                'street' => $this->street,
                'price_type' => $this->price_type,
                'city' => $this->city,
                'zones' => $zones,
                'price_per_km' => $this->price_per_km,
                'fuel_price' => $this->fuel_price,
                'avg_fuel_con' => $this->avg_fuel_con,
            ]);
        }
    }

    public function render()
    {
        return view('livewire.createform');
    }
}
