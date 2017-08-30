$(document).ready(function(){
  function displayParsedData(data){
          /* Working with the 'data' object (not string) here, now we can access the different properties available.*/
          var all = "";
          for(var i=0;i<=6;i++){
            var timestamp = data.list[i].dt;
            var a = new Date(timestamp*1000);
            var days = ['Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday'];
            var dayOfWeek = days[a.getDay()]
            //console.log(data.list[i]);
            var conditionIco = "If you see me something done broke";
            if(data.list[i].weather[0].icon == "01n" || data.list[i].weather[0].icon == "01d"){
              conditionIco = "sun.png";
              }
              else if (data.list[i].weather[0].icon == "02n" || data.list[i].weather[0].icon == "02d") {
              conditionIco = "cloud.png";
              }
              else if (data.list[i].weather[0].icon == "03n" || data.list[i].weather[0].icon == "03d" || data.list[i].weather[0].icon == "04n" || data.list[i].weather[0].icon == "04d") {
              conditionIco = "clouds.png";
              }
              else if (data.list[i].weather[0].icon == "09n" || data.list[i].weather[0].icon == "09d" || data.list[i].weather[0].icon == "10n" || data.list[i].weather[0].icon == "10d"){
              conditionIco = "rain.png";
              }
              else if (data.list[i].weather[0].icon == "11n" || data.list[i].weather[0].icon == "11d"){
              conditionIco = "storm.png";
              }
              else if (data.list[i].weather[0].icon == "13n" || data.list[i].weather[0].icon == "13d"){
              conditionIco = "snow.png";
              }
              else{
              conditionIco = "danger.png";
              }

              if(i==0){
              all +="<div class=\"weatherDay\">"+"<div class=\"keepstextverticallycentered\">"+"<div id=\"dayofweek\">"+dayOfWeek+"</div>"+"<div class=\"cond\">"+"<img src=\"images/"+conditionIco+"\"></img>"+"</div>"+"<div class=\"temp\">"+Math.round(data.list[i].temp.min)+"</div>"+"</div>"+"</div>";
              }
              else {
              all +="<div class=\"weatherDay\">"+"<div class=\"keepstextverticallycentered\">"+"<div id=\"dayofweek\">"+dayOfWeek+"</div>"+"<div class=\"cond\">"+"<img src=\"images/"+conditionIco+"\"></img>"+"</div>"+"<div class=\"temp\">"+Math.round(data.list[i].temp.min)+" | "+Math.round(data.list[i].temp.max)+"</div>"+"</div>"+"</div>";
              }
          }
          console.log(all);
          document.getElementById('weatherContainer').innerHTML = all;
          /*
          text = '<b>Name: </b>' + data.list[0].temp.day + '<br/>';
          text += '<b>message: </b>' + data.message + '<br/>';
          text += '<b>Current Condition: </b>' + data.list[0].weather[0].main + '<br/>';
          text += '<b>Weather Conditions: </b>' + data.list[0].weather[0].description + '<br/>';
          $('#lol').append(text);
          */
        }


        function getBus() {
        $.ajax(
          {
              url: 'nextbus.php',
              type:'GET',
              dataType: 'text',
              data: {test: '1'},
              success: function(lol)
              {
                //console.log(lol);
                  $(".bussesTab").html(lol);
              }
          })
        }
        var previous = "There must be an error";
        function getTweets() {
          var prev="no";
            $.ajax(
            {
                url: 'twitterfeed.php',
                type:'GET',
                dataType: 'json',
                data: {test: '1'},
                success: function(lol){
                      console.log(lol[2]);
                        console.log("The Tweets changed!");
    					console.log(lol);
                        //var jArray= JSON.parse(lol);
                        //console.log(jArray);
                        if(previous != lol[0]){
                        previous = lol[0];
                        $('.reutersTab').empty();
                        $( ".reutersTab" ).append( $("<div class=\"twoPercentTwitter\"></div>") );
                        var urlRegex = /(https?:\/\/[^\s]+)/;
                        var allUrlsRegex = /(https?:\/\/[^\s]+)/g;

                        for(var i=0;i<4;i++){
                            jArray = lol[i];

                            try {
                              var theURL = jArray.match(urlRegex)[1];
                              jArray = jArray.replace(allUrlsRegex,"");
                              if(jArray.length >= 90){
                                jArray = jArray.substring(0,90);
                                jArray+="...";
                              }
                              $( ".reutersTab" ).append( $("<div class=\"twoPercentTwitter\"></div>") );
                              $( ".reutersTab" ).append( $("<div class=\"tweet\">"+"<div id=\"tweetImage\"><div id=\"divForVertAlign\"><span class=\"spanForVertAlign\"></span>"+"<img src=\"https://api.qrserver.com/v1/create-qr-code/?data="+theURL+"&amp;size=100x100\" alt=\"\" title=\"\" />"+"</div></div><div id=\"tweetText\">"+jArray+"</div>"+"</div>"));
                              $( ".reutersTab" ).append( $("<div class=\"twoPercentTwitter\"></div>") );
                            } catch (e) {
                              if(jArray.length >= 100){
                                jArray = jArray.substring(0,100);
                                jArray+="...";
                              }
                              $( ".reutersTab" ).append( $("<div class=\"twoPercentTwitter\"></div>") );
                              $( ".reutersTab" ).append( $("<div class=\"tweet\">"+"<div id=\"tweetText\" style=\"width: 94%; margin-right: 3%; margin-left: 3%;\">"+jArray+"</div>"+"</div>"));
                              $( ".reutersTab" ).append( $("<div class=\"twoPercentTwitter\"></div>") );
                            }
                        }
                      }
                }
            });
        }



  function getWeather() {
            $.ajax({
              url: 'http://api.openweathermap.org/data/2.5/forecast/daily?q=Piscataway,US&units=imperial&cnt=7&lang=en&appid=cee6efaacaa8adfde69b77da692f7506',
              type: 'GET',
              dataType:"jsonp",
              success: function(data) {
                //$("#raw_json").html('<h2>$.ajax</h2><pre>' + JSON.stringify(data, null, 2) + '</pre>');
                displayParsedData(data);
                //console.log(data);
              },
              error: function(jqXHR, textStatus, error) {
                alert( "error: " + jqXHR.responseText);
              }
            });
          }

          function getWalkin() {
                    $.ajax({
                      url: 'calendar/calendar/calendar.php',
                      type: 'GET',
                      dataType:"json",
                      success: function(data) {
                        //$("#raw_json").html('<h2>$.ajax</h2><pre>' + JSON.stringify(data, null, 2) + '</pre>');
                        console.log(data);
			//console.log(data[0].end);
			console.log("Walkin module triggered");
                        //var all = "";
                        $('#placeholderContainer').empty();
                        for(var i=0;i<4;i++){
                          try {
                          var timestampStart = data[i].start;
                          var timestampEnd = data[i].end;
                          var a = new Date(timestampStart*1000);
                          var b = new Date(timestampEnd*1000);
                          var ahour = a.getHours();
                          var amin = a.getMinutes();
                          var bhour = b.getHours();
                          var bmin = b.getMinutes();
                          if (amin < 10) {
                            amin = "0" + amin;
                          }
                          if (bmin < 10) {
                            bmin = "0" + bmin;
                          }

                          var days = ['Sun','Mon','Tues','Wed','Thurs','Fri','Sat'];
                          var dayOfWeekStart = days[a.getDay()];
                          var dayOfWeekEnd = days[b.getDay()];
                          var ticket = data[i].title;
                          console.log(ticket);
                          var ticketRegex = /^[0-9]{3,7},*\b/;
                          var theTicket = "NA";
                          console.log(theTicket);
                          try {
                          theTicket = ticket.match(ticketRegex);
                          }
                          catch(e){theTicket = "NA";}
                          if(theTicket==null){
                            theTicket = "NA";
                          }
                          console.log(theTicket);
                          console.log(dayOfWeekStart);
                          //all += "<div id=\"placeholder\"><div class=\"walkinDay\">"+dayOfWeekStart+"</div><p>"+timestampStart+"<br>15:00<br></p><div class=\"walkinTicket\">"+theTicket+"</div></div>";
                          //console.log(all);
                          $('#placeholderContainer').append("<div id=\"placeholder\"><div class=\"walkinDay\">"+dayOfWeekStart+" "+a.getDate()+"</div><p>"+ahour+":"+amin+"<br>"+bhour+":"+bmin+"<br></p><div class=\"walkinTicket\">"+theTicket+"</div></div>");
                          }
                          catch (e) {
                            //alert("uh oh");
                            $('#placeholderContainer').append("<div id=\"placeholder\"><p>No Walk-In App</p></div>");

                          }
                          finally{
                          //console.log(all);
                        }
                        }
                      },
                      error: function(jqXHR, textStatus, error) {
                        alert( "error: "+ "Issue with accessing. Please let walkin appointments populate before reloading page. If this is not the case then something else may be wrong");
                      }
                    });
                  }


          /*function getTime() {
            var time = new Date();
            var h = time.getHours();
            var m = time.getMinutes();
            var s = time.getSeconds();
              if (h < 10) {
                h = "0" + h;
              }
              if (m < 10) {
                m = "0" + m;
              }
            document.getElementById('placeholder').innerHTML = "Current Time "+h + ":" + m;
            console.log(time+ " lol");
          }*/
          setInterval(function(){
            getBus();
          }, 5000);//update every 5 seconds
          setInterval(function(){
          getWeather();
          }, 1800000);//update every 30 mins
          setInterval(function(){
          getTweets();
        }, 30000);//update every 30 sec
        /*setInterval(function(){
          getTime();
        }, 10000);//update every 10 seconds*/

	  setInterval(function(){
          getWalkin();
        }, 300000);//update every 5 mins

          getBus();
          getWeather();
          getTweets();
          getWalkin();
          //getTime();


});
