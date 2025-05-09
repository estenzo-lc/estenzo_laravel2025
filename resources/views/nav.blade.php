<style>
    body {
        background-color: #f7d2ff; /* pastel pink */
    }

    .navbar {
        background-color: #c8b3ff; /* pastel purple */
    }

    .navbar-brand,
    .nav-link {
        color: white !important;
        transition: background-color 0.3s ease, color 0.3s ease;
        padding: 8px 12px;
        border-radius: 4px;
        position: relative;
    }

    .nav-link:hover {
        color: #c3f9ff !important; /* soft cyan hover */
        background-color: #bec1ff;  /* light purple hover */
        transform: translateY(-2px);
    }

    .nav-link::after {
        content: '';
        position: absolute;
        left: 0;
        bottom: 0;
        width: 0;
        height: 2px;
        background-color: #c3f9ff; /* underline pastel cyan */
        transition: width 0.3s ease;
    }

    .nav-link:hover::after {
        width: 100%;
    }

    .logout-btn {
        background-color: #bec1ff; /* pastel violet */
        border-color: #bec1ff;
        color: white !important;
        margin-left: 10px;
        transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
    }

    .logout-btn:hover {
        background-color: #c0d7ff; /* hover with pastel blue */
        border-color: #c0d7ff;
        color: white !important;
        transform: scale(1.1);
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }

    .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.5);
    }

    .navbar-toggler-icon {
        background-image: url("data:image/svg+xml;charset=utf8,%3Csvg viewBox='0 0 30 30' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath stroke='rgba%28255,255,255,1%29' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3E%3C/svg%3E");
    }
</style>
