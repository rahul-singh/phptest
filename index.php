abstract class GitHubClientBase
 {
+	const GITHUB_AUTH_TYPE_BASIC = 'basic';
+	const GITHUB_AUTH_TYPE_OAUTH_BASIC = 'x-oauth-basic';
+
 	protected $url = 'https://api.github.com';
 	protected $uploadUrl = 'https://uploads.github.com';
 
 @@ -12,7 +15,10 @@
 	protected $timeout = 240;
 	protected $rateLimit = 0;
 	protected $rateLimitRemaining = 0;
-	
+
+	protected $authType = self::GITHUB_AUTH_TYPE_BASIC;
+	protected $oauthKey = null;
+
 	protected $page = null;
 	protected $pageSize = 100;
 	
 @@ -25,12 +31,39 @@
 	protected $lastExpectedHttpCode = null;
 	protected $pageData = array();
 
+	public function setAuthType($type)
+	{
+		switch($type)
+		{
+			case self::GITHUB_AUTH_TYPE_OAUTH_BASIC:
+				$this->authType = self::GITHUB_AUTH_TYPE_OAUTH_BASIC;
+				break;
+			case self::GITHUB_AUTH_TYPE_BASIC:
+			default:
+				$this->authType = self::GITHUB_AUTH_TYPE_BASIC;
+		}
+	}
+
 	public function setCredentials($username, $password)
 	{
+		if($this->authType != self::GITHUB_AUTH_TYPE_BASIC)
+		{
+			throw new GitHubClientException("Cannot set credentials when authentication type is not 'basic'");
+		}
+
 		$this->username = $username;
 		$this->password = $password;
 	}
 	
+	public function setOauthKey($key)
+	{
+		if($this->authType != self::GITHUB_AUTH_TYPE_OAUTH_BASIC)
+		{
+			throw new GitHubClientException("Cannot set OAuth key when authentication type is not 'x-oauth-basic'");
+		}
+		$this->oauthKey = $key;
+	}
+
 	public function setDebug($debug)
 	{
 		$this->debug = $debug;
 @@ -150,11 +183,16 @@ protected function doRequest($url, $method, $data, $contentType = null, $filePat
 
 		curl_setopt($c, CURLOPT_VERBOSE, $this->debug); 
 		
-		if($this->username && $this->password)
+		if($this->authType == self::GITHUB_AUTH_TYPE_BASIC && $this->username && $this->password)
 		{
 			curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC); 
 			curl_setopt($c, CURLOPT_USERPWD, "$this->username:$this->password");
 		}
+		elseif($this->authType == self::GITHUB_AUTH_TYPE_OAUTH_BASIC && $this->oauthKey)
+		{
+			curl_setopt($c, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
+			curl_setopt($c, CURLOPT_USERPWD, "$this->oauthKey:".self::GITHUB_AUTH_TYPE_OAUTH_BASIC);
+		}
 		 
 		curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
 		curl_setopt($c, CURLOPT_USERAGENT, "tan-tan.github-api");
