<!doctype html>
<html lang="en">
<head>
 
<title>Card Game</title>
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
<style type="text/css">
    body {
      margin: 30px;
      font-family: "Georgia", serif;
      line-height: 1.8em;
      color: #333;
    }
     
    h1, h2, h3, h4 {
      font-family: "Lucida Sans Unicode", "Lucida Grande", sans-serif;
    }
     
    #content {
      margin: 80px 70px;
      text-align: center;
      -moz-user-select: none;
      -webkit-user-select: none;
      user-select: none;
    }
     
    /* Header/footer boxes */
     
    .wideBox {
      clear: both;
      text-align: center;
      margin: 70px;
      padding: 10px;
      background: #ebedf2;
      border: 1px solid #333;
    }
     
    .wideBox h1 {
      font-weight: bold;
      margin: 20px;
      color: #666;
      font-size: 1.5em;
    }
     
    /* Slots for final card positions */
     
    #cardSlots {
      margin: 50px auto 0 auto;
      background: #ddf;
    }
     
    /* The initial pile of unsorted cards */
     
    #cardPile {
      margin: 0 auto;
      background: #ffd;
    }
     
    #cardSlots  {
      width: 80px;
      height: 120px;
      padding: 20px;
      border: 2px solid #333;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      -moz-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
      -webkit-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
      box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    }

    #cardPile {
      width: 910px;
      height: 120px;
      padding: 20px;
      border: 2px solid #333;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      -moz-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
      -webkit-box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
      box-shadow: 0 0 .3em rgba(0, 0, 0, .8);
    }
     
    /* Individual cards and slots */
     
    #cardSlots div {
      float: left;
      width: 58px;
      height: 78px;
      padding: 10px;
      padding-top: 40px;
      padding-bottom: 0;
      border: 2px solid #333;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      margin: 0 0 0 10px;
      background: #fff;
    }

    #cardPile div {
      float: left;
      width: 58px;
      height: 78px;
      padding: 10px;
      padding-top: 40px;
      padding-bottom: 0;
      border: 2px solid #333;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      margin: 0 0 0 10px;
      background: #fff;
    }
     
    #cardSlots div:first-child, #cardPile div:first-child {
      margin-left: 0;
    }
     
    #cardSlots div.hovered {
      background: #aaa;
    }
     
    #cardSlots div {
      border-style: dashed;
    }
     
    #cardPile div {
      background: #666;
      color: #fff;
      font-size: 50px;
      text-shadow: 0 0 3px #000;
    }
     
    #cardPile div.ui-draggable-dragging {
      -moz-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
      -webkit-box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
      box-shadow: 0 0 .5em rgba(0, 0, 0, .8);
    }
     
    /* Individually coloured cards */
     
    #card1.correct { background: red; }
    #card2.correct { background: red; }
    #card3.correct { background: red; }
    #card4.correct { background: red; }
    #card5.correct { background: red; }
    #card6.correct { background: red; }
    #card7.correct { background: red; }
    #card8.correct { background: red; }
    #card9.correct { background: red; }
    #card10.correct { background: red; }
     
     
    /* "You did it!" message */
    #successMessage, #routeMessage {
      position: absolute;
      left: 580px;
      top: 250px;
      width: 0;
      height: 0;
      z-index: 100;
      background: #dfd;
      border: 2px solid #333;
      -moz-border-radius: 10px;
      -webkit-border-radius: 10px;
      border-radius: 10px;
      -moz-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
      -webkit-box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
      box-shadow: .3em .3em .5em rgba(0, 0, 0, .8);
      padding: 20px;
    }
</style>
 
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5.0/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.9/jquery-ui.min.js"></script>
 
<script type="text/javascript">
 
<?php

// current directory
// echo "current work directory";
// echo getcwd() . "\n";
//echo exec('whoami')."\n";
$output = array();
exec('java RandomFixedSum < 5.txt', $output);

