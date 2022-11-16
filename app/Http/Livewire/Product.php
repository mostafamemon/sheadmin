<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomProduct;
use App\Models\EcomCategory;
use App\Models\EcomSubCategory;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File; 

class Product extends Component
{
    use WithPagination;
    use WithFileUploads;

    protected $paginationTheme = 'bootstrap';

    public $current_page        = "index";
    public $categories          = [];
    public $products            = [];
    public $sub_categories      = [];
    public $filter_by_category  = "all";
    public $filter_by_subcategory = "all";
    public $filter_by_name      = "";
    public $filter_by           = "";

    public $category_id         = "";
    public $sub_category_id     = "";
    public $hot_product         = 0;
    public $new_arrival         = 0;
    public $top_selling         = 0;
    public $best_rated          = 0;
    public $clearense           = 0;
    public $user_rating         = 5;

    public $product_page_main_image         = "";
    public $product_page_other_image_1      = "";
    public $product_page_other_image_2      = "";
    public $product_page_other_image_3      = "";
    public $product_page_other_image_4      = "";
    public $hot_product_image               = "";

    public $product_page_main_image_old         = "";
    public $product_page_other_image_1_old      = "";
    public $product_page_other_image_2_old      = "";
    public $product_page_other_image_3_old      = "";
    public $product_page_other_image_4_old      = "";
    public $hot_product_image_old               = "";

    public $product_name        = "";
    public $short_description   = "";
    public $long_description    = "";
    public $in_stock            = 1;

    public function mount()
    {
        $this->categories       = EcomCategory::orderBy('category_name','asc')->get();
        if (isset(request()->current_page)) {
            $this->current_page     = request()->current_page;
            if($this->current_page == "update")
            {
                $this->product_id   = request()->product_id;
                $product = EcomProduct::where('id',$this->product_id)->first();
                $this->category_id         = $product->category_id;
                $this->sub_categories      = EcomSubCategory::where('category_id',$this->category_id)->get();
                $this->sub_category_id     = $product->sub_category_id;
                $this->hot_product         = $product->hot_product;
                $this->new_arrival         = $product->new_arrival;
                $this->top_selling         = $product->top_selling;
                $this->best_rated          = $product->best_rated;
                $this->clearense           = $product->clearense;
                $this->user_rating         = $product->user_rating;
                if($product->product_page_main_image != "") {
                    $this->product_page_main_image_old  = $product->product_page_main_image;
                }
                if($product->product_page_other_image_1 != "") {
                    $this->product_page_other_image_1_old  = $product->product_page_other_image_1;
                }
                if($product->product_page_other_image_2 != "") {
                    $this->product_page_other_image_2_old  = $product->product_page_other_image_2;
                }
                if($product->product_page_other_image_3 != "") {
                    $this->product_page_other_image_3_old  = $product->product_page_other_image_3;
                }
                if($product->product_page_other_image_4 != "") {
                    $this->product_page_other_image_4_old  = $product->product_page_other_image_4;
                }
                if($product->hot_product_image != "") {
                    $this->hot_product_image_old           = $product->hot_product_image;
                }

                $this->product_name        = $product->product_name;
                $this->short_description   = $product->short_description;
                $this->long_description    = $product->long_description;
                $this->in_stock            = $product->in_stock;
            }
        }
        $this->filter();
    }

    public function getSubCategory()
    {
        $this->sub_categories = EcomSubCategory::where('category_id',$this->category_id)->orderBy('sub_category_name','asc')->get();
    }

    public function getFilterSubCategory()
    {
        $this->sub_categories = EcomSubCategory::where('category_id',$this->filter_by_category)->orderBy('sub_category_name','asc')->get();
    }

    public function filter()
    {
        $products = EcomProduct::orderBy('product_name','asc');
        if($this->filter_by_name != "") {
            $products->where('product_name', 'like', '%' . $this->filter_by_name . '%');
        }
        if($this->filter_by_category != "all") {
            $products->where('category_id',$this->filter_by_category);
        }
        if($this->filter_by_subcategory != "all") {
            $products->where('sub_category_id',$this->filter_by_subcategory);
        }
        if($this->filter_by != "all") {
            if($this->filter_by == "in_stock") {
                $products->where('in_stock',1);
            }elseif($this->filter_by == "out_of_stock") {
                $products->where('in_stock',0);
            }elseif($this->filter_by == "hot_product") {
                $products->where('hot_product',1);
            }elseif($this->filter_by == "new_arrival") {
                $products->where('new_arrival',1);
            }elseif($this->filter_by == "top_selling") {
                $products->where('top_selling',1);
            }elseif($this->filter_by == "best_rated") {
                $products->where('best_rated',1);
            }elseif($this->filter_by == "clearense") {
                $products->where('clearense',1);
            }
        }
        $this->products = $products->get();
    }

