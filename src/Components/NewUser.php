<?php

namespace Paksuco\UsersUI\Components;

use Livewire\Component;

class NewUser extends Component
{
    public $args;

    public function mount($args = [])
    {
        $this->args = $args;
    }

    public function render()
    {
        return view("users-ui::components.new-user");
    }
}
