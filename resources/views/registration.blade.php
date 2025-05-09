<style>
    body {
        background: linear-gradient(135deg, #f7d2ff, #c0d7ff); /* pastel pink to pastel blue */
        min-height: 100vh;
        margin: 0;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .card {
        background-color: #ffffff;
        border-radius: 1rem;
        padding: 2rem;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
        border: none;
    }

    h2 {
        color: #9d8dff; /* soft purple */
    }

    .form-label {
        font-weight: 600;
        color: #6f42c1; /* muted purple */
    }

    .form-control {
        border-radius: 0.5rem;
        border: 1px solid #ccc;
    }

    .btn-primary {
        background-color: #c8b3ff; /* pastel purple */
        border-color: #c8b3ff;
        color: white;
        transition: all 0.3s ease-in-out;
    }

    .btn-primary:hover {
        background-color: #b39ddb;
        border-color: #b39ddb;
        transform: scale(1.02);
    }

    .btn-secondary {
        background-color: #c3f9ff; /* pastel cyan */
        border-color: #c3f9ff;
        color: black;
    }

    .btn-secondary:hover {
        background-color: #a0efff;
        border-color: #a0efff;
    }

    #password-strength {
        font-size: 0.9rem;
    }

    .strength-weak {
        color: #f67280; /* soft red */
    }

    .strength-medium {
        color: #ffce54; /* pastel yellow */
    }

    .strength-strong {
        color: #4caf50; /* green */
    }

    .form-check-label {
        color: #6c757d;
    }

    .invalid-feedback {
        color: #f67280;
    }
</style>
