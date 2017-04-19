<?php
/* Declare our Array of cards:  Each card is an array of
armor and battle points*/
$cardType = array
  (
  array("Dragon",10,10,2),  //2
  array("Caotic Wizard Halfling",8,7,3),  //4
  array("Mage",7,8,5),  //9
  array("Fearie",3,6,8),  //17
  array("Wolf",5,5,8),  // 25
  array("Village Warrior",6,3,15),  // 40
  array("Speed Cyclist",5,2,10), // 50
  array("Elf",3,4,20), // 70
  array("Troll",3,3,20), // 90
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
// Get a randomly generated integer between 1 & 100
$randInt = rand (1,100);
// Function to get the key to a card
function getKey($rand,$array){
  // Pass $cardType into getMaxArray to build our comparison array
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

// Declare Variable
$NUM_CARDS = 5;
// Declare card keyy array
//$cardKeys = array();

// Select the player's hand
//for ($i = 0; $i++; $i < $NUM_CARDS) {
  // Get the max array for our deck
  //$comparisonArray = getMaxArray($cardType);



  // Call the function to get the key to a card
  //$cardKey = getCardKey($randInt, $comparisonArray);

  // Clear the comparison array
  $comparisonArray = array ();
//}
//print_r($cardKeys);

 //Test Code
$cardKey = getKey($randInt, $cardType);
//print_r ($maxArray);
echo "<br>";
echo "The random integer is: " . $randInt . ".  The card key is " . $cardKey . "<br>";
for ($i=0; $i < 10; $i++){
echo "index: " . $i . " Prob Value: " . $cardType[$i][3] . " ";
echo "Card: " . $cardType[$i][0] . "  ";
echo "Max Value: " . getMax($i,$cardType) . "<br>";
}
 ?>
