<?php
/*
cr: 13 - instagram: sizdahorg

کانال تلگرام ما:
@tmsizdah
کانال یوتیوب ما:
youtube.com/@13learn
youtube.com/@13hack

اینستاگرام برای سوالات و...:
@sizdahorg
*/
ob_start();
define('API_KEY','8473441275:AAGnWHju-vvGtWvdGU3gmt-smwMJ8PusT_0');
//-----------------------------------------------------------------------------------------
//فانکشن Mrbertbot :
function mahdi($method,$datas=[]){
    $url = "https://api.telegram.org/bot".API_KEY."/".$method;
    $ch = curl_init();
    curl_setopt($ch,CURLOPT_URL,$url);
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    curl_setopt($ch,CURLOPT_POSTFIELDS,$datas);
    $res = curl_exec($ch);
    if(curl_error($ch)){
        var_dump(curl_error($ch));
    }else{
        return json_decode($res);
    }
}
//-----------------------------------------------------------------------------------------
//متغیر ها :
// msg
$Dev = array("6124319854","6124319854","6124319854"); 
$usernamebot = "member_gir_free_new_bot";
$channel = "https://t.me/new_membergir";
$channelcode = "c2";  // کانالی که کد سکه ها در ان ارسال میشود
$web = "htdocs/bot.php";
$token = API_KEY;
//-----------------------------------------------------------------------------------------------
global $update;
$message = $update->message;
$from_id = $message->from->id;
$chat_id = $message->chat->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$username = $message->from->username;
$textmassage = $message->text;
$firstname = $update->callback_query->from->first_name;
$usernames = $update->callback_query->from->username;
$chatid = $update->callback_query->message->chat->id;
$fromid = $update->callback_query->from->id;
$membercall = $update->callback_query->id;
//------------------------------------------------------------------------
$data = $update->callback_query->data;
$messageid = $update->callback_query->message->message_id;
$tc = $update->message->chat->type;
$gpname = $update->callback_query->message->chat->title;
//------------------------------------------------------------------------
$forward_from = $update->message->forward_from;
$forward_from_id = $forward_from->id;
$forward_from_username = $forward_from->username;
$forward_from_first_name = $forward_from->first_name;
$reply = $update->message->reply_to_message->forward_from->id;
$reply_username = $update->message->reply_to_message->forward_from->username;
$reply_first = $update->message->reply_to_message->forward_from->first_name;
// ========================================================================
$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$from_id));
$tch = $forchannel->result->status;
$forchannelq = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$tchq = $forchannelq->result->status;
//=================================================================================================
//فانکشن ها :
function SendMessage($chat_id, $text){
mahdi('sendMessage',[
'chat_id'=>$chat_id,
'text'=>$text,
'parse_mode'=>'MarkDown']);
}
 function Forward($berekoja,$azchejaei,$kodompayam)
{
mahdi('ForwardMessage',[
'chat_id'=>$berekoja,
'from_chat_id'=>$azchejaei,
'message_id'=>$kodompayam
]);
}
function  getUserProfilePhotos($token,$from_id) {
  $url = 'https://api.telegram.org/bot'.$token.'/getUserProfilePhotos?user_id='.$from_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatMembersCount($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatMembersCount?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->result;
  return $result;
}
function getChatstats($chat_id,$token) {
  $url = 'https://api.telegram.org/bot'.$token.'/getChatAdministrators?chat_id=@'.$chat_id;
  $result = file_get_contents($url);
  $result = json_decode ($result);
  $result = $result->ok;
  return $result;
}
//--------------------------------------------------------------
@$user = json_decode(file_get_contents("data/user.json"),true);
@$juser = json_decode(file_get_contents("data/$from_id.json"),true);
@$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
//===================================================================
if(!in_array($from_id, $user["userlist"]) == true) {
$user["userlist"][]="$from_id";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
    }
//==================================================================
if(in_array($from_id, $user["blocklist"])) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🛑شما به خاطر رعایت نکردن قوانین از ربات مسدود شدید 

❇️ لطفا پیام دوباره ارسال نکنید",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
    		]);
}
if($textmassage=="/start" && $tc == "private"){	
if(in_array($from_id, $user["userlist"]) == true) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"به منوی اصلی ربات خوش امدید 🎉

🔻 از دکمه های زیر استفاده کنید",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤 عضو بگیر",'callback_data'=>'takemember'],['text'=>"🔖 حساب کاربری",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 زیر مجموعه",'callback_data'=>'member'],['text'=>"💳 خرید سکه",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ انتقال سکه",'callback_data'=>'sendcoin'],['text'=>"📍 پیگیری سفارش",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👮🏻 پشتیبانی",'callback_data'=>'sup'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help'],['text'=>"🚀 کُدسکه",'callback_data'=>'code']
   ],
  	],
	  	'resize_keyboard'=>true,
  	])
  	]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $first_name 😊
	
🎖 به ربات عضو گیر پلاس خوش اومدی 

ℹ️ این ربات چی کار میکنه ؟

📣 به وسیله این ربات میتونید برای کانالتون عضو رایگان دریافت کنید

🚀 کافیه شروع کنی به جمع کردن سکه و بعد با سکه های عضو کاملا واقعی و ایرانی دریافت کنید

🚦 اگه نیاز به توضیخات بیش تر داری از راهنما استفاده کن",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤 عضو بگیر",'callback_data'=>'takemember'],['text'=>"🔖 حساب کاربری",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 زیر مجموعه",'callback_data'=>'member'],['text'=>"💳 خرید سکه",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ انتقال سکه",'callback_data'=>'sendcoin'],['text'=>"📍 پیگیری سفارش",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👮🏻 پشتیبانی",'callback_data'=>'sup'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help'],['text'=>"🚀 کُدسکه",'callback_data'=>'code']
   ],
  	],
	  	'resize_keyboard'=>true,
  	])
  	]);
