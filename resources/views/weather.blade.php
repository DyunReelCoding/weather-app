<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather App</title>
    <!-- Add Bootstrap CSS link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        /* Add your custom styles here, if needed */
        body {
            padding: 20px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        form {
            margin-bottom: 20px;
        }

        .weather-card {
            display: flex;
            align-items: center;
            text-align: left;
        }

        .weather-image {
            max-width: 60px;
            /* Adjust the max-width as needed */
            height: auto;
            margin-right: 20px;
            /* Adjust the margin as needed */
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="mt-4">Weather App</h1>

        <form action="{{ route('getWeather') }}" method="post" class="form-inline d-flex justify-content-center">
            @csrf
            <div class="form-group mx-sm-3 mb-2">
                <label for="city" class="sr-only">Enter city:</label>
                <input type="text" class="form-control" name="city" placeholder="Enter city" required>
            </div>
            <button type="submit" class="btn btn-primary mb-2">Get Weather</button>
        </form>

        @isset($data)
        <!-- Display weather data -->
        @php
        $condition = strtolower($data['weather'][0]['main']);
        $imagePath = "images/weather/$condition.png";
        @endphp
        <div class="card weather-card">
            @if (file_exists(public_path($imagePath)))
            <img src="{{ asset($imagePath) }}" alt="{{ $condition }} image" class="weather-image">
            @endif
            <div class="card-body">
                <h2 class="card-title">{{ $data['name'] }} Weather</h2>
                <p class="card-text">Temperature: {{ $data['main']['temp'] - 273.15 }} &deg;C</p>
                <p class="card-text">Condition: {{ $data['weather'][0]['description'] }}</p>
            </div>
        </div>
        @endisset

        @isset($error)
        <!-- Display error message -->
        <div class="alert alert-danger mt-4" role="alert">
            <p>Error: {{ $error['message'] }}</p>
        </div>
        @endisset
    </div>

    <!-- Add Bootstrap JS and Popper.js (required for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>