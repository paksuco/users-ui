<div>
    <div class="flex pb-4">
        <div class="w-1/2 items-end flex">
            <h2 class="text-2xl font-semibold">@lang("User Management")</h2>
        </div>
        <div class="w-1/2 text-right">
            <button class="inline-block rounded bg-blue-700 text-white hover:bg-blue-800 py-2 px-3 shadow-outline-gray"
                    wire:click="$emit('showModal', 'modal title', 'users-ui::new-user', {{json_encode(["user" => "taha paksu", "id" => 5])}})">
                @lang("Create new User")
            </button>
        </div>
    </div>

    <div class="p-4 bg-gray-100">
        @livewire('paksuco-table::table', [
        "model" => \App\User::class,
        "queryable" => true,
        "sortable" => true,
        "pageable" => true,
        "perPage" => 50,
        "actions" => function($row) {
            return "<button>{$row->name}</button>";
        },
        "fields" => [
            [
                "type" => "field",
                "name" => "name",
                "value" => "string",
                "sortable" => true,
                "queryable" => true,
                "filterable" => false
            ],
            [
                "name" => "actions",
                "type" => "actions"
            ]
        ]
        ])
    </div>

    @livewire('paksuco-modal::modal')
</div>
