<?php
include_once("./conection/conexao.php");

function parseToXML($htmlStr){
	$xmlStr=str_replace('<','&lt;',$htmlStr);
	$xmlStr=str_replace('>','&gt;',$xmlStr);
	$xmlStr=str_replace('"','&quot;',$xmlStr);
	$xmlStr=str_replace("'",'&#39;',$xmlStr);
	$xmlStr=str_replace("&",'&amp;',$xmlStr);
	return $xmlStr;
}

// Select all the rows in the markers table
$result_markers = $conn->query("SELECT * FROM markers");

header("Content-type: text/xml");

// Start XML file, echo parent node
echo '<markers>';

// Iterate through the rows, printing XML nodes for each
while ($row_markers = $result_markers->fetch(PDO::FETCH_ASSOC)){
  // Add to XML document node
  echo '<marker ';
  echo 'name="' . parseToXML($row_markers['name']) . '" ';
  echo 'address="' . parseToXML($row_markers['address']) . '" ';
  echo 'lat="' . $row_markers['lat'] . '" ';
  echo 'lng="' . $row_markers['lng'] . '" ';
  echo '/>';
}

// End XML file
echo '</markers>';