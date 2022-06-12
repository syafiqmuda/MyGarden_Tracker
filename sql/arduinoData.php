<?php
include "../sql/config.php";

// UNIQUE ID
$unitId	= 1;

// Query
$sql = "SELECT * from ESPtable2 WHERE id = '$unitId'";
$result = mysqli_query($con, $sql);

// Check and Fetch
if (mysqli_num_rows($result) > 0){
    
	$row = mysqli_fetch_assoc($result);

	// NI (SENSOR)
    $HUMID1 	= $row['SENT_NUMBER_1'];
	$HUMID2 	= $row['SENT_NUMBER_2'];
	$TEMP1 		= $row['SENT_NUMBER_3'];
	$TEMP2 		= 0;
	$WATERLV1 	= $row['SENT_NUMBER_4'];
	$WATERLV2 	= 0;

    // BC (Button)
	$BTN1 = $row['RECEIVED_BOOL1'];
	$BTN2 = $row['RECEIVED_BOOL2'];
	//$BTN3 = $row['RECEIVED_BOOL3'];
	//$BTN4 = $row['RECEIVED_BOOL4'];

    // NC (Value Controller)
    $PUMP1 = $row['RECEIVED_NUM1'];
	$PUMP2 = $row['RECEIVED_NUM2'];
	//$PUMP3 = $row['RECEIVED_NUM3'];
	//$PUMP4 = $row['RECEIVED_NUM4'];

	// Query (ADD ESP INTO ARDUINO)
	$sql = "INSERT INTO arduino (ARDUINO_ID, HUMID1, HUMID2, TEMP1, TEMP2, WATERLV1, WATERLV2, BUTTON1, BUTTON2, PUMP1, PUMP2) VALUE (?,?,?,?,?,?,?,?,?,?,?)" ;
	$stmt = mysqli_prepare($con, $sql);

	// Bind
	mysqli_stmt_bind_param($stmt, "issssssssss", $unitId, $HUMID1, $HUMID2, $TEMP1, $TEMP2, $WATERLV1, $WATERLV1, $BTN1, $BTN2, $PUMP1, $PUMP2);
	
	// Execute
	if(mysqli_stmt_execute ($stmt)){

		// Query (TRANSFER ARDUINO INTO PLANTDATA 1)
		$sql = "UPDATE plantdata SET pd_humidity=?, pd_waterlevel=?,  pd_temperature=?, pd_pump=?, pd_switch=? WHERE pd_arduinoId = $unitId AND pd_plantNo = 1" ;
		$stmt = mysqli_prepare($con, $sql);

		// Bind + Execute
		mysqli_stmt_bind_param($stmt, "iiiii", $HUMID1, $WATERLV1, $TEMP1, $PUMP1, $BTN1);
		mysqli_stmt_execute ($stmt);

		// Query (TRANSFER ARDUINO INTO PLANTDATA 2)
		$sql = "UPDATE plantdata SET pd_humidity=?, pd_waterlevel=?,  pd_temperature=?, pd_pump=?, pd_switch=? WHERE pd_arduinoId = $unitId AND pd_plantNo = 2" ;
		$stmt = mysqli_prepare($con, $sql);

		// Bind + Execute
		mysqli_stmt_bind_param($stmt, "iiiii", $HUMID2, $WATERLV2, $TEMP2, $PUMP2, $BTN2);
		mysqli_stmt_execute ($stmt);
	}

	else{
		var_dump("2 Query ERROR");
		exit();
	}
}

else{
	var_dump("1 Query ERROR");
	exit();
}
?>