<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Participant;
use App\Models\Webinar;

class Stream extends Component
{
    public $name = '';
    public $phone = '';
    public $registered = false;
    public $webinarId;

    public function mount($webinar_id)
    {
        $this->webinarId = $webinar_id;
        $cookieKey = 'webinar_user_' . $this->webinarId;
        $this->registered = request()->cookie($cookieKey) === '1';    }

    public function register()
    {
        $this->validate([
            'name' => 'required|min:2',
            'phone' => 'required|min:5',
        ]);

        $webinar = Webinar::where('uuid', $this->webinarId)->first();
        Participant::create([
            'name' => $this->name,
            'phone' => $this->phone,
            'webinar_id' => $webinar->id,
        ]);

        $cookieKey = 'webinar_user_' . $this->webinarId;
        cookie()->queue(cookie($cookieKey, '1', 60 * 24 * 1));

        $this->registered = true;
    }

    public function render()
    {
        return view('livewire.stream')->layout('index');
    }
}
