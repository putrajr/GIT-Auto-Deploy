<?php
$project_dir = "";						// "/var/www/html/deploy"
$server_seperator="/";					// "/" in linux and unix, "\\" in windows

$repository_username_url_ssh = "";		// "https://bitbucket.org/putrajr"
$repository_name = "";					// "git-auto-deploy"
$branches = "";							// "master"

$root_user = "";						// "root"
$rsa_file_path="";						// "/root/server/ssh/xyz.file"
$root_or_rsa_password = "";				// "123456"

$ip_server= "";							// "192.168.1.6"
$port_ssh_server = "22";				// default port ssh is "22"

$type_auth =1;							/* type_auth:
										1. password
										2. rsa without password
										3. rsa with password */

set_include_path(__DIR__.'phpseclib-1.0.5/phpseclib/');

include('phpseclib-1.0.5/phpseclib/Net/SSH2.php');

$ssh = new Net_SSH2($ip_server,$port_ssh_server);
if($type_auth>1){
	include('phpseclib-1.0.5/phpseclib/Crypt/RSA.php');
	$key = new Crypt_RSA();
	if($type_auth>2){
		$key->setPassword($root_or_rsa_password);
	}
	$key->loadKey(file_get_contents($rsa_file_path));
}else{
	$key=$root_or_rsa_password;
}
if (!$ssh->login($root_user, $key)) {
	exit('Login Failed');
}
if($server_seperator=="/"){
	$cmd="cd ";
}else{
	$cmd="cd \D ";
}
if(is_dir($project_dir.$server_seperator.$repository_name)){
	$res = $ssh->exec($cmd.$project_dir.$server_seperator.$repository_name.' && git pull');
}else{
	$res = $ssh->exec($cmd.$project_dir.' && git clone -b '.$branch.' '.$repository_username_url_ssh.'/'.$repository_name);
}
echo $res;
?>