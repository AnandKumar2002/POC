<div>
    <form wire:submit.prevent="deleteAccount" class="space-y-4">

        <flux:input name="password" type="password" wire:model.defer="password" required  placeholder="Enter your password" icon="key" />
        <flux:error name="password" icon="exclamation-circle" class="text-red-500" />

        <div class="flex justify-end gap-2">

            {{-- Close Modal --}}
            <flux:modal.close>
                <flux:button variant="ghost">Cancel</flux:button>
            </flux:modal.close>

            {{-- Submit --}}
            <flux:button variant="danger" type="submit" icon="trash">
                Confirm Deletion
            </flux:button>
        </div>
    </form>
</div>