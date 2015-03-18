<?php
error_reporting( E_ERROR );
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
	public function getGitHubCount($userName,$reop){
	$gitData = array();
	try{
	  $url = IBase::GIT_BASE_URL.$userName."/".$reop.IBase::GIT_CONTRIBUTOR_URL_SUFFIX; 	 
	  $data = $this->getCommitCounts($url);
	  if(isset($data->message)){
		  $gitData['error'] = $data->message;  
	   }else{
		   $obj = $data[0];
		   $gitData['data'] = $obj->total;
	   }
	 } catch(Exception $e) {
		  echo 'Caught exception: ',  $e->getMessage(), "\n";
	 }	 
	 return $gitData;
	}
	// get bit commit count from bit bucket
	public function getBitCount($userName,$reop){
	 $bitData = array();
	 try{	
	   $url = IBase::BIT_BASE_URL.$userName."/".$reop.IBase::BIT_CONTRIBUTOR_URL_SUFFIX;
	   $data = $this->getCommitCounts($url);
	  if(isset($data->count)){
		  $bitData['data'] = $data->count;  
	   }else{
		   $obj = $data->error;
		   $bitData['error'] = $obj->message;
	   }
	  } catch(Exception $e) {
		 echo 'Caught exception: ',  $e->getMessage(), "\n";
	 }	 
	 return  $bitData; 
	}
}
?>
