<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ActivateRrss extends Component
{
    public $name;
    public $active;
    public $social_id;
    public $icon;
    public $url;

    public function mount($social)
    {

        $this->name = $social->name;
        $this->url = $social->url;
        $this->active = $social->active ==1? 1:0;
        $this->social_id = $social->id;
        $this->icon = $social->icon;
    }
    public function delete(){
        unlink(storage_path("app/public/logos/".$this->social->icon));
        DB::table('social_links')->where('id',$this->social_id)->delete();

    }

    public function switchActive()
    {

        $state= $this->active ? 1:0;

        DB::table('social_links')->where('id',$this->social_id)->update(['active'=>$state]);

    }


    public function render()
    {
        return view('livewire.activate-rrss');
    }
}