$juser = json_decode(file_get_contents("data/$from_id.json"),true);	
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="ثبت نشده !";
$juser["userfild"]["$from_id"]["setmember"]="ثبت نشده !";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
}
/*
cr: 13 - instagram: sizdahorg

کانال تلگرام ما:
@tmsizdah
کانال یوتیوب ما:
youtube.com/@13learn
youtube.com/@13hack

اینستاگرام برای سوالات و...:
@sizdahorg
*/
elseif(strpos($textmassage , '/start ') !== false  ) {
$start = str_replace("/start ","",$textmassage);
if(in_array($from_id, $user["userlist"])) {
mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"شما قبلا به ربات دعوت شده ایده ✔️
	
📍 و دیگر امکان عضویت مجدد در ربات وجود ندارد",
	   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤 عضو بگیر",'callback_data'=>'takemember'],['text'=>"🔖 حساب کاربری",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 زیر مجموعه",'callback_data'=>'member'],['text'=>"💳 خرید سکه",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ انتقال سکه",'callback_data'=>'sendcoin'],['text'=>"📍 پیگیری سفارش",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👮🏻 پشتیبانی",'callback_data'=>'sup'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help'],['text'=>"🚀 کُدسکه",'callback_data'=>'code']
   ],
  	],
	  	'resize_keyboard'=>true,
  	])
  	]);	
}
else 
{
$juser = json_decode(file_get_contents("data/$from_id.json"),true);	
$inuser = json_decode(file_get_contents("data/$start.json"),true);
$member = $inuser["userfild"]["$start"]["invite"];
$coin = $inuser["userfild"]["$start"]["coin"];
$memberplus = $member + 1;
$coinplus = $coin  + 0.5;
	mahdi('sendmessage',[
	'chat_id'=>$start,
	'text'=>"یک کابر با لینک دعوت شما وارد ربات شد ✔️
📌 تعداد افرادی که دعوت کرده اید : $memberplus
💰 موجودی شما : $coinplus سکه",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
 mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"سلام $first_name 😊
	
🎖 به ربات عضو گیر پلاس خوش اومدی 

ℹ️ این ربات چی کار میکنه ؟

📣 به وسیله این ربات میتونید برای کانالتون عضو رایگان دریافت کنید

🚀 کافیه شروع کنی به جمع کردن سکه و بعد با سکه های عضو کاملا واقعی و ایرانی دریافت کنید

🚦 اگه نیاز به توضیخات بیش تر داری از راهنما استفاده کن",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤 عضو بگیر",'callback_data'=>'takemember'],['text'=>"🔖 حساب کاربری",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 زیر مجموعه",'callback_data'=>'member'],['text'=>"💳 خرید سکه",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ انتقال سکه",'callback_data'=>'sendcoin'],['text'=>"📍 پیگیری سفارش",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👮🏻 پشتیبانی",'callback_data'=>'sup'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help'],['text'=>"🚀 کُدسکه",'callback_data'=>'code']
   ],
  	],
	  	'resize_keyboard'=>true,
  	])
  	]);	
$inuser["userfild"]["$start"]["invite"]="$memberplus";
$inuser["userfild"]["$start"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$start.json",$inuser);
$juser["userfild"]["$from_id"]["invite"]="0";
$juser["userfild"]["$from_id"]["coin"]="0";
$juser["userfild"]["$from_id"]["setchannel"]="ثبت نشده !";
$juser["userfild"]["$from_id"]["setmember"]="ثبت نشده !";
$juser["userfild"]["$from_id"]["inviter"]="$start";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif($cuser["userfild"]["$fromid"]["channeljoin"] == true){
$allchannel = $cuser["userfild"]["$fromid"]["channeljoin"];
for($z = 0;$z <= count($allchannel) -1;$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if($allchannel[$z] == true){
     mahdi('answercallbackquery', [
              'callback_query_id' =>$membercall,
            'text' => "📌 به دلیل ترک کانال @$allchannel[$z] دو سکه کاهش یافت",
            'show_alert' =>false
         ]);  
unset($cuser["userfild"]["$fromid"]["channeljoin"][$z]);
$cuser["userfild"]["$fromid"]["channeljoin"]=array_values($cuser["userfild"]["$fromid"]["channeljoin"]);  
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin - 2;
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);      
}
}
if($data=="panel"){
mahdi('editmessagetext',[
        'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به منوی اصلی ربات خوش امدید 🎉

🔻 از دکمه های زیر استفاده کنید",
   	'reply_markup'=>json_encode([
  	'inline_keyboard'=>[
   [
   ['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
   ],
    [
   ['text'=>"👤 عضو بگیر",'callback_data'=>'takemember'],['text'=>"🔖 حساب کاربری",'callback_data'=>'accont']
   ],
   [
   ['text'=>"🗣 زیر مجموعه",'callback_data'=>'member'],['text'=>"💳 خرید سکه",'callback_data'=>'bycoin']
   ],
      [
   ['text'=>"↗️ انتقال سکه",'callback_data'=>'sendcoin'],['text'=>"📍 پیگیری سفارش",'callback_data'=>'suporder']
   ],
      [
   ['text'=>"👮🏻 پشتیبانی",'callback_data'=>'sup'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help'],['text'=>"🚀 کُدسکه",'callback_data'=>'code']
   ],
  	],
	  	'resize_keyboard'=>true,
  	])
  	]);	
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["file"]="none";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif($data=="takecoin" ){
$rules = $cuser["userfild"]["$fromid"]["acceptrules"];
if($rules == false){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"⏱ یکم صبر کن ⏱

🛑 اول قوانین رو کامل بخون بعد شروع به سکه جمع کردن کن

1️⃣ با عضو شدن در هر کانال یک سکه دریافت میکنید
2️⃣ درصورت لفت دادن از هر کانال بعد از عضویت 2 سکه منفی دریافت میکنید
3️⃣  برای دریافت عضو برای کانال خودتون به اعضای هر 2 سکه میتوانید یک عضو دریافت کنید
4️⃣ درصورت ثبت کانال غیر اخلاقی از ربات مسدود خواهید شد

📌 اطلاعیه : در صورت وجود هر گونه مشکل و عضویت در کانال و نگرفتن سکه یا غیر اخلاقی بودن کانال با پشتیبانی در ارتباط باشید یا کانال مورد نظر را گزارش دهید

📍 قوانین رو بخون به دردت میخوره تا بعدن به مشکل نخوری دوست من

🔘 راهنما : لطفا پس از عضویت در هر کانال به ربات بازگشته و روی دریافت سکه بزنید

⚠️ برای مشاهده کامل قوانین و نحوه استفاده از ربات از دکمه راهنما استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"✅ قوانین را خواندم",'callback_data'=>"takecoin"],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
[
				   ['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help']
				   ],
                     ]
               ])
	]);	
$cuser["userfild"]["$fromid"]["acceptrules"]="true";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
		   }
