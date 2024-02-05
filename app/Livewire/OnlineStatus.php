<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Cache;

class OnlineStatus extends Component
{
    public $userId;

    public function mount($userId)
    {
        $this->userId = $userId;
    }

    public function render()
    {
        $isOnline = Cache::has('user-is-online-' . $this->userId);

        return view('livewire.online-status', ['isOnline' => $isOnline]);
    }
}
