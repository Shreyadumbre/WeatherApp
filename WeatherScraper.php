<?php

    if($_GET['city']){
        
        $filecontent = file_get_contents("https://api.openweathermap.org/data/2.5/weather?q=".urlencode($_GET['city'])."&appid=d26c47909e39bf06409e1fd2085d577b");
        
        $weatherArray = json_decode($filecontent,true);
        
       // print_r($weatherArray);
        $tempinCelcius = intval($weatherArray['main']['temp'] - 273.15);
        
        $tempinFerh = intval(($weatherArray['main']['temp'] * (9/5)) - 459.67);
    
        if($weatherArray['cod'] == 200){
        $weather = "The temperature in ".$_GET['city']." is ".$tempinCelcius."&deg;C";
        }
        
        else{
            $error = "The city cannot be found.";
        }
    }


?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags always come first -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

      <title>Weather Scraper</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.2/css/bootstrap.min.css" integrity="sha384-y3tfxAZXuh4HwSYylfB+J125MxIs6mR5FOHamPBG064zB+AFeWH94NdvaCBm8qnd" crossorigin="anonymous">
      <link href="https://fonts.googleapis.com/css?family=Sigmar+One" rel="stylesheet">
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
       
      <style type="text/css">
      
      html { 
          background: url("background.jpg") no-repeat center center fixed; 
          -webkit-background-size: cover;
          -moz-background-size: cover;
          -o-background-size: cover;
          background-size: cover;
          }
        
          body {
              
              background: none;
              
          }
          
          .container {
              
              text-align: center;
              margin-top: 100px;
              width: 650px;
              
          }
          
          input {
              
              margin: 20px 0;
              
          }
          
          #weather {
              
              margin-top:15px;
              
          }
          h1,label{
              
              font-family: 'Sigmar One', cursive;
              color: white;
          }
          h1{
              font-size: 43px;
          }
          label{
              font-size: 28px;
          }
          .slow .toggle-group { transition: left 0.7s; -webkit-transition: left 0.7s; }
          
           #console-event{
              
              font-weight: bold;
              color: white;
          }
      </style>
      
  </head>
  <body>
     <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js" integrity="sha384-wHAiFfRlMFy6i5SRaxvfOCifBUQy1xHdJ/yoi7FRNXMRBu5WHdZYu1hA6ZOblgut" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/js/bootstrap.min.js" integrity="sha384-B0UglyR+jN6CkvvICOB2joaf5I4l3gm9GU6Hc1og6Ls7i6U/mkkaduKaBhlAXv9k" crossorigin="anonymous"></script>
      <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
<script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
      <div class="container">
      
          <h1>What's The Weather?</h1>
          <form>
  <fieldset class="form-group">
    <label for="city">Enter your city.</label>
    <input type="text" class="form-control" name="city" id="city" placeholder="Eg. London, Tokyo" value="<?php echo $_GET['city']; ?>">
  </fieldset>
  
  <button type="submit" class="btn btn-success">Submit</button>
              
   <div id="weather"><?php
              
              if($weather){
       
        echo '<div class="alert alert-success" role="alert">'.$weather.'</div>';
       }else if($error) {
       
       echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
       }
   
              
         ?>     
   </div>
          </form>
      <input id="toggle-event" type="checkbox" value="0" data-on="&deg;C" data-off="&deg;F" data-toggle="toggle">
                    <div id="console-event"></div>
      </div>
            
            
                    <script>
                      $(function() {
                        $('#toggle-event').change(function() {
                            var status = $(this).prop('checked');
                            
                          //$('#console-event').html('Toggle: ' + $(this).prop('checked'))
                            if(status == true){
                                $('#console-event').html('<?php echo $tempinCelcius; ?>&deg;');
                            }else if(status == false){
                                 $('#console-event').html('<?php echo $tempinFerh; ?>&deg;');
                            }
                        })
                      })
                    </script>
   
  </body>
</html>