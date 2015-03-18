<html>
<body>
<h2><center> Commit Count Form</center></h2>
<form action="display.php" method="POST">
<table align="center" style='width:600px;border: 5px solid #FFEEFF; padding: 20px;font-family: verdana; font-size: 15px'>
<tr><td>Please Fill Valid GitHub User Name : </td><td><input type="text" name="git_username" value="rahul-singh" required></td></tr>
<tr><td>Please Fill Valid GitHub Repository :</td> <td><input type="text" name="git_reponame" value="phptest"  required></td></tr>
<tr><td>Please Fill Valid BitBucket User Name :</td> <td><input type="text" name="bit_username" value="rahulas5" required></td></tr>
<tr><td>Please Fill Valid BitBucket Repository :</td><td><input type="text" name="bit_reponame" value="phptest1" required></td></tr>
 <br/>
<tr><td><input type="submit" name="save" value="CommitCounts"/></td></tr>
</form>
</table>
</body>
</html>
