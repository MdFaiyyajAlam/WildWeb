@extends('layouts.adminbase')

@section('title')
    Admin Panel
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <h1>Admin Panel</h1>
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Users</h5>
                                <p class="card-text">{{ $users->count() }}</p>
                                <i class="fas fa-users fa-2x"></i> <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Posts</h5>
                                <p class="card-text">100+</p>
                                <i class="fas fa-edit fa-2x"></i> <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Comments</h5>
                                <p class="card-text">100+</p>
                                <i class="fas fa-comments fa-2x"></i> <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="card">
                            <div class="card-body text-center">
                                <h5 class="card-title">Total Categories</h5>
                                <p class="card-text">10+</p>
                                <i class="fas fa-list fa-2x"></i> <!-- Font Awesome Icon -->
                            </div>
                        </div>
                    </div>
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
@endsection
