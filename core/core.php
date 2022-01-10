<?php
function view($name, $data = [])
{
        $dir = dirname(dirname(__FILE__));
        $views =  $dir.'/app/views/';
        $cache = $dir.'/public/cache';
        $blade = new eftec\bladeone\BladeOne($views,$cache);
        $blade->setMode(\eftec\bladeone\BladeOne::MODE_DEBUG);
        // $blade->setBaseUrl(assetUrl());
        // MODE_AUTO / MODE_DEBUG / MODE_FAST
        extract($data);
        echo  $blade->run($name , $data);
}

function assetUrl(){
    $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $actual_link . '/public/';
}

function redirect($path)
{
    header('Location: /'.$path);
}


function getAbsoluteUrl()
{
    $url = explode('?', "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]");
    return $url[0];
}

function getStrBetween($string, $start, $end){
    $string = ' ' . $string;
    $ini = strpos($string, $start);
    if ($ini == 0) return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
}

function helpText($text = 'title', $placement = 'top'){
    return '<a class="help-text" data-toggle="tooltip" data-placement="'.$placement.'" title="'.$text.'" ><i class="fa fa-question-circle-o "></i></a>';
}
function getFullUrl()
{
    $url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
    return $url;
}

function multiNum($arr, $place = 2)
{
    if (!empty($arr)) {
        foreach ($arr as $key => $value) {
            $arr[$key] = num($value , $place);
        }
    }
    return $arr;
}

function num($number, $place = 2)
{
    return number_format((float)$number, $place, '.', '');
}

/**
 * Generate a random string, using a cryptographically secure
 * pseudorandom number generator (random_int)
 *
 * For PHP 7, random_int is a PHP core function
 * For PHP 5.x, depends on https://github.com/paragonie/random_compat
 *
 * @param int $length      How many characters do we want?
 * @param string $keyspace A string of all possible characters
 *                         to select from
 * @return string
 */
function randomStr($length, $keyspace = '*^%$0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ{}[]=+-@#.&`~')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        $pieces []= $keyspace[random_int(0, $max)];
    }
    return implode('', $pieces);
}

function csrfToken($name = 'formToken'){
    $length = rand(40,60);
    $formId = randomStr(5);
    $token = randomStr($length);
    if(isset($_SESSION['validForm'])){
        unset($_SESSION['validForm']);
    }
    $_SESSION['validForm'][$formId][$name] = $token;
    $csrfToken = '<input type="hidden" name="_token" value="'.$token.'"/>';
    $csrfToken .= '<input type="hidden" name="formId" value="'.$formId.'"/>';
    return $csrfToken;
}

function validFormCheck($token,$formId)
{
    $check = $_SESSION['validForm'][$formId]['formToken'];
    unset($_SESSION['validForm'][$formId]['formToken']);
    if(empty($token) ||  $token != $check){
        // invalid form
        return false;
    }
    return true;
}


 // pagination helper function (remove page from the query string)
function removeQueryStringVarFromUrl($url, $key) {
    $url = preg_replace('/(.*)(?|&)' . $key . '=[^&]+?(&)(.*)/i', '$1$2$4', $url . '&');
    $url = substr($url, 0, -1);
    return $url;
}


