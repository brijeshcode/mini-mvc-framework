<?php
/**
  * it show the data on home page
  */
namespace App\Controllers;
use App\Models\Image ;

class ImagesController
{
	private $pageSize = 12;
	private $image = '';

	function __construct()
 	{
 		$this->image = new Image();
 	}
    public function index()
    {
        $imgs = $this->image->withCategory($this->pageSize);
        // echo "<pre>"; print_r($imgs); echo "</pre>"; die();
        view('images', compact('imgs'));
    }

    public function cat($category)
    {
      echo $category;
    }
 }


?>
