<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Line Chart Example</title>
    
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
		
		
		@media only screen and (max-width: 600px) {
            .chart-container {
                height: 400px; 
                width: 100%;
                margin: 0 auto;
                background-color:#000 !important;
            }
        }

        .rating {
  display: flex;
  justify-content: center;
}

.rating {
  display: flex;
  flex-direction: row-reverse;
  justify-content: center;
  align-items: center;
}

.rating input[type="radio"] {
  display: none;
}

.rating label {
  font-size: 25px;
  color: gray;
  cursor: pointer;
  margin-right: 5px;
}

.rating label:before {
  content: "\2605";
}

.rating input[type="radio"]:checked ~ label {
  color: #FFD700;
}

button[type="submit"] {
  background-color: #4CAF50;
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 10px;
}

button[type="submit"]:hover {
  background-color: #3e8e41;
}

@media (max-width: 768px) {
  .rating label {
    font-size: 20px;
  }
  
  button[type="submit"] {
    padding: 8px 16px;
  }
}

@media (max-width: 480px) {
  .rating label {
    font-size: 16px;
  }
  
  button[type="submit"] {
    padding: 6px 12px;
  }
}



/* explanation */

article {
  background-color:#ffe;
  box-shadow:0 0 1em 1px rgba(0,0,0,.25);
  color:#006;
  font-family:cursive;
  font-style:italic;
  margin:4em;
  max-width:30em;
  padding:2em;
}
       
</style>
</head>
<body>
        <br>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-6">
                <a href="<?php echo base_url('feedbackHistory');?>"><button class="btn btn-primary bt-lg">History</button></a>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-6">
                <a href="<?php echo base_url('feedbackSuggestion');?>"><button class="btn btn-danger bt-lg">Suggestion</button></a>
            </div>
        </div>
    </div>

    <br><br>
    <div class="chart-res">
        <div class="chart-container">
            <canvas id="myChart1"></canvas>
        </div>
    </div>

    <!-- Rating System Yaha Rahega Aman Bhai -->
    <div class="rating">
    <form>
  <div class="rating">
    <input type="radio" id="star5" name="rating" value="5" />
    <label for="star5" title="5 stars"></label>
    <input type="radio" id="star4" name="rating" value="4" />
    <label for="star4" title="4 stars"></label>
    <input type="radio" id="star3" name="rating" value="3" />
    <label for="star3" title="3 stars"></label>
    <input type="radio" id="star2" name="rating" value="2" />
    <label for="star2" title="2 stars"></label>
    <input type="radio" id="star1" name="rating" value="1" />
    <label for="star1" title="1 star"></label>
  </div>
  <button type="submit">Submit</button>
</form>

</div>

    <!-- End of Rating System -->    
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/2.2.1/chartjs-plugin-annotation.min.js" integrity="sha512-qF3T5CaMgSRNrxzu69V3ZrYGnrbRMIqrkE+OrE01DDsYDNo8R1VrtYL8pk+fqhKxUBXQ2z+yV/irk+AbbHtBAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    // const labels = [9, 10, 11, 12 ,13];

    

const labels = [9, 10, 11, 12, 13];
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
  { x: 14, y: 1 },
  { x: 14, y: 2 },
  { x: 14.5, y: 2 },
  { x: 14.5, y: 3 },
  { x: 15, y: 3 },
  { x: 15, y: 5 },
  { x: 15.3, y: 5 },
  { x: 15.3, y: 3 },
  { x: 15.5, y: 3 },
  { x: 15.5, y: 2 },
  { x: 16, y: 2 },
  { x: 16, y: 1 },
  { x: 19, y: 1 },
  { x: 19, y: 2 },
  { x: 19.5, y: 2 },
  { x: 19.5, y: 3 },
  { x: 20, y: 3 },
  { x: 20, y: 5 },
  { x: 20.5, y: 5},
  { x: 20.5, y: 6},
  { x: 21.3, y: 6},
];

const ctx = document.getElementById('myChart1').getContext('2d');

const chart = new Chart(ctx, {
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
    },
    plugins: {
      annotation: {
        annotations: {
          box1: {
            type: 'box',
            xMin: 11,
            xMax: 14,
            yMin: 0.3,
            yMax: 0.7,
            backgroundColor: 'yellow',
            borderColor: 'red',
            borderWidth: 2,
            borderRadius: 10,
            padding: 10,
            cornerRadius: 10
          },
          box2: {
            type: 'box',
            xMin: 16,
            xMax: 19,
            yMin: 0.3,
            yMax: 0.7,
            backgroundColor: 'orange',
            borderColor: 'red',
            borderWidth: 2,
            borderRadius: 10,
            padding: 10,
            cornerRadius: 10
          }
        }
      }
    }
  }
});



    

</script>

<script>
  $(document).ready(function(){
    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');

ratingInputs.forEach((input) => {
  input.addEventListener('change', () => {
    console.log('Selected rating:', input.value);
  });
});
  });
</script>

</body>
</html>
