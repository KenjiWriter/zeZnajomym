<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Createform extends Component
{
    public $city, $street, $price_per_km, $zones, $zonesInfo;

    public function mount()
    {
        $this->zones = 0;
    }

    public function render()
    {
        if(isset($this->zonesInfo)){
            dd($this->zonesInfo);
        }
        return view('livewire.createform');
    }
}
