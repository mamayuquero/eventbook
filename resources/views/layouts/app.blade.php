<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Event Booking System</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">


    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">

    <!-- Custom Aesthetic + Animation -->
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f8f9fa, #e0f7fa);
        }

        .navbar {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.05);
        }

        .container {
            margin-top: 40px;
            animation: fadeIn 0.6s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        }

        h3 {
            font-weight: 600;
            color: #333;
        }

        .btn {
            border-radius: 50px;
            font-weight: 500;
        }

        .table> :not(caption)>*>* {
            vertical-align: middle;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>

<body>
    @if (!in_array(Route::currentRouteName(), ['login', 'register', 'logout.success']))
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark px-4">
        <a class="navbar-brand fw-bold" href="/">EventSys</a>
        <div class="ms-auto">
            @auth
            <a href="{{ route('bookings.index') }}" class="btn btn-outline-light me-2">Bookings</a>
            @if(Auth::user()->role === 'admin')
            <a href="{{ route('events.index') }}" class="btn btn-warning me-2">Events</a>
            @endif
            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-danger">Logout</button>
            </form>
            @endauth
        </div>
    </nav>
    @endif

    <div class="container">
        @yield('content')
    </div>
</body>


<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- Enable Flatpickr on specific inputs -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        flatpickr("#date", {
            altInput: true,
            altFormat: "F j, Y",
            dateFormat: "Y-m-d",
            minDate: "today",
            defaultDate: "today"
        });

        flatpickr("#time", {
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true,
            minuteIncrement: 15
        });
    });
</script>


</body>

</html>