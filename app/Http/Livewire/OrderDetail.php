<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomOrder;
use App\Models\EcomOrderDetail;

class OrderDetail extends Component
{
    public $order = "";
    public $order_details = [];

    public function mount()
    {
        if(isset($_GET['order_id'])) {
            $order_id = $_GET['order_id'];
            $this->order = EcomOrder::where('id',$order_id)->first();
            $this->order_details = EcomOrderDetail::where('order_id',$order_id)->get();
        }
    }

    public function render()
    {
        return view('livewire.order-detail');
    }
}
