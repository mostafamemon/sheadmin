<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomCategory;
use App\Models\EcomSubCategory;

class SubCategory extends Component
{
    public $current_page    = "index";
    public $sub_categories  = [];
    public $categories      = [];
    public $filter_by       = "all";
    public $filter_name     = "";

    public $sub_category_id     = "";
    public $category_id         = "";
    public $sub_category_name   = "";

    public function mount()
    {
        if (isset(request()->current_page)) {
            $this->current_page     = request()->current_page;
            if($this->current_page == "update")
            {
                $this->sub_category_id  = request()->sub_category_id;
                $sub_category = EcomSubCategory::where('id',$this->sub_category_id)->first();
                $this->category_id          = $sub_category->category_id;
                $this->sub_category_name    = $sub_category->sub_category_name;
            }
        }
        $this->categories = EcomCategory::orderBy('category_name','asc')->get();
        $this->filter();
    }

    public function filter()
    {
        $sub_categories = EcomSubCategory::orderBy('sub_category_name','asc');
        if($this->filter_by != "all") {
            $sub_categories->where('category_id',$this->filter_by);
        }
        if($this->filter_name != "") {
            $sub_categories->where('sub_category_name', 'like', '%' . $this->filter_name . '%');
        }
        $this->sub_categories = $sub_categories->get();
    }

    public function store()
    {
        $sub_category                = new EcomSubCategory();
        $sub_category->category_id   = $this->category_id;
        $sub_category->sub_category_name   = $this->sub_category_name;
        $sub_category->save();

        session()->flash('message', 'Sub category successfully added!');
        return redirect()->to('/sub-category');
    }  

    public function delete($sub_category_id)
    {
        EcomSubCategory::where('id',$sub_category_id)->delete();

        session()->flash('message', 'Sub category successfully deleted!');
        return redirect()->to('/sub-category');
    }

    public function update()
    {
        $sub_category                       = EcomSubCategory::where('id',$this->sub_category_id)->first();
        $sub_category->category_id          = $this->category_id;
        $sub_category->sub_category_name    = $this->sub_category_name;
        $sub_category->save();

        session()->flash('message', 'Sub category successfully updated!');
        return redirect()->to('/sub-category');
    }

    public function render()
    {
        return view('livewire.sub_category.index');
    }
}
