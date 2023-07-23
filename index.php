<?php
function weatherDetail() {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $city = $_POST["city"];

        $WEATHER_API_KEY = "acf37f3891970398c00cdfcee02c3720";

        $API_URL = "https://api.openweathermap.org/data/2.5/weather?q=" . urlencode($city) . "&appid=" . $WEATHER_API_KEY;

        $cURL = curl_init();
        curl_setopt($cURL, CURLOPT_URL, $API_URL);
        curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($cURL);

        if (curl_errno($cURL)) {
            echo "Error: " . curl_error($cURL);
            curl_close($cURL);
            return false;
        }

        if ($response) {
            $data = json_decode($response, true);
            curl_close($cURL);
            return $data;
        } else {
            echo "Failed to fetch weather data.";
            curl_close($cURL);
            return false;
        }
    }
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Search</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="weather-search-container">
        <h2>Weather Search</h2>
        <form action="" method="post">
            <input type="text" id="cityInput" name="city" placeholder="Enter city name">
            <button type="submit">Search</button>
        </form>
        <div class="weather-detail">
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $weatherData = weatherDetail();
                if ($weatherData) {
                    $city = $weatherData["name"];
                    $temp = $weatherData["main"]["temp"];
                    $min_temp = $weatherData["main"]["temp_min"];
                    $max_temp = $weatherData["main"]["temp_max"];
                    $desc = $weatherData["weather"][0]["description"];
                    
                    function kelTOcel($temperature){
                        return $temperature - 273.15;
                    }

                    echo "<h3>Weather Details for " . $city . "</h3>";
                    echo "<p>The weather in " . $city . " will be " . $desc . "</p>";
                    echo "<p><strong>Temperature: " . kelTOcel($temp) . "  °C</strong></p>";
                    echo "<p><strong>Minimum Temperature: " . kelTOcel($min_temp) . "  °C</strong></p>";
                    echo "<p><strong>Maximum Temperature: " . kelTOcel($max_temp) . "  °C</strong></p>";
                }
            }
            ?>
        </div>
    </div>
</body>
</html>
