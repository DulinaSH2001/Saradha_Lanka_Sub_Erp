<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Signing you in…</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('partials.glass-theme')
</head>

<body class="glass-bg">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-sm glass-card">
                    <div class="card-body p-4 text-center">
                        <div class="spinner-border text-primary mb-3" role="status"></div>
                        <h1 class="h5">Finishing sign-in…</h1>
                        <p class="text-muted mb-0">Please wait while we redirect you.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (function () {
            // Clear any old tokens from localStorage since we're using session auth
            localStorage.removeItem('auth_token');

            // Redirect to dashboard (authentication is handled by the controller)
            window.location.replace('/dashboard');
        })();
    </script>
</body>

</html>