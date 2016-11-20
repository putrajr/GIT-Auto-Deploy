<?php
set_include_path('/path/to/phpseclib-1.0.5/phpseclib/');

include('phpseclib-1.0.5/phpseclib/Net/SSH2.php');
//for using ssh/rsakey with/without password tutorial can see at:
//1. ssh/rsa without password : http://phpseclib.sourceforge.net/ssh/auth.html#rsakey
//2. ssh/rsa with password : http://phpseclib.sourceforge.net/ssh/auth.html#encrsakey
//include('phpseclib-1.0.5/phpseclib/Crypt/RSA.php');

//$ssh = new Net_SSH2('ip','port');
$ssh = new Net_SSH2('xxx.xxx.xxx.xxx','22');
//if (!$ssh->login('user root', 'password user root')) {
if (!$ssh->login('root', 'xxxxxxx')) {
    exit('Login Failed');
}
//$res = $ssh->exec('cd /var/www/my-repositories && git pull');
$res = $ssh->exec('cd /path/to/repositories/cloned && git pull');
echo $res;
?>