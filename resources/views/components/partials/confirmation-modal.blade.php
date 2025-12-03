@props([
    'name', 
    'title' => 'Are you sure?', 
    'message' => '',
])

{{-- MODAL CONTENT --}}
<flux:modal 
    name="{{ $name }}" 
    variant="surface"
    tone="dark"
    class="md:w-96"
>

    <div class="space-y-6">
        <div>
            <flux:heading size="lg">{{ $title }}</flux:heading>
            @if ($message)
                <flux:subheading>{{ $message }}</flux:subheading>
            @endif
        </div>

        <div>
            {{ $slot }}
        </div>
    </div>
</flux:modal>
