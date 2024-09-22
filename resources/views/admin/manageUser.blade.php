{{--
@extends('layouts.adminbase')

@section('title')
    Admin Panel
@endsection

@section('content')
<div class="container">
    <div class="row">
        <h1>Admin Panel</h1>
        <div class="col-lg-12">
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Pincode</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if ($users->isEmpty())
                            <tr>
                                <td colspan="9" class="text-center">No users found</td>
                            </tr>
                        @else
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->phone }}</td>
                                    <td>{{ $user->address }}</td>
                                    <td>{{ $user->pincode }}</td>
                                    <td class="d-flex ">
                                        <a href="" class="btn btn-success btn-sm me-2">View</a>
                                        <a href="" class="btn btn-info btn-sm me-2">Edit</a>
                                        <a href="" class="btn btn-danger btn-sm me-2">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script>
    $(document).ready(function() {
        $('.table').DataTable();
    });
</script>
@endsection --}}


@extends('layouts.adminbase')

@section('title')
    Admin Panel
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h3 class="mt-2 mb-2">Manage Users ({{ $users->count() }})</h3>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Id</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address</th>
                                        <th>Pincode</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($users->isEmpty())
                                        <tr>
                                            <td colspan="9" class="text-center">No users found</td>
                                        </tr>
                                    @else
                                        @foreach ($users as $user)
                                            <tr>
                                                <td>{{ $user->id }}</td>
                                                <td>{{ $user->first_name }}</td>
                                                <td>{{ $user->last_name }}</td>
                                                <td>{{ $user->email }}</td>
                                                <td>{{ $user->phone }}</td>
                                                <td>{{ $user->address }}</td>
                                                <td>{{ $user->pincode }}</td>
                                                <td class="d-flex ">
                                                    <button class="btn btn-success btn-sm me-2 view-btn"
                                                        data-id="{{ $user->id }}">View</button>
                                                    <button class="btn btn-info btn-sm me-2 edit-btn"
                                                        data-id="{{ $user->id }}">Edit</button>

                                                    <form id="deleteForm-{{ $user->id }}"
                                                        action="{{ route('admin.user.destroy', $user->id) }}"
                                                        method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm me-2"
                                                            onclick="if(confirm('Are you sure you want to delete this user?')) { document.getElementById('deleteForm-{{ $user->id }}').submit(); }">Delete</button>
                                                    </form>

                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- View Modal -->
    <div class="modal fade" id="viewUserModal" tabindex="-1" aria-labelledby="viewUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewUserModalLabel">User Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p><strong>First Name: </strong><span id="viewFirstName"></span></p>
                    <p><strong>Last Name: </strong><span id="viewLastName"></span></p>
                    <p><strong>Email: </strong><span id="viewEmail"></span></p>
                    <p><strong>Phone: </strong><span id="viewPhone"></span></p>
                    <p><strong>Address: </strong><span id="viewAddress"></span></p>
                    <p><strong>Pincode: </strong><span id="viewPincode"></span></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editUserModal" tabindex="-1" aria-labelledby="editUserModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editUserModalLabel">Edit User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form id="editUserForm">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" id="editUserId">
                        <div class="mb-3">
                            <label for="editFirstName" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="editFirstName" name="first_name">
                        </div>
                        <div class="mb-3">
                            <label for="editLastName" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="editLastName" name="last_name">
                        </div>
                        <div class="mb-3">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email">
                        </div>
                        <div class="mb-3">
                            <label for="editPhone" class="form-label">Phone</label>
                            <input type="text" class="form-control" id="editPhone" name="phone">
                        </div>
                        <div class="mb-3">
                            <label for="editAddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="editAddress" name="address">
                        </div>
                        <div class="mb-3">
                            <label for="editPincode" class="form-label">Pincode</label>
                            <input type="text" class="form-control" id="editPincode" name="pincode">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function() {
            $('.table').DataTable();

            // View User Details
            $('.view-btn').on('click', function() {
                let userId = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.users.show', ':id') }}'.replace(':id', userId),
                    method: 'GET',
                    success: function(response) {
                        $('#viewFirstName').text(response.first_name);
                        $('#viewLastName').text(response.last_name);
                        $('#viewEmail').text(response.email);
                        $('#viewPhone').text(response.phone);
                        $('#viewAddress').text(response.address);
                        $('#viewPincode').text(response.pincode);
                        $('#viewUserModal').modal('show');
                    }
                });
            });

            // Edit User Details
            $('.edit-btn').on('click', function() {
                let userId = $(this).data('id');
                $.ajax({
                    url: '{{ route('admin.users.edit', ':id') }}'.replace(':id', userId),
                    method: 'GET',
                    success: function(response) {
                        $('#editUserId').val(response.id);
                        $('#editFirstName').val(response.first_name);
                        $('#editLastName').val(response.last_name);
                        $('#editEmail').val(response.email);
                        $('#editPhone').val(response.phone);
                        $('#editAddress').val(response.address);
                        $('#editPincode').val(response.pincode);
                        $('#editUserModal').modal('show');
                    }
                });
            });

            // Update User via Ajax
            $('#editUserForm').on('submit', function(e) {
                e.preventDefault();
                let userId = $('#editUserId').val();
                let formData = $(this).serialize();
                $.ajax({
                    url: '{{ route('admin.users.update', ':id') }}'.replace(':id', userId),
                    method: 'PUT',
                    data: formData,
                    success: function(response) {
                        $('#editUserModal').modal('hide');
                        location.reload();
                    },
                    error: function(xhr) {
                        alert('An error occurred');
                    }
                });
            });
        });
    </script>
@endsection
