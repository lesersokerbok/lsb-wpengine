<?php

class ColumnUtil {

  public static function the_column_class($numberOfBoxes, $index) {

    $columnClass = "col-md-".(12/$numberOfBoxes);

    echo $columnClass;
  }
}

?>
