
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">

            <div class="card shadow">
                <div class="card-header text-center">
                    <h4>Register</h4>
                </div>

                <div class="card-body">

                    {{-- Error Message --}}
                    @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Name -->
                        <div class="mb-3">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>

                        <!-- Password -->
                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <!-- Button -->
                        <div class="d-grid">
                            <button type="submit" class="btn btn-success">
                                Register
                            </button>
                        </div>
                    </form>

                    <!-- Login link -->
                    <div class="text-center mt-3">
                        <a href="{{ route('login') }}">
                            Already have an account? Login
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>
