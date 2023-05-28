<?php

namespace application\lib;

class Utils {

    public function isAssoc(array $arr){
        if (array() === $arr) return false;
        return array_keys($arr) !== range(0, count($arr) - 1);
    }

	public function getPaginator($totalItems, $listSize, $strUrlPage) {

		$pages = ceil($totalItems / $listSize);

		$sort = isset($_GET['sort']) ? '?sort='.$_GET['sort'] : '';

		$pager =  "<nav aria-label='Page navigation'>";
        $pager .= "<ul class='pagination'>";
        for($i=1; $i<=$pages; $i++) {
            $pager .= "<li class='page-item'><a class='page-link' href='/$strUrlPage/$i/$sort'> $i </a></li>";
        }
        $pager .= "</ul>";

        return $pager;

	}

// substitute get parameter
    public function sgp($url, $varname, $value) {
     
    preg_match('/^([^?]+)(\?.*?)?(#.*)?$/', $url, $matches);
    $gp = (isset($matches[2])) ? $matches[2] : ''; // GET-parameters
    
    if (!$gp) {
        $url .= strpos($url, '?') === false ? '?' : '&';
        $url .= $varname.'='.$value;
        return $url;
    }
   
    $pattern = "/([?&])$varname=.*?(?=&|#|\z)/";
    if (preg_match($pattern, $gp)) {
        $substitution = ($value !== '') ? "\${1}$varname=" . preg_quote($value) : '';
        $newgp = preg_replace($pattern, $substitution, $gp); // new GET-parameters
        $newgp = preg_replace('/^&/', '?', $newgp);
    }
    else    {
        $s = ($gp) ? '&' : '?';
        $newgp = $gp.$s.$varname.'='.$value;
    }
   
    $anchor = (isset($matches[3])) ? $matches[3] : '';
    $newurl = $matches[1].$newgp.$anchor;
    return $newurl;
}



}