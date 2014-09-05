<?php

class ColumnUtil {

  public static function the_column_class($numberOfBoxes, $index) {

    $columnClass = "col-md-".(12/$numberOfBoxes);
    $offsetClass = "";

    if($numberOfBoxes == 1) {
      $columnClass = "col-md-8";
      $offsetClass = "col-md-offset-2";
    }

    if($numberOfBoxes == 2) {
      $columnClass = "col-md-5";
      if($index == 0) {
        $offsetClass = "col-md-offset-1";
      }
    }

    echo $columnClass." ".$offsetClass;
  }
}

?>