else
{
if($tchq != 'member' && $tchq != 'creator' && $tchq != 'administrator'){
$join = $cuser["userfild"]["$fromid"]["canceljoin"];
if($join == false){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🎉 یک فرصت باورنکردی 🎉
			   
📣 شما داخل کانال ربات عضو نیستید یا عضویت تو کانال ما میتونی 2 سکه دریافت کنی
ℹ️ علاوه بر اون میتونی اطلاعات و اخرین بروز رسانی های و کد رایگان رو تو کانال دریافت کنی

📍 این فرصت دیگر قابل تکرار نیست از این فرصت استفاده کن دوست خوبم",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$channel"],['text'=>"💰 دریافت سکه",'callback_data'=>'mainchannel']
				   ],
				   [
				   ['text'=>"➡️ نمیخوام عضو بشم",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["canceljoin"]="true";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);		   
}
else
{
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📣 نام کانال : $name
📍 یوزرنیم کانال :  @$username	
📌 ایدی : $id	
🔗توضیحات کانال : $description",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$username"],['text'=>"💰 دریافت سکه",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ بعدی",'callback_data'=>'nextchannel'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   				   [
				   ['text'=>"🛑 گزارش",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);	
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لیست کانال ها به پایان رسیده لطفا دقایقی دیگر دوباره امتحان کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 امتحان دوباره",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
else
{
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📣 نام کانال : $name
📍 یوزرنیم کانال :  @$username	
📌 ایدی : $id	
🔗توضیحات کانال : $description",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$username"],['text'=>"💰 دریافت سکه",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ بعدی",'callback_data'=>'nextchannel'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 گزارش",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لیست کانال ها به پایان رسیده لطفا دقایقی دیگر دوباره امتحان کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 امتحان دوباره",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
}
elseif($data=="truechannel" ){
$getjoinchannel = $cuser["userfild"]["$fromid"]["getjoin"];
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$getjoinchannel."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
        mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "❌ هنوز داخل کانال عضو نیستید",
            'show_alert' =>true
        ]);
}
else
{
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "🎉 تبریک یک سکه اضافه شد 🎉",
            'show_alert' =>false
				   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$coinchannel = $user["setmemberlist"];
$channelincoin = $coinchannel[$arraychannel];
$downchannel = $channelincoin - 1;
$pluscoin = $coin + 1;
$cuser["userfild"]["$fromid"]["channeljoin"][]="$getjoinchannel";
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
if($downchannel > 0){
@$user = json_decode(file_get_contents("data/user.json"),true);
$user["setmemberlist"]["$arraychannel"]="$downchannel";
$user["setmemberlist"]=array_values($user["setmemberlist"]); 
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📣 نام کانال : $name
📍 یوزرنیم کانال :  @$username	
📌 ایدی : $id	
🔗توضیحات کانال : $description",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$username"],['text'=>"💰 دریافت سکه",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ بعدی",'callback_data'=>'nextchannel'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 گزارش",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لیست کانال ها به پایان رسیده لطفا دقایقی دیگر دوباره امتحان کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 امتحان دوباره",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
else
{
unset($user["setmemberlist"]["$arraychannel"]);
unset($user["channellist"]["$arraychannel"]);
$user["channellist"]=array_values($user["channellist"]); 
$user["setmemberlist"]=array_values($user["setmemberlist"]);  
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📣 نام کانال : $name
📍 یوزرنیم کانال :  @$username	
📌 ایدی : $id	
🔗توضیحات کانال : $description",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$username"],['text'=>"💰 دریافت سکه",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ بعدی",'callback_data'=>'nextchannel'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 گزارش",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لیست کانال ها به پایان رسیده لطفا دقایقی دیگر دوباره امتحان کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 امتحان دوباره",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
}
elseif($data=="nextchannel" ){
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "📌 در حال پردازش ...",
            'show_alert' =>false
        ]);
$arraychannel = $cuser["userfild"]["$fromid"]["arraychannel"];
$plusarraychannel = $arraychannel + 1 ;
$allchannel = $user["channellist"];
for($z = $plusarraychannel;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📣 نام کانال : $name
📍 یوزرنیم کانال :  @$username	
📌 ایدی : $id	
🔗توضیحات کانال : $description",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$username"],['text'=>"💰 دریافت سکه",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ بعدی",'callback_data'=>'nextchannel'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 گزارش",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser["userfild"]["$fromid"]["arraychannel"]="$z";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لیست کانال ها به پایان رسیده لطفا دقایقی دیگر دوباره امتحان کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 امتحان دوباره",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
elseif($data=="mainchannel" ){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=@".$channel."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
        mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "❌ هنوز داخل کانال عضو نیستید",
            'show_alert' =>true
        ]);
}
else
{
 mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "🎉 تبریک 2 سکه اضافه شد 🎉",
            'show_alert' =>false
        ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$pluscoin = $coin + 2;
$cuser["userfild"]["$fromid"]["coin"]="$pluscoin";
$cuser["userfild"]["$fromid"]["channeljoin"][]="$channel";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
@$user = json_decode(file_get_contents("data/user.json"),true);
$allchannel = $user["channellist"];
for($z = 0;$z <= count($allchannel);$z++){
$getchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$allchannel[$z]."&user_id=".$fromid));
$okchannel = $getchannel->result->status;
if($okchannel != 'member' && $okchannel != 'creator' && $okchannel != 'administrator'){
$omm = $allchannel[$z];
break;
}
}
if ($allchannel[$z] == true){
$url = file_get_contents("https://api.telegram.org/bot$token/getChat?chat_id=$allchannel[$z]");
$getchat = json_decode($url, true);
$name = $getchat["result"]["title"]; 
$username = $getchat["result"]["username"]; 
$id = $getchat["result"]["id"]; 
$description = $getchat["result"]["description"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📣 نام کانال : $name
📍 یوزرنیم کانال :  @$username	
📌 ایدی : $id	
🔗توضیحات کانال : $description",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"📣 عضویت در کانال",'url'=>"https://t.me/$username"],['text'=>"💰 دریافت سکه",'callback_data'=>'truechannel']
				   ],
				   [
				   ['text'=>"➡️ بعدی",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   				   				   [
				   ['text'=>"🛑 گزارش",'callback_data'=>'badchannel']
				   ],
                     ]
               ])
			   ]);
