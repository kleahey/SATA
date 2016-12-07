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

	<div class="col-md-2 col-md-offset-5 text-center"></br></br>
		<!-- The data encoding type, enctype, MUST be specified as below -->
		<form enctype="multipart/form-data" action="fileupload.php" method="POST">
			<div class="form-group">
    			<!-- MAX_FILE_SIZE must precede the file input field -->
    			<label for="inputFile">Send this file:</label>
			<input type="hidden" name="MAX_FILE_SIZE" value="30000" />
    			<!-- Name of input element determines name in $_FILES array -->
    			<input type="file" id="inputFile" name="userfile" />
			<p class="help-block">The system will only accept .CSV files up to 300kb.</p>
			</div>
    			<input type="submit" class="btn btn-default" value="Send File" />
		</form>
	</div>
	</div>
   </body>
</html>
