<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\WithPagination;

class Customer extends Component
{
    use WithPagination;

    public $users = [];
    public $filter_phone = "";
    public $filter_name = "";
    
    public function mount()
    {
        $this->filter();
    }

    public function filter()
    {
        $users = User::orderBy('id','desc');
        
        if($this->filter_phone != "") {
            $users->where('phone','like','%'.$this->filter_phone.'%');
        }
        if($this->filter_name != "") {
            $users->where('name','like','%'.$this->filter_name.'%');
        }
        $this->users = $users->where('user_type','user')->limit('25')->get();
    }

    public function render()
    {
        return view('livewire.customer');
    }
}
