<?php

namespace Paksuco\UsersUI\Tables;

class UserTable extends \Paksuco\Table\Contracts\TableSettings
{
    public $model = \App\User::class;
    public $queryable = true;
    public $sortable = true;
    public $pageable = true;
    public $perPages = [10, 25, 50, 100];
    public $perPage = 10;

    public $fields = [
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
            "name" => 'roles',
            "type" => "callback",
            "format" => "\Paksuco\UsersUI\Tables\UserTable::getUserRoles",
            "sortable" => false,
            "queryable" => false,
            "filterable" => true,
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
            "format" => "\Paksuco\UsersUI\Tables\UserTable::getActions",
            "sortable" => false,
            "queryable" => false,
            "filterable" => false,
        ],
    ];

    public static function getUserRoles($user)
    {
        return $user->roles->pluck("name")->implode(", ");
    }

    public static function getActions($user)
    {
        return "<button class='mr-1 rounded px-3 py-1 bg-blue-700 text-white shadow'
                wire:click='\$emit(\"editUser\"," . $user->id . ")'>" . __("Edit") .
        "</button>" .
        "<button class='rounded px-3 py-1 bg-red-700 text-white shadow'
                wire:click='\$emit(\"deleteUser\"," . $user->id . ")'>" . __("Delete") .
            "</button>";
    }
}

if (!function_exists("__")) {
    function __($x)
    {
    }
}
