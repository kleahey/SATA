<?php

$db = mysqli_connect("localhost","root","Planet@ry7","SATA") or
                        die ("You are not authorized to access this database.");

$file = $_FILES['userfile']['tmp_name'];
 
if (($handle = fopen($file, "r")) !== FALSE) {
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
            echo die(mysqli_error($db);
	}
	}
    }
    fclose($handle);
}
?>
