<?php
/**
  * it show the data on home page
  */
namespace App\Controller;
// use App\Core\ClassDb;
use App\Models\Quote;

class homePage
{
    public function index()
    {
        $quotes = (new Quote())->page(5)->limit(5)->withPagination();
        view('quotes' ,compact('quotes'));
    }
 }
?>
