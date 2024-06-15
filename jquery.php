<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>jqeury beginners</title>
</head>
<body>
    <p id="para" >toogle the image using jqeury only <img id="spinner" src="" alt="dude" height="red" style="display:none; vertical-align:middle; "> </p>

    <a  href="#" onclick="$('#para').css('background-color , red') return false;" >red</a> 
    <a  href="#" onclick="$('#para').css('background-color , blue') return false;" >blue</a> 
    <a href="#" onclikc="$(#spinner).toggle(function() { alert(hello toggled page);});" >toggle</a>

  

    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
</body>
</html>