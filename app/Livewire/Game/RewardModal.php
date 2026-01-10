<?php

namespace App\Livewire\Game;

use App\Models\Reward;
use Livewire\Component;
use Livewire\Attributes\On;

class RewardModal extends Component
{
    public $show = false;
    public $reward = null;

    #[On('show-reward')]
    public function showReward($rewardCode)
    {
        $this->reward = Reward::where('code', $rewardCode)->first();
        if ($this->reward) {
            $this->show = true;
        }
    }

    public function close()
    {
        $this->show = false;
        $this->reward = null;
    }

    public function render()
    {
        return view('livewire.game.reward-modal');
    }
}
