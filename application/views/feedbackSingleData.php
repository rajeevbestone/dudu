<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>
<body>
    

<style>
    .container {
  max-width: 800px;
  margin: 0 auto;
}
table, th, td {
  border: 1px solid #383838;
  
}
table {
  border-collapse: collapse;
  width: 100%;
}

th, td {
  padding: 8px;
  text-align: left;
  border-bottom: 1px solid #383838;
}

th {
  background-color: #f2f2f2;
  font-weight: bold;
}

tbody tr:nth-child(even) {
  background-color: #f2f2f2;
}

tbody tr:hover {
  background-color: #ddd;
}
.container {
    padding-right: 2px !important;
    padding-left: 2px !important;}
	
	
	
	
	
@media only screen and (max-width: 600px) {
 th {
    background-color: #000;
	color:#fff;
    font-weight: bold;
    text-align: center !important;
}
th, td {
    padding: 0px !important;
    text-align: center !important;
    border-bottom: 1px solid #ffffff47;
	background-color: #000;
	color:#fff;
}
table {
  border-collapse: collapse;
  width: 100%;
}

body {
    font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
    font-size: 14px;
    line-height: 1.42857143;
    color: #333;
    background-color: #000;
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
<!-- Back button element -->
<a href="<?php echo base_url('feedbackData');?>" class="back-button">&#8249;</a><br><br><br><br>
<div class="container">
  <table>
    <thead>
      <tr>
        <th>Date</th>
        <th>Program 1</th>
        <th>Duration 1</th>
        <th>Program 2</th>
        <th>Duration 2</th>
        <th>Day</th>
        <th>Total Slept</th>
        <th>Cycle Count</th>
      </tr>
    </thead>
    <tbody id="feedback-table">
    </tbody>
  </table>
</div>



<script>
    const feedbackData = [  {    "forDate": "2023-02-26",    "program_1": "C/Yellow",    "duration_1": "10 minutes",    "program_2": "D/Red",    "duration_2": "20 minutes",    "day": "February",    "totalSlept": 16,    "cycleCount": 22  },  {    "forDate": "2023-02-27",    "program_1": "C/Yellow",    "duration_1": "10 minutes",    "program_2": "D/Red",    "duration_2": "20 minutes",    "day": "February",    "totalSlept": 16,    "cycleCount": 22  },  {    "forDate": "2023-03-01",    "program_1": "C/Yellow",    "duration_1": "10 minutes",    "program_2": "D/Red",    "duration_2": "20 minutes",    "day": "March",    "totalSlept": 16,    "cycleCount": 22  }];

const tableBody = document.getElementById('feedback-table');

feedbackData.forEach(feedback => {
  const tableRow = document.createElement('tr');
  
  tableRow.innerHTML = `
    <td>${feedback.forDate}</td>
    <td>${feedback.program_1}</td>
    <td>${feedback.duration_1}</td>
    <td>${feedback.program_2}</td>
    <td>${feedback.duration_2}</td>
    <td>${feedback.day}</td>
    <td>${feedback.totalSlept}</td>
    <td>${feedback.cycleCount}</td>
  `;
  
  tableBody.appendChild(tableRow);
});

</script>



</body>
</html>