<?php
require_once 'dbconnect.php';

$where="";
// if( !empty($_REQUEST['search']['value']) ) { 
// 	$where.=" WHERE  ( email LIKE '".$_REQUEST['search']['value']."%' ";    
// 	$where.=" OR mobile_number LIKE '".$_REQUEST['search']['value']."%' )";
// }
$totalRecordsSql = "SELECT count(*) as total FROM users $where;";
$stmt = $conn->prepare($totalRecordsSql);
$stmt->execute();
$res = $stmt->fetchAll();
$totalRecords=0;
foreach ($res as $key => $value) {
	$totalRecords = $value['total'];
}
$columns = array( 
	0 =>'user_id', 
	1 => 'name',
	2=> 'email',
    3=>'mobile_number'
);

$sql = "SELECT user_id,name,email,mobile_number";
$sql.=" FROM users $where";

//$sql.=" ORDER BY ". $columns[$_REQUEST['order'][0]['column']]."   ".$_REQUEST['order'][0]['dir']."  LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";

$sql.=" LIMIT ".$_REQUEST['start']." ,".$_REQUEST['length']."   ";

$stmt = $conn->prepare($sql);
$stmt->execute();
$result = $stmt->fetchAll(\PDO::FETCH_ASSOC);
//print_r($result);
$json_data = array(
 "draw"            => intval( $_REQUEST['draw'] ),   
 "recordsTotal"    => intval($totalRecords ),  
 "recordsFiltered" => intval($totalRecords),
 "data"            => $result   // total data array
 );

echo json_encode($json_data);
?>