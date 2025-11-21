<x-layouts.admin title="Users" description="Manage your users efficiently" keywords="users,management,admin"
    ogImage="{{ asset('images/og-default.png') }}">
    <div class="max-w-6xl mx-auto">
        <div class="mb-4 flex items-center justify-between">
            <h1 class="text-2xl font-semibold">Users</h1>
            <div>
                <button id="refreshBtn" class="px-3 py-1 rounded-md border text-sm transition cursor-pointer">
                    Refresh
                </button>
                <a href="users/create" class="px-3 py-1 rounded-md border text-sm transition cursor-pointer">
                    Create
                </a>
            </div>
        </div>

        <div>
            <table id="usersTable" class="border rounded-sm shadow-xl" style="width:100%">
                <thead>
                    <tr>
                        <th class="text-left p-2">ID</th>
                        <th class="text-left p-2">Username</th>
                        <th class="text-left p-2">Full Name</th>
                        <th class="text-left p-2">Email</th>
                        <th class="text-left p-2">Phone</th>
                        <th class="text-left p-2">City</th>
                        <th class="text-left p-2">Joined</th>
                        <th class="text-left p-2">Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>

        </div>
    </div>

    @push('scripts')

        <script>
            $(function () {
                const table = $('#usersTable').DataTable({
                    processing: true,
                    serverSide: true,
                    responsive: true,
                    ajax: "{{ route('users.data') }}",
                    columns: [
                        { data: 'id', name: 'id' },
                        { data: 'username', name: 'username' },
                        { data: 'full_name', name: 'full_name' },
                        { data: 'email', name: 'email' },
                        { data: 'phone', name: 'phone' },
                        { data: 'city', name: 'city' },
                        { data: 'joined', name: 'joined' },
                        { data: 'actions', name: 'actions', orderable: false, searchable: false }
                    ],
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'excelHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        {
                            extend: 'pdfHtml5',
                            exportOptions: {
                                columns: ':visible'
                            }
                        },
                        'colvis'
                    ],
                    initComplete: function () {
                        table.column(4).visible(false);
                        table.column(5).visible(false);
                    }
                });

                // Refresh table
                $('#refreshBtn').on('click', function () {
                    table.ajax.reload(null, false);
                });
            });
        </script>
    @endpush
</x-layouts.admin>