<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('partials.glass-theme')
</head>

<body class="glass-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm glass-card">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-4 text-center" style="color: var(--text)">Create account</h1>

                        <div id="alert" class="alert d-none" role="alert"></div>

                        <a href="/auth/google/redirect" class="btn btn-glass btn-glass-danger w-100 mb-3">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt=""
                                width="18" class="me-2"> Sign up with Google
                        </a>

                        <div class="text-center text-muted mb-2">or</div>

                        <form id="registerForm">
                            <div class="mb-3">
                                <label for="name" class="form-label" style="color: var(--text)">Full name</label>
                                <input type="text" class="form-control input-glass" id="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label" style="color: var(--text)">Email address</label>
                                <input type="email" class="form-control input-glass" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label" style="color: var(--text)">Password</label>
                                <input type="password" class="form-control input-glass" id="password" required
                                    minlength="8">
                            </div>
                            <button type="submit" id="submitBtn"
                                class="btn btn-glass btn-glass-primary w-100">Register</button>
                        </form>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <span></span>
                            <a href="/login" class="small">Already have an account? Login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        (function () {
            const apiBase = '/api';
            const registerEndpoint = apiBase + '/register';
            const dashboardUrl = '/dashboard';

            function setLoading(loading) {
                $('#submitBtn').prop('disabled', loading).text(loading ? 'Creating…' : 'Register');
            }

            function showAlert(type, message) {
                const $alert = $('#alert');
                $alert.removeClass('d-none alert-success alert-danger').addClass('alert-' + type).text(message);
            }

            $('#registerForm').on('submit', function (e) {
                e.preventDefault();
                const name = $('#name').val();
                const email = $('#email').val();
                const password = $('#password').val();
                setLoading(true);
                $('#alert').addClass('d-none');

                $.ajax({
                    url: registerEndpoint,
                    method: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    data: JSON.stringify({ name, email, password }),
                    success: function (res) {
                        if (res && res.token) {
                            localStorage.setItem('auth_token', res.token);
                            try { localStorage.setItem('auth_user', JSON.stringify(res.user || {})); } catch (e) { }
                            window.location.href = dashboardUrl;
                        } else {
                            showAlert('danger', 'Unexpected response from server.');
                        }
                    },
                    error: function (xhr) {
                        let message = 'Registration failed.';
                        if (xhr && xhr.responseJSON) {
                            if (xhr.responseJSON.message) message = xhr.responseJSON.message;
                            if (xhr.responseJSON.errors) {
                                const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                                if (firstKey) message = xhr.responseJSON.errors[firstKey][0];
                            }
                        }
                        showAlert('danger', message);
                    },
                    complete: function () { setLoading(false); }
                });
            });
        })();
    </script>
</body>

</html>
