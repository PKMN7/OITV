HDTV (also called OITV) is an infotainment display written for the Rutgers OIT HelpDesk that aims to be the go to source for weather, bus times, news, and walk-in appointments.

HDTV currently supports features for the aforementioned and may include additional features in the future.

Currently supported features:
1. Weather
2. Rutgers NB Hill Center NextBus Bus Predictions
3. News
4. Walk-In appointments

-----------------------

Weather: (files: weather.php, index.js)
The weather section currently supports a 7 day forecast and displays the highs and lows for each day along with the relevant icon. The weather section was built using php and javascript. The weather section pulls its data from the OpenWeather API
TODO: There are plans to potentially replace the OpenWeather API with a more reliable source like DarkSky or Yahoo Weather. This will likely require a change in design as the DarkSky logo would need to be present and may only support a 3 day forecast on the free tier.

Nextbus Predictions: (files: nextbus.php, index.js)
The bus section of the display aims to serve up the predicted arrival time for all bus types in transit to the Rutgers NB Hill Center Bus stop. This section of content was written in PHP and JavaScript and utilizes the NextBus XML API as a data source.
TODO: There are plans to reproduce the functionality of this section all in JavaScript as there is no need to maintain an API Key server side. The work for this has already been done using JavaScript and the NextBus JSON API source... I just need to find the file.

News: (folders: twitter-api-php-master)(src - files: twitterfeed.php, index.js)
The News section of HDTV currently utilizes Reuters as a source for news and pulls this news from Reuters official @Reuters Twitter account. This section was written using PHP and JavaScript. The sources used for this section are Twitter API and the GOQR API.
TODO: There are plans to implement more news sources and possibly move away from twitter and into simple RSS feeds.
NOTES regarding API keys: 
1. Copy `config.php.dist` to `config.php`.
2. Put Twitter API secret keys into `config.php`.

Walk-In appointments: (folders: calendar)(files: index.js)
The Walk-in Appointments section shows the next 4 walk-in appointments in the timeframe of a month. This section was written using the calendar piece pulled from http://gwaihir.rutgers.edu/rn/display/ as the data source.

-------------------------

authored by:
Liam Laverty - Developer and designer
Rae Clarke - Initial idea, designer, icon creator

Contributions and inspirations from:
Andrew Zhu - Assisted with a bug that plagued the news section
Albert Cassamajor - Mentor of Unix and assistance with configuring the raspberry pi
Andy Henriquez - OpenWeather API key holder

Special thanks to all staff, faculty, and students for feedback and advice
