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

	//select method
	function query_all_patients(){
		global $db;
		$sql = 'select * from patient';
		return mysqli_query($db,$sql);
	}

	function query_all_hospitals_name(){
		global $db;
		$sql = 'select hname from hospital';
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

	function find_max_physician_id(){
		global $db;
		$sql = 'SELECT phid FROM `physician` order by phid desc limit 1';
		$result = mysqli_query($db,$sql);
		$max = mysqli_fetch_row($result);
		mysqli_free_result($result);
		return $max[0];
	}

	function find_max_hospital_id(){
		global $db;
		$sql = 'SELECT hid FROM `hospital` order by hid desc limit 1';
		$result = mysqli_query($db,$sql);
		$max = mysqli_fetch_row($result);
		mysqli_free_result($result);
		return $max[0];
	}

	function find_hospital_by_name($name){
		global $db;
		$sql = "SELECT hid FROM `hospital` ";
		$sql .= "where hname='" . $name."';";
		$result = mysqli_query($db,$sql);
		$max = mysqli_fetch_row($result);
		mysqli_free_result($result);
		return $max[0];
	}

	function query_all_physicians(){
		global $db;
		$sql = "select * from physician";
		return mysqli_query($db,$sql);
	}

	function query_patient($pid){
		global $db;
		$sql = "select * from patient ";
		$sql .= "where pid ='" . $pid."'";
		return mysqli_query($db,$sql);
	}

	function query_patient_by_name($name){
		//fuzzy search
		global $db;
		$sql = "select * from patient ";
		$sql .= "where pfname like '%" . $name."%' ";
		$sql .= "or plname like '%" . $name. "%';";
		return mysqli_query($db,$sql);
	}

	function query_physician_by_name($name){
		//fuzzy search
		global $db;
		$sql = "select * from physician ";
		$sql .= "where phfname like '%" . $name."%';";
		return mysqli_query($db,$sql);
	}

	function query_hospital_by_name($name){
		//fuzzy search
		global $db;
		$sql = "select * from hospital ";
		$sql .= "where hname like '%" . $name."%';";
		return mysqli_query($db,$sql);
	}

	function query_physician($phid){
		global $db;
		$sql = "select * from physician p join hospital h on p.hid=h.hid ";
		$sql .= "where phid ='" . $phid."'";
		return mysqli_query($db,$sql);
	}

	function query_physician_by_hospital($hid){
		global $db;
		$sql = "select p.phid as phid,p.phfname as phfname,p.phspl as phspl,p.phtel as phtel from hospital h join physician p on p.hid=h.hid ";
		$sql .= "where h.hid ='" . $hid."'";
		return mysqli_query($db,$sql);
	}


	function query_hospital($hid){
		global $db;
		$sql = "select * from hospital ";
		$sql .= "where hid ='" . $hid."'";
		return mysqli_query($db,$sql);
	}

	function query_all_hospitals(){
		global $db;
		$sql = "select * from hospital";
		return mysqli_query($db,$sql);
	}

	//add method
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
		$sql .= "'".db_escape($db,strtoupper($patient['fname']))."',";
		$sql .= "'".db_escape($db,strtoupper($patient['lname']))."',";
		$sql .= "'".db_escape($db,$patient['gender'])."',";
		$sql .= "'".db_escape($db,$patient['birthday'])."',";
		$sql .= "'".db_escape($db,$patient['race'])."',";
		$sql .= "'".db_escape($db,$patient['status'])."');";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo false;
			close_db_connect($db);
			exit;
		}
	}

	function add_physician($physician){
		global $db;

		$errors = validate_physician($physician);
		if(!empty($errors)){
			return $errors;
		}

		$phid = find_max_physician_id()+1??'';
		$hid = find_hospital_by_name($physician['hname']);
		$sql = "insert into physician (phid, phfname,phtel,phspl,hid) ";
		$sql .= 'values (';
		$sql .= "'".db_escape($db,$phid)."',";
		$sql .= "'".db_escape($db,strtoupper($physician['phfname']))."',";
		$sql .= "'".db_escape($db,$physician['phtel'])."',";
		$sql .= "'".db_escape($db,strtoupper($physician['phspl']))."',";
		$sql .= "'".db_escape($db,$hid)."');";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo false;
			close_db_connect($db);
			exit;
		}
	}

	function add_hospital($hospital){
		global $db;

		$errors = validate_hospital($hospital);
		if(!empty($errors)){
			return $errors;
		}

		$hid = find_max_hospital_id()+1??'';
		$sql = "insert into hospital (hid, hname,hst_address,hst_city,hstate,hzip) ";
		$sql .= 'values (';
		$sql .= "'".db_escape($db,$hid)."',";
		$sql .= "'".db_escape($db,strtoupper($hospital['hname']))."',";
		$sql .= "'".db_escape($db,strtoupper($hospital['hst_address']))."',";
		$sql .= "'".db_escape($db,strtoupper($hospital['hst_city']))."',";
		$sql .= "'".db_escape($db,strtoupper($hospital['hstate']))."',";
		$sql .= "'".db_escape($db,$hospital['hzip'])."');";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo false;
			close_db_connect($db);
			exit;
		}
	}

	function insert_physician_user($puser){
		global $db;
		$password = password_hash($puser['password'], PASSWORD_DEFAULT);
		$sql = "insert into physician_user (username,hashed_password) ";
		$sql .= "values (";
		$sql .= "'".db_escape($db,$puser['username'])."',";
		$sql .= "'".db_escape($db,$password)."');";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			close_db_connect($db);
			return false;
			exit;
		}
	}

	function insert_admin_user($puser){
		global $db;
		$password = password_hash($puser['password'], PASSWORD_DEFAULT);
		$sql = "insert into admins (username,hashed_password) ";
		$sql .= "values (";
		$sql .= "'".db_escape($db,$puser['username'])."',";
		$sql .= "'".db_escape($db,$password)."');";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			close_db_connect($db);
			return false;
			exit;
		}
	}


	//update
	function update_patient($patient){
		global $db;

		$errors = validate_patient($patient);
		if(!empty($errors)){
			return $errors;
		}

		$sql = "update patient set ";
		$sql .= "pfname='".db_escape($db,strtoupper($patient['fname']))."',";
		$sql .= "plname='".db_escape($db,strtoupper($patient['lname']))."',";
		$sql .= "pgender='".db_escape($db,$patient['gender'])."',";
		$sql .= "pbd='".db_escape($db,$patient['birthday'])."',";
		$sql .= "prace='".db_escape($db,$patient['race'])."',";
		$sql .= "pstatus='".db_escape($db,$patient['status'])."' ";
		$sql .= "where pid='".db_escape($db,$patient['id'])."' ";
		$sql .= "limit 1;";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo false;
			close_db_connect($db);
			exit;
		}
	}

	function update_physician($physician){
		global $db;

		$errors = validate_physician($physician);
		if(!empty($errors)){
			return $errors;
		}
		$hid = find_hospital_by_name($physician['hname']);
		$sql = "update physician set ";
		$sql .= "phfname='".db_escape($db,strtoupper($physician['phfname']))."',";
		$sql .= "phtel='".db_escape($db,$physician['phtel'])."',";
		$sql .= "phspl='".db_escape($db,$physician['phspl'])."',";
		$sql .= "hid='".db_escape($db,$hid)."' ";
		$sql .= "where phid='".db_escape($db,$physician['phid'])."' ";
		$sql .= "limit 1;";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo $sql;
			close_db_connect($db);
			exit;
		}
	}

	function update_hospital($hospital){
		global $db;

		$errors = validate_hospital($hospital);
		if(!empty($errors)){
			return $errors;
		}
		$sql = "update hospital set ";
		$sql .= "hname='".db_escape($db,strtoupper($hospital['hname']))."',";
		$sql .= "hst_address='".db_escape($db,strtoupper($hospital['hst_address']))."',";
		$sql .= "hst_city='".db_escape($db,strtoupper($hospital['hst_city']))."',";
		$sql .= "hstate='".db_escape($db,strtoupper($hospital['hstate']))."',";
		$sql .= "hzip='".db_escape($db,$hospital['hzip'])."' ";
		$sql .= "where hid='".db_escape($db,$hospital['hid'])."' ";
		$sql .= "limit 1;";
		$result = mysqli_query($db,$sql);
		if($result){
			return true;
		}else{
			echo $sql;
			close_db_connect($db);
			exit;
		}
	}


	//...............delete
	function delete_patient($pid){
		global $db;
		try{
			$sql = "delete from patient where pid='" .db_escape($db,$pid)."' limit 1;";
			$result = mysqli_query($db,$sql);
			if($result){
				return true;
			}else{
				return false;
				close_db_connect($db);
				exit;
			}

		}
		catch(mysqli_sql_exception $e){
			return fasle;
		}
	}

	function delete_physician($pid){
		global $db;
		try{
			$sql = "delete from physician where phid='" .db_escape($db,$pid)."' limit 1;";
			$result = mysqli_query($db,$sql);
			if($result){
				return true;
			}else{
				return false;
				close_db_connect($db);
				exit;
			}

		}catch (mysqli_sql_exception $e){
			return false;
		}
	}

	function delete_hospital($hid){
		global $db;
		try{
			$sql = "delete from `hospital` where hid='" .db_escape($db,$hid)."' limit 1;";
			$result = mysqli_query($db,$sql);
			if($result){
				return true;
			}else{
				return false;
				close_db_connect($db);
				exit;
			}
		}catch (mysqli_sql_exception $e){
			return false;
		}
		
		
	}

	// validate
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

		//status is blank
		if(is_blank($patient['status'])){
			$errors['status'] = 'Marital status is required!';
		}

		return $errors;
	}

	function validate_physician($physician){
		$errors = [];
		//name is blank
		if(is_blank($physician['phfname'])){
			$errors['phfname'] = 'Name cannot be blank!';
		}else if(!lenth_less_than($physician['phfname'],20)){
			$errors['phfname'] = 'Length must be less than 20 characters!';
		}

		//hospital name is wrong
		global $db;
		$sql = "select count(*) from hospital ";
		$sql .= "where hname = '" . strtoupper($physician['hname'])."';";
		$count = mysqli_fetch_row(mysqli_query($db,$sql));
		if($count[0] < 1){
			$errors['hname'] = 'Hospital is not existed! Input a correct name!';
		}
		

		//race is blank
		if(is_blank($physician['phspl'])){
			$errors['phspl'] = 'Field is required!';
		}

		//date is invalid
		if(!has_valid_phone_format($physician['phtel'])){
			$errors['phtel'] = 'Wrong phone number format! xxx-xxx-xxxx is required!';
		}
		close_db_connect($db);
		return $errors;
	}

	function validate_hospital($hospital){
		$errors = [];
		//name is blank
		if(is_blank($hospital['hname'])){
			$errors['hname'] = 'Name cannot be blank!';
		}else if(!lenth_less_than($hospital['hname'],30)){
			$errors['hname'] = 'Length must be less than 30 characters!';
		}

		//address is blank
		if(is_blank($hospital['hst_address'])){
			$errors['hst_address'] = 'Field is required!';
		}else if(!lenth_less_than($hospital['hst_address'],30)){
			$errors['hst_address'] = 'Length must be less than 30 characters!';
		}

		//city is blank
		if(is_blank($hospital['hst_city'])){
			$errors['hst_city'] = 'Field is required!';
		}else if(!lenth_less_than($hospital['hst_city'],30)){
			$errors['hst_city'] = 'Length must be less than 30 characters!';
		}

		//state is blank
		if(is_blank($hospital['hstate'])){
			$errors['hstate'] = 'Field is required!';
		}else if(!lenth_less_than($hospital['hstate'],20)){
			$errors['hstate'] = 'Length must be less than 20 characters!';
		}

		//zipcode is invalid
		if(!has_valid_zip_format($hospital['hzip'])){
			$errors['hzip'] = 'Zipcode must be 5 digits!';
		}
		return $errors;
	}

	//verify user identification
	function verify_physician_user($user){
		global $db;
		try{
			$sql = "select * from `physician_user` where username='" .db_escape($db,$user['username'])."' limit 1;";
			$result = mysqli_fetch_assoc(mysqli_query($db,$sql));
			if($result){
				if(password_verify($user['password'], $result['hashed_password'])){
					return true;
				}else{
					return false;
				}
			}else{
				close_db_connect($db);
				return false;
				exit;
			}
		}catch (mysqli_sql_exception $e){
			return false;
		}
	}

	function verify_admin_user($user){
		global $db;
		try{
			$sql = "select * from `admins` where username='" .db_escape($db,$user['username'])."' limit 1;";
			$result = mysqli_fetch_assoc(mysqli_query($db,$sql));
			if($result){
				if(password_verify($user['password'], $result['hashed_password'])){
					return true;
				}else{
					return false;
				}
			}else{
				close_db_connect($db);
				return false;
				exit;
			}
		}catch (mysqli_sql_exception $e){
			return false;
		}
	}
?>