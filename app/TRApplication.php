<?php

//! Front-end processor
class TRApplication extends Controller {
    function mainPage($f3, $args) {
		  $f3->set('content','main.htm');
      $f3->set('buddy',array('Tom','Dick','Harry'));
      echo  \Template::instance()->render('layout.htm');
    }

    function error($error) {
      echo "Error occured";
      echo "<pre>";
      echo var_dump($error);
      echo "</pre>";
    }
}
?>