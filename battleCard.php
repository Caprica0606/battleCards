<!DOCTYPE html>
<html>
<header>
        <!-- CSS link-->
        <link rel="stylesheet" type="text/css" href="battleCard.css">
      <title>Coding Commanders battleCards</title>
</header>
  <body background = "battleCards/background.jpg" >
    <div class = "main";>
        <!-- Game Form-->
       <form name = "gameForm">
        <!-- Top Container-->
          <div class = "top">
              <div class = "cards">
                <!--<img src = "battleCards/cardBack2.jpg">   <img src = "battleCards/cardBack.jpg">   <img src = "battleCards/cardBack.jpg">   <img src = "battleCards/cardBack.jpg">   <img src = "battleCards/cardBack.jpg">   <img src = "battleCards/cardBack.jpg">-->
              </div>
            </div>
          </form>
        </div>
          <script>
          src="https://code.jquery.com/jquery-3.2.1.min.js"
          integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4="
          crossorigin="anonymous"></script>
  </body>
</html>
<?php
/* Declare our Array of cards:  Each card is an array of
armor and battle points*/
$cardDeck = array
  (
  array("Dragon",10,10,2),  //2
  array("Caotic Wizard Halfling",8,7,3),  //5
  array("Mage",7,8,5),  //10
  array("Ninja Fearie",4,6,8),  //18
  array("Wolf",5,5,8),  // 26
  array("Village Warrior",6,3,15),  // 41
  array("Speed Cyclist",5,2,10), // 51
  array("Elf",3,4,20), // 71
  array("Troll",3,3,20), // 91
  array("Unicorn",1,5,9) // 100
  );

  /* Function to get the to max placement value for each card type*/
  function getMax($key, $array) {
    // Declare $maxValue
    $cardMax = 0;
    $maxValue = 0;
    /* Loop through the array, starting at the given
      index and ending at the last element in the
      array.*/
    for ($i = $key; $i > -1; $i--) {
      /* it will add the  probability score for each index
        included in the loop*/
       $cardMax = $array[$i][3];
       $maxValue = $maxValue + $cardMax;
    }
    // and returns the max value for the key
    return $maxValue;
  }

// Function to create an array of max values
function getMaxArray ($array){
  // Get the max for each value and put those in an array
    for ($i = 0; $i < 10; $i++) {
      $maxArr[$i]= getMax($i, $array);
    }
  return $maxArr;
}

// Function to get the key to a card
function getKey($rand,$array){
  // Pass $cardDeck into getMaxArray to build our comparison array
  $comparisonArray = getMaxArray($array);
  // put our random number into our $maxArray
  array_push($comparisonArray,$rand);
  // sort the array so $randInt is given a key based on its value
  sort($comparisonArray);
  // Initialize counter
  $i = -1;
    foreach ($comparisonArray as $value) {
        if ($value == $rand) {
            $cardKey = $i + 1;
            // Add the card key to an array of card keys
            //array_push($cardKeys,$cardKey);
        }
        else {
        $i++;
        }
    }
    return ($cardKey);
    $comparisonArray = array();
}
/* Function to check an array of cards to make sure
  no card is selected more time than it is in the deck*/
  /* array_count_values: Returns an array where
  the values of the array passed in will be the keys
  and the number of times the value is in the
  array is the value*/
  function checkKey($keyValue,$keyArray,$deckArray) {
    // Count how many of each card are in our key array
    $valueCount = array_count_values($keyArray);
      if (array_key_exists($keyValue, $valueCount) == true) {
        $keyCount = $valueCount [$keyValue];
        $maxInDeck = $deckArray [$keyValue] [3];
        if ($keyCount > $maxInDeck) {
          return -1;
        }
        else {
          return 1;
        }
        }
      Else {
        return 2;
      }
      }

function getHand ($numCards, $cardArray) {
  // Declare Variables
  $cardKeys = array();
  $i = 0;
  // loop to test and select a card key if it passes the test
    while($i < $numCards) {
      $randInt = rand (1,100);
      $key = getKey($randInt, $cardArray);
      $test = checkKey($key, $cardKeys, $cardArray);
          if ($test > 0) {
            array_push($cardKeys,$key);
            $i ++;
          }
    }
    return $cardKeys;
}