$cuser = json_decode(file_get_contents("data/$fromid.json"),true);
$cuser["userfild"]["$fromid"]["getjoin"]="$username";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لیست کانال ها به پایان رسیده لطفا دقایقی دیگر دوباره امتحان کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
				   ['text'=>"🔄 امتحان دوباره",'callback_data'=>'takecoin'],['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);
}
}
}
elseif($data=="badchannel"){
$getjoinchannel = $cuser["userfild"]["$fromid"]["getjoin"];
	 mahdi('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "📌 گزارش کانال غیر اخلاقی یا وجود مشکل برای ادمین ارسال شد",
            'show_alert' =>true
        ]);
	mahdi('sendmessage',[
	'chat_id'=>$Dev[0],
	'text'=>"⚠️ یک گزارش کانال غیر اخلاقی یا وجود مشکل برای کانال @$getjoinchannel ارسال شد
	
📍 توسط : 
🔸 ایدی : $fromid
🔹 یوزرنیم : @$usernames",
  	]);		
}
elseif($data=="accont"){
$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🎫 اطلاعات حساب شما :
			   
💰 تعداد سکه ها : $coin
📣 اخرین کانال ثبت شده : $setchannel
👤 اخرین تعداد عضو سفارش داده شد : $setmember
🗣 تعداد افراد دعوت کرده : $invite
📍 نام شما : $firstname
📍 یوزرنیم شما : @$usernames
📍 ایدی عددی شما : $fromid",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"⭐️ عضویت ها",'callback_data'=>'mechannel'],['text'=>"💳 سفارشات",'callback_data'=>'order']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="mechannel"){
$allchannel = $cuser["userfild"]["$fromid"]["channeljoin"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 "."@".$allchannel[$z]."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 لیست کانال های عضو شده توسط شما :
	
$result

⚠️ توجه کنید در صورت خروج از هر یک از کانال ها دو سکه از شما کسر میشود",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);		
}	
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 شما هنوز در هیچ کانالی برا جمع کردن سکه اضافه نشده اید
	
📌 با عضوت در هر کانال یک سکه دریافت کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
				   ],
				   ]
            ])           
  	]);		
}
}
elseif($data=="order"){
$allchannel = $cuser["userfild"]["$fromid"]["listorder"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 ".$allchannel[$z]."  عضو"."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 لیست سفارش های شما :
	
$result

📌 میتوانید وضعیت هر سفارش رو در قسمت پیگیری سفارش مشاهده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);		
}
else
{
$coin = $cuser["userfild"]["$fromid"]["coin"];
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 شما هنوز هیچ سفارشی برا جذب عضو ثبت نکرده اید
	
📌 در صورتی که تعداد سکه های شما بیش تر از 10 عدد است میتوانید برای کانال خود عضو سفارش دهید
💰 تعداد سکه ها : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"👤 عضو بگیر",'callback_data'=>'takemember']
				   ],
				   ]
            ])           
  	]);		
}
}
elseif($data=="member"){
$invite = $cuser["userfild"]["$fromid"]["invite"];
$coin = $cuser["userfild"]["$fromid"]["coin"];
		mahdi('sendphoto',[
	'chat_id'=>$chatid,
	'photo'=>new CURLFile("other/logo.jpg"),
	'caption'=>"🎖 ربات عضو گیر پلاس	
➖
📌 با این ربات میتونی عضو رایگان دریافت کنی اونم به صورت کاملا واقعی و ایرانی

🎉 از این فرصت عالی استفاده کن

🔗 لینک ورود :
https://t.me/$usernamebot?start=$fromid",
    		]);
	mahdi('sendmessage',[
	'chat_id'=>$chatid,
	'text'=>"📍 بنر بالا حاوی لینک دعوت اختصاصی شما برای وروده به ربات عضو پلاس است با اشتراک بنر برای گروه ها و دوستانتان سکه جمع کنید
	
📍 با دعوت هر دو نفر یک سکه دریافت میکنید [هر نفر نیم سکه]
💰 تعداد سکه ها : $coin
🗣 تعداد افراد دعوت کرده : $invite

🔆 در صورت خرید سکه توسط زیر مجموعه های شما 20 درصد به شما پورسانت تعلق میگیرد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);			
}
elseif($data=="sendcoin"){	

mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
	'text'=>"📍 برای ارسال سکه برای کاربر دیگر یا دوستت لطفا پیامی رو ازش فوروارد کن یا ایدی عددی فرد رو ارسال کن
	
📌 ایدی عددی هر فرد در بخش حساب کابری وی مشخص است",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
$cuser["userfild"]["$fromid"]["file"]="sendcoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);		
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendcoin') {
$coin = $juser["userfild"]["$from_id"]["coin"];
if($forward_from == true){
if($forward_from_id != $from_id){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کابر مورد نظر یافت شد ✅
			
📌 اطلاعات :
📍 نام  : $forward_from_first_name
📍 یوزرنیم  : @$forward_from_username
📍 ایدی عددی : $forward_from_id

🔆 لطفا تعداد سکه ارسالی را وارد کنید
💰 تعداد سکه ها : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setsendcoin";
$juser["userfild"]["$from_id"]["sendcoinid"]="$forward_from_id";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 نمیتونی که برای خودت سکه بفرستی !

📌 برای ارسال سکه برای کاربر دیگر یا دوستت لطفا پیامی رو ازش فوروارد کن یا ایدی عددی فرد رو ارسال کن",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
if($textmassage != $from_id){
if(is_numeric($textmassage)){
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$textmassage&user_id=".$textmassage);
$statjson = json_decode($stat, true);
$status = $statjson['ok'];
if($status == 1){
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کابر مورد نظر یافت شد ✅
			
📌 اطلاعات :
📍 نام  : $name
📍 یوزرنیم  : @$username
📍 ایدی عددی : $id

🔆 لطفا تعداد سکه ارسالی را وارد کنید
💰 تعداد سکه ها : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setsendcoin";
$juser["userfild"]["$from_id"]["sendcoinid"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 ایدی وارد شده صحیح نمیباشد

📌 لطفا با دقت بیش تری وارد کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 ایدی وارد شده اصلا عدد نیست !

📌 لطفا با دقت بیش تری وارد کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 نمیتونی که برای خودت سکه بفرستی !

📌 برای ارسال سکه برای کاربر دیگر یا دوستت لطفا پیامی رو ازش فوروارد کن یا ایدی عددی فرد رو ارسال کن",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);	
}
}
}	
elseif($juser["userfild"]["$from_id"]["file"] == "setsendcoin"){
$coin = $juser["userfild"]["$from_id"]["coin"];
$userid = $juser["userfild"]["$from_id"]["sendcoinid"];
$inuser = json_decode(file_get_contents("data/$userid.json"),true);
$coinuser = $inuser["userfild"]["$userid"]["coin"];
if($textmassage <= $coin && $coin > 0){
$coinplus = $coin - $textmassage;
$sendcoinplus = $coinuser + $textmassage;
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 سکه های ها با موفقیت انتقال پیدا کرد

📌 اطلاعات انتقال :
🔆 ایدی فرد : $userid
💰 تعداد سکه انتقال : $textmassage
💰 تعداد سکه های باقی مانده : $coinplus",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
		mahdi('sendmessage',[
	'chat_id'=>$userid,
	'text'=>"📍 تعداد $textmassage سکه برای شما انتقال پیدا کرد

📌 اطلاعات فرستنده :
🔆 ایدی فرد : $from_id
📍یوزرنیم : @$username",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
$juser["userfild"]["$from_id"]["file"]="none";
$juser["userfild"]["$from_id"]["coin"]="$coinplus";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
$inuser["userfild"]["$userid"]["coin"]="$sendcoinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$userid.json",$inuser);	
}
else
{
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 این تعداد سکه برای انتقال ندارید 
	
📌 حداکثر انتقال سکه : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
}
elseif($data=="suporder"){
$allchannel = $cuser["userfild"]["$fromid"]["listorder"];
for($z = 0;$z <= count($allchannel)-1;$z++){
$result = $at.$result."📍 ".$allchannel[$z]."  عضو"."\n";
}
if($result == true){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 لطفا یوزرنیم کانال مورد نظر را بفرستید
			   
📌 تا وضعیت سفارش خود را دریافت کنید
📣مثال : @$channel

➖➖➖➖
📍 لیست سفارشات شما :

$result",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
$cuser["userfild"]["$fromid"]["file"]="setorder";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 شما هنوز سفارشی ثبت نکرده اید 
			   
📌 ابتدا ثبت سفارش کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"👤 عضو بگیر",'callback_data'=>'takemember']
				   ],
                     ]
               ])
			   ]);	
}
}
elseif($juser["userfild"]["$from_id"]["file"] == "setorder"){
$searchchannel = array_search($textmassage,$user["channellist"]);
$setmember = $user["setmemberlist"][$searchchannel];
if(preg_match('/^(@)(.*)/s',$textmassage)){
if($searchchannel == true){
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆 سفارش در حال انجام است
	
🎫 اطلاعات سفارش شما :
	
📍 ایدی کانال : $textmassage
📍 تعداد عضو باقی مانده : $setmember

📌 در صورت وجود هر نوع مشکل یا اتمام نریسیدن سفارش بعد از 48 ساعت کافیست با پشتیبانی در ارتباط باشید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
else
{
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 سفارش شما به اتمام رسیده است",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);		
}
}
else
{
		mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 یوزرنیم کانال وارد شده نامعتبر است
			   
📌 لطفا یوزرنیم را به شکل صحیح وارد کنید
📣مثال : @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
				   ]
            ])           
  	]);	
}
}
elseif($data=="takemember"){
$coin = $cuser["userfild"]["$fromid"]["coin"];
if($coin >= 10){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 برای دریافت عضو یوزرنیم کانال خودت رو ارسال کن
➕ مثال : @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
$cuser["userfild"]["$fromid"]["file"]="setchannel";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);	
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 تعداد سکه کافی نمیباشد
			   
ℹ️ برای دریافت عضو حداقل باید شما ده سکه داشته باشید

💰 تعداد سکه های شما : $coin",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"💰 سکه بگیر",'callback_data'=>'takecoin']
				   ],
                     ]
               ])
			   ]);	
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setchannel') {
if(preg_match('/^(@)(.*)/s',$textmassage)){
$coin = $juser["userfild"]["$from_id"]["coin"];
$max = $coin / 2;
$maxmember = floor($max);
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کانال شما تنظیم شد ✅
			
📣 کانال تنظیم شد : $textmassage

📍 تعداد عضو کی میخواهید دریافت کنید را ارسال کنید
ℹ️ حداکثر میتوانید $maxmember عضو را دریافت کنید
💰 تعداد سکه های شما  : $coin
➕ مثال : 10",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="setmember";
$juser["userfild"]["$from_id"]["setchannel"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 یوزرنیم کانال ارسال شده نامعتبر نمیباشد یوزرنیم کانال با @ اغاز میشود
➕ مثال : @$channel",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setmember') {
$coin = $juser["userfild"]["$from_id"]["coin"];
$setchannel = $juser["userfild"]["$from_id"]["setchannel"];
$max = $coin / 2;
$maxmember = floor($max);
if($maxmember >= $textmassage){
$howmember = getChatMembersCount($setchannel,$token);
$endmember = $howmember + $textmassage;
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"ℹ️ اطلاعات سفارش : 

📣 ادرس کانال : $setchannel
👤 تعداد عضو سفارش داده شده : $textmassage
👥 تعداد اعضای کانال : $howmember
📌 تعداد اعضا بعد از سفارش : $endmember 

📍 ایا سفارش فوق را تایید میکنید ؟

⚠️ ربات را قبلا از تایید سفارش در کانال ادمین کنید علت و راهنمای ادمین کردن ربات رو میتوانید در راهنما ببنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"✅ تایید",'callback_data'=>'trueorder']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help']
				   ],
                     ]
               ])
 ]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser["userfild"]["$from_id"]["setmember"]="$textmassage";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 عدد وارد شده یا از حداکثر تعداد عضو که میتوانید دریافت کنید بیش تر است یا اصلا عدد نیست !
