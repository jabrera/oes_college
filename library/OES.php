<?php
class OES {
	protected $loggedID;
	
	function loggedUser($loggedID) {
		$this->loggedID = $loggedID;
	}

	function getID($username) {
		$x = "";
		$query = mysql_query("SELECT * FROM Account WHERE Username = '$username'");
		while($row = mysql_fetch_array($query)) {
			$x = $row["ID"];
		}
		return $x;
	}

	function getLoggedUserInfo($column) {
		$x = "";
		$query = mysql_query("SELECT $column FROM Account WHERE ID = '{$this->loggedID}'");
		while($row = mysql_fetch_array($query)) {
			$x = $row[$column];
		}
		return $x;
	}

	function getUserInfo($column, $id) {
		$x = "";
		$query = mysql_query("SELECT $column FROM Account WHERE ID = '$id'");
		while($row = mysql_fetch_array($query)) {
			$x = $row[$column];
		}
		return $x;
	}

	function getNameFormat($format, $id) {
		$x = $format;
		$formats = "FfMmLl";
		for($i = 0; $i < strlen($formats); $i++) {
			$temp = substr($formats, $i, 1);
			$x = str_replace($temp, '{'.$temp.'}', $x);
		}
		$type = $this->getSingleData("Account", "Type", "ID = '$id'");
		if($type == "Student")
			$query = mysql_query("SELECT FirstName, MiddleName, LastName FROM Student WHERE ID = '$id'");
		elseif($type == "Faculty")
			$query = mysql_query("SELECT FirstName, MiddleName, LastName FROM Faculty WHERE ID = '$id'");
		while($row = mysql_fetch_array($query)) {
			$x = str_replace("{f}", $row["FirstName"], $x);
			$x = str_replace("{m}", $row["MiddleName"], $x);
			$x = str_replace("{l}", $row["LastName"], $x);
			$x = str_replace("{F}", substr($row["FirstName"], 0, 1), $x);
			$x = str_replace("{M}", substr($row["MiddleName"], 0, 1), $x);
			$x = str_replace("{L}", substr($row["LastName"], 0, 1), $x);
		}
		return $x;
	}

	function generateAccountID() {
		$id = "";
		$sy = $this->getSchoolYear();
		$query = mysql_query("SELECT * FROM Account WHERE ID LIKE '$sy%' ORDER BY ID DESC LIMIT 1");
		$n = 0;
		while($row = mysql_fetch_array($query)) {
			$n = 1;
			$id = $row["ID"]+1;
			break;
		}
		if($n == 0)
			$id = $sy."00001";
		return $id;
	}

	function generateUsername($id, $fname, $mname, $lname) {
		return substr($lname, 0, 1).substr($fname, 0, 1).substr($mname, 0, 1).substr($id, -6);
	}

	/*
	For >= PHP 5.3
	function getAge($birthDate) {
		$birthDate = new DateTime($birthDate);
		$now = new DateTime();
		$int = $now->diff($birthDate);
		return $int->y;
	}
	*/

	/*
	For < PHP 5.3
	*/
	function getAge($birthDate) {
		return date_diff(date_create($birthDate), date_create('now'))->y;
	}

	function getProfilePicture($id) {
		$profpic = "images/users/$id.jpg";
		if(!file_exists($profpic))
			$profpic = "images/users/unknown.jpg";
		return $profpic;
	}

	function getSingleData($table, $column, $where) {
		$x = "";
		$query = mysql_query("SELECT $column FROM $table WHERE $where");
		while($row = mysql_fetch_array($query)) {
			$x = $row[$column];
			break;
		}
		return $x;
	}

	function getRow($table, $columns, $additional) {
		$x = array();
		$queryString = "";
		if($columns == "*") {
			$queryString .= "SELECT * ";
			$columns = array();
			$temp_table = explode(" INNER JOIN ", $table);
			foreach($temp_table as $t) {
				$query = mysql_query("SHOW COLUMNS FROM $t");
				while($row = mysql_fetch_array($query)) {
					$columns[] = $row["Field"];
				}
			}
		} elseif(strpos(",", $columns)) {
			$queryString .= "SELECT $columns ";
			$columns = explode(",", str_replace(" ", "", $columns));
		}
		$queryString .= "FROM $table";
		if($additional != "")
			$queryString .= " WHERE $additional";
		$query = mysql_query($queryString);
		while($row = mysql_fetch_array($query)) {
			foreach($columns as $column)
				$x[$column] = $row[$column];
			break;
		}
		return $x;
	}

