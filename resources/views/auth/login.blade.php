<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('partials.glass-theme')
    <style>
        :root {
            --bg-start: #0b0b0c;
            --bg-end: #111219;
            --glass-bg: rgba(255, 255, 255, 0.06);
            --glass-border: rgba(255, 255, 255, 0.15);
            --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.55);
            --text: #e6e6e6;
            --muted: #9aa0a6;
            --highlight: #00e0ff;
            /* cyan highlight */
            --danger: #ff3b3b;
        }

        body {
            background: radial-gradient(1200px 800px at 10% 10%, #1a1b26 0%, transparent 60%),
                radial-gradient(1000px 700px at 90% 20%, #111827 0%, transparent 55%),
                linear-gradient(160deg, var(--bg-start), var(--bg-end));
            color: var(--text);
            min-height: 100vh;
        }

        .glass-card {
            background: var(--glass-bg);
            border: 1px solid var(--glass-border);
            box-shadow: var(--glass-shadow);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 14px;
        }

        .form-control {
            background: rgba(255, 255, 255, 0.06);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: var(--text);
        }

        .form-control:focus {
            border-color: var(--highlight);
            box-shadow: 0 0 0 0.2rem rgba(0, 224, 255, 0.15);
            background: rgba(255, 255, 255, 0.08);
            color: var(--text);
        }

        .btn-primary {
            background: linear-gradient(180deg, #14151d, #0e0f14);
            border: 1px solid rgba(255, 255, 255, 0.12);
            color: #fff;
            position: relative;
        }

        .btn-primary:hover {
            filter: brightness(1.08);
            border-color: var(--highlight);
            box-shadow: 0 0 12px rgba(0, 224, 255, 0.35);
        }

        .btn-outline-danger {
            border: 1px solid rgba(255, 255, 255, 0.18) !important;
            color: #fff !important;
            background: linear-gradient(180deg, rgba(255, 59, 59, 0.18), rgba(255, 59, 59, 0.12));
        }

        .btn-outline-danger:hover {
            box-shadow: 0 0 12px rgba(255, 59, 59, 0.45);
            border-color: rgba(255, 59, 59, 0.6) !important;
        }

        .text-muted {
            color: var(--muted) !important;
        }

        a {
            color: var(--highlight);
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .card-body h1 {
            color: #fff;
        }
    </style>
</head>

<body class="glass-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm glass-card">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-4 text-center">Sign in</h1>

                        <div id="alert" class="alert d-none" role="alert"></div>

                        <a href="/auth/google/redirect" class="btn btn-glass btn-glass-danger w-100 mb-3">
                            <img src="https://www.gstatic.com/firebasejs/ui/2.0.0/images/auth/google.svg" alt=""
                                width="18" class="me-2"> Sign in with Google
                        </a>

                        <div class="text-center text-muted mb-2">or</div>

                        <form id="loginForm">
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
                                class="btn btn-glass btn-glass-primary w-100">Login</button>
                        </form>
                        <div class="d-flex justify-content-between align-items-center mt-3">
                            <a href="/forgot-password" class="small">Forgot password?</a>
                            <a href="/register" class="small">Create account</a>
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
            const loginEndpoint = apiBase + '/login';
            const dashboardUrl = '/dashboard';

            function setLoading(loading) {
                $('#submitBtn').prop('disabled', loading).text(loading ? 'Logging in…' : 'Login');
            }

            function showAlert(type, message) {
                const $alert = $('#alert');
                $alert.removeClass('d-none alert-success alert-danger').addClass('alert-' + type).text(message);
            }

            $('#loginForm').on('submit', function (e) {
                e.preventDefault();
                const email = $('#email').val();
                const password = $('#password').val();
                setLoading(true);
                showAlert('success', '');
                $('#alert').addClass('d-none');

                $.ajax({
                    url: loginEndpoint,
                    method: 'POST',
                    contentType: 'application/json; charset=utf-8',
                    dataType: 'json',
                    data: JSON.stringify({ email, password }),
                    success: function (res) {
                        if (res && res.token) {
                            localStorage.setItem('auth_token', res.token);
                            // Optionally store user
                            try { localStorage.setItem('auth_user', JSON.stringify(res.user || {})); } catch (e) { }
                            window.location.href = dashboardUrl;
                        } else {
                            showAlert('danger', 'Unexpected response from server.');
                        }
                    },
                    error: function (xhr) {
                        let message = 'Login failed.';
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
