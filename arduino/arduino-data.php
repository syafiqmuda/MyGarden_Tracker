<?php
include "../sql/config.php";

// Arduino ID
$unitId	= 1;

// Query
$sql = "SELECT * from ESPtable2 WHERE id = '$unitId'";
$result = mysqli_query($con, $sql);

// Check and Fetch
if (mysqli_num_rows($result) > 0){
    
	$row = mysqli_fetch_assoc($result);

    // RB (Button)
	$BTN1_value = $row['RECEIVED_BOOL1'];
	$BTN2_value = $row['RECEIVED_BOOL2'];
	$BTN3_value = $row['RECEIVED_BOOL3'];
	$BTN4_value = $row['RECEIVED_BOOL4'];
	$BTN5_value = $row['RECEIVED_BOOL5'];

    // SB (Status)
    $STAT1_value = $row['SENT_BOOL_1'];
	$STAT2_value = $row['SENT_BOOL_2'];
	$STAT3_value = $row['SENT_BOOL_3'];

    // NC (Value Controller)
    $VC1 = $row['RECEIVED_NUM1']/255 * 100;
	$VC2 = $row['RECEIVED_NUM2']/255 * 100;
	$VC3 = $row['RECEIVED_NUM3']/255 * 100;
	$VC4 = $row['RECEIVED_NUM4']/255 * 100;
	$VC5 = $row['RECEIVED_NUM5']/255 * 100;

	$VC1_value = round($VC1, 0);
	$VC2_value = round($VC2, 0);
	$VC3_value = round($VC3, 0);
	$VC4_value = round($VC4, 0);
	$VC5_value = round($VC5, 0);

    // NI (Value Indicator)
    $VI1 = $row['SENT_NUMBER_1']/1023 * 100;
	$VI2 = $row['SENT_NUMBER_2']/1023 * 100;
	$VI3 = $row['SENT_NUMBER_3']/1023 * 100;
	$VI4 = $row['SENT_NUMBER_4']/1023 * 100;

	$VI1_value = round($VI1, 0);
	$VI2_value = round($VI2, 0);
	$VI3_value = round($VI3, 0);
	$VI4_value = round($VI4, 0);
}
?>