// create pagination on array
function arrPagination($arrData, $pageSize = 20, $isFixSize = false ){
        // $temp = $arrData ;
        $queryString = '';
        if (isset($_SERVER['QUERY_STRING'])) {
            $queryString = removeQueryStringVarFromUrl($_SERVER['QUERY_STRING'], 'page');
        }
        $pagination = array();
        if(!isset($_GET['page']) || empty($_GET['page'])){
        $crrPage = 1;
        }else{
            $crrPage = $_GET['page'];
        }
        $total = count($arrData);

        if(!$isFixSize){
            if(isset($_GET['pageSize']) && !empty($_GET['pageSize'])){
                $pageSize = $_GET['pageSize'];
            }
        }
        $limit = $pageSize;

        $totalPages = ceil( $total/ $limit ); //calculate total pages
        $crrPage = max($crrPage, 1); //get 1 page when $crrPage <= 0
        $crrPage = min($crrPage, $totalPages); //get last page when $crrPage > $totalPages
        $offset = ($crrPage - 1) * $limit;
        if( $offset < 0 ) $offset = 0;

        $pagination['data'] = array_slice( $arrData, $offset, $limit );
        $htmlCode = '';
        $htmlCode .= '<div class="row"> ';
        $htmlCode .= '<div class="col-md-4 col-sm-4 text-left" style="margin: 20px 0;">';
        $htmlCode .= 'Showing '.($offset+1).' to ';
        if($total< $limit){
            $htmlCode .=($total);
        }elseif(($total - $offset) < $limit){
            $htmlCode .= ($total - $offset);
        }else{
            $htmlCode .= ($offset + $limit);
        }
        $htmlCode .= ' of '.$total.' entries';
        $htmlCode .= '</div>';
        $htmlCode .= '<div class="col-md-8 col-sm-8 text-right"> ';
        $htmlCode .= '  <nav aria-label="Page navigation">';
        $htmlCode .= '      <ul class="pagination">';

        if(!isset($crrPage) || $crrPage == 1 || empty($crrPage) ){
            $htmlCode .= '          <li class="disabled">';
            $htmlCode .= '              <a href="javascript:void(0)" aria-label="Previous">';
            $htmlCode .= '                  <span aria-hidden="true">&laquo; Previous</span>';
            $htmlCode .= '              </a>';
            $htmlCode .= '          </li>';

        }elseif ($crrPage > 1) {
            $link = '?'.$queryString.'&page='.($crrPage - 1);
            $htmlCode .= '          <li>';
            $htmlCode .= '              <a href="'.$link.'" aria-label="Previous">';
            $htmlCode .= '                  <span aria-hidden="true">&laquo; Previous</span>';
            $htmlCode .= '              </a>';
            $htmlCode .= '          </li>';
        }

         $max = 7;

        if($crrPage < $max){
            $sp = 1;
        }
        elseif($crrPage >= ($totalPages - floor($max / 2)) ){
                    $sp = $totalPages - $max + 1;
        }
            elseif($crrPage >= $max){
                $sp = $crrPage  - floor($max/2);
            }

            if(isset($crrPage) && $crrPage >= $max ){
            $link = '?'.$queryString.'&page=1';
                $htmlCode .='<li ><a href="'.$link.'">1</a></li>';
                $htmlCode .='<li><a href="javascript:void(0)">..</a></li>';
            }


            for ($i = $sp; $i <= ($sp + $max -1);$i++) {
            $link = '?'.$queryString.'&page='.$i;
                 if($i > $totalPages)
                        continue;

                    if($crrPage == $i){
                        $htmlCode .= '<li class="active" ><a href="javascript:void(0)" >'.$i.'</a></li>';
                    }
                    else{
                        $htmlCode .= '<li><a href="'.$link.'">'.$i.'</a></li>';
                    }
            }

            if( isset($crrPage) && $crrPage < ($totalPages - floor($max / 2))){
                $htmlCode .='<li><a href="javascript:void(0)">..</a></li>';
                    $link = '?'.$queryString.'&page='.$totalPages;
                $htmlCode .='<li><a href="'.$link.'">'.$totalPages.'</a></li>';
            }

            if(isset($crrPage) && $crrPage < $totalPages){
                    $nextLink = '?'.$queryString.'&page='.($crrPage+1);
            $htmlCode .= '<li> <a href="'.$nextLink.'" aria-label="Next"> <span aria-hidden="true">Next&raquo;</span> </a> </li>';
            }else{
                $htmlCode .= '<li class="disabled"> <a href="javascript:void(0)" aria-label="Next"> <span aria-hidden="true">Next&raquo;</span> </a> </li>';
            }

        $htmlCode .= '      </ul>';
        $htmlCode .= '  </nav>';
        $htmlCode .= '</div>'; // end of col-md-12
        $htmlCode .= '</div>'; // end of row

        $pagination['htmlCode'] = $htmlCode;

        return $pagination ;
    }
    function is_decimal( $val )
    {
        return is_numeric( $val ) && floor( $val ) != $val;
    }


    // return date array
    // date array contain first and last date of each month of given year
    function monthFirstLastDate($year = '2019'){
        $date = array();

        for ($i=1; $i <= 12 ; $i++) {
            $date[$i]['first'] = strtotime("01-$i-$year");
            $date[$i]['last'] = strtotime(date("t-m-Y", strtotime("15-$i-$year")));
        }
        return $date;
    }


?>