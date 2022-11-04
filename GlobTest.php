<?php

function foo($array)
{
  if (count($array) == 2) {
    // On vérifie si le 2ème élément du premier tableau est plus petit que le premier élément du second tableau
    // Alors on renvoie les 2 tableaux
    if ($array[0][1] < $array[1][0]) {
      $hasComma = false;
      foreach ($array as $ar) {
        if ($hasComma) {
          echo ",";
        }
        echo "[";
        $hasComma = false;
        foreach ($ar as $value) {
          if ($hasComma) {
            echo ",";
          }
          echo "$value";
          $hasComma = true;
        }
        echo "]";
        $hasComma = true;
      }
      echo "\n";
    }


    // Sinon on renvoie le plus petit et plus grand nombre
    else {
      $min = 0;
      $max = 0;
      foreach ($array as $el) {
        foreach ($el as $el) {
          $min = $min === null ||
            $el < $min ? $el : $min;
          $max = $max === null ||
            $el > $max ? $el : $max;
        }
      }

      $array = [$min, $max];
      foreach ($array as $value) {
        $myArray[] = ' . ($value) ';
      }
      echo "[" .  implode(', ', $array) . "]\n";
    };
  }

  // Sinon, on récupère le tableau ayant la plus grand somme
  // On récupère le plus petit et le plus grand nombre inférieur au premier element du tableau ayant la plus grand somme
  // On renvoie en premier le tableau contenant le plus petit et grand nombre suivi du tableau ayant la plus grand somme
  else {
    $min = null;
    $max = null;
    $elementSum = [];
    foreach ($array as $el) {
      $elementSum = [!count($elementSum) || ($elementSum[0][0] + $elementSum[0][1]) < ($el[0] + $el[1]) ? $el : $elementSum[0]];
    };

    $key = array_search($elementSum[0], $array);

    unset($array[$key]);

    foreach ($array as $el) {
      foreach ($el as $el) {
        $min = $min === null ||
          $el < $min ? $el : $min;
        $max = $max === null ||
          ($el > $max && $el < $elementSum[0][0]) ? $el : $max;
      }
    }

    $hasComma = false;
    foreach ([[$min, $max], $elementSum[0]] as $ar) {
      if ($hasComma) {
        echo ",";
      }
      echo "[";
      $hasComma = false;
      foreach ($ar as $value) {
        if ($hasComma) {
          echo ",";
        }
        echo "$value";
        $hasComma = true;
      }
      echo "]";
      $hasComma = true;
    }
  }
  echo "\n";
}
foo([[0, 3], [6, 10]]); // [0,3],[6,10]
foo([[0, 5], [3, 10]]); //[0, 10]
foo([[0, 5], [2, 4]]); // [0, 5]
foo([[7, 8], [3, 6], [2, 4]]); // [2,6],[7,8]
foo([[3, 6], [3, 4], [15, 20], [16, 17], [1, 4], [6, 10], [3, 6]]); // [1,10],[15,20]