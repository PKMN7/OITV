 <?php
ini_set('display_errors',0);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="cache-control" content="max-age=0" />
	<meta http-equiv="cache-control" content="no-cache" />
	<meta http-equiv="expires" content="0" />
	<meta http-equiv="expires" content="Tue, 01 Jan 1980 1:00:00 GMT" />
	<meta http-equiv="pragma" content="no-cache" />

	<title>ResNet display page</title>

	<script type="text/javascript" src="http://code.jquery.com/jquery-1.6.4.min.js"></script>
	<?php require 'calendar/class.iCalReader.php';?>
	<link href="style.css" rel="stylesheet" type="text/css" />

	<script>
		function refreshAllFrames() {
			refreshNextBus(3); // 3 seconds
			refreshCalendar(300); // 5 minutes
			refreshTicketReview(60); // 1 minute
		}
		function refreshNextBus (delay) {
			var reloadTime = delay * 1000;
			setTimeout(function () {
				var iframe = document.getElementById("nextBusIframe");
				iframe.contentDocument.location.reload(true);
				refreshNextBus(delay);
			}, reloadTime);
		}
		function refreshCalendar (delay) {
			var reloadTime = delay * 1000;
			setTimeout(function () {
				var iframe = document.getElementById("calendarIframe");
				iframe.contentDocument.location.reload(true);
				refreshCalendar(delay);
			}, reloadTime);
		}
        function refreshTicketReview (delay) {
			var reloadTime = delay * 1000;
			setTimeout(function () {
				var iframe = document.getElementById("ticketReviewIframe");
				iframe.contentDocument.location.reload(true);
				refreshTicketReview(delay);
			}, reloadTime);
		}
	</script>
</head>

<body onLoad="refreshAllFrames();" style="background-color: #000; overflow: hidden;">
	<div style="width:50%; float:left; text-align:center; padding-top: 30px; margin: auto;">
		<span style="color: #cc5500; font-size: 38px;"><b>Network Support Time</b></span>
		<br />
		<div id="clockDiv" style="margin:0 auto;">
			<script src="clock.js"></script>
			<div class="clock" style="margin: 0 auto;">
				<div id="Date"></div>
				  <ul>
					  <li id="hours"></li>
					  <li id="point">:</li>
					  <li id="min"></li>
					  <li id="point">:</li>
					  <li id="sec"></li>
				  </ul>
			</div>
		</div>
		<div style="text-align:center; padding-top: 25px;">
			<iframe id="ticketReviewIframe" width="100%" height="600" style="border:0;" src="ticketreview.php">
				Attempting to load ticket review iframe...
			</iframe>
		</div>
	</div>
	<div style="width:50%; float:right; text-align:center; padding-top: 35px; margin: auto;">
		<div style="text-align:center;">
			<iframe id="calendarIframe" height="575" width="535" style="border: 0" src="calendar/cal.html">
				Attempting to load calendar iframe...
			</iframe>
		</div>
		<div style="text-align:center;">
			<iframe id="nextBusIframe" width="100%" height="500px;" style="border:0; overflow: hidden;" src="nextbus.php">
				Attempting to load nextbus iframe...
			</iframe>
		</div>s
	</div>
</body>
