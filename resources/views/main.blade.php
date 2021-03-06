@extends('head')

@section('contens')
<div class="col-6">
<a class="btn btn-primary" href="user/add"> Add User</a>
<div>
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif
    <table class="table table-bordered table-striped" id="users">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Companies</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

@push('scripts')
<script>
$(function() {
    $('#users').DataTable({
        processing: true,
        serverSide: true,
        ajax: 'user/data',
        columns: [
            { data: 'user_id', name: 'id' },
            { data: 'name', name: 'name' },
            { data: 'companies', name: 'companies' },
            { data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
});
</script>
@endpush