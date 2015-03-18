<?php
interface IBase{
	 //define constants 
	 const AGENT = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1; .NET CLR 1.0.3705; .NET CLR 1.1.4322)';
	 const GIT_BASE_URL = 'https://api.github.com/repos/';
	 const GIT_CONTRIBUTOR_URL_SUFFIX = '/stats/contributors';	 
	 const BIT_BASE_URL = 'https://bitbucket.org/api/1.0/repositories/';
	 const BIT_CONTRIBUTOR_URL_SUFFIX = '/changesets?limit=0';
	 public function getConnection();
	 public function logger();
	 public function curlInit($url);	  
	 public function jsonDecode($result);
	 //define other methods
}
?>

