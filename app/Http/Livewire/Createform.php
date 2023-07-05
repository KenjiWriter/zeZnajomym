<?php

namespace App\Http\Livewire;

use App\Models\DriversProfile;
use Livewire\Component;
use Illuminate\Support\Facades\Validator;

class Createform extends Component
{
    public $city, $driver_name, $street, $postcode, $price_per_km, $zones, $zonesInfo, $price_type, $avg_fuel_con, $fuel_price, $finished = false, $newProfileId, $code;

    protected $rules = [
        'city' => 'required',
        'postcode' => 'required',
        'driver_name' => 'required',
        'street' => 'required',
        'price_type' => 'required',
    ];

    public function mount()
    {
        $this->price_type = 1;
    }

    public function customValidation()
    {
        $valid = true;
        if ($this->price_type == 1) {
            if (empty($this->price_per_km)) {
                $valid = false;
            }
        } else {
            if (empty($this->avg_fuel_con) or empty($this->fuel_price)) {
                $valid = false;
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

            $this->code = implode('', $fourDigits);
            $zones = json_encode($this->zonesInfo);
            $create = DriversProfile::create([
                'name' => $this->driver_name,
                'code' => $this->code,
                'postcode' => $this->postcode,
                'street' => $this->street,
                'price_type' => $this->price_type,
                'city' => $this->city,
                'zones' => $zones,
                'price_per_km' => $this->price_per_km,
                'fuel_price' => $this->fuel_price,
                'avg_fuel_con' => $this->avg_fuel_con,
            ]);

            if ($create) {
                $this->finished = true;
                $this->newProfileId = $create->id;
            }
        }
    }

    public function render()
    {
        return view('livewire.createform');
    }
}
