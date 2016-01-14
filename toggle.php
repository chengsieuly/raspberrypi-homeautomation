<?php
$rfPath = '/var/www/html/codesend ';
$outletLight = $_POST['outletId'];
$outletStatus = $_POST['outletStatus'];
$outletTimer = $_POST['outletTimer'];
$counter = $outletTimer;

$filename = 'data.json';
$data = file_get_contents($filename);
$json = json_decode($data, true);

if ($outletLight == "1" && $outletStatus == "on") {
    $rfCodes = array(5510451, 5510460);
} else if ($outletLight == "1" && $outletStatus == "off") {
    $rfCodes = array(5510460);
} else if ($outletLight == "two" && $outletStatus == "on") {
    $rfCodes = array(5510595, 5510604);
} else if ($outletLight == "two" && $outletStatus == "off") {
    $rfCodes = array(5510604);
} else if ($outletLight == "three" && $outletStatus == "on") {
    $rfCodes = array(5510915, 5510924);
} else if ($outletLight == "three" && $outletStatus == "off") {
    $rfCodes = array(5510924);
} else if ($outletLight == "four" && $outletStatus == "on") {
    $rfCodes = array(5512451, 5512460);
} else if ($outletLight == "four" && $outletStatus == "off") {
    $rfCodes = array(5512460);
} else if ($outletLight == "five" && $outletStatus == "on") {
    $rfCodes = array(5518595, 5518604);
} else if ($outletLight == "five" && $outletStatus == "off") {
    $rfCodes = array(5518604);
}


foreach ($rfCodes as $rfCode) {
    shell_exec($rfPath . $rfCode);
    $json[$outletLight] = $outletStatus;
    $jsonNew = json_encode($json);
    file_put_contents($filename, $jsonNew);

    for ($i = 0; $i < $outletTimer; $i++) {
      $counter--;

      if ($counter == 0) {
        $outletStatus = "off";
        $json[$outletLight] = $outletStatus;
        $json['two'] = $outletStatus;
        $json['three'] = $outletStatus;
        $jsonNew = json_encode($json);
        file_put_contents($filename, $jsonNew);
      }

      sleep(1);
    }
}

echo json_encode(array('success' => true));
?>
