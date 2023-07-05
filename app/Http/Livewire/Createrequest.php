<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Createrequest extends Component
{
    public $profile, $finish = false;

    public function render()
    {
        return view('livewire.createrequest');
    }
}
