<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    @include('partials.glass-theme')
</head>

<body class="glass-bg">
    <nav class="navbar navbar-expand-lg navbar-glass">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SLA SUB ERP</a>
            <div class="d-flex">
                <button id="logoutBtn" class="btn btn-glass btn-glass-danger">Logout</button>
            </div>
        </div>
    </nav>
    <div class="container py-4">
        <div class="alert alert-success glass">You are logged in.</div>
        <pre id="me" class="p-3 border rounded glass"></pre>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        (function () {
            const token = localStorage.getItem('auth_token');
            if (!token) { window.location.href = '/login'; return; }
            $.ajax({
                url: '/api/me',
                headers: { 'Authorization': 'Bearer ' + token },
                success: function (res) { $('#me').text(JSON.stringify(res, null, 2)); },
                error: function () { $('#me').text('Failed to load user.'); }
            });
            $('#logoutBtn').on('click', function () {
                $.ajax({
                    url: '/api/logout', method: 'POST',
                    headers: { 'Authorization': 'Bearer ' + token },
                    complete: function () { localStorage.removeItem('auth_token'); localStorage.removeItem('auth_user'); window.location.href = '/login'; }
                });
            });
        })();
    </script>
</body>

</html>
