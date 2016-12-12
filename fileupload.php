<html>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Solutions Center Wall</title>

    <!-- Bootstrap -->

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="page.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

   </head>

  <body>
	<div class="container">
  	<div class="row header">
          <div class="col-md-12">
            <h1 style="margin-top:20px;margin-bottom:20px;">Solutions Center Wall</h1>
	    </br>
          </div>
  	</div>
  </div>

  <div class="container">
  <div class="col-md-6 col-md-offset-3">
  <div class="alert alert-warning alert-dismissible" role="alert" style="margin-top:25px;margin-bottom:25px;">
  <?php

  //Connect to the database
  $db = mysqli_connect("localhost","root","Planet@ry7","SATA") or
                          die ("You are not authorized to access this database.");

  //Grab the temporary uploaded file from date.php
  $file = $_FILES['userfile']['tmp_name'];

  //Ensure that a file was actually selected for upload
  if (($handle = fopen($file, "r")) === FALSE) {
    echo "You must select a file to upload!";

  //Begin the data import from the CSV file
  } else if (($handle = fopen($file, "r")) !== FALSE) {
    $count = 0;
        while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    	      $count++;
    	      if($count > 1) {
              $sql = "INSERT INTO tickets ( date, csr, app, rec, mem, appchat, recchat, memchat, calls)
    		        VALUES (
    		            '".mysqli_real_escape_string($db,$data[0])."',
    		              '".mysqli_real_escape_string($db,$data[1])."',
    		                '".mysqli_real_escape_string($db,$data[2])."',
    		                  '".mysqli_real_escape_string($db,$data[3])."',
    		                    '".mysqli_real_escape_string($db,$data[4])."',
    		                      '".mysqli_real_escape_string($db,$data[5])."',
    		                        '".mysqli_real_escape_string($db,$data[6])."',
    		                          '".mysqli_real_escape_string($db,$data[7])."',
    		                            '".mysqli_real_escape_string($db,$data[8])."'
    		                              )";

    	         $query = mysqli_query($db, $sql);

               if(!$query){
                 echo die(mysqli_error($db));
    	         }
            }
         }
         if (mysqli_affected_rows($db) > 0) {
           echo "Success!";
         } else {
           echo "Fail";
         }
     fclose($handle);
  }

  ?>

  </div>
  </div>
  </div>

	<div class="container-fluid">
	<div class="col-md-2 col-md-offset-5 text-center">
	   <form action="page.php" method="post" role="form" id="dateForm">
	     <label for="date" class="control-label">Select the Date</label>
             <select class="form-control" id="dateSelector" name="dateSelector">
              <?php
                 $db1 = mysqli_connect("localhost","root","Planet@ry7","SATA") or
                        die ("You are not authorized to access this database.");

                 $date_query = "SELECT
                                  date
                                FROM
                                  tickets
                                GROUP BY
                                  date
                                ORDER BY
                                  date DESC
				                        LIMIT
				                          7";
                 $date_result = mysqli_query($db1,$date_query);
                 $date_details = "";
		 $value_num = 0;

                 while($date_row = mysqli_fetch_array($date_result))
                      {
                        $date = $date_row['date'];

                        $date_details .="
                           <option value=$date>$date</option>
                        ";
                      }
                print $date_details;
              ?>
             </select>
             <p>
               <button type="submit" class="btn btn-default btn-sm" value="Submit" id="dateButton">Choose Date</button>
             </p>
	   </form>
        </div>
     </div>
     </body>
</html>
