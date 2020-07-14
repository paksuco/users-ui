<?php

namespace Paksuco\UsersUI\Components;

use Livewire\Component;

class UsersDelete extends Component
{
    public $args;
    public $user;

    public function mount($args)
    {
        $this->args = $args;
        if($args["id"])
        {
            $this->user = \App\User::find($args["id"]);
        }
    }

    public function render()
    {
        return view("users-ui::components.users-delete");
    }
}
