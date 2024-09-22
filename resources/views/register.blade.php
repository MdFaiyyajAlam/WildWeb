@extends('layouts.base')

@section('title')
    Register
@endsection

@section('content')
    <div class="container mt-2 pt-4">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <h2 class="text-center mb-4">Create an Account</h2>
                <form id="registerForm" class="border p-4 bg-light rounded">
                    @csrf
                    <div class="mb-3">
                        <input type="text" name="first_name" class="form-control" placeholder="First Name" required>
                        <span class="text-danger error-text first_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="last_name" class="form-control" placeholder="Last Name" required>
                        <span class="text-danger error-text last_name_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="email" name="email" class="form-control" placeholder="Email" required>
                        <span class="text-danger error-text email_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="phone" class="form-control" placeholder="Phone" required>
                        <span class="text-danger error-text phone_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="address" class="form-control" placeholder="Address" required>
                        <span class="text-danger error-text address_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="text" name="pincode" class="form-control" placeholder="Pincode" required>
                        <span class="text-danger error-text pincode_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <span class="text-danger error-text password_error"></span>
                    </div>
                    <div class="mb-3">
                        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password" required>
                        <span class="text-danger error-text confirm_password_error"></span>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $('#registerForm').submit(function(e) {
            e.preventDefault();

            // Clear previous error messages
            $('.error-text').text('');

            $.ajax({
                url: "{{ route('register.user') }}",
                method: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    alert(response.message);
                    window.location.href = response.redirect_url;
                    $('#registerForm')[0].reset(); // Reset the form
                },
                error: function(error) {
                    if (error.responseJSON.errors) {
                        $.each(error.responseJSON.errors, function(key, value) {
                            $('.' + key + '_error').text(value[0]); // Display error messages
                        });
                    } else {
                        alert('Registration failed!');
                    }
                }
            });
        });
    </script>
@endsection
