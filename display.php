<?php
include('Contributor.php');
if(!isset($_POST['save']))
{
$host  = $_SERVER['HTTP_HOST'];
$uri   = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
$page = 'input.php';
header("Location: http://$host$uri/$page");
}else{
// create object of Contributor
$obj = new Contributor();
//call github commit method
$gitDataAr = $obj->getGitHubCount($_POST['git_username'],$_POST['git_reponame']);
//call BitBucket commit method
$bitDataAr = $obj->getBitCount($_POST['bit_username'],$_POST['bit_reponame']);
}
?>
<center><div style='width:1000px;border: 15px solid #FFEEFF; padding: 10px;font-family: verdana; font-size: 15px'>
<?php 
if(isset($gitDataAr['error'])){
?>
<b>Error Message: <?php echo $gitDataAr['error']; ?></b>
<?php
}else{
?>
<b>Total Number of Commits by user in GitHub Repository: <?php echo $gitDataAr['data']; ?></b>
<?php } ?>
<br></div></center>
<center><div style='width:1000px;border: 15px solid #FFEEFF; padding: 10px;font-family: verdana; font-size: 15px'>
<?php 
if(isset($bitDataAr['error'])){
?>
<b>Error Message: <?php echo $bitDataAr['error']; ?></b>
<?php
}else{
?>
<b>Total Number of Commits by user in BitBucket  Repository: <?php echo $bitDataAr['data']; ?></b>
<?php } ?>
<br></div></center>
