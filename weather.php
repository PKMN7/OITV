<head>
<meta http-equiv="refresh" content="1800">
</head>

<?php


$city="Piscataway";
$country="US";
$key=""; //removed 
$url="http://api.openweathermap.org/data/2.5/forecast/daily?q=".$city.",".$country."&units=imperial&cnt=7&lang=en&appid=".$key;
$cur="http://api.openweathermap.org/data/2.5/weather?q=".$city.",".$country."&units=imperial&cnt=7&lang=en&appid=".$key;
$json=file_get_contents($url);
$data=json_decode($json,true);
$curjson=file_get_contents($cur);
$curdata=json_decode($curjson,true);
$data['city']['name'];
//print_r($data);

for($x=0;$x<7;$x++){
$texts = ( $data['list'][$x]['temp']['day']);
$goodtexts = filter_var($texts, FILTER_SANITIZE_STRING);
$alltexts[] = $goodtexts;

$condition = ( $data['list'][$x]['weather'][0]['main']);
$goodcondition = filter_var($condition, FILTER_SANITIZE_STRING);
$allconditions[] = $goodcondition;
}
//echo $curdata['main']['temp'];
//echo $curdata['weather'][0]['main'];
//echo $data['list'][0]['temp']['day'];
?>
<link rel="stylesheet" href="index.css">

  <body>
     <div id="weatherContainer">

     </div>
 </body>

 <script type="text/javascript">

 function myFunction() {
     var d = new Date();
     var weekday = new Array(7);
     weekday[0] = "Sunday";
     weekday[1] = "Monday";
     weekday[2] = "Tuesday";
     weekday[3] = "Wednesday";
     weekday[4] = "Thursday";
     weekday[5] = "Friday";
     weekday[6] = "Saturday";

     var n = weekday[d.getDay()];
     document.getElementById("demo").innerHTML = n;
   }

      var temperature= JSON.parse('<?php echo json_encode($alltexts); ?>');
      var condition= JSON.parse('<?php echo json_encode($allconditions); ?>');

      for(var i=0;i<=6;i++){
          console.log(temperature[i]);
          document.getElementById('weatherContainer').innerHTML += "<div class=\"weatherDay\">"+"<div class=\"keepstextverticallycentered\"><div class=\"temp\">"+temperature[i]+"</div>"+"<div class=\"cond\">"+condition[i]+"</div>"+"</div>"+"</div>";
      }

   </script>
