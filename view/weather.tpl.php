<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Weather Information</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Weather Information</h1>

    <form method="GET" action="">
        <label for="weather">city:</label>
        <input type="text" id="weather" name="name" placeholder="city name">

        <label for="id">id:</label>
        <input type="text" id="id" name="id" placeholder="city id">

        <label for="latitude">latitude:</label>
        <input type="text" id="latitude" name="latitude" placeholder="city latitude">

        <label for="longitude">longitude:</label>
        <input type="text" id="longitude" name="longitude" placeholder="city longitude">

        <input type="submit" value="Get Weather" class="btn-weather">
    </form>
    
    <div class="data">
        <?php if (isset($result)): ?>
            <?php if (isset($result['error'])): ?>
                <p><?= htmlspecialchars($result['error'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php elseif (isset($result['name'])): ?>
                <h2>Weather in <?= htmlspecialchars($result['name'], ENT_QUOTES, 'UTF-8') ?></h2>
                <p>Temperature: <?= htmlspecialchars($result['main']['temp'], ENT_QUOTES, 'UTF-8') ?>°C</p>
            
            <!-- icon weather -->
                <?php $iconUrl = "http://openweathermap.org/img/wn/" . htmlspecialchars($result['weather'][0]['icon'], ENT_QUOTES, 'UTF-8') . ".png"; ?>
                <img src="<?= $iconUrl ?>" alt="Weather icon">

                <p>Condition: <?= htmlspecialchars($result['weather'][0]['description'], ENT_QUOTES, 'UTF-8') ?></p>
            <?php else: ?>
                <p>Weather data not available.</p>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</body>
</html>