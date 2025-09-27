<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    @include('partials.glass-theme')
</head>

<body class="glass-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-sm glass-card">
                    <div class="card-body p-4">
                        <h1 class="h4 mb-3 text-center">Forgot your password?</h1>
                        <p class="text-muted text-center">Enter your email and we'll send a reset link.</p>
                        <div id="alert" class="alert d-none" role="alert"></div>
                        <form id="forgotForm">
                            <div class="mb-3">
                                <label for="email" class="form-label" style="color: var(--text)">Email address</label>
                                <input type="email" class="form-control input-glass" id="email" required>
                            </div>
                            <button type="submit" id="submitBtn" class="btn btn-glass btn-glass-primary w-100">Send
                                reset link</button>
                        </form>
                        <div class="mt-3 text-center">
                            <a href="/login" class="small">Back to login</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/jquery-3.7.1.min.js') }}"></script>
    <script>
        (function () {
            $('#forgotForm').on('submit', function (e) {
                e.preventDefault();
                const email = $('#email').val();
                $('#submitBtn').prop('disabled', true).text('Sending…');
                $('#alert').addClass('d-none');
                $.ajax({
                    url: '/api/forgot-password', method: 'POST',
                    contentType: 'application/json; charset=utf-8', dataType: 'json',
                    data: JSON.stringify({ email }),
                    success: function (res) {
                        $('#alert').removeClass('d-none alert-danger').addClass('alert alert-success').text(res.message || 'Email sent if the address exists.');
                    },
                    error: function (xhr) {
                        let message = 'Failed to send reset link.';
                        if (xhr && xhr.responseJSON) {
                            if (xhr.responseJSON.message) message = xhr.responseJSON.message;
                            if (xhr.responseJSON.errors) {
                                const firstKey = Object.keys(xhr.responseJSON.errors)[0];
                                if (firstKey) message = xhr.responseJSON.errors[firstKey][0];
                            }
                        }
                        $('#alert').removeClass('d-none alert-success').addClass('alert alert-danger').text(message);
                    },
                    complete: function () { $('#submitBtn').prop('disabled', false).text('Send reset link'); }
                });
            });
        })();
    </script>
</body>

</html>