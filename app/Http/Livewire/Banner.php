<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomBanner;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\File; 

class Banner extends Component
{
    use WithFileUploads;

    public $slider_1                    = "";
    public $slider_2                    = "";
    public $slider_3                    = "";
    public $old_slider_1                = "";
    public $old_slider_2                = "";
    public $old_slider_3                = "";

    public $right_banner_1              = "";
    public $right_banner_2              = "";
    public $right_banner_3              = "";
    public $old_right_banner_1          = "";
    public $old_right_banner_2          = "";
    public $old_right_banner_3          = "";

    public $first_triple_banner_1       = "";
    public $first_triple_banner_2       = "";
    public $first_triple_banner_3       = "";
    public $old_first_triple_banner_1   = "";
    public $old_first_triple_banner_2   = "";
    public $old_first_triple_banner_3   = "";

    public $second_triple_banner_1      = "";
    public $second_triple_banner_2      = "";
    public $second_triple_banner_3      = "";
    public $old_second_triple_banner_1  = "";
    public $old_second_triple_banner_2  = "";
    public $old_second_triple_banner_3  = "";

    public function mount()
    {
        $banners = EcomBanner::where('id',1)->first();
        if($banners != "") {
            $this->slider_1                     = "";
            $this->slider_2                     = "";
            $this->slider_3                     = "";
            $this->old_slider_1                 = $banners->slider_1;
            $this->old_slider_2                 = $banners->slider_2;
            $this->old_slider_3                 = $banners->slider_3;

            $this->right_banner_1               = "";
            $this->right_banner_2               = "";
            $this->right_banner_3               = "";
            $this->old_right_banner_1           = $banners->right_banner_1;
            $this->old_right_banner_2           = $banners->right_banner_2;
            $this->old_right_banner_3           = $banners->right_banner_3;

            $this->first_triple_banner_1        = "";
            $this->first_triple_banner_2        = "";
            $this->first_triple_banner_3        = "";
            $this->old_first_triple_banner_1    = $banners->first_triple_banner_1;
            $this->old_first_triple_banner_2    = $banners->first_triple_banner_2;
            $this->old_first_triple_banner_3    = $banners->first_triple_banner_3;

            $this->second_triple_banner_1       = "";
            $this->second_triple_banner_2       = "";
            $this->second_triple_banner_3       = "";
            $this->old_second_triple_banner_1   = $banners->second_triple_banner_1;
            $this->old_second_triple_banner_2   = $banners->second_triple_banner_2;
            $this->old_second_triple_banner_3   = $banners->second_triple_banner_3;
        }
    }

    public function update()
    {
        $banners = EcomBanner::where('id',1)->first();
        if($banners == "") {
            $banners = new EcomBanner();
        }
        if($this->slider_1 != "") {
            $banners->slider_1  = $this->slider_1->store('public/banners');
            if($this->old_slider_1 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_slider_1))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_slider_1));
                }
            }
        }
        if($this->slider_2 != "") {
            $banners->slider_2  = $this->slider_2->store('public/banners');
            if($this->old_slider_2 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_slider_2))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_slider_2));
                }
            }
        }
        if($this->slider_3 != "") {
            $banners->slider_3  = $this->slider_3->store('public/banners');
            if($this->old_slider_3 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_slider_3))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_slider_3));
                }
            }
        }

        if($this->right_banner_1 != "") {
            $banners->right_banner_1  = $this->right_banner_1->store('public/banners');
            if($this->old_right_banner_1 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_right_banner_1))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_right_banner_1));
                }
            }
        }

        if($this->right_banner_2 != "") {
            $banners->right_banner_2  = $this->right_banner_2->store('public/banners');
            if($this->old_right_banner_2 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_right_banner_2))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_right_banner_2));
                }
            }
        }

        if($this->right_banner_3 != "") {
            $banners->right_banner_3  = $this->right_banner_3->store('public/banners');
            if($this->old_right_banner_3 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_right_banner_3))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_right_banner_3));
                }
            }
        }


        if($this->first_triple_banner_1 != "") {
            $banners->first_triple_banner_1  = $this->first_triple_banner_1->store('public/banners');
            if($this->old_first_triple_banner_1 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_first_triple_banner_1))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_first_triple_banner_1));
                }
            }
        }
        if($this->first_triple_banner_2 != "") {
            $banners->first_triple_banner_2  = $this->first_triple_banner_2->store('public/banners');
            if($this->old_first_triple_banner_2 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_first_triple_banner_2))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_first_triple_banner_2));
                }
            }
        }
        if($this->first_triple_banner_3 != "") {
            $banners->first_triple_banner_3  = $this->first_triple_banner_3->store('public/banners');
            if($this->old_first_triple_banner_3 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_first_triple_banner_3))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_first_triple_banner_3));
                }
            }
        }


        if($this->second_triple_banner_1 != "") {
            $banners->second_triple_banner_1  = $this->second_triple_banner_1->store('public/banners');
            if($this->old_second_triple_banner_1 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_second_triple_banner_1))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_second_triple_banner_1));
                }
            }
        }
        if($this->second_triple_banner_2 != "") {
            $banners->second_triple_banner_2  = $this->second_triple_banner_2->store('public/banners');
            if($this->old_second_triple_banner_2 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_second_triple_banner_2))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_second_triple_banner_2));
                }
            }
        }
        if($this->second_triple_banner_3 != "") {
            $banners->second_triple_banner_3  = $this->second_triple_banner_3->store('public/banners');
            if($this->old_second_triple_banner_3 != "") {
                if(File::exists('storage/'.str_replace('public/', '', $this->old_second_triple_banner_3))) {
                    File::delete('storage/'.str_replace('public/', '', $this->old_second_triple_banner_3));
                }
            }
        }
        $banners->save();
        session()->flash('message', 'Product successfully added!');
        return redirect()->to('/banner');
    }

    public function render()
    {
        return view('livewire.banner');
    }
}