// Number of cards in a hand
$NUM_CARDS = 5;
// Get the client's hand
$playerHand = getHand($NUM_CARDS,$cardDeck);
// Initialize an array to hold our cards' picture locations
$picLocation = array
(
  array("Dragon", "battleCards/dragonCard.jpg" ),
  array("Caotic Wizard Halfling","battleCards/halflingCard.jpg" ),  //5
  array("Mage","battleCards/mageCard.jpg"),  //10
  array("Ninja Fearie","battleCards/fearieCard.jpg"),  //18
  array("Wolf","battleCards/wolfCard.jpg"),  // 26
  array("Village Warrior","battleCards/warriorCard.jpg"),  // 41
  array("Speed Cyclist","battleCards/cyclistCard.jpg"), // 51
  array("Elf","battleCards/elf.jpg"), // 71
  array("Troll","battleCards/trollCardu.jpg"), // 91
  array("Unicorn","battleCards/UnicornCard.jpg") // 100
);

// Function to display cards
function displayHand ($hand,$column,$locationArray) {
  $pictures= array();
  // Loop through the card keys in the player's hand
  foreach ($hand as $value) {
    // Get the location of our pic
    array_push($pictures, $locationArray [$value] [$column]);
  }
    return $pictures;
}
// Player's hand
$cardPictures = displayHand ($playerHand,1,$picLocation);

// Display the player's hand
echo "<div class = 'bottom' align = 'center'>";
foreach ($cardPictures as $value) {
  echo " <img class = 'cards' src = '" . $value . "' > ";
}
echo "</div>";
// Have the player Select the cards to play
    echo "<div class = 'side'>";
    echo "<form  type  = 'submit' action='battleCard.php' id = 'submitMe' method='post' name = 'pickCards'>
        Which 3 cards would you like to play?" . "<br>";
    echo "<select name = 'cardSelect[]'  multiple= 'multiple'>";
    foreach ($playerHand as $value) {
      $n = 0;
      echo  "<option value = " . $value . ">" . $cardDeck[$value][0] . "</option>";
      $n++;
    }
    echo "</select>";
    echo "<input type='submit' name='formSubmit' value='Submit '/>";
    echo "</form>";
    echo "</div>";
//******** Code to happen after submit********/
if(isset($_POST['formSubmit'])) {
  // Pass the player's choices to php
  $cardSelect = $_POST['cardSelect'];
  //put indexes in Variables
  $BATTLE_KEY = 1;
  $ARMOR_KEY = 2;
  //function to calculate points
  function getPoints ($selectArray,$deckArray,$key) {
    $count = 0;
    $points = 0;
    	 foreach ($selectArray as $deckKey) {
         if ($count < 3) {
          $points = $points + $deckArray [$deckKey][$key];
         }
         $count++;
       }
       return $points;
     }

  // Get the Computer's hand
  $compHand = getHand($NUM_CARDS,$cardDeck);
  // Computer will select his cards
  sort($compHand);
  array_pop($compHand);
  array_pop($compHand);
  print_r($compHand);
  // Display Computer's hand
  $compPictures = displayHand ($compHand,1,$picLocation);
  foreach ($compPictures as $value) {
    echo " <img class = 'cards' src = '" . $value . "' > ";
  }
  // Calculate player's Os
  $O_points = getPoints($cardSelect,$cardDeck,$BATTLE_KEY);
  // Calculate player's D
  $D_points = getPoints($cardSelect,$cardDeck,$ARMOR_KEY);
  // Calculate computer's Os
  $bigOs = getPoints($compHand,$cardDeck,$BATTLE_KEY);
  // Calculate computer's D
  $bigD =  getPoints($compHand,$cardDeck,$ARMOR_KEY);
  // Calculate D after attack
  $playerDamaged = $D_points - $bigOs;
  $computerDamaged = $bigD - $O_points;
  $toReturn = "";
  if ($computerDamaged < 0) {
    $compDied = 1;
    $toReturn .= "Your oppent ran out of armor and died.  ";
  }
  if ($playerDamaged < 0) {
    $playerDied = 1;
    $toReturn .= "You ran out of armor and died!  ";
  }
  else{
    $playerScore = $O_points - $bigD;
    $compScore = $bigOs - $D_points;
    $toReturn .= "Your score is " . $playerScore . ".  ";
    $toReturn .= "Your opponent scored " . $compScore . ".  ";
      if ($playerScore > $compScore) {
          $toReturn .= "  You win!";
      }
      elseif ($compScore > $playerScore) {
        $toReturn .= "  You have been defeated.";
      }
      else {
        $toReturn .= "  You and your oppenent recieved the same score.";
      }
  }

  echo $toReturn;
}
/* //Test Code
$cardKey = getKey($randInt, $cardDeck);
//print_r ($maxArray);
echo "<br>";
echo "The random integer is: " . $randInt . ".  The card key is " . $cardKey . "<br>";
for ($i=0; $i < 10; $i++){
echo "index: " . $i . " Prob Value: " . $cardDeck[$i][3] . " ";
echo "Card: " . $cardDeck[$i][0] . "  ";
echo "Max Value: " . getMax($i,$cardDeck) . "<br>";
} */
 ?>
