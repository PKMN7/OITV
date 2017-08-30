<?php require 'class.iCalReader.php';

$ical = new ical('http://www.google.com/calendar/ical/scarletmail.rutgers.edu_c05vafih9msspu0c2c6eo889vc%40group.calendar.google.com/private-f3c5492edbbe4ffcfb142e1f3b95d627/basic.ics');

$beginningOfToday = mktime( 0, 0, 0, date("n"), date("j"), date("Y") );
$endOfToday = mktime( 0, 0, 0, date("n"), date("j"), date("Y") ) + 2678400;
$events = $ical->eventsFromRange($beginningOfToday, $endOfToday);
$output = array();
foreach ($events as $event) {

	$str = $event['DESCRIPTION'];
	$found = preg_match('/[0-9]{6}/', $str, $matches);
	if ($found) $ticket = $matches[0];
	else $ticket = "";

	$str = $event['SUMMARY'];
	$found = preg_match('/\((.*?)\)/', $str, $matches);
	if ($found) $user = substr($matches[0],1,strlen($matches[0])-2);
	else $user = "Walk-In Appt.";

	if ($ticket == "") $title = $user;
	else if ($user == "Walk-In Appt.") $title = $ticket;
	else $title = $ticket . " " . $user;

        $output[] = array(
            "title" => $title,
	    "start" => strtotime($event['DTSTART']),
	    "end" => strtotime($event['DTEND'])
        );

}
//header("Content-type: application/json");
echo json_encode($output);
//echo $beginningOfToday."lol";
//echo $endOfToday;

?>
