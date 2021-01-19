<?php

$n = array(1,2,3,4,5,6,7,8,9);
$null_options = array();
@$linha = $_POST['linha'];

?>
<div>
  <div style="width: 49%; float: left; text-align: center">
    <p>INITIAL SUDOKU</p>
    <form method="POST" action="#">
      <table style="border: 1px solid; border-collapse: collapse;" align="center">
        <?php
          if(@$_POST){
            for($i = 0; $i<9; $i++){
              echo "<tr>";
              for($j = 0; $j<9; $j++){
                echo "<td>";
                echo '<input name="linha['.$i.']['.$j.']" value="'.$linha[$i][$j].'" style="width: 50px; height: 50px; text-align: center; font-size: 32px" />';
                echo "</td>";
              }
              echo "</tr>";
            }
          }else{
            for($i = 0; $i<9; $i++){
              echo "<tr>";
              for($j = 0; $j<9; $j++){
                echo "<td>";
                echo '<input name="linha['.$i.']['.$j.']" value="" style="width: 50px; height: 50px; text-align: center; font-size: 32px" />';
                echo "</td>";
              }
              echo "</tr>";
            }
          }
        ?>
      </table>
      <input type="submit" value="Solve Sudoku" style="width: 300px; height: 50px; font-size: 22">
    </form>
  </div>
  <div style="width: 49%; float: left; text-align: center">
    <p style="color: red">SOLVED SUDOKU</p>
    <?php
      if(@$_POST){
        for($i = 0; $i<9; $i++){
          for($j = 0; $j<9; $j++){
            if($linha[$i][$j]){
              $sudoku[$i][$j] = intval($linha[$i][$j]);
            }else{
              $sudoku[$i][$j] = null;
            }
          }
        }
        foreach($sudoku as $lk => $line){
          foreach($line as $ik => $item){
            if($item == null){
              array_push($null_options, $lk.$ik);
            }
          }
        }
        resolver_sudoku($null_options, $n, $sudoku);
      }
    ?>
  </div>
</div>

<?php

//Function used to solve sudoku
function resolver_sudoku($array, $n, $sudoku, $description = ''){
  //$last is used to description
  $last = '';

  //Foreach in array of positions without solutions
  foreach($array as $a){
    //First step: Trying to solve using row
    $array_verificador = array_diff($n, $sudoku[$a[0]]);
    if(count($array_verificador) == 1){
      foreach($array_verificador as $value){
        $sudoku[$a[0]][$a[1]] = $value;
        if(@$last != $a){
          $description .= "Line => Position: ".$a." | Value: ".$value."<br>";
          $last = $a;
        } 
      }
      foreach (array_keys($array, $a) as $key) {
        unset($array[$key]);
      }
    }
    //End of Solving using Row

    //Second step: Trying to solve using column
    for($i=0;$i<9;$i++){
      foreach (array_keys($array_verificador, $sudoku[$i][$a[1]]) as $key) {
        unset($array_verificador[$key]);
      }
    }
    if(count($array_verificador) == 1){
      foreach($array_verificador as $value){
        $sudoku[$a[0]][$a[1]] = $value;
        if(@$last != $a){
          $description .= "Column => Position: ".$a." | Value: ".$value."<br>"; 
          $last = $a;
        }
      }
      foreach (array_keys($array, $a) as $key) {
        unset($array[$key]);
      }
    }
    //End of solving using column

    //Third step: Last solving using Matrix
    //Get the positions of matrix (is not the best, but it's work) 
    if($a[0] == 0 || $a[0] == 1 || $a[0] == 2){
      $x = 0;
    }
    if($a[0] == 3 || $a[0] == 4 || $a[0] == 5){
      $x = 3;
    }
    if($a[0] == 6 || $a[0] == 7 || $a[0] == 8){
      $x = 6;
    }

    if($a[1] == 0 || $a[1] == 1 || $a[1] == 2){
      $y = 0;
    }
    if($a[1] == 3 || $a[1] == 4 || $a[1] == 5){
      $y = 3;
    }
    if($a[1] == 6 || $a[1] == 7 || $a[1] == 8){
      $y = 6;
    }
    //Verifying the matrix to trying solve de solution
    for($i=$x; $i<$x+3; $i++){
      for($j=$y; $j<$y+3; $j++){
        foreach (array_keys($array_verificador, $sudoku[$i][$j]) as $key) {
          unset($array_verificador[$key]);
        }
        if(count($array_verificador) == 1){
          foreach($array_verificador as $value){
            $sudoku[$a[0]][$a[1]] = $value;
            if(@$last != $a){
              $description .= "Matriz => Position: ".$a." | Value: ".$value."<br>"; 
              $last = $a;
            }
          }
          foreach (array_keys($array, $a) as $key) {
            unset($array[$key]);
          }
        }
      }
    }
  }
  //End of third solution

  //Count if an array has positions without solution, if exists, just run again the function until all positions have a solution
  if(count($array) > 0){
    resolver_sudoku($array, $n, $sudoku, $description);
  //If not, print table with the solved sudoku
  }else{
    echo '<table style="border: 1px solid; border-collapse: collapse" align="center">';
      for($i = 0; $i<9; $i++){
        echo "<tr>";
        for($j = 0; $j<9; $j++){
          echo "<td>";
          echo '<input value="'.$sudoku[$i][$j].'" style="width: 50px; height: 50px; text-align: center; font-size: 32px" />';
          echo "</td>";
        }
        echo "</tr>";
      }
    echo '</table>';
    echo "<b>--DESCRIPTION--</b><br>";
    echo $description;
  }
}

    

?> 
