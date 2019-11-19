<?php
	function get_db_connect(){
		$db = mysqli_connect('localhost','root','','F196083B');
		return $db;
	}
	
	function close_db_connect(){
		if(isset($db)){
			mysqli_close($db);
		}
	}

	function query_all_patients(){
		global $db;
		$sql = 'select * from patient';
		return mysqli_query($db,$sql);
	}

	function find_max_patient_id(){
		global $db;
		$sql = 'SELECT pid FROM `patient` order by pid desc limit 1';
		$result = mysqli_query($db,$sql);
		$max = mysqli_fetch_row($result);
		mysqli_free_result($result);
		return $max[0];
	}

	function query_patient($pid){
		global $db;
		$sql = "select * from patient ";
		$sql .= "where pid ='" . $pid."'";
		return mysqli_query($db,$sql);
	}

	function add_patient($patient){
		global $db;

		$errors = validate_patient($patient);
		if(!empty($errors)){
			return $errors;
		}

		$id = find_max_patient_id()+1??'';
		$sql = "insert into patient (pid, pfname,plname,pgender,pbd,prace,pstatus) ";
		$sql .= 'values (';
		$sql .= "'".$id."',";
		$sql .= "'".strtoupper($patient['fname'])."',";
		$sql .= "'".strtoupper($patient['lname'])."',";
		$sql .= "'".$patient['gender']."',";
		$sql .= "'".$patient['birthday']."',";
		$sql .= "'".$patient['race']."',";
		$sql .= "'".$patient['status']."');";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo fail;
			close_db_connect($db);
			exit;
		}
	}

	function update_patient($patient){
		global $db;

		$errors = validate_patient($patient);
		if(!empty($errors)){
			return $errors;
		}

		$sql = "update patient set ";
		$sql .= "pfname='".strtoupper($patient['fname'])."',";
		$sql .= "plname='".strtoupper($patient['lname'])."',";
		$sql .= "pgender='".$patient['gender']."',";
		$sql .= "pbd='".$patient['birthday']."',";
		$sql .= "prace='".$patient['race']."',";
		$sql .= "pstatus='".$patient['status']."' ";
		$sql .= "where pid='".$patient['id']."' ";
		$sql .= "limit 1;";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo fail;
			close_db_connect($db);
			exit;
		}
	}

	function delete_patient($pid){
		global $db;
		$sql = "delete from patient where pid='" .$pid."' limit 1;";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo fail;
			close_db_connect($db);
			exit;
		}
	}

	function validate_patient($patient){
		$errors = [];
		//name is blank
		if(is_blank($patient['fname'])){
			$errors['fname'] = 'First name cannot be blank!';
		}else if(!lenth_less_than($patient['fname'],20)){
			$errors['fname'] = 'Length must be less than 20 characters!';
		}
		if(is_blank($patient['lname'])){
			$errors['lname'] = 'Last name cannot be blank!';
		}else if(!lenth_less_than($patient['fname'],20)){
			$errors['lname'] = 'Length must be less than 20 characters!';
		}

		//date is invalid
		if(!has_valid_date_format($patient['birthday'])){
			$errors['birthday'] = 'Date format is YYYY-MM-DD!';
		}

		//gender is blank
		if(is_blank($patient['gender'])){
			$errors['gender'] = 'Gender is required!';
		}

		//race is blank
		if(is_blank($patient['race'])){
			$errors['race'] = 'Race is required!';
		}

		//status is blank
		if(is_blank($patient['status'])){
			$errors['status'] = 'Marital status is required!';
		}

		return $errors;
	}
?>