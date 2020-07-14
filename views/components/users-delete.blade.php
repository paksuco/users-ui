<div class="max-w-lg text-sm">
    <div class="p-6 pb-8 leading-6">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Voluptatibus quia, nulla! Maiores et
        perferendis eaque, exercitationem praesentium nihil.
    </div>
    <div class="px-3 py-3 border-t rounded-b bg-gray-50 flex justify-end">
        <button class="text-gray-600 font-medium text-sm py-3 px-4 rounded mr-3"
                wire:click='$emit("closeModal")'>Cancel</button>
        <button class="bg-red-700 text-white font-medium text-sm py-3 px-4 rounded" wire:click="deleteUser">Delete
            User</button>
    </div>
</div>
