<div id="busContainer">
<center><div id="busStopTitle"><span style="color:#4099FF; font-weight: bold;">Hill Center Bus Stop</span></div></center>
<font color=white size=3>
    <!--<meta http-equiv="refresh" content="10">-->
<?php
echo "<center>";
ini_set('display_errors',0);
$xml = file_get_contents('http://webservices.nextbus.com/service/publicXMLFeed?command=predictions&a=rutgers&stopId=1004');
echo $xml;
convertXmlObjToArr(simplexml_load_string($xml),$array);

$routes = array();
foreach ($array as $route) {
	$name = $route['@attributes']['routetitle'];
	$secs = $route['@children'][0]['@children'][0]['@attributes']['seconds'];
	$mins = $route['@children'][0]['@children'][0]['@attributes']['minutes'];
	$secs = $secs - ($mins * 60);
	if (strlen($secs) == 1) $secs = "0" . $secs;
	if ($mins == "") {
		//echo $name . " - " . $mins . ":" . $secs . "<br />";
	} else {
		if ($mins == 1)
			$routes[] = $name . "-<font color=#ffa538><b>" . $mins . ":" . $secs . "</b></font>";
		elseif ($mins == 0 && $secs <= 60)
			$routes[] = $name . "-<font color=#ff4f4f><b>" . $mins . ":" . $secs . "</b></font>";
		else
			$routes[] = $name . "-" . $mins . ":" . $secs;
	}
}
if (count($routes) >= 1) {
	asort($routes);
	echo "<table width=60% style=\"color:white;font-size:45px;\">";
  echo "<tr><th style=\"text-align:left;width:auto;\">"."<u>Route</u>"."</th><th style=\"text-align:right;width:auto;\">"."<u>Time</u>"."</th></tr>";
	foreach ($routes as $route) {
		$route = explode("-",$route);
		echo "<tr><td style=\"text-align:left;width:auto;\">".$route[0]."</td><td style=\"text-align:right;width:auto;\">".$route[1]."</td></tr>";
	}
	echo "</table>";
} else {
	echo "<div id=\"noBuses\">NextBus is down or there are currently no busses running</div>";
}
//echo "<i><font size=2>Last updated at " . date('h:i:s') . "</font></i>";
echo "</center>";

function convertXmlObjToArr($obj, &$arr)
{
    $children = $obj->children();
    foreach ($children as $elementName => $node)
    {
        $nextIdx = count($arr);
        $arr[$nextIdx] = array();
        $arr[$nextIdx]['@name'] = strtolower((string)$elementName);
        $arr[$nextIdx]['@attributes'] = array();
        $attributes = $node->attributes();
        foreach ($attributes as $attributeName => $attributeValue)
        {
            $attribName = strtolower(trim((string)$attributeName));
            $attribVal = trim((string)$attributeValue);
            $arr[$nextIdx]['@attributes'][$attribName] = $attribVal;
        }
        $text = (string)$node;
        $text = trim($text);
        if (strlen($text) > 0)
        {
            $arr[$nextIdx]['@text'] = $text;
        }
        $arr[$nextIdx]['@children'] = array();
        convertXmlObjToArr($node, $arr[$nextIdx]['@children']);
    }
    return;
}
$item1 = $_REQUEST['test'];
?>
</font>
</div>
