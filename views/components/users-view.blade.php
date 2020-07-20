<div class="container p-4">
    <div class="flex flex-col px-4 sm:px-0 sm:flex-row sm:pb-4">
        <div class="sm:w-1/2 items-end flex">
            <h2 class="text-2xl font-semibold">@lang("User Management")</h2>
        </div>
        <div class="sm:w-1/2 mt-3 sm:mt-0 sm:text-right">
            <button class="inline-block rounded bg-blue-700 text-white hover:bg-blue-800 py-2 px-3 shadow-outline-gray"
                    wire:click="$emit('showModal', 'Create new User', 'users-ui::users-form')">
                @lang("Create new User")
            </button>
        </div>
    </div>

    @livewire('paksuco-table::table', $config)

    @livewire('paksuco-modal::modal')
</div>
