<?php
        $config = require 'config.php';

       // $router->get('', 'homePage@index');
       $router->get('', 'QuotesController@index');
       $router->get('quotes', 'QuotesController@index');
       $router->get('images', 'ImagesController@index');
       $router->get('category', 'ImagesController@cat');
       $router->get('404', 'app/controllers/404.php' );


/*
GET     /photos index   photos.index
GET     /photos/create  create  photos.create
POST    /photos store   photos.store
GET     /photos/{photo} show    photos.show
GET     /photos/{photo}/edit    edit    photos.edit
PUT/PATCH       /photos/{photo} update  photos.update
DELETE  /photos/{photo} destroy photos.destroy
*/
?>
