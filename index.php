<?php
        require 'vendor/autoload.php';

        error_reporting(E_ALL);
        ini_set('display_errors', 1);
        Core\App::bind('config',require 'config.php') ;



        require 'core/core.php';
        require 'app/helper/helper.php';

        /*--- temp use for creating the backup on every refresh  --- */
        Core\Router::load('app/routes.php')->direct(Core\Request::uri(), Core\Request::method());
  ?>
