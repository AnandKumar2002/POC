@extends('layouts.admin')

@section('header', 'Pages')

@section('content')
<div class="mb-3">
    <a href="{{ route('pages.create') }}" class="btn btn-primary">Create New Page</a>
</div>

<main class="card">
    <section class="card-body">
        <table class="table table-bordered" id="pages-table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Slug</th>
                    {{-- <th>HTML</th> --}}
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </section>
</main>
@endsection

@push('scripts')
<x-snippets.yajra />
<script>
    $(document).ready(function () {
        $('#pages-table').DataTable({
            processing: true,
            serverSide: true,
            ajax: '{{ route('pages.index') }}',
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'slug', name: 'slug' },
                // { data: 'html', name: 'html' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endpush
