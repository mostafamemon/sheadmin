<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\EcomTextContent;

class TextContent extends Component
{
    public $facebook_link           = "";
    public $youtube_link            = "";
    public $instagram_link          = "";
    public $privacy_policy          = "";
    public $terms_and_conditions    = "";
    public $cancellation_and_return = "";

    public function mount()
    {
        $contents = EcomTextContent::where('id',1)->first();
        if($contents != "") {
            $this->facebook_link                = $contents->facebook_link;
            $this->youtube_link                 = $contents->youtube_link;
            $this->instagram_link               = $contents->instagram_link;
            $this->privacy_policy               = $contents->privacy_policy;
            $this->terms_and_conditions         = $contents->terms_and_conditions;
            $this->cancellation_and_return      = $contents->cancellation_and_return;
        }
    }

    public function update()
    {
        $contents = EcomTextContent::where('id',1)->first();
        if($contents == "") {
            $contents = new EcomTextContent();
        }
        $contents->facebook_link                = $this->facebook_link;
        $contents->youtube_link                 = $this->youtube_link;
        $contents->instagram_link               = $this->instagram_link;
        $contents->privacy_policy               = $this->privacy_policy;
        $contents->terms_and_conditions         = $this->terms_and_conditions;
        $contents->cancellation_and_return      = $this->cancellation_and_return;
        $contents->save();

        session()->flash('message', 'Text contents successfully updated!');
        return redirect()->to('/text-content');
    }

    public function render()
    {
        return view('livewire.text-content');
    }
}
