<?php
/* Declare our Array of cards:  Each card is an array of
armor and battle points*/
$cardDeck = array
  (
  array("Dragon",10,10,2),  //2
  array("Caotic Wizard Halfling",8,7,3),  //5
  array("Mage",7,8,5),  //10
  array("Fearie",3,6,8),  //18
  array("Wolf",5,5,8),  // 26
  array("Village Warrior",6,3,15),  // 41
  array("Speed Cyclist",5,2,10), // 51
  array("Elf",3,4,20), // 71
  array("Troll",3,3,20), // 91
  array("Unicorn",1,5,9) // 100
  );
  /* Function to get max probabilty value for each card
    we will pass in the key and arraay*/
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
// Get the Computer's hand
$compHand = getHand($NUM_CARDS,$cardDeck);
// Test hands
print_r ($playerHand);
echo "<br>";
print_r ($compHand);
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
