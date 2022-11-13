<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\InventoryProduct;
use App\Models\InventoryCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\WithPagination;

class Product extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $current_page        = "index";
    public $pre_page            = "add";
    public $product_id          = "";
    public $max_row             = 10;
    public $inputs              = [];
    public $i                   = 1;

    public $category_id         = "";
    public $product_name        = "";
    public $quantity            = "";
    public $unit                = [];
    public $update_page_unit    = "";
    public $purchase_price      = "";
    public $sale_price          = "";
    public $barcode             = "";
    public $warn_at             = "";

    public $categories          = [];
    public $parent_categories   = [];
    public $parent_id           = 0;
    public $category_name       = "";
    public $vat_percentage      = 0;

    public $filter_category     = "all";
    public $filter_barcode      = "";
    public $filter_name         = "";

    public $bulk_update_products = "";
    public $bulk_update_quantity = "";
    public $bulk_update_purchase = "";
    public $bulk_update_sale     = "";

    public function mount()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        if (isset(request()->current_page)) {
            $this->current_page = request()->current_page;

            if(request()->product_id != "") {
                $this->product_id          = request()->product_id;
            } else $this->product_id = "";

            $this->pre_page = request()->pre_page;

            if(request()->current_page == "update" && $this->product_id != "") {
                $cache_products            = getProducts();
                $product_info              = $cache_products->where('id',$this->product_id)->first();
                $this->category_id         = $product_info->category_id;
                $this->product_name        = $product_info->product_name;
                $this->quantity            = $product_info->quantity;
                $this->update_page_unit    = $product_info->unit;
                $this->purchase_price      = $product_info->purchase_price;
                $this->sale_price          = $product_info->sale_price;
                $this->barcode             = $product_info->barcode;
                $this->warn_at             = $product_info->warn_at;
            }
        }
        $this->unit[0] = "pcs";
        $this->categories = getCategories();
        $this->parent_categories = InventoryCategory::where('company_id',auth()->user()->company_id)->where('parent_id',0)->orderBy('parent_id','asc')->orderBy('category_name','asc')->get();
    }

    public function addCategory()
    {
        if(!in_array(config('app.roles')['product_add'], json_decode(auth()->user()->roles))) {
            return redirect('/404');
        }

        $this->validate([
            'category_name'          => 'required|max:255',
            'vat_percentage'         => 'numeric'
        ]);

        if($this->parent_id == 0) {
            $count = InventoryCategory::where('company_id',auth()->user()->company_id)->where('category_name',$this->category_name)->where('parent_id',0)->count();
        }else {
            $count = InventoryCategory::where('company_id',auth()->user()->company_id)->where('parent_id',$this->parent_id)->where('category_name',$this->category_name)->count();
        }

        if($count > 0) {
            $this->addError('category_name','name must be unique');
            return;
        }

        $category = new InventoryCategory();
        $category->company_id        = auth()->user()->company_id;
        $category->parent_id         = $this->parent_id;
        $category->category_name     = $this->category_name;
        if($this->parent_id == 0) {
            if($this->vat_percentage != "") $category->vat_percentage    = $this->vat_percentage;
        }else{
            $this->vat_percentage    = InventoryCategory::where('id',$this->parent_id)->first()->vat_percentage;
        }
        $category->vat_percentage    = $this->vat_percentage;
        $category->save();

        $this->parent_id = 0;
        $this->category_name = "";
        $this->vat_percentage = "";

        Cache::forget('categories_'.auth()->user()->company_id);
        $this->categories = getCategories();
        $this->parent_categories = InventoryCategory::where('company_id',auth()->user()->company_id)->where('parent_id',0)->orderBy('parent_id','asc')->orderBy('category_name','asc')->get();

        session()->flash('message', 'Category successfully created!');
        return;
    }

    public function deleteCategory($category_id)
    {
        if(!in_array(config('app.roles')['product_add'], json_decode(auth()->user()->roles))) {
            return redirect('/404');
        }

        $category = InventoryCategory::find($category_id);

        if($category->parent_id == 0) {
            InventoryCategory::where('parent_id',$category_id)->delete();
        }
        $category->delete();

        Cache::forget('categories_'.auth()->user()->company_id);
        $this->categories = getCategories();
        $this->parent_categories = InventoryCategory::where('company_id',auth()->user()->company_id)->where('parent_id',0)->orderBy('parent_id','asc')->orderBy('category_name','asc')->get();

        return redirect()->to('/product/category');
    }

    public function addRow()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $i = $this->i + 1;
        $this->i = $i;
        array_push($this->inputs ,$i);
        $this->unit[$i] = "pcs";
    }

    public function removeRow($i)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        unset($this->inputs[$i]);
        $i = $this->i - 1;
        $this->i = $i;
    }

    function generate_barcode() {
        A:
        $charset = "0123456789";
        $letters = str_split($charset);
        $code = '';
        for ($i = 0; $i <= 12; $i++) {
            $code .= $letters[rand(0, count($letters)-1)];
        };
        $cache_products = getProducts();
        $count = $cache_products->where('company_id', auth()->user()->company_id)->where('barcode',$code)->count();
        if ($count > 0) { goto A; }
        else return $code;
    }

    public function input_validation()
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $error = 0;
        $settings = getSettings();
        $products = getProducts();

        // PRODUCT NAME VALIDATION
        if($this->inputs == []) {
            if($this->product_name == "") {
                $this->addError('product_name.0','name is required');
                $error++;
            }
            if(isset($this->product_name[0]) && $this->product_name[0] == "") {
                $this->addError('product_name.0','name is required');
                $error++;
            }
            if(isset($this->product_name[0]) && $this->product_name[0] != "") {
                $count = $products->where('product_name',$this->product_name[0])->count();
                if($count > 0) {
                    $this->addError('product_name.0','name should be unique');
                    $error++;
                }
                $length = strlen($this->product_name[0]);
                if($length > 255) {
                    $this->addError('product_name.0','name is too long');
                    $error++;
                }
            }
        }
        else{
            if(!isset($this->product_name[0])) {
                $this->addError('product_name.0','name is required');
                $error++;
            }
            if(isset($this->product_name[0]) && $this->product_name[0] == "") {
                $this->addError('product_name.0','name is required');
                $error++;
            }
            if(isset($this->product_name[0]) && $this->product_name[0] != "") {
                $count = $products->where('product_name',$this->product_name[0])->count();
                if($count > 0) {
                    $this->addError('product_name.0','name should be unique');
                    $error++;
                }
                $length = strlen($this->product_name[0]);
                if($length > 255) {
                    $this->addError('product_name.0','name is too long');
                    $error++;
                }
            }

            foreach($this->inputs as $key => $value) {
                if(!isset($this->product_name[$value])) {
                    $this->addError('product_name.'.$value,'name is required');
                    $error++;
                }
                if(isset($this->product_name[$value]) && $this->product_name[$value] == "") {
                    $this->addError('product_name.'.$value,'name is required');
                    $error++;
                }
                if(isset($this->product_name[$value]) && $this->product_name[$value] != "") {
                    $count = $products->where('product_name',$this->product_name[$value])->count();
                    if($count > 0) {
                        $this->addError('product_name.'.$value,'name should be unique');
                        $error++;
                    }
                    $length = strlen($this->product_name[$value]);
                    if($length > 255) {
                        $this->addError('product_name.'.$value,'name is too long');
                        $error++;
                    }
                }
            }
        }

        // QUANTITY VALIDATION
        if(!isset($this->quantity[0])) {
            $this->addError('quantity.0','stock value is required');
            $error++;
        } else {
            if($this->quantity[0] == "") {
                $this->addError('quantity.0','stock value is required');
                $error++;
            }

            if($this->quantity[0] != "") {
                if (!is_numeric($this->quantity[0])) {
                    $this->addError('quantity.0','value should be numeric');
                    $error++;
                }
            }
        }

        foreach($this->inputs as $key => $value) {
            if(!isset($this->quantity[$value])) {
                $this->addError('quantity.'.$value,'stock value is required');
                $error++;
            } else {
                if($this->quantity[$value] == "") {
                    $this->addError('quantity.'.$value,'stock value is required');
                    $error++;
                }

                if (!is_numeric($this->quantity[$value])) {
                    $this->addError('quantity.'.$value,'value should be numeric');
                    $error++;
                }
            }
        }

        // PURCHASE PRICE VALIDATION
        if($settings->profit_calculation == 1) {
            if(!isset($this->purchase_price[0]) || $this->purchase_price[0] == "") {
                $this->addError('purchase_price.0','buy price required');
                $error++;
            }
        }
        if(isset($this->purchase_price[0])) {
            if (!is_numeric($this->purchase_price[0]) && $this->purchase_price[0] != "") {
                $this->addError('purchase_price.0','value should be numeric');
                $error++;
            }
        }

        foreach($this->inputs as $key => $value) {
            if($settings->profit_calculation == 1) {
                if(!isset($this->purchase_price[$value]) || $this->purchase_price[$value] == "") {
                    $this->addError('purchase_price.'.$value,'buy price required');
                    $error++;
                }
            }

            if(isset($this->purchase_price[$value]) && $this->purchase_price[$value] != "") {
                if (!is_numeric($this->purchase_price[$value])) {
                    $this->addError('purchase_price.'.$value,'value should be numeric');
                    $error++;
                }
            }
        }

        // SALE PRICE VALIDATION
        if($settings->pre_defind_sale_price == 1) {
            if(!isset($this->sale_price[0]) || $this->sale_price[0] == "") {
                $this->addError('sale_price.0','sale price required');
                $error++;
            }
        }
        if(isset($this->sale_price[0])) {
            if (!is_numeric($this->sale_price[0]) && $this->sale_price[0] != "") {
                $this->addError('sale_price.0','value should be numeric');
                $error++;
            }
        }

        foreach($this->inputs as $key => $value) {
            if($settings->pre_defind_sale_price == 1) {
                if(!isset($this->sale_price[$value]) || $this->sale_price[$value] == "") {
                    $this->addError('sale_price.'.$value,'sale price required');
                    $error++;
                }
            }
            if(isset($this->sale_price[$value]) && $this->sale_price[$value] != "") {
                if (!is_numeric($this->sale_price[$value])) {
                    $this->addError('sale_price.'.$value,'value should be numeric');
                    $error++;
                }
            }
        }

        // BARCODE
        if(isset($this->barcode[0])) {
            if (!is_numeric($this->barcode[0]) && $this->barcode[0] != "") {
                $this->addError('barcode.0','numeric only');
                $error++;
            }
        }

        foreach($this->inputs as $key => $value) {
            if(isset($this->barcode[$value]) && $this->barcode[$value] != "") {
                if (!is_numeric($this->barcode[$value])) {
                    $this->addError('barcode.'.$value,'numeric only');
                    $error++;
                }
            }
        }

        // WARN AT
        if(isset($this->warn_at[0])) {
            if (!is_numeric($this->warn_at[0]) && $this->warn_at[0] != "") {
                $this->addError('warn_at.0','numeric only');
                $error++;
            }
        }

        foreach($this->inputs as $key => $value) {
            if(isset($this->warn_at[$value]) && $this->warn_at[$value] != "") {
                if (!is_numeric($this->warn_at[$value])) {
                    $this->addError('warn_at.'.$value,'numeric only');
                    $error++;
                }
            }
        }

        if($error > 0) return $error;
        else return 0;
    }

    public function store()
    {
        if(!in_array(config('app.roles')['product_add'], json_decode(auth()->user()->roles))) {
            return redirect('/404');
        }

        $validation_error = $this->input_validation();
        if($validation_error > 0) return;

        $settings = getSettings();

        $array_of_names = [];

        foreach ($this->product_name as $key => $value) {
            if(in_array($this->product_name[$key], $array_of_names)) continue;

            $product = new InventoryProduct();
            $product->company_id        = auth()->user()->company_id;
            if(isset($this->category_id[$key]) && $this->category_id[$key] != "") $product->category_id = $this->category_id[$key];
            $product->product_name      = $this->product_name[$key];
            $product->quantity          = $this->quantity[$key];
            $product->unit              = $this->unit[$key];

            if(isset($this->purchase_price[$key]) && $this->purchase_price[$key] != "") $product->purchase_price = $this->purchase_price[$key];
            if(isset($this->sale_price[$key]) && $this->sale_price[$key] != "") $product->sale_price = $this->sale_price[$key];

            if(isset($this->barcode[$key]) && $this->barcode[$key] != "") {
                $product->barcode       = $this->barcode[$key];
            }else { $product->barcode   = $this->generate_barcode(); }

            if(isset($this->warn_at[$key]) && $this->warn_at[$key] != "") {
                $product->warn_at       = $this->warn_at[$key];
            }else { $product->warn_at   = $settings->default_warn_at; }

            $product->save();

            $array_of_names[] = $product->product_name;
        }

        $products = InventoryProduct::where('company_id',auth()->user()->company_id)->orderBy('product_name','asc')->get();
        Cache::put('products_'.auth()->user()->company_id,$products);

        session()->flash('message', 'Product successfully added!');

        return redirect()->to('/product');
    }

    public function update()
    {
        if(!in_array(config('app.roles')['product_update'], json_decode(auth()->user()->roles))) {
            return redirect('/404');
        }

        $settings = getSettings();

        $this->validate([
            'product_name'     => 'required|max:255',
            'quantity'         => 'required|numeric',
            'purchase_price'   => 'numeric',
            'sale_price'       => 'numeric',
            'barcode'          => 'numeric',
            'warn_at'          => 'numeric'
        ]);

        if($settings->profit_calculation == 1) {
            $this->validate([
                'purchase_price' => 'required|numeric'
            ]);
        }

        if($settings->pre_defind_sale_price == 1) {
            $this->validate([
                'sale_price' => 'required|numeric'
            ]);
        }

        $cache_products            = getProducts();
        $name_count = $cache_products->where('product_name',$this->product_name)
                        ->where('id','!=',$this->product_id)
                        ->count();
        if($name_count > 0) {
            $this->addError('product_name','name must be unique');
            return;
        }

        if($this->barcode != "") {
            $barcode_count = $cache_products->where('barcode',$this->barcode)
                                ->where('id','!=',$this->product_id)
                                ->count();
            if($barcode_count > 0) {
                $this->addError('barcode','barcode must be unique');
                return;
            }
        }

        $product = $cache_products->where('id',$this->product_id)->first();
        $product->category_id         = $this->category_id;
        $product->product_name        = $this->product_name;
        $product->quantity            = $this->quantity;
        $product->unit                = $this->update_page_unit;
        $product->purchase_price      = $this->purchase_price;
        $product->sale_price          = $this->sale_price;

        if($this->barcode != "") {
            $product->barcode         = $this->barcode;
        }else{
            $product->barcode         = $this->generate_barcode();
        }

        if($this->warn_at != "") {
            $product->warn_at         = $this->warn_at;
        }else{
            $product->warn_at         = $settings->default_warn_at;
        }
        $product->save();

        $products = InventoryProduct::where('company_id',auth()->user()->company_id)->orderBy('product_name','asc')->get();
        Cache::put('products_'.auth()->user()->company_id,$products);

        session()->flash('message', 'Product successfully updated!');

        return redirect()->to('/product?page='.$this->pre_page);
    }

    public function delete($product_id,$pre_page)
    {
        if(!in_array(config('app.roles')['product_delete'], json_decode(auth()->user()->roles))) {
            return redirect('/404');
        }

        InventoryProduct::where('id',$product_id)->delete();

        $products = InventoryProduct::where('company_id',auth()->user()->company_id)->orderBy('product_name','asc')->get();
        Cache::put('products_'.auth()->user()->company_id,$products);

        session()->flash('message', 'Product successfully deleted!');
        return redirect()->to('/product?page='.$pre_page);
    }

    public function bulk_update()
    {
        if(!in_array(config('app.roles')['product_update'], json_decode(auth()->user()->roles))) {
            return redirect('/404');
        }

        foreach($this->bulk_update_products as $row) {

            $need_to_update = 0; $update_array = [];

            if(isset($this->bulk_update_quantity[$row->id]) && $this->bulk_update_quantity[$row->id] != "" && is_numeric($this->bulk_update_quantity[$row->id])) {
                $need_to_update                          = $need_to_update + 1;
                $update_array[0]['quantity']             = $this->bulk_update_quantity[$row->id];
            }

            if(isset($this->bulk_update_purchase[$row->id]) && $this->bulk_update_purchase[$row->id] != "" && is_numeric($this->bulk_update_purchase[$row->id])) {
                $need_to_update                          = $need_to_update + 1;
                $update_array[0]['purchase_price']       = $this->bulk_update_purchase[$row->id];
            }

            if(isset($this->bulk_update_sale[$row->id]) && $this->bulk_update_sale[$row->id] != "" && is_numeric($this->bulk_update_sale[$row->id])) {
                $need_to_update                          = $need_to_update + 1;
                $update_array[0]['sale_price']           = $this->bulk_update_sale[$row->id];
            }

            if($need_to_update > 0) {
                $updateProduct = InventoryProduct::where('id',$row->id)->update($update_array[0]);
            }
        }

        $products = InventoryProduct::where('company_id',auth()->user()->company_id)->orderBy('product_name','asc')->get();
        Cache::put('products_'.auth()->user()->company_id,$products);

        session()->flash('message', 'Products successfully updated!');
        return redirect()->to('product/bulk-update');
    }

    public function render()
    {
        if(in_array(config('app.roles')['product_read'], json_decode(auth()->user()->roles))) {
            $settings = getSettings();
            $products = InventoryProduct::where('company_id',auth()->user()->company_id);

            if($this->filter_category != "all")  { $products = $products->where('category_id',$this->filter_category); }
            if($this->filter_barcode != "")   { $products = $products->where('barcode',$this->filter_barcode); }
            if($this->filter_name != "")      { $products = $products->where('product_name', 'LIKE', '%'.$this->filter_name.'%'); }

            if($this->filter_category != "all" || $this->filter_barcode != "" || $this->filter_name != "") {
                $products = $products->orderby('product_name','asc')->get();
            } else {
                $products = $products->orderby('product_name','asc')->paginate('10');
            }

            if($this->current_page == "bulk-update") {
                $this->bulk_update_products = InventoryProduct::where('company_id',auth()->user()->company_id);
                if($this->filter_category != "all")  { $this->bulk_update_products = $this->bulk_update_products->where('category_id',$this->filter_category); }
                $this->bulk_update_products = $this->bulk_update_products->orderby('product_name','asc')->get();
            }

            return view('livewire.user.product.index',compact('products','settings'));
        }
        else {
            return view('404');
        }
    }
}
