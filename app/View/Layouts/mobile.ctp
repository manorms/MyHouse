<?php ?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <title>Estructura basica de una pagina web en HTML5</title>
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->

    <!-- <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes, minimum-scale=1, maximum-scale=2"> -->
    <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">
    <style>
      /* following three (cascaded) are equivalent to above three meta viewport statements */
      /* see http://www.quirksmode.org/blog/archives/2014/05/html5_dev_conf.html */
      /* see http://dev.w3.org/csswg/css-device-adapt/ */
      @-ms-viewport { width: 100vw ; zoom: 100% ; }
      @viewport { width: 100vw ; zoom: 100% ; }
      @-ms-viewport { user-zoom: fixed ; }
      @viewport { user-zoom: fixed ; }
      /*@-ms-viewport { user-zoom: zoom ; min-zoom: 100% ; max-zoom: 200% ; }   @viewport { user-zoom: zoom ; min-zoom: 100% ; max-zoom: 200% ; }*/
      .material-icons {
          /*float: left;
          margin-right: 5px;
          margin-top: -5px;*/
      }
    </style>
    <?php
      echo $this->Html->css('jquery_mobile/jquery.mobile-1.4.5.min');

      echo $this->Html->script('jquery_mobile/jquery-1.11.1.min');
      echo $this->Html->script('jquery_mobile/jquery.mobile-1.4.5.min');

      echo $this->fetch('meta');
  		echo $this->fetch('css');
  		echo $this->fetch('script');
    ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
    rel="stylesheet">
</head>

<body>
  <div data-role="page">
  	<div data-role="header">...</div>
  	<div role="main" class="ui-content">
      <?php echo $this->Session->flash(); ?>
      <?php echo $this->Session->flash('auth'); ?>
      <?php echo $this->fetch('content'); ?>
    </div>
  	<div data-role="footer">...</div>
  </div>

</body>
</html>
