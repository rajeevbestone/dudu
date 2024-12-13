<!DOCTYPE html>
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

    .sleep-suggestion {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
    }

    .sleep-suggestion h2 {
        font-size: 32px;
        text-align: center;
        margin-bottom: 20px;
    }

    .sleep-suggestion p {
        font-size: 18px;
        line-height: 1.5;
        margin-bottom: 10px;
    }

    .sleep-suggestion ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .sleep-suggestion li {
        font-size: 16px;
        line-height: 1.5;
        margin-bottom: 5px;
    }

    @media (max-width: 600px) {
        .sleep-suggestion h2 {
            font-size: 28px;
        }
    
        .sleep-suggestion p {
            font-size: 16px;
        }
    
        .sleep-suggestion li {
            font-size: 14px;
        }
    }      
</style>
</head>
<body>
    <a href="<?php echo base_url('userFeedback?userID=20');?>" class="back-button">&#8249;</a><br><br><br><br>
    <br>
    
    <div class="sleep-suggestion">
        <h2>Improve Your Sleep for a Better Tomorrow</h2>
        <p>Are you struggling with getting a good night's rest? Try these tips to improve your sleep:</p>
        <ul>
            <li>Avoid caffeine and alcohol before bedtime</li>
            <li>Create a relaxing bedtime routine</li>
            <li>Ensure your sleeping environment is dark, quiet, and cool</li>
            <li>Get regular exercise during the day</li>
            <li>Limit screen time before bed</li>
        </ul>
        <p>Getting enough quality sleep has many benefits including:</p>
        <ul>
            <li>Improved mood and mental health</li>
            <li>Increase in productivity and focus</li>
            <li>Reduction in risk of health problems such as obesity, diabetes, and heart disease</li>
        </ul>
        <p>Make sleep a priority in your life and you'll see the positive effects in all areas of your life.</p>
    </div>

</body>
</html>
