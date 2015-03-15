<?php
include('IBase.php');
class BaseAction implements IBase{
	public $conn = null;
	public $result = null;
	public $data = null;
	 
	 public function getConnection(){
		// define connection code here
		return $conn;
	 }
	 public function logger(){
		 // Define Logger to Log Message
	 }
	 /**
	 initialize curl with given url
	 return : $result
	 */
	 public function curlInit($url){
		 try{
		 $ch = curl_init();
		 curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		 curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		 curl_setopt($ch, CURLOPT_URL,$url);
		 curl_setopt($ch, CURLOPT_USERAGENT, IBase::AGENT);
		 $result=curl_exec($ch);
         curl_close($ch);
		 }catch(Exception $e){
			 echo 'Caught exception: ',  $e->getMessage(), "\n";
		 }
		 return $result;
	 } 
	 /**
	 json decode
	 return : $result
	 */
	 public function jsonDecode($result){
	    try{
			$data = json_decode($result);
		}catch(Exception $e){
			 echo 'Caught exception: ',  $e->getMessage(), "\n";
		 }
		return $data;
	 }
}
?>
