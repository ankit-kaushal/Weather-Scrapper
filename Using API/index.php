<?php
	error_reporting(E_ALL ^ E_WARNING); 
	$weather = "";
	$error = "";
	if ($_GET['city']){

		$urlContents = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&APPID=f42861e511c164f2d1fcf063a6ddd3d2");

		$weatherArray = json_decode($urlContents, true);

		if ($weatherArray['cod'] == 200){
		
			$weather = "The weather in ".$_GET['city']." is currently '".$weatherArray['weather'][0]['description']."'.";

			$tempInCelcius = intval($weatherArray['main']['temp'] - 273);

			$weather .= " The temprature is ".$tempInCelcius."&deg;C , humidity is ".$weatherArray['main']['humidity']."% and the wind speed is ".$weatherArray['wind']['speed']."m/s.";

		}

		else {

			$error = "City could not be found - please try again.";

		}

	}


?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather Scrapper</title>
    <link rel="shortcut icon" href="favicon.png">

    <style type="text/css">
    	html { 
			  background: url(background.jpg) no-repeat center center fixed; 
			  -webkit-background-size: cover;
			  -moz-background-size: cover;
			  -o-background-size: cover;
			  background-size: cover;
			}

		body{
			background: none;
		}

		.container{
			text-align: center;
			margin-top: 100px;
			width: 450px;
		}

		input{
			margin: 20px 0;
		}

		#weather{
			margin-top: 15px;
		}



    </style>
  </head>
  <body>
  	
  	<div class="container">
			
  		
  		<h1>What's The Weather?</h1>

  		<form>
		  <div class="form-group">
		    <label for="city">Enter the name of your city.</label>
		    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. Kolkata" value="<?php 

		    if (array_key_exists('city', $_GET)){

		    	echo $_GET['city']; 
			
			}

		    ?>">
		  </div>
		  	<button type="submit" class="btn btn-primary">Submit</button>
		</form>

		<div id="weather"><?php

			if($weather){

			echo '<div class="alert alert-success" role="alert">
  '.$weather.'
</div>';

			}
			else if ($error){
				echo '<div class="alert alert-danger" role="alert">
  '.$error.'
</div>';
			}

		?></div>


  	</div>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>