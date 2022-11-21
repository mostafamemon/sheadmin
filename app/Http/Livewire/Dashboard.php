<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Dashboard extends Component
{
    public $pending_orders      = 0;
    public $todays_order        = 0;
    public $todays_sale         = 0;
    public $this_month_sale     = 0;
     
    public function render()
    {
        return view('livewire.dashboard');
    }
}