ℹ️ حداکثر میتوانیید عدد $maxmember این وارد کنید
➕ مثال : 10",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
/*
cr: 13 - instagram: sizdahorg

کانال تلگرام ما:
@tmsizdah
کانال یوتیوب ما:
youtube.com/@13learn
youtube.com/@13hack

اینستاگرام برای سوالات و...:
@sizdahorg
*/
elseif($data=="trueorder"){
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$admin = getChatstats(@$setchannel,$token);
if($admin != true){
	       mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "ℹ️ ربات داخل کانال ثبت شده باید ادمین باشد نحوه ادمین کردن و دلیل ان را در راهنما مبتوانید ببنید",
            'show_alert' =>true
        ]);
}
else
{
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 سفارش شما با موفقیت ثبت شد
			   
ℹ️ میتوانید اخرین وضعیت سفارش را در قست یپگیری سفارش ببنید

📌 توجه داشته باشید به هیچ عنوان  ربات را از ادمینی کانال خارج نکنید

⚠️ برای اطلاع از قوانین و برای این که بعدن دچار مشکل نشید حتما به قسمت راهنما و قوانین مراجعه کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help']
				   ],
                     ]
               ])
			   ]);	
$coin = $cuser["userfild"]["$fromid"]["coin"];
$setchannel = $cuser["userfild"]["$fromid"]["setchannel"];
$setmember = $cuser["userfild"]["$fromid"]["setmember"];
$pluscoin = $setmember * 2;
$coinplus = $coin - $pluscoin;
$cuser["userfild"]["$fromid"]["coin"]="$coinplus";
$cuser["userfild"]["$fromid"]["listorder"][]="$setchannel -> $setmember";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
$user["channellist"][]="$setchannel";
$user["setmemberlist"][]="$setmember";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
elseif($data=="bycoin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"این قسمت در حال حاضر غیر فعال میباشد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"غیرفعال",'url'=>"t.me/tmsizdah"],['text'=>"غیرفعال",'url'=>"t.me/tmsizdah"]
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="help"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ به بخش راهنما خوش امدید

📍 بخش مورد نطر را انتخاب کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="rules"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ قوانین و شرایط ربات :
			   
