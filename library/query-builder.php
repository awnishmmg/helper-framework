<?php 

function insert_batch($tablename,$extra=[]){
	global $con;

	$tmp_data=[];

	$tmp_data[]='NULL';

	foreach($_REQUEST as $names => $value){

		if(strtolower($names)=='submit'){
			continue;
		}else{
			// echo $names.'='.$value.'<br/>';
			$tmp_data[]=$value;
		}
	
	}//end for

	if(count($extra)>0){

		foreach($extra as $index => $extra_value){
			$tmp_data[] = $extra_value;
		}
		
	}

	// echo '<pre>';
	// 	print_r($tmp_data);

	$col_values=implode("','",$tmp_data);
	$sql = "INSERT INTO $tablename VALUES('$col_values');";

	//echo $sql;
	if(mysqli_query($con,$sql)){

	$count = mysqli_affected_rows($con);
	if($count>0){
		return true;
	}else{

		return false;
	}

	}else
	{
		echo 'Insert Error'.mysqli_error($con);
		exit;
	}
}

function insertat($tablename,$formdata){
global $con;

// print_r($formdata);
// exit;

$columns=array_keys($formdata);
$values = array_values($formdata);

#print_r($columns);
#print_r($values);

#exit();

$columns=implode(",",$columns);

$values=implode("','",$values);



$sql = "INSERT INTO $tablename($columns) VALUES('$values');";

// echo $sql;

if(mysqli_query($con,$sql)){

	$count = mysqli_affected_rows($con);
	if($count>0){
		return true;
	}else{

		return false;
	}
}else
{
	echo 'Insert Error'.mysqli_error($con);
	exit;
}

}

function getall(string $tablename){

	global $con;

	if($tablename==''){
			die('Table-name cannot be null');
	}

	$sql = "SELECT * FROM $tablename";

	//echo $sql;

	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		// /echo 'No Record Found';
		return [false];
	}

} #select * from table_name


function select(string $tablename,$columns='',$condition=[],$sep='AND'){

	global $con;

	if($columns==''){
		$columns_names='*';

	}else{
		$columns_names = implode(',',$columns);
	}
	if(count($condition)<=0){
		$condition='';
	}

	//print_r($cond_columns);

	$query='';
	foreach($condition as $columns => $values_operator){

		$query=$query.$columns;

		foreach($values_operator as $index => $values){

			
			if($index==0){
				$query=$query.$values;
			}else{
				$query=$query."'".$values."'";
			}

		}
		$query=$query." $sep ";



	}

	#echo $query;

	if($sep=='AND'){
		$newquery=substr($query,0,-4);
		$newquery=trim($newquery).';';
	}else{
		$newquery=substr($query,0,-3);
		$newquery=trim($newquery).';';
	}
	
	//echo $newquery;
	//exit();
	$sql = "SELECT $columns_names FROM ";


	$sql=$sql.$tablename." where ".$newquery;
	//echo $sql;
	//exit;


	$result_set=mysqli_query($con,$sql);
	@$count=@mysqli_num_rows(@$result_set);
	if($count>0){

		while($row=mysqli_fetch_assoc($result_set)){

			$data[]=$row;

		}
		return $data;

	}else{
		//echo 'No Record Found';
		return [false];
	}

}

function delete($tablename,$columns_id=[]){
	global $con;
	if(count($columns_id)<=0){
		echo 'id cannot be Blank';
		exit();
	}
	$where='';
	$sql = "DELETE FROM $tablename where ";
	foreach ($columns_id as $columns => $value) {
		$where=$where.$columns."='".$value."' AND ";
	}
	$new_where = substr($where,0,-4);
	$sql = $sql.$new_where;

	$sql=trim($sql).';';

	if(mysqli_query($con,$sql)){

			$count = mysqli_affected_rows($con);
			if($count>0){
				return true;
			}else{

				return false;
			}

	}else{

	echo 'delete Error'.mysqli_error($con);
	exit;
}

}


