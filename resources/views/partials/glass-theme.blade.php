<style>
    :root {
        --bg-start: #0b0b0c;
        --bg-end: #111219;
        --glass-bg: rgba(255, 255, 255, 0.06);
        --glass-bg-strong: rgba(255, 255, 255, 0.12);
        --glass-border: rgba(255, 255, 255, 0.16);
        --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.55);
        --text: #e6e6e6;
        --muted: #9aa0a6;
        --highlight: #00e0ff;
        --danger: #ff3b3b;
        --success: #00d68f;
    }

    body.glass-bg {
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

    .input-glass.form-control {
        background: rgba(255, 255, 255, 0.06);
        border: 1px solid rgba(255, 255, 255, 0.12);
        color: var(--text);
    }

    .input-glass.form-control:focus {
        border-color: var(--highlight);
        box-shadow: 0 0 0 0.2rem rgba(0, 224, 255, 0.15);
        background: rgba(255, 255, 255, 0.08);
        color: var(--text);
    }

    .btn-glass {
        border: 1px solid rgba(255, 255, 255, 0.16) !important;
        color: #fff !important;
        position: relative;
        overflow: hidden;
        transition: transform .08s ease, box-shadow .15s ease, border-color .15s ease;
    }

    .btn-glass:active {
        transform: scale(0.98);
    }

    .btn-glass-primary {
        background: linear-gradient(180deg, #14151d, #0e0f14);
    }

    .btn-glass-primary:hover {
        border-color: var(--highlight) !important;
        box-shadow: 0 0 14px rgba(0, 224, 255, 0.35);
    }

    .btn-glass-danger {
        background: linear-gradient(180deg, rgba(255, 59, 59, 0.18), rgba(255, 59, 59, 0.12));
    }

    .btn-glass-danger:hover {
        border-color: rgba(255, 59, 59, 0.6) !important;
        box-shadow: 0 0 14px rgba(255, 59, 59, 0.45);
    }

    .btn-glass-success {
        background: linear-gradient(180deg, rgba(0, 214, 143, 0.22), rgba(0, 214, 143, 0.12));
    }

    .btn-glass-success:hover {
        border-color: rgba(0, 214, 143, 0.6) !important;
        box-shadow: 0 0 14px rgba(0, 214, 143, 0.4);
    }

    .link-highlight {
        color: var(--highlight);
    }

    .link-highlight:hover {
        text-decoration: underline;
    }

    .navbar-glass {
        background: rgba(0, 0, 0, 0.35) !important;
        border-bottom: 1px solid rgba(255, 255, 255, 0.12);
        backdrop-filter: blur(10px);
    }
</style>