1️⃣ درصورت ثبت کانال غیر اخلاقی در ربات هم سفارش شما هم حساب شما از ربات مسدود خواهد شد
2️⃣ درصورت ارسال پیام مکرر و اسپم در ربات از ربات مسدود خواهید شد
3️⃣ ربات عضو پلاس هیچ مسولیتی در قبال تکمیل سفارش شما ندارد ممکن است تعداد از عضو ها بعد از عضو شدن از کانال لفت بدهند
4️⃣ ربات حتما باید در داخل کانال شما ادمین باشد در صورت ادمین نبودن ربات درست کار نمیکند و گزارش از طرف کابران ارسال میشود و کانال شما لغو سفارش میشود
5️⃣ درصورت انتقال سکه نادرست پشتیبانی هیچ مسولیتی را قبول نمیکند پس در انتقال سکه با دقت عمل کنید
6️⃣ خرید سکه به صورت کامل خودکار متصل به درگاه زرین پال است در صورت وجود هر گونه مشکل میتوانید با پشتیبانی در ارتباط باشید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="coinandmember"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ مباحث سکه | عضو :
			   
1️⃣ با عضویت در هر کانال یک سکه دریافت میکنید
2️⃣ با لفت دادن از کانال های عضو شده دو سکه منفی دریافت میکنید
3️⃣ برای دریافت هر عضو شما باید 2 سکه پرداخت کنید
4️⃣ در انتقال سکه هزینه بابت انتقال گرفته نمیشود
5️⃣ کد سکه ها کد های هستند که داخل کانال ربات گذاشته میشوند و به اندازه تایین شده توسط ادمین سکه هدیه میدهند",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="qu"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ سوالات متداول شما :
			   
📍چقدر طول میکشه سفارشم تکمیل بشه ؟
با توجه به ترافیک ربات سرعت سفارش شما انجام میشه اما به طور معمولا در طول 48 ساعت سفارش شما تکمیل خواهد شد

📍اگر سکه بخرم خودکار میاد یا باید پیام بدم پشتیبانی ؟
در صورت خرید سکه به صورت خودکار سکه برای شما واریز میشود

📍برای انتقال سکه میتونم یوزرنیم فرد رو بزنم ؟
خیر امکان این کار وجود ندارد و فقط تنها از طریق فوروارد و ایدی فرد امکان پذیر هستند",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="whyadmin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ چرا باید ربات را ادمین کنم :
			   
📍 ربات برای دیدن لیست عضو های کانال  شما و محاسبه دریافت سکه یا کم کردن سکه باید در کانال شما ادمین باشد 

📍 درصورت خارج کردن ربات از ادمینی کانال سفارش شما لغو و حساب شما مسدود خواهد شد

📍 از طرف ربات پیامی برای کانال شما ارسال نمیشود پس هرگز ربات را از ادمینی کانال خرج نکنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="howadmin"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ اموزش ادمین کردن ربات به صورت متنی :
			   
1️⃣ ابتدا به قسمت تنظیمات کانال بروید
2️⃣ سپس به قسمت adminstrators بروید
3️⃣ سپس روی add adminstrators کلیک کنید
4️⃣ بر روی علامت ذره بین کلیک کنید و سپس یوزرنیم ربات را وارد کنید [@$usernamebot]
5️⃣ سپس در لیست زیر روی نام ربات کلیک کنید و بعد از تیک بالای صحفه را بزنید

📍 مشاهده میکنید که نام ربات در لیست مدیران قرار گرفته است 

",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="about"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ درباره ربات :
			   
🤖 ربات عضو پلاس برنامه نویسی شده توسط تیم s4team است 

📌 تمام حقوق و متون پیام ها و سورس کد ربات محفوظ است و هر نوع کپی بر داری پیگرد قانونی دارد

🎉 ربات عضو پلاس راهی برای پیش رفت شما 
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="howuser"){
		mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"ℹ️ اموزش استفاده از ربات :
			   
1️⃣ سکه بگیر
📍با استفاده از دکمه دریافت سکه در منوی اصلی ربات میتوانید سکه جمع کنید پس از عضوت در هر کانال به ربات برگشته و از دکمه دریافت سکه استفاده کنید
📍 در صورت وجود هر نوع مشکل و کانال غیر اخلاقی یا عضویت در کانال و دریافت نکردن سکه از دکمه گزارش استفاده کنید و سپس دکمه بعد را بزنید

2️⃣ عضو بگیر
📍 پس از دریافت و جعع کردن سکه نوبت به دریافت عضو برای کانال خودتان هست برای دریافت عضو شما باید حداقل 10 سکه داشته باشید
📍 ربات در کانال سفارش داده شده باید ادمین باشد تا بتواند درست کار کند در صورت برداشتن ربات از ادمینی سفارش شما لغو خواهد شد
📍 کانال سفارش داده شده حتما باید کانال عمومی باشد

3️⃣ زیر مجموعه
📍 با دعوت دوستان خود به ربات با لینک اختصاصی خود میتوانید سکه دریافت کنید
📍در صورت خرید سکه توسط کسانی که شما دعوت میکنید 20 درصد به شما پورسنات از مقدار خریداری شده تعلق میگیرد

4️⃣ کد سکه :
📍 کد سکه کد های هستند که اگر شما نخستین نفری باشید که ان را داخل ربات وارد میکند میتوانید به اندازه ارزش کد سکه دریافت کنید
📍 کد سکه ها در کانال @$channel گذاشته میشود و ارزش هر کد سکه توسط ادمین تایین میشود",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   				   [
['text'=>"📍قوانین | شرایط",'callback_data'=>'rules'],['text'=>"📍مباحث سکه | عضو",'callback_data'=>'coinandmember']
				   ],
				   				   				   [
['text'=>"📍سوالات متداول",'callback_data'=>'qu'],['text'=>"📍علت ادمین کردن",'callback_data'=>'whyadmin']
				   ],
				   			   				   				   [
['text'=>"📍درباره ربات",'callback_data'=>'about'],['text'=>"📍اموزش استفاده",'callback_data'=>'howuser']
				   ],
				   			   				   				   [
['text'=>"📍نحوه ادمین کردن ربات",'callback_data'=>'howadmin']
				   ],
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
}
elseif($data=="code"){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🎖 به بخش کد سکه خوش امدید 
			   
📍 کد سکه ارسالی از کانال @$channelcode را ارسال کنید

📌 توجه کنید کد سکه برا کامل و بدون کم کردن یا اضافه کردن چیزی ارسال کنید

📣 اطلاعات بیش تر در مورد کد سکه را در راهنما ببنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel'],['text'=>"🚦 راهنما | قوانین",'callback_data'=>'help']
				   ],
                     ]
               ])
			   ]);	