    public function store()
    {
        $product                                = new EcomProduct();
        if($this->category_id != "") {
            $product->category_id                   = $this->category_id;
        }
        if($this->sub_category_id != "") {
            $product->sub_category_id               = $this->sub_category_id;
        }
        $product->hot_product                   = $this->hot_product;
        $product->new_arrival                   = $this->new_arrival;
        $product->top_selling                   = $this->top_selling;
        $product->best_rated                    = $this->best_rated;
        $product->clearense                     = $this->clearense;
        $product->user_rating                   = 5;

        if($this->product_page_main_image != "") {
            $product->product_page_main_image      = $this->product_page_main_image->store('public/product_images');
        }
        if($this->product_page_other_image_1 != "") {
            $product->product_page_other_image_1   = $this->product_page_other_image_1->store('public/product_images');
        }
        if($this->product_page_other_image_2 != "") {
            $product->product_page_other_image_2   = $this->product_page_other_image_2->store('public/product_images');
        }
        if($this->product_page_other_image_3 != "") {
            $product->product_page_other_image_3   = $this->product_page_other_image_3->store('public/product_images');
        }
        if($this->product_page_other_image_4 != "") {
            $product->product_page_other_image_4   = $this->product_page_other_image_4->store('public/product_images');
        }
        if($this->hot_product_image != "") {
            $product->hot_product_image            = $this->hot_product_image->store('public/product_images');
        }

        $product->product_name                  = $this->product_name;
        $product->short_description             = $this->short_description;
        $product->long_description              = $this->long_description;
        $product->in_stock                      = $this->in_stock;
        $product->save();

        session()->flash('message', 'Product successfully added!');
        return redirect()->to('/product');
    }  

    public function delete($product_id)
    {
        $product = EcomProduct::where('id',$product_id)->first();
        if($product->product_page_main_image != "") {
            if(File::exists('storage/'.str_replace('public/', '', $product->product_page_main_image))) {
                File::delete('storage/'.str_replace('public/', '', $product->product_page_main_image));
            }
        }
        if($product->product_page_other_image_1 != "") {
            if(File::exists('storage/'.str_replace('public/', '', $product->product_page_other_image_1))) {
                File::delete('storage/'.str_replace('public/', '', $product->product_page_other_image_1));
            }
        }if($product->product_page_other_image_2 != "") {
            if(File::exists('storage/'.str_replace('public/', '', $product->product_page_other_image_2))) {
                File::delete('storage/'.str_replace('public/', '', $product->product_page_other_image_2));
            }
        }if($product->product_page_other_image_3 != "") {
            if(File::exists('storage/'.str_replace('public/', '', $product->product_page_other_image_3))) {
                File::delete('storage/'.str_replace('public/', '', $product->product_page_other_image_3));
            }
        }if($product->product_page_other_image_4 != "") {
            if(File::exists('storage/'.str_replace('public/', '', $product->product_page_other_image_4))) {
                File::delete('storage/'.str_replace('public/', '', $product->product_page_other_image_4));
            }
        }if($product->hot_product_image != "") {
            if(File::exists('storage/'.str_replace('public/', '', $product->hot_product_image))) {
                File::delete('storage/'.str_replace('public/', '', $product->hot_product_image));
            }
        }
        EcomProduct::where('id',$product_id)->delete();

        session()->flash('message', 'Product successfully deleted!');
        return redirect()->to('/product');
    }

    public function update()
    {
        $product                                = EcomProduct::where('id',$this->product_id)->first();
        $product->category_id                   = $this->category_id;
        $product->sub_category_id               = $this->sub_category_id;
        $product->hot_product                   = $this->hot_product;
        $product->new_arrival                   = $this->new_arrival;
        $product->top_selling                   = $this->top_selling;
        $product->best_rated                    = $this->best_rated;
        $product->clearense                     = $this->clearense;

        if($this->product_page_main_image != "") {
            $product->product_page_main_image      = $this->product_page_main_image->store('public/product_images');
            if($this->product_page_main_image_old != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->product_page_main_image_old))) {
                    File::delete('storage/'.str_replace('public/', '', $this->product_page_main_image_old));
                }
            }
        }
        if($this->product_page_other_image_1 != "") {
            $product->product_page_other_image_1   = $this->product_page_other_image_1->store('public/product_images');
            if($this->product_page_other_image_1_old != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->product_page_other_image_1_old))) {
                    File::delete('storage/'.str_replace('public/', '', $this->product_page_other_image_1_old));
                }
            }
        }
        if($this->product_page_other_image_2 != "") {
            $product->product_page_other_image_2   = $this->product_page_other_image_2->store('public/product_images');
            if($this->product_page_other_image_2_old != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->product_page_other_image_2_old))) {
                    File::delete('storage/'.str_replace('public/', '', $this->product_page_other_image_2_old));
                }
            }
        }
        if($this->product_page_other_image_3 != "") {
            $product->product_page_other_image_3   = $this->product_page_other_image_3->store('public/product_images');
            if($this->product_page_other_image_3_old != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->product_page_other_image_3_old))) {
                    File::delete('storage/'.str_replace('public/', '', $this->product_page_other_image_3_old));
                }
            }
        }
        if($this->product_page_other_image_4 != "") {
            $product->product_page_other_image_4   = $this->product_page_other_image_4->store('public/product_images');
            if($this->product_page_other_image_4_old != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->product_page_other_image_4_old))) {
                    File::delete('storage/'.str_replace('public/', '', $this->product_page_other_image_4_old));
                }
            }
        }
        if($this->hot_product_image != "") {
            $product->hot_product_image            = $this->hot_product_image->store('public/product_images');
            if($this->hot_product_image_old != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->hot_product_image_old))) {
                    File::delete('storage/'.str_replace('public/', '', $this->hot_product_image_old));
                }
            }
        }

        $product->product_name                  = $this->product_name;
        $product->short_description             = $this->short_description;
        $product->long_description              = $this->long_description;
        $product->in_stock                      = $this->in_stock;
        $product->save();

        session()->flash('message', 'Product successfully updated!');
        return redirect()->to('/product');
    }

    public function render()
    {
        return view('livewire.product.index');
    }
}
