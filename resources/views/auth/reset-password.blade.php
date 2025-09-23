<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('partials.glass-theme')
</head>

<body class="glass-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm glass-card">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-3 text-center">Set a new password</h1>
                        <div id="alert" class="alert d-none" role="alert"></div>
                        <form id="resetForm">
                            <input type="hidden" id="token">
                            <div class="mb-3">
                                <label for="email" class="form-label">Email address</label>
                                <input type="email" class="form-control input-glass" id="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">New password</label>
                                <input type="password" class="form-control input-glass" id="password" required
                                    minlength="8">
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-glass btn-glass-primary w-100">Reset
                                password</button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="/login" class="small">Back to login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        (function () {
            const params = new URLSearchParams(window.location.search);
            const token = params.get('token');
            const email = params.get('email');
            if (token) document.getElementById('token').value = token;
            if (email) document.getElementById('email').value = email;

            $('#resetForm').on('submit', function (e) {
                e.preventDefault();
                const email = $('#email').val();
                const password = $('#password').val();
                const token = $('#token').val();
                $('#submitBtn').prop('disabled', true).text('Resetting…');
                $('#alert').addClass('d-none');
                $.ajax({
                    url: '/api/reset-password', method: 'POST',
                    contentType: 'application/json; charset=utf-8', dataType: 'json',
                    data: JSON.stringify({ email, password, token }),
                    success: function (res) {
                        $('#alert').removeClass('d-none alert-danger').addClass('alert alert-success').text(res.message || 'Password changed. You can now login.');
                    },
                    error: function (xhr) {
                        let message = 'Failed to reset password.';
                        if (xhr && xhr.responseJSON) {
                            if (xhr.responseJSON.message) message = xhr.responseJSON.message;
                            if (xhr.responseJSON.errors) {
                                const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                                if (firstKey) message = xhr.responseJSON.errors[firstKey][0];
                            }
                        }
                        $('#alert').removeClass('d-none alert-success').addClass('alert alert-danger').text(message);
                    },
                    complete: function () { $('#submitBtn').prop('disabled', false).text('Reset password'); }
                });
            });
        })();
    </script>
</body>

</html>