function update($tablename,$sets=[],$match_columns=[]){

	global $con;

	if(count($sets)<=0 or count($match_columns)<=0){

		echo 'set the columns name and unique columns';
		exit;
	}

	$setstr = '';

	$sql = "UPDATE $tablename SET ";
	foreach($sets as $columns =>$value){

		$setstr=$setstr.$columns."='".$value."',";

	}

	$newsetstr = substr($setstr,0,-1);

	$where ='';

	$sql = "UPDATE $tablename SET ";
	foreach($match_columns as $columns =>$value){

		$where=$where.$columns."='".$value."' AND ";

	}

	$new_where = substr($where,0,-4);
	//$newwhere = substr($where,0,-1);
	$sql=$sql.$newsetstr.' WHERE '.trim($new_where).';';
	//echo $sql;
	if(mysqli_query($con,$sql)){

			$count = mysqli_affected_rows($con);
			if($count>0){
				return true;
			}else{

				return false;
			}

	}else{

	echo 'update Error'.mysqli_error($con);
	exit;
}


}

function getone(string $tablename,$id_columns=[]){

	global $con;

	if($tablename==''){

		echo 'table name cannot be blank';

	}

	if(count($id_columns)<=0){

		echo 'invalid id supplied';
	}

	$sql = "SELECT * FROM $tablename WHERE ";

	#echo $sql;

	$where='';
	foreach ($id_columns as $columns => $value) {
		$where = $where . $columns ."='".$value."' AND ";	
	}

	$new_where = substr($where,0,-4);

	$sql=$sql.trim($new_where).';';
	//echo $sql;

	$result_set=mysqli_query($con,$sql);
	@$count=@mysqli_num_rows(@$result_set);
	if($count>0){

		while($row=mysqli_fetch_assoc($result_set)){

			$data[]=$row;

		}
		return $data[0];

	}else{
		//echo 'No record Found';
		return [false];
	}


	
} #select * from table_name


function delete_batch($tablename,$id_column,$ids_arr=[]){
	global $con;
	if(count($ids_arr)<=0){
		echo 'id cannot be Blank';
		exit();
	}

	$ids = implode("','",$ids_arr);

	$sql = "DELETE FROM $tablename where $id_column IN ('".$ids."');";
	//echo $sql;
	if(mysqli_query($con,$sql)){

			$count = mysqli_affected_rows($con);
			if($count>0){
				return true;
			}else{

				return false;
			}

	}else{

	echo 'delete Error'.mysqli_error($con);
	exit;
}

}

function doexist($tablename,$cols_values){
		$columns=array_keys($cols_values);

		$data=select($tablename,$columns,$cols_values);
		$check = isset($data) ? $data : [];
		if($check[0]==false){
			return false;
		}else{
			return true;
		}
}

# Below is the Query for Joins
# This Query Builder Pattern will Only work if the Condition both have same column
# name schema

function join2($joins_params,$on_columns){
	global $con;

	$tables_arr=explode('|',$joins_params);
	//print_r($tables_arr);

	$first_table = $tables_arr[0];
	$second_table = end($tables_arr);

	$first_arr=explode('=',$first_table);
	$second_arr=explode('=',$second_table);

	$tabel_1 = $first_arr[0];
	$tabel_2 = $second_arr[0];

	// $columns = $first_arr[1].','.$second_arr[1];

	$col1=explode(',',$first_arr[1]);
	$col2=explode(',',$second_arr[1]);

	$field_1 ='';
	foreach($col1 as $index => $value){
		$field_1=$field_1.$tabel_1.'.'."$value,";
	}
	//echo $field_1;


	$field_2 ='';
	foreach($col2 as $index => $value){
		$field_2=$field_2.$tabel_2.'.'."$value,";
	}
	$select_columns=$field_1.$field_2;

	$select_columns=substr($select_columns,0,-1);
	//echo $select_columns;
	$sql = "SELECT $select_columns FROM $tabel_1 INNER JOIN $tabel_2 USING ($on_columns)";

	//echo $sql;

	$result_set=mysqli_query($con,$sql);
	@$count = @mysqli_num_rows(@$result_set);

	// echo $count;
	// exit;

	if($count>0){

		while ($row=mysqli_fetch_assoc($result_set)) {
			
			$data[]=$row;
		}

		return $data;

	}else{

		//echo 'No Record Found';
		return [false];
	}


}



?>