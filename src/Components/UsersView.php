<?php

namespace Paksuco\UsersUI\Components;

use Livewire\Component;

class UsersView extends Component
{
    protected $listeners = ["editUser", "deleteUser"];

    public function mount()
    {
    }

    public function render()
    {
        return view("users-ui::components.users-view");
    }

    public function editUser($id)
    {
        $this->emit('showModal', 'Edit User', 'users-ui::users-form', ["id" => $id]);
    }

    public function deleteUser($id)
    {
        $this->emit('showModal', 'Delete User', 'users-ui::users-delete', ["id" => $id]);
    }
}
