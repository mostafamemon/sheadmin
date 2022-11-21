<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomOrder;
use App\Models\EcomOrderDetail;

class Report extends Component
{
    public $orders = [];
    public $order_details = [];

    public $filter_order_no = "";
    public $filter_phone = "";
    public $filter_date = "";
    public $filter_status = "PENDING";
    
    public function mount()
    {
        $this->filter();
    }

    public function filter()
    {
        $orders = EcomOrder::orderBy('id','desc');
        
        if($this->filter_phone != "") {
            $orders->where('phone','like','%'.$this->filter_phone.'%');
        }
        if($this->filter_date != "") {
            $orders->whereDate('order_date_time',$this->filter_date);
        }
        if($this->filter_order_no != "") {
            $orders->where('id',ltrim($this->filter_order_no, "0"));
        }
        if($this->filter_status != "") {
            $orders->where('status',$this->filter_status);
        }
        $this->orders = $orders->limit('25')->get();
    }

    public function render()
    {
        return view('livewire.report');
    }
}