$cuser["userfild"]["$fromid"]["file"]="takecodecoin";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'takecodecoin') {
$code = $user["codecoin"];
if ($textmassage == $code) {
$coincode = $user["howcoincode"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"🎉 تبریک کد سکه درست بود 🎉
			
💰 تعداد $coincode سکه به حساب شما افزوده شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"❄️ کد سکه استفاده شد ❄️
			
📍 و دیگه قابل استفاده نیست 

🎖 اطلاعات کاربر برنده :

📌نام : $first_name
📌ایدی : $from_id

🤖 ایدی ربات : @$usernamebot",
 ]);
unset($user["codecoin"]);
unset($user["howcoincode"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$coin = $juser["userfild"]["$from_id"]["coin"];
$coinplus = $coin + $coincode;
$juser["userfild"]["$from_id"]["coin"]="$coinplus";
$juser["userfild"]["$fromid"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"متاسفم 😔
			
📍 کد سکه که وارد کرده اشتباه یا یکی دیگه زود تر اون رو استفاده کرده

📌 دقت کن کد سکه صحیح در کانال @$channelcode گذاشته میشه",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
}
}
elseif($data=="sup"){
mahdi('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🎖 به بخش پشتیبانی خوش امدید
			   
👤 پشتیبانی در خدمت شماست لطفا شکایات , مشکلات ,انتقادات , پشنهادات خود یا ایراد در انجام نشدن سفارش را برای ما ارسال کنید

📍 پیام خود رو در قالب متن یا ... ارسال کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
			   ]);	
$cuser["userfild"]["$fromid"]["file"]="sendsup";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);	
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendsup') {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 پیام شما ارسال شد منتظر پاسخ باشید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
mahdi('ForwardMessage',[
'chat_id'=>$Dev[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
}
	elseif($update->message && $update->message->reply_to_message && in_array($from_id,$Dev) && $tc == "private"){
	mahdi('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"پیام شما برای فرد ارسال شد ✔️"
		]);
	mahdi('sendmessage',[
        "chat_id"=>$reply,
        "text"=>"👤 پاسخ پشتیبان برای شما :

`$textmassage`",
'parse_mode'=>'MarkDown'
		]);
}
if(file_get_contents("data/$fromid.txt") == "true"){
$pluscoin = file_get_contents("data/".$fromid."coin.txt");
$inviter = $cuser["userfild"]["$fromid"]["inviter"];
$invitercoin = $pluscoin / 100 * 20;
	       mahdi('answercallbackquery', [
            'callback_query_id' =>$membercall,
            'text' => "📍 در حال اضافه کردن سکه های خریداری شده ...",
            'show_alert' =>false
        ]);
		         mahdi('sendmessage',[
        	'chat_id'=>$inviter,
        	'text'=>"💰 تعداد : $invitercoin سکه
			
📍 به عنوان پورسانت از خرید دوستت به سکه های شما اضافه شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$coin = $cuser["userfild"]["$fromid"]["coin"];
$coinplus = $coin + $pluscoin;
$cuser["userfild"]["$fromid"]["coin"]="$coinplus";
$cuser = json_encode($cuser,true);
file_put_contents("data/$fromid.json",$cuser);
$inuser = json_decode(file_get_contents("data/$inviter.json"),true);
$coininviter = $inuser["userfild"]["$inviter"]["coin"];
$coinplusinviter = $coininviter + $invitercoin ;
$inuser["userfild"]["$inviter"]["coin"]="$coinplusinviter";;
$inuser = json_encode($inuser,true);
file_put_contents("data/$inviter.json",$inuser);
unlink("data/".$fromid."coin.txt");
unlink("data/$fromid.txt");
}
//==============================================================
//panel admin
elseif($textmassage=="/panel" or $textmassage=="panel" or $textmassage=="مدیریت"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
mahdi('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦 ادمین عزیز به پنل مدریت ربات خوش امدید",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"📍 امار ربات"],['text'=>"📍 مسدود کردن"]                  
		 ],
 	[
	  	['text'=>"📍 ارسال به همه"],['text'=>"📍 فروارد همگانی"]
	  ],
	   	[
['text'=>"📍 لیست سفارشات"],['text'=>"📍 حذف سفارش"]
	  ],
	  	   	[
['text'=>"📍 ارسال سکه"],['text'=>"📍 کم کردن سکه"]
	  ],
	  	  	   	[
['text'=>"📍 ساخت کد سکه"],['text'=>"📍 سکه همگانی"]
	  ],
	  	  	  	  	   	[
['text'=>"📍 بکاپ از اطلاعات"]
	  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif($textmassage=="برگشت 🔙"){
if ($tc == "private") {
if (in_array($from_id,$Dev)){
mahdi('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦 به منوی مدیریت بازگشتید",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	  	  	 [
		['text'=>"📍 امار ربات"],['text'=>"📍 مسدود کردن"]                  
		 ],
 	[
	  	['text'=>"📍 ارسال به همه"],['text'=>"📍 فروارد همگانی"]
	  ],
	   	[
['text'=>"📍 لیست سفارشات"],['text'=>"📍 حذف سفارش"]
	  ],
	  	   	[
['text'=>"📍 ارسال سکه"],['text'=>"📍 کم کردن سکه"]
	  ],
	  	  	   	[
['text'=>"📍 ساخت کد سکه"],['text'=>"📍 سکه همگانی"]
	  ],
	  	  	  	   	[
['text'=>"📍 بکاپ از اطلاعات"]
	  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
}
elseif($textmassage=="📍 امار ربات"){
if (in_array($from_id,$Dev)){
$all = count($user["userlist"]);
$order = count($user["channellist"]);
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"🤖 امار ربات شما : 
		
📌 تعداد عضو ها : $all

📌 تعداد سفارشات فعال : $order",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="📍 مسدود کردن"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"لطفا یک پیام از کاربر را فوروارد کنید یا ایدی عددی فرد را وارد کنید 🚀",
   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="block";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'block') {
if ($textmassage != "برگشت 🔙") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کابر با موفقیت از ربات مسدود شد ✔️

🔹ایدی : $forward_from_id
🔸یوزرنیم : @$forward_from_username",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["blocklist"][]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کابر با موفقیت از ربات مسدود شد ✔️

🔹ایدی : $textmassage",
	  'reply_to_message_id'=>$message_id,
 ]);
$juser["blocklist"][]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($textmassage == '📍 ارسال به همه' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="sendtoall";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendtoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
if ($textmassage != "برگشت 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     mahdi('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"$textmassage",
        ]);
}
}
}
elseif ($textmassage == '📍 فروارد همگانی' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="fortoall";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'fortoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
if ($textmassage != "برگشت 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif($textmassage=="📍 لیست سفارشات"){
if (in_array($from_id,$Dev)){
$order = $user["channellist"];
$ordercount = count($user["channellist"]);
for($z = 0;$z <= count($order)-1;$z++){
$result = $result.$order[$z]."\n";
}
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"📍 تعداد سفارشات فعال درون ربات : $ordercount
		
📌 لیست سفارشات : 
$result",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="📍 حذف سفارش"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"📍 لطفا یوزرنیم کانال مورد نظر را ارسال کنید 
مثال : @$channel",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="remorder";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'remorder') {
if ($textmassage != "برگشت 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"سفارش پاک شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
$how = array_search($textmassage,$user["channellist"]);
unset($user["setmemberlist"][$how]);
unset($user["channellist"][$how]);
$user["channellist"]=array_values($user["channellist"]); 
$user["setmemberlist"]=array_values($user["setmemberlist"]);
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);  
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
elseif($textmassage=="📍 ارسال سکه"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"لطفا یک پیام از کاربر را فوروارد کنید یا ایدی عددی فرد را وارد کنید 🚀",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="adminsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'adminsendcoin') {
if ($textmassage != "برگشت 🔙") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربر مورد نطر یافت شد ✔️

🔹ایدی : $forward_from_id
🔸یوزرنیم : @$forward_from_username

📍 تعداد سکه ارسالی را وارد کنید",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 تعداد سکه ارسالی را وارد کنید

🔹ایدی : $textmassage",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sethowsendcoin') {
if ($textmassage != "برگشت 🔙") {
$id = $juser["idforsend"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 تعداد $textmassage سکه برای کاربر $id ارسال شد",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"📍 تعداد $textmassage سکه توسط مدیریت برای شما ارسال شد",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$inuser = json_decode(file_get_contents("data/$id.json"),true);
$coin = $inuser["userfild"]["$id"]["coin"];
$coinplus = $coin + $textmassage;
$inuser["userfild"]["$id"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$id.json",$inuser);
}
}
elseif($textmassage=="📍 کم کردن سکه"){
if (in_array($from_id,$Dev)){
				mahdi('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"لطفا یک پیام از کاربر را فوروارد کنید یا ایدی عددی فرد را وارد کنید 🚀",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="adminsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'adminsendcoin2') {
if ($textmassage != "برگشت 🔙") {
if ($forward_from == true) {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"کاربر مورد نطر یافت شد ✔️

🔹ایدی : $forward_from_id
🔸یوزرنیم : @$forward_from_username

📍 تعداد سکه که باید کاهش پیدا کند را ارسال کنید",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$forward_from_id";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
else
{
	         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 تعداد سکه که باید کاهش پیدا کند را ارسال کنید

🔹ایدی : $textmassage",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["idforsend"]="$textmassage";
$juser["userfild"]["$from_id"]["file"]="sethowsendcoin2";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sethowsendcoin2') {
if ($textmassage != "برگشت 🔙") {
$id = $juser["idforsend"];
         mahdiphp('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 تعداد $textmassage سکه از کاربر $id کم شد",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>$id,
        	'text'=>"📍 تعداد $textmassage سکه توسط مدیریت از شما کم شد",
			               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
 ]);
$inuser = json_decode(file_get_contents("data/$id.json"),true);
$coin = $inuser["userfild"]["$id"]["coin"];
$coinplus = $coin - $textmassage;
$inuser["userfild"]["$id"]["coin"]="$coinplus";
$inuser = json_encode($inuser,true);
file_put_contents("data/$id.json",$inuser);
}
}
elseif($textmassage=="📍 ساخت کد سکه"){
if (in_array($from_id,$Dev)){
				mahdiphp('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"کد سکه را وارد کنید میتوانید از حروف یا اعداد استفاده کنید 🚀
		
📍 کد سکه به کانال  [@$channelcode] ارسال میشود",
  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
		]);
$juser["userfild"]["$from_id"]["file"]="setcodecoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
		}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'setcodecoin') {
if ($textmassage != "برگشت 🔙") {
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 ارزش کد سکه را تایین کنید
			
📌 فقط عدد وارد کنید",
	  'reply_to_message_id'=>$message_id,
 ]);
$user["codecoin"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="howcodecoin";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'howcodecoin') {
if ($textmassage != "برگشت 🔙") {
$code = $user["codecoin"];
         mahdiphp('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"📍 کد سکه به کانال @$channelcode ارسال شد",
	  'reply_to_message_id'=>$message_id,
 ]);
          mahdi('sendmessage',[
        	'chat_id'=>"@$channelcode",
        	'text'=>"🎉 یک کد سکه جدید ساخته شد 🎉
➖➖
🔆 اولین نفری که کد را در بخش کد سکه ربات ارسال کند برند است

📍 اطلاعات : 
💎 کد سکه : $code
💰 ارزش کد سکه : $textmassage سکه

🤖 ایدی ربات : @$usernamebot",
 ]);
$user["howcoincode"]="$textmassage";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
}
}
elseif ($textmassage == '📍 سکه همگانی' ) {
if (in_array($from_id,$Dev)){
         mahdiphp('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا تعداد سکه همگانی را وارد کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"برگشت 🔙"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$juser["userfild"]["$from_id"]["file"]="sendcointoall";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);		
}
}
elseif ($juser["userfild"]["$from_id"]["file"] == 'sendcointoall') {
$juser["userfild"]["$from_id"]["file"]="none";
$juser = json_encode($juser,true);
file_put_contents("data/$from_id.json",$juser);	
if ($textmassage != "برگشت 🔙") {
$numbers = $user["userlist"];
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"سکه همگانی ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
   mahdi('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"🎉 تبریک 🎉

💰 $textmassage سکه توسط مدیریت ربات برای شما ارسال شد",
          'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				   [
['text'=>"🔙 برگشت",'callback_data'=>'panel']
				   ],
                     ]
               ])
        ]);
$juser = json_decode(file_get_contents("data/$numbers[$z].json"),true);
$coin = $juser["userfild"]["$numbers[$z]"]["coin"];
$coinplus = $coin + $textmassage;
$juser["userfild"]["$numbers[$z]"]["coin"]="$coinplus";
$juser = json_encode($juser,true);
file_put_contents("data/$numbers[$z].json",$juser);	
}
}
}
elseif($update->message->text != true){ 
	mahdi('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"لطفا فقط از دکمه های ربات استفاده کنید 
	
	برای دیدن دکمه ها روی /start کلیک نمایید
	",
	  	]);
}
elseif ($textmassage == '📍 بکاپ از اطلاعات' ) {
if (in_array($from_id,$Dev)){
         mahdi('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"از اطلاعات کاربران بکاپ گرفته شد 🚀",
	  'reply_to_message_id'=>$message_id,
 ]);
$user = (file_get_contents("data/user.json"));
file_put_contents("data/backup.json",$user);	
}
}
unlink("error_log");
/*
cr: 13 - instagram: sizdahorg

کانال تلگرام ما:
@tmsizdah
کانال یوتیوب ما:
youtube.com/@13learn
youtube.com/@13hack

اینستاگرام برای سوالات و...:
@sizdahorg
*/
?>
