<?php
use App\Models\InventoryCategory;
use App\Models\InventorySetting;
use App\Models\InventoryProduct;
use App\Models\InventoryCompany;
use App\Models\InventoryCustomer;
use App\Models\InventoryCustomerTransaction;
use App\Models\InventorySupplier;
use App\Models\InventorySupplierTransaction;
use App\Models\InventorySMSSetting;
use App\Models\InventoryExpense;
use App\Models\InventorySaleDetails;
use Illuminate\Support\Facades\Cache;

function getCategoryName($category_id) {
    $name = "";
    $category = InventoryCategory::where('id',$category_id)->first();
    if($category == "") {
        return "Unknown";
    }else {
        if($category->parent_id != 0) {
            $parent = InventoryCategory::where('id',$category->parent_id)->first();
            $name   = $name.$parent->category_name.' -> ';
        }
        return $name.$category->category_name;
    }
}

function getCategories(){
    if (!Cache::has('categories_'.auth()->user()->company_id)) {
        $result = [];
        $categories = InventoryCategory::where('company_id',auth()->user()->company_id)->where('parent_id',0)->orderBy('category_name','asc')->get();

        $key = 0;

        foreach($categories as $category) {
            $has_sub    = InventoryCategory::where('parent_id',$category->id)->count();
            if($has_sub == 0) {
                $result[$key]['category_id']    = $category->id;
                $result[$key]['parent_name']    = "";
                $result[$key]['category_name']  = $category->category_name;
                $result[$key]['vat_percentage'] = $category->vat_percentage;
                $result[$key]['sub_category']   = [];
                $key++;
            }

        }

        foreach($categories as $category) {
            $subs    = InventoryCategory::where('parent_id',$category->id)->orderBy('category_name','asc')->get();
            if(count($subs) > 0) {
                $result[$key]['category_id']    = $category->id;
                $result[$key]['parent_name']    = "";
                $result[$key]['category_name']  = $category->category_name;
                $result[$key]['vat_percentage'] = $category->vat_percentage;

                $sub_ctg    = [];
                $sub_key    = 0;
                foreach($subs as $sub_category) {
                    $sub_ctg[$sub_key]['category_id']    = $sub_category->id;
                    $sub_ctg[$sub_key]['parent_name']    = $category->category_name;
                    $sub_ctg[$sub_key]['category_name']  = $sub_category->category_name;
                    $sub_ctg[$sub_key]['vat_percentage'] = $category->vat_percentage;
                    $sub_key++;
                }
                $result[$key]['sub_category']            = $sub_ctg;
                $result[$key]['total_sub']               = count($sub_ctg);

                $key++;
            }
        }

        Cache::put('categories_'.auth()->user()->company_id,$result);
        return $result;
    }
    else{
        return Cache::get('categories_'.auth()->user()->company_id);
    }
}

function getSettings() {
    if (!Cache::has('settings_'.auth()->user()->company_id)) {
        $settings = InventorySetting::where('company_id',auth()->user()->company_id)->first();
        Cache::put('settings_'.auth()->user()->company_id,$settings);
        return $settings;
    } else {
        return Cache::get('settings_'.auth()->user()->company_id);
    }
}

function getProducts() {
    if (!Cache::has('products_'.auth()->user()->company_id)) {
        $products = InventoryProduct::where('company_id',auth()->user()->company_id)->orderBy('product_name','asc')->get();
        Cache::put('products_'.auth()->user()->company_id,$products);
        return $products;
    } else {
        return Cache::get('products_'.auth()->user()->company_id);
    }
}

function getCompany() {
    if (!Cache::has('company_'.auth()->user()->company_id)) {
        $company = InventoryCompany::where('id',auth()->user()->company_id)->first();
        Cache::put('company_'.auth()->user()->company_id,$company);
        return $company;
    } else {
        return Cache::get('company_'.auth()->user()->company_id);
    }
}

function getCustomers() {
    if (!Cache::has('customers_'.auth()->user()->company_id)) {
        $customers = InventoryCustomer::where('company_id',auth()->user()->company_id)->orderBy('name','asc')->get();
        Cache::put('customers_'.auth()->user()->company_id,$customers);
        return $customers;
    } else {
        return Cache::get('customers_'.auth()->user()->company_id);
    }
}

