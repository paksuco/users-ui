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

    public static function actions($row)
    {
        return "<button class='mr-1 rounded px-3 py-1 bg-blue-700 text-white shadow' wire:click='\$emit(\"editUser\"," . $row->id . ")'>" . __("Edit") . "</button>" .
        "<button class='rounded px-3 py-1 bg-red-700 text-white shadow' wire:click='\$emit(\"deleteUser\"," . $row->id . ")'>" . __("Delete") . "</button>";
    }
}
