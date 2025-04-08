<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Participant;
use App\Models\Webinar;
use App\Enums\StatusEnum;

class Stream extends Component
{
    public $name = '';
    public $phone = '';
    public $registered = false;
    public $webinarId;
    public $isLive = false;

    // Video info
    public $video_uuid = '';
    public $video_name = '';

    public function mount($webinar_id)
    {
        $this->webinarId = $webinar_id;
        $cookieKey = 'webinar_user_' . $this->webinarId;
        $this->registered = request()->cookie($cookieKey) === '1';

        $webinar = Webinar::where('uuid', $this->webinarId)->first();
        $file = $webinar->attachment('webinarVideo')->first();
        $this->video_uuid = $file->name;
        $this->video_name = $webinar->title;

        $this->checkStreamStatus();

    }

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

    public function checkStreamStatus()
    {
        $webinar = Webinar::where('uuid', $this->webinarId)->first();

        if ($webinar) {
            $this->isLive = true;
        } else {
            $this->isLive = false;
        }
    }
}
