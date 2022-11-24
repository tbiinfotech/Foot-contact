<?php
$url="http://15.188.226.196/public/reset/".$mailData['reset_token'];
?>
<!DOCTYPE html>
<html>
<head>
 <title>Reset Password</title>
</head>
<body>
<h1>Reset Password</h1>
 <p >Please open link in new tab:- 
 <a href=<?= $url ?>>Click Here</a>

</body>
</html>
