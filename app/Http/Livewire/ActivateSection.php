<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ActivateSection extends Component
{
    public $name;
    public $active;
    public $section_id;

    public function mount($section)
    {

        $this->name = $section->name;
        $this->active = $section->active ==1? 1:0;


        $this->section_id = $section->id;
    }

    public function switchActive()
    {

        $state= $this->active ? 1:0;

        DB::table('pages_content')->where('id',$this->section_id)->update(['active'=>$state]);

    }

    public function render()
    {
        return view('livewire.activate-section');
    }
}
