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
    ];
}
