<?php

echo "<pre>";
$res = array();
//get details from last commit
exec("git log --name-only --max-count=4", $res);

//keep only files names, not commit details
foreach($res as $k=>$string)
{
	if(!is_file($string))
		unset($res[$k]);
}

//recount array
array_values($res);

echo "<h1>Files found in git log result:</h1>";
print_r($res);
echo "<hr />";

