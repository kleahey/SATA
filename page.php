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

    <div class="container" id="wrapper">

      <div class="row header">
        <div class="col-md-9">
          <h1>Solutions Center Wall</h1>
	  <h4>
	      <?php 
		$selected_date = $_POST['dateSelector'];
		print $selected_date;
	      ?>
	  </h4>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <table class="table table-striped table-condensed">
	    <caption>Tickets and Chats</caption>
	      <thead>
		<tr>
		  <td>Name</td>
		  <td>App Tickets</td>
		  <td>Rec Tickets</td>
		  <td>Member Tickets</td>
		  <td>App Chats</td>
		  <td>Rec Chats</td>
		  <td>Member Chats</td>
		</tr>
	      </thead>
	      <tbody>
		<?php
		  $db2 = mysqli_connect("localhost","root","Planet@ry7","SATA") or
                        die ("You are not authorized to access this database.");

                  $ticket_query = "SELECT
				     *
                                   FROM
                                     tickets
				   WHERE
				     date = '$selected_date'
				   AND
				     (app + rec + mem + appchat + recchat + memchat) > 0
                                   ORDER BY
                                     csr ASC";
                   $ticket_result = mysqli_query($db2,$ticket_query);
                   $ticket_details = "";

		   while($ticket_row = mysqli_fetch_array($ticket_result))
                      {
                        $ticket_csr = $ticket_row['csr'];
                        $ticket_app = $ticket_row['app'];
			$ticket_rec = $ticket_row['rec'];
			$ticket_mem = $ticket_row['mem'];
			$ticket_appchat = $ticket_row['appchat'];
			$ticket_recchat = $ticket_row['recchat'];
			$ticket_memchat = $ticket_row['memchat'];

                        $ticket_details .="
                           <tr>
                              <td>$ticket_csr</td>
                              <td>$ticket_app</td>
			      <td>$ticket_rec</td>
			      <td>$ticket_mem</td>
			      <td>$ticket_appchat</td>
			      <td>$ticket_recchat</td>
			      <td>$ticket_memchat</td>
                           </tr>
                        ";
                      }
                print $ticket_details;
                ?>
	      </tbody>
	  </table>
        </div>
      </div>

      <div class="text-center">
        <table class="table table-striped table-condensed">
	   <caption>Scheduled Calls</caption>
	      <thead>
		<tr>
		   <td>Name</td>
		   <td>Number of Calls</td>
		</tr>
	      </thead>
	      <tbody>
		<?php 
			$db = mysqli_connect("localhost","root","Planet@ry7","SATA") or
        			die ("You are not authorized to access this database.");

			 $call_query = "SELECT
					date,
					csr,
					calls
			   	     FROM
					tickets
				     WHERE
					date = '$selected_date' AND calls > 0
				     ORDER BY
					calls DESC";
		      $call_result = mysqli_query($db,$call_query);
		      $call_details = "";

		      while($call_row = mysqli_fetch_array($call_result))
		      {
			$call_csr = $call_row['csr'];
			$call_calls = $call_row['calls'];
			
		        $call_details .="
			   <tr>
			      <td>$call_csr</td>
			      <td>$call_calls</td>
			   </tr>
		     	";
		      }
		print $call_details; 
		?>
	      </tbody>
	</table>
      </div>

      <div class="row">
        <div class="col-md-12 text-center">
          <h3>Trending Issues - October 2016</h3>
	    <div class="row">
	      <div class="col-md-6 text-center">
		<img src="appcatgraph.php">
	      </div>
	      <div class="col-md-6 text-center">
		<img src='appscatgraph.php'>		
	      </div>
	    </div>
	    <div class="row">
              <div class="col-md-6 text-center">
                <img src="reccatgraph.php">
              </div>
              <div class="col-md-6 text-center">
		<img src='recscatgraph.php'>
              </div>
            </div>
	    <div class="row">
              <div class="col-md-6 text-center">
              </div>
              <div class="col-md-6 text-center">
              </div>
            </div>
        </div>
      </div>

    </div>

  </body>

</html>
