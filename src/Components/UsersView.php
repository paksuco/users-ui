<?php

namespace Paksuco\UsersUI\Components;

use Livewire\Component;

class UsersView extends Component
{
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
                "perPage" => 50,
                "fields" => [
                    [
                        "name" => "name",
                        "type" => "field",
                        "format" => "string",
                        "sortable" => true,
                        "queryable" => true,
                        "filterable" => false,
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

    public static function actions($row)
    {
        return "<button>" . $row->name . "</button>";
    }
}
