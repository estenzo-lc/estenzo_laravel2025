<style>
    body {
        background: linear-gradient(135deg, #f7d2ff, #c0d7ff); /* pastel gradient */
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        margin: 0;
    }

    .reset-card {
        background: #ffffff;
        padding: 2rem;
        border-radius: 1rem;
        box-shadow: 0 0 25px rgba(0, 0, 0, 0.1);
        width: 100%;
        max-width: 450px;
    }

    h3 {
        color: #9d8dff; /* soft purple */
    }

    .form-label {
        font-weight: 600;
        color: #6f42c1;
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

    .strength-weak {
        color: #f67280; /* pastel red */
    }

    .strength-medium {
        color: #ffce54; /* pastel yellow */
    }

    .strength-strong {
        color: #4caf50; /* green */
    }

    .alert-danger {
        background-color: #ffe3e3;
        color: #c0392b;
        border: none;
        border-radius: 0.5rem;
    }
</style>
