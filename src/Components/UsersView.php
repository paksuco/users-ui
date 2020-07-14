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
        return view("users-ui::components.users-view", [
            "config" => [
                "model" => \App\User::class,
                "queryable" => true,
                "sortable" => true,
                "pageable" => true,
                "perPages" => [10, 25, 50, 100],
                "perPage" => 10,
                "fields" => [
                    [
                        "name" => "id",
                        "type" => "field",
                        "format" => "string",
                        "sortable" => true,
                        "queryable" => false,
                        "filterable" => false,
                    ],
                    [
                        "name" => "name",
                        "type" => "field",
                        "format" => "string",
                        "class" => "w-full bg-gray-50",
                        "sortable" => true,
                        "queryable" => true,
                        "filterable" => false,
                    ],
                    [
                        "name" => "email",
                        "type" => "field",
                        "format" => "string",
                        "sortable" => true,
                        "queryable" => true,
                        "filterable" => false,
                    ],
                    [
                        "name" => "email_verified_at",
                        "type" => "field",
                        "format" => "boolean",
                        "sortable" => true,
                        "queryable" => false,
                        "filterable" => true,
                    ],
                    [
                        "name" => "actions",
                        "type" => "callback",
                        "format" => "\Paksuco\UsersUI\Components\UsersView::actions",
                    ],
                ],
            ],
        ]);
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
