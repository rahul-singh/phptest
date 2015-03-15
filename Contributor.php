<?php
include('BaseAction.php');
class Contributor extends BaseAction{
	public function getCommitCounts($url){
		$data = null;
		try{
		$result = parent::curlInit($url);
		$data = parent::jsonDecode($result);
		}catch(Exception $e){
			 echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		return $data;
	}
	// get git commit count from git hub
	public function getGitHubCount(){
	 try{
	 $userName='rahul-singh'; 
	 $url = IBase::GIT_BASE_URL.$userName.IBase::GIT_REPO_NAME.IBase::GIT_CONTRIBUTOR_URL_SUFFIX;
	 $data = $this->getCommitCounts($url);
	 $obj = $data[0];
	 } catch(Exception $e) {
		 echo 'Caught exception: ',  $e->getMessage(), "\n";
	 }	 
	 return $obj->total;
	}
	// get bit commit count from bit bucket
	public function getBitCount(){
	try{	
	 $userName='rahulas5'; 	 
	 $url = IBase::BIT_BASE_URL.$userName.IBase::BIT_REPO_NAME.IBase::BIT_CONTRIBUTOR_URL_SUFFIX;
	  $data = $this->getCommitCounts($url);
	  } catch(Exception $e) {
		 echo 'Caught exception: ',  $e->getMessage(), "\n";
	 }	 
	 return  $data->count; 
	}
}
// create object
$obj = new Contributor();
//call github commit method
echo "getGitHubCount::".$obj->getGitHubCount();
echo "<br/>";

//call bithub commit method
echo "getBitCount::".$obj->getBitCount();
?>
