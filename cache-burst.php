<?php

//generate unique hash code for cache bursting
function getUniqueHashCode()
{
	$rand_no=md5(rand(0,99999));
    return $rand_no;
}
?>