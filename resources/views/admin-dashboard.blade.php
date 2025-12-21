<x-layouts.admin.admin-layout>
    <div class="min-h-screen p-6 space-y-6">

        <h1 class="text-2xl font-bold">Admin Layout Notification Test</h1>

        <div class="flex flex-wrap gap-4">
            <button onclick="notifyToast('success','Success toast!')" class="btn btn-success">
                Toast Success
            </button>

            <button onclick="notifyToast('error','Error toast!')" class="btn btn-danger">
                Toast Error
            </button>

            <button onclick="notifyToast('warning','Warning toast!')" class="btn btn-warning">
                Toast Warning
            </button>

            <button onclick="notifyAlert('success','Success alert!')" class="btn btn-success">
                Alert Success
            </button>

            <button onclick="notifyAlert('error','Error alert!')" class="btn btn-danger">
                Alert Error
            </button>

            <button onclick="notifyAlert('warning','Warning alert!')" class="btn btn-warning">
                Alert Warning
            </button>
        </div>

    </div>
</x-layouts.admin.admin-layout>