<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomOrder;

class Dashboard extends Component
{
    public $pending_orders      = 0;
    public $todays_order        = 0;
    public $todays_sale         = 0;
    public $this_month_sale     = 0;
     
    public function mount()
    {
        $today = date('Y-m-d');
        $first_date_of_month    = date('Y-m-01');
        $last_date_of_month     = date('Y-m-t');

        $this->pending_orders   = EcomOrder::whereDate('order_date_time', $today)->where('status','PENDING')->count();
        $this->todays_order     = EcomOrder::whereDate('order_date_time', $today)->count();
        $this->todays_sale      = EcomOrder::whereDate('order_date_time', $today)->where('status','DELIVERED')->sum('grand_total');
        $this->this_month_sale  = EcomOrder::whereBetween('order_date_time', [$first_date_of_month.' 00:00:00', $last_date_of_month.' 23:59:59'])->where('status','DELIVERED')->sum('grand_total');
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
