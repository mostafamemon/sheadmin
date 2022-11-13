<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomCategory;

class Category extends Component
{
    public $current_page = "index";
    public $categories   = [];
    public $filter_by    = "all";
    public $filter_name  = "";
    public function mount()
    {
        if (isset(request()->current_page)) {
            $this->current_page = request()->current_page;
        }
        $this->filter();
    }

    public function filter()
    {
        $categories = EcomCategory::orderBy('category_name','asc');
        if($this->filter_by != "all") {
            if($this->filter_by == "show_in_top_menu") {
                $categories->where('show_in_top_menu',1);
            } elseif($this->filter_by == "show_in_home_page") {
                $categories->where('show_in_home_page',1);
            }
        }
        if($this->filter_name != "") {
            $categories = $categories->where('category_name', 'like', '%' . $this->filter_name . '%');
        }
        $this->categories = $categories->get();
    }

    public function render()
    {
        return view('livewire.category.index');
    }
}