	function getData($table, $columns, $additional) {
		$x = array();
		$queryString = "";
		$tables = explode(" INNER JOIN ", $table);
		if($columns == "*") {
			$queryString .= "SELECT * ";
			$columns = array();
			foreach($tables as $t) {
				$query = mysql_query("SHOW COLUMNS FROM $t");
				while($row = mysql_fetch_array($query)) {
					$columns[] = $row["Field"];
				}
			}
		} elseif(strpos(",", $columns)) {
			$queryString .= "SELECT $columns ";
			$columns = explode(",", str_replace(" ", "", $columns));
		}
		$queryString .= "FROM $table";
		if($additional != "")
			$queryString .= " WHERE $additional";
		$query = mysql_query($queryString);
		$i = 0;
		while($row = mysql_fetch_array($query)) {
			foreach($columns as $column)
				$x[$i][$column] = $row[$column];
			$i++;
		}
		return $x;
	}

	function getColleges() {
		$x = array();
		$query = mysql_query("SELECT * FROM College");
		$i = 0;
		while($row = mysql_fetch_array($query)) {
			$x[$i]["ID"] = $row["ID"];
			$x[$i]["Name"] = $row["Name"];
			$x[$i]["Code"] = $row["Code"];
			$i++;
		}
		return $x;
	}

	function getCourses($collegeID) {
		$x = array();
		$ar = array("all", "exact");
		if(in_array($collegeID, $ar)) {
			$query = mysql_query("SELECT * FROM Course ORDER BY Name");
		} else {
			$query = mysql_query("SELECT * FROM Course WHERE CollegeID = '$collegeID' ORDER BY Name");
		}
		$i = 0;
		while($row = mysql_fetch_array($query)) {
			$x[$i]["ID"] = $row["ID"];
			$x[$i]["Name"] = $row["Name"];
			$x[$i]["Code"] = $row["Code"];
			$i++;
		}
		return $x;
	}

	function getCourseYears($courseID) {
		$x = "";
		$query = mysql_query("SELECT YearCourse FROM Course WHERE ID = '$courseID' LIMIT 1");
		while($row = mysql_fetch_array($query)) {
			$x = $row["YearCourse"];
			break;
		}
		return $x;
	}

	function getSchoolYear() {
		$x = "";
		$query = mysql_query("SELECT SchoolYear FROM Administration ORDER BY ID DESC LIMIT 1");
		while($row = mysql_fetch_array($query)) {
			$x = $row["SchoolYear"];
			break;
		}
		return $x;
	}

	function getTermInWords($inWords) {
		$x = "";
		$query = mysql_query("SELECT Term FROM Administration ORDER BY ID DESC LIMIT 1");
		while($row = mysql_fetch_array($query)) {
			$x = $row["Term"];
			break;
		}
		if($inWords) {
			if($x == 1)
				$x = "1st Semester";
			elseif($x == 2)
				$x = "2nd Semester";
			elseif($x == 3)
				$x = "3rd Semester";
			elseif($x == 4)
				$x = "Summer Term";
		}
		return $x;
	}

	function isExists($table, $column, $value) {
		$exists = false;
		$where = "";
		for($i = 0; $i < sizeof($column); $i++) {
			if($i == 0)
				$where .= $column[$i]." = '".$value[$i]."'";
			else
				$where .= " AND ".$column[$i]." = '".$value[$i]."'";
		}
		$query = mysql_query("SELECT * FROM $table WHERE $where");
		if(mysql_num_rows($query) > 0)
			$exists = true;
		return $exists;
	}

	function convertArrayToSQL($arr) {
		$data = "/";
		foreach($arr as $ar) {
			$data .= $ar."/";
		}
		return $data;
	}

	function convertSQLToArray($data) {
		$data = explode("|", $data);
		$arr = array();
		for($i = 1; $i < sizeof($data)-1; $i++) {
			$arr[] = $data[$i];
		}
		return $arr;
	}

	function removeElementInArray($arr, $el) {
		if(in_array($el, $arr))
			unset($arr[array_search($el, $arr)]);
		return $arr;
	}
}
?>