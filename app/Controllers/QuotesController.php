<?php
namespace App\Controllers;

use App\Models\Quote;
/**
  * it show the data on home page
  */

class QuotesController
{
	private $pageSize = 12;
	private $quote = '';

	function __construct()
 	{
 		$this->quote = new Quote();
 	}
    public function index()
    {
        $quotes = $this->quote->quotesWithCategory($this->pageSize);
        // echo "<pre>"; print_r($quotes); echo "</pre>"; die();
        // echo "<pre>"; print_r($quotes['data']); echo "</pre>"; die();
        view('quotes', compact('quotes'));
    }

 }


?>
