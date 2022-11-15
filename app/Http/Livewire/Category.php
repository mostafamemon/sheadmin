<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\EcomCategory;
use Illuminate\Support\Facades\File; 

class Category extends Component
{
    use WithFileUploads;

    public $current_page = "index";
    public $categories   = [];
    public $filter_by    = "all";
    public $filter_name  = "";

    public $category_id         = "";
    public $category_name       = "";
    public $search_bar_display  = 0;
    public $top_menu_display    = 0;
    public $home_page_display   = 0;
    public $category_banner     = "";
    public $category_old_banner = "";

    public function mount()
    {
        if (isset(request()->current_page)) {
            $this->current_page     = request()->current_page;
            if($this->current_page == "update")
            {
                $this->category_id  = request()->category_id;
                $category = EcomCategory::where('id',$this->category_id)->first();
                $this->category_name        = $category->category_name;
                $this->search_bar_display   = $category->show_in_search_bar;
                $this->top_menu_display     = $category->show_in_top_menu;
                $this->home_page_display    = $category->show_in_home_page;
                if($category->category_banner != "") {
                    $this->category_banner      = $category->category_banner;
                    $this->category_old_banner  = $category->category_banner;
                }
            }
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
            } elseif($this->filter_by == "show_in_search_bar") {
                $categories->where('show_in_search_bar',1);
            }
        }
        if($this->filter_name != "") {
            $categories = $categories->where('category_name', 'like', '%' . $this->filter_name . '%');
        }
        $this->categories = $categories->get();
    }

    public function store()
    {
        $category                    = new EcomCategory();
        $category->category_name     = $this->category_name;
        $category->show_in_search_bar= $this->search_bar_display;
        $category->show_in_top_menu  = $this->top_menu_display;
        $category->show_in_home_page = $this->home_page_display;
        if($this->category_banner != "") {
            $category->category_banner   = $this->category_banner->store('public/category-banners');
        }
        $category->save();

        session()->flash('message', 'Category successfully added!');
        return redirect()->to('/category');
    }  

    public function delete($category_id)
    {
        $category = EcomCategory::where('id',$category_id)->first();
        if($category->category_banner != "") {
            if(File::exists('storage/'.str_replace('public/', '', $category->category_banner))) {
                File::delete('storage/'.str_replace('public/', '', $category->category_banner));
            }
        }
        EcomSubCategory::where('category_id',$category_id)->delete();
        EcomCategory::where('id',$category_id)->delete();

        session()->flash('message', 'Category successfully deleted!');
        return redirect()->to('/category');
    }

    public function update()
    {
        $category                    = EcomCategory::where('id',$this->category_id)->first();
        $category->category_name     = $this->category_name;
        $category->show_in_search_bar= $this->search_bar_display;
        $category->show_in_top_menu  = $this->top_menu_display;
        $category->show_in_home_page = $this->home_page_display;
        if($this->category_old_banner != "") {
            if(File::exists('storage/'.str_replace('public/', '', $this->category_old_banner))) {
                File::delete('storage/'.str_replace('public/', '', $this->category_old_banner));
            }
        }
        if($this->category_banner != "") {
            $category->category_banner   = $this->category_banner->store('public/category-banners');
        }
        $category->save();

        session()->flash('message', 'Category successfully updated!');
        return redirect()->to('/category');
    }

    public function render()
    {
        return view('livewire.category.index');
    }
}
