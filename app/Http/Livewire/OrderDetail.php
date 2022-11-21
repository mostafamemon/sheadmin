<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomOrder;
use App\Models\EcomOrderDetail;

class OrderDetail extends Component
{
    public $order = "";
    public $order_id = "";
    public $order_details = [];
    public $update_status = "";

    public function mount()
    {
        if(isset($_GET['order_id'])) {
            $this->order_id = $_GET['order_id'];
            $this->order = EcomOrder::where('id',$this->order_id)->first();
            $this->update_status = $this->order->status;
            $this->order_details = EcomOrderDetail::where('order_id',$this->order_id)->get();
        }
    }

    public function change_status($order_id)
    {
        $this->order->status = $this->update_status;
        $this->order->save();
        session()->flash('message', 'Status successfully added!');
        return redirect()->to('/order-details?order_id='.$this->order_id);

    }

    public function render()
    {
        return view('livewire.order-detail');
    }
}