//$randomNums = explode(" ", $output);
// for ($i=0; $i < 20; $i++) {
//     $randomNums[$i] = $i;
// } 
echo "//".$output[0].";\n";
$randomNums = explode(" ", $output[0]);
$numbers = array();
for ($i=0; $i < 20; $i++) {
 $numbers[$i] = (int)$randomNums[$i];
}
$js_array = json_encode($numbers);
echo "var nums = ". $js_array . ";\n";
?>

 var correctCards = 0;
 var TOTAL_ROUND = 20;
 var leftRounds = 20;
 var totalScore = 0;
$( init );

function init() {
  $('#routeMessage').hide();
  $('#routeMessage').css( {
    left: '580px',
    top: '250px',
    width: 0,
    height: 0
  } );

  $('#successMessage').hide();
  $('#successMessage').css( {
    left: '580px',
    top: '250px',
    width: 0,
    height: 0
  } );
 
  // Reset the game
  correctCards = 0;
  $('#cardPile').html( '' );
  $('#cardSlots').html( '' );
 
  // Create the pile of shuffled cards
  var numbers = [ 1, 2, 3, 4, 5, 6, 7, 8, 9, 10 ];
  numbers.sort( function() { return Math.random() - .5 } );
 
  for ( var i=0; i<10; i++ ) {
    $('<div>' + numbers[i] + '</div>').data( 'number', numbers[i] ).attr( 'id', 'card'+numbers[i] ).appendTo( '#cardPile' ).draggable( {
      containment: '#content',
      stack: '#cardPile div',
      cursor: 'move',
      revert: true
    } );
  }
 
  // Create the card slots
  var words = [ 'Slot'];
  for ( var i=1; i<=1; i++ ) {
    $('<div>' + words[i-1] + '</div>').data( 'number', i ).appendTo( '#cardSlots' ).droppable( {
      accept: '#cardPile div',
      hoverClass: 'hovered',
      drop: handleCardDrop
    } );
  }
 
}

function myFunction() {
    //window.location="{{URL::to('/')}}";
    //https://www.surveymonkey.com/r/HSGCG28
    //="{{URL::to('https://www.surveymonkey.com/r/HSGCG28')}}";
    window.location.replace("https://www.surveymonkey.com/r/HSGCG28");
}

function handleCardDrop( event, ui ) {
  var slotNumber = $(this).data( 'number' );
  var cardNumber = ui.draggable.data( 'number' );

 
    ui.draggable.addClass( 'correct' );
    ui.draggable.draggable( 'disable' );
    $(this).droppable( 'disable' );
    ui.draggable.position( { of: $(this), my: 'left top', at: 'left top' } );
    ui.draggable.draggable( 'option', 'revert', false );
    correctCards++;

  $("#scoreGot").text(nums[TOTAL_ROUND-leftRounds]);
  totalScore = totalScore + nums[TOTAL_ROUND-leftRounds];
  leftRounds = leftRounds - 1;
  $("#totalScore").text(totalScore);
  $("#leftRounds").text(leftRounds);

  if ( correctCards == 1 && leftRounds != 0) {
    $('#successMessage').show();
    $('#successMessage').animate( {
      left: '450px',
      top: '200px',
      width: '300px',
      height: '80px',
      opacity: 1
    } );
  }

  if (leftRounds == 0) {
    $('#routeTotalScore').text(totalScore);
    $('#routeMessage').show();
    $('#routeMessage').animate( {
      left: '450px',
      top: '200px',
      width: '300px',
      height: '80px',
      opacity: 1
    } );
  }
 
}


</script>
 
</head>
<body>


<div id="content">
 
  <div>
    <h2 style="display:inline">Your score: </h2>
    <p id = "totalScore" style="display:inline;font-size:170%">0</p>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
    <h2 style="display:inline" >Left Rounds: </h2>
    <p id = "leftRounds" style="display:inline;font-size:170%">20</p>
  </div>

  <div id="cardPile"> </div>
  <div id="cardSlots"> </div>
 
  <div id="routeMessage">
    <h2 style="display:inline">Your final score: </h2><h2 id = "routeTotalScore" style="display:inline"></h2><br/>
    <button onclick="myFunction()">Go to survey</button>
  </div>

  <div id="successMessage">
    <h2 style="display:inline">Points you get </h2> <h2 id = "scoreGot" style="display:inline"></h2> <br/>
    <button onclick="init()">Next Round</button>
  </div>
 
</div>
 
</body>
</html>