function getSuppliers() {
    if (!Cache::has('suppliers_'.auth()->user()->company_id)) {
        $suppliers = InventorySupplier::where('company_id',auth()->user()->company_id)->orderBy('name','asc')->get();
        Cache::put('suppliers_'.auth()->user()->company_id,$suppliers);
        return $suppliers;
    } else {
        return Cache::get('suppliers_'.auth()->user()->company_id);
    }
}

function getPendingPurchase() {
    if (!Cache::has('purchase_user_'.auth()->user()->id) || Cache::get('purchase_user_'.auth()->user()->id) == "" || Cache::get('purchase_user_'.auth()->user()->id) == []) {
        return [];
    } else {
        return Cache::get('purchase_user_'.auth()->user()->id);
    }
}

function getPendingSales() {
    if (!Cache::has('sales_user_'.auth()->user()->id) || Cache::get('sales_user_'.auth()->user()->id) == "" || Cache::get('sales_user_'.auth()->user()->id) == []) {
        return [];
    } else {
        return Cache::get('sales_user_'.auth()->user()->id);
    }
}

function isFileExists($file) {
    return \Storage::exists($file);
}

function get_last_transaction($customer_id) {
    $last_transaction = InventoryCustomerTransaction::where('customer_id',$customer_id)->orderBy('id','desc')->first();
    return $last_transaction->total_transaction_amount.'_'.$last_transaction->current_dues.'_'.$last_transaction->current_advance;
}

function get_supplier_last_transaction($supplier_id) {
    $last_transaction = InventorySupplierTransaction::where('supplier_id',$supplier_id)->orderBy('id','desc')->first();
    return $last_transaction->total_transaction_amount.'_'.$last_transaction->current_dues.'_'.$last_transaction->current_advance;
}

function get_current_sms_balance($company_id) {
    $sms_settings = InventorySMSSetting::where('company_id',$company_id)->first();
    if($sms_settings == "") {
        return "SMS Balance: 0";
    }

    if($sms_settings->sms_provider == "MIM SMS") {
        $api_key = $sms_settings->parameter_1_value;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://esms.mimsms.com/miscapi/".$api_key."/getBalance");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $curl_exec = curl_exec($curl);
        curl_close($curl);
        return $curl_exec;
    }else {
        return "Unknown";
    }
}

function getMyURL() {
    $protocol = (!empty($_SERVER['HTTPS']) && (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1')) ? 'https://' : 'http://';
    $server = $_SERVER['SERVER_NAME'];
    $port = $_SERVER['SERVER_PORT'] ? ':'.$_SERVER['SERVER_PORT'] : '';
    return $protocol.$server.$port;
}

function getDatesFromRange($a,$b,$x=0,$dates=[]){
    while(end($dates) != date("Y-m-d",strtotime($b))){
        $x = array_push($dates, date("Y-m-d", strtotime("$a + $x day")));
    }
    return $dates;
}

function calculateSalesVAT() {
    $settings = getSettings();
    if($settings->vat_calculation == "CATEGORY_BASED") {
        $vat = array_sum(array_column(getPendingSales(),'vat'));
    }elseif($settings->vat_calculation == "NET_PAYABLE") {
        $total_amount = array_sum(array_column(getPendingSales(),'total'));
        $vat = ($settings->vat_percentage_on_net_payable/100) * $total_amount;
    }else {
        $vat = 0;
    }
    return $vat;
}

function getExpense($from_date,$to_date) {
    $date1 = date_create($from_date);
    $date2 = date_create($to_date);
    $diff  = date_diff($date1,$date2);

    if($diff->days > 31) {
        return 0;
    }

    $from_date  = date('Y-m-d',strtotime($from_date));
    $to_date    = date('Y-m-d',strtotime($to_date));
    return $expense = InventoryExpense::whereBetween('date', [$from_date, $to_date.' 23:59:59'])->sum('amount');
}

function getSaleDetail($sales_id) {
    return InventorySaleDetails::where('sales_id',$sales_id)->get();
}

function getCustomerLastTrx($customer_id) {
    return InventoryCustomerTransaction::where('customer_id',$customer_id)->orderBy('id','desc')->first();
}
