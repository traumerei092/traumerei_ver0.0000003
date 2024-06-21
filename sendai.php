<?php include 'templates/header.php'; ?>
<div class="shop">
    <p>SENDAI</p>
</div>

<?php
include 'includes/functions.php';
$storeData = getDataForStore('sendai');
$entryCount = count($storeData['movies']);
?>
<div class="container">
    <div class="info">
        <div class="count">
            <p>Count: <?php echo $entryCount; ?></p>
        </div>
        <div class="data-button">
            <button onclick="openModal()">LIST</button>
        </div>
    </div>

    <div class="graph">
        <canvas id="movieChart"></canvas>
        <canvas id="sportChart"></canvas>
        <canvas id="hobbyChart"></canvas>
    </div>
</div>

<div id="dataModal" class="modal hidden">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h1>データ一覧</h1>
        <table border="1">
            <tr><th>氏名</th><th>年齢</th><th>映画</th><th>スポーツ</th><th>趣味</th></tr>
            <?php
            foreach ($storeData['names'] as $index => $name) {
                echo "<tr>
                    <td>{$storeData['names'][$index]}</td>
                    <td>{$storeData['ages'][$index]}</td>
                    <td>{$storeData['movies'][$index]}</td>
                    <td>{$storeData['sports'][$index]}</td>
                    <td>{$storeData['hobbies'][$index]}</td>
                </tr>";
            }
            ?>
        </table>
    </div>
</div>

<script>
    var movieData = <?php echo json_encode(array_count_values($storeData['movies'])); ?>;
    var sportData = <?php echo json_encode(array_count_values($storeData['sports'])); ?>;
    var hobbyData = <?php echo json_encode(array_count_values($storeData['hobbies'])); ?>;

    console.log(movieData);
    console.log(sportData);
    console.log(hobbyData);

    // モーダルを開く関数
    function openModal() {
        document.getElementById("dataModal").style.display = "block";
    }

    // モーダルを閉じる関数
    function closeModal() {
        document.getElementById("dataModal").style.display = "none";
    }

    // モーダル外をクリックした場合にモーダルを閉じる
    window.onclick = function(event) {
        if (event.target == document.getElementById("dataModal")) {
            closeModal();
        }
    }
</script>

<script>
    const apiKey = '';
    const locations = {
        tokyo: {lat: 35.682839, lon: 139.759455},
        osaka: {lat: 34.693737, lon: 135.502165},
        nagoya: {lat: 35.181446, lon: 136.906398},
        sapporo: {lat: 43.062096, lon: 141.354376},
        sendai: {lat: 38.268215, lon: 140.869355},
        hiroshima: {lat: 34.385203, lon: 132.455293},
        fukuoka: {lat: 33.590354, lon: 130.401716}
    };

    const currentLocation = 'sendai'; //現在地

    async function fetchWeather(location) {
        const url = `https://api.openweathermap.org/data/2.5/weather?lat=${location.lat}&lon=${location.lon}&appid=${apiKey}&units=metric`;
        const response = await fetch(url);
        const data = await response.json();
        return data;
    }

    async function displayWeather() {
        const location = locations[currentLocation];
        const weatherData = await fetchWeather(location);
        const weatherDiv = document.getElementById('weather');
        const iconUrl = `http://openweathermap.org/img/wn/${weatherData.weather[0].icon}.png`;
        const temperature = weatherData.main.temp;

        weatherDiv.innerHTML = `
            <img src="${iconUrl}" alt="Weather Icon">
            <span>${temperature}°C</span>
        `;
    }

    displayWeather();
</script>

<?php include 'templates/footer.php'; ?>

