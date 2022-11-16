<?php
use App\Models\EcomCategory;
use App\Models\EcomSubCategory;

function get_category_name($category_id) {
    return EcomCategory::where('id',$category_id)->first()->category_name;
}

function get_sub_category_name($sub_category_id) {
    return EcomSubCategory::where('id',$sub_category_id)->first()->sub_category_name;
}
