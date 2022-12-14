<?php
use App\Models\EcomCategory;
use App\Models\EcomSubCategory;
use App\Models\EcomProduct;

function get_category_name($category_id) {
    $name = EcomCategory::where('id',$category_id)->first();
    if($name != "") {
        return $name->category_name;
    } else {
        return "";
    }
}

function get_sub_category_name($sub_category_id) {
    $name = EcomSubCategory::where('id',$sub_category_id)->first();
    if($name != "") {
        return $name->sub_category_name;
    } else {
        return "";
    }
}

function get_product_name($product_id) {
    return EcomProduct::where('id',$product_id)->first()->product_name;
}
