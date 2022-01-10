<?php

use App\Core\ClassDb;

function masterData($table, $id, $field ='name' )
{

 	$data = (new ClassDb())->getDataFromId($table, $id);
 	if(!empty($data)){
 		if($field == 'all' || $field == ''){return $data;}
 		return $data[$field];
 	}

 	return "Data Not found";
}

function readAbleDate($date)
{
    return date('jS M Y [ d-m-Y ]', $date);
}

function readAbleTime($date)
{
    return date('jS-M-Y [ d-m-Y  H:i:s ]', $date);
}

?>