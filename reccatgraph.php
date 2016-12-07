<?php // content="text/plain; charset=utf-8"
require_once ('/var/www/html/moodle/BB/jpgraph/src/jpgraph.php');
require_once ('/var/www/html/moodle/BB/jpgraph/src/jpgraph_bar.php');

$datay=array(2872,1018,979,932,816,427);
$xaxisarr=array('Uploading Documents','Question About App','Account Access','Students','Submitting Form','Question from Applicant');

// Create the graph. These two calls are always required
$graph = new Graph(500,300);
$graph->SetScale('textlin');
$graph->xaxis->SetTickLabels($xaxisarr);
$graph->xaxis->SetLabelAngle(30);

// Add a drop shadow
$graph->SetShadow();

// Adjust the margin a bit to make more room for titles
$graph->SetMargin(80,20,10,100);

// Create a bar pot
$bplot = new BarPlot($datay);

// Add the bar plot to the graph and display bar values
$graph->Add($bplot);
$bplot->value->SetFormat('%01.0f');
$bplot->value->Show();  

// Adjust the fill color
$bplot->SetFillColor('#981a36');

// Setup the titles
$graph->title->Set('Recommender Categories');

$graph->title->SetFont(FF_FONT1,FS_BOLD);
$graph->yaxis->title->SetFont(FF_FONT1,FS_BOLD);
$graph->xaxis->title->SetFont(FF_FONT1,FS_BOLD);

// Display the graph
$graph->Stroke();
?>
