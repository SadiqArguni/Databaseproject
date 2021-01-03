<?php
define('DB_DSN', 'mysql:host=localhost;dbname=pizza_store;charset=utf8');
define('DB_USER', 'root');
define('DB_PASSWORD', '');

	function connect() {
		mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
		try {
			$opt = array(
		        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		    );
		    return new PDO(DB_DSN,DB_USER,DB_PASSWORD, $opt);
		} catch(Exception $e) {
			return false;
		}
	}

	if ( connect() ) {
		$conn = connect();
	} else {
		return false;
	}
