<?php
session_start();

if(isset($_POST["tradelink"])){
	$_SESSION["tradeurl"] = $_POST["tradelink"];
}

require('settings.php');
require('steamauth/steamauth.php');
if(isset($_SESSION["steamid"])) {
	include_once('steamauth/userInfo.php');
}
if(isset($_SESSION["steam_personaname"])) {
	include_once('steamauth/userInfo.php');
}
?>
<!doctype html>
<html itemscope="" itemtype="http://schema.org/WebPage" lang="en">
<head>
<base target="_blank">
<meta content="origin" id="mref" name="referrer">
<meta charset="UTF-8"/>
<title><?=$title?></title>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.8.16/jquery-ui.js"></script>
<link rel="shortcut icon" type="image/gif" href="/img/favicon.gif">
<link rel="stylesheet" href="/css/preloader.css"/>
<link rel="stylesheet" href="/css/main.css"/>
<link rel="stylesheet" href="/css/header.css"/>
<link rel="stylesheet" href="/css/chat.css"/>
<link rel="stylesheet" href="/css/jquery.mCustomScrollbar.css"/>
<link rel="stylesheet" href="/css/popup.css"/>
<link rel="stylesheet" href="/css/jackpot.css"/>
<link rel="stylesheet" href="/css/items.css"/>
<link rel="stylesheet" href="/css/inventory.css"/>
<link rel="stylesheet" href="/css/tipsy.css"/>
<link rel="stylesheet" href="/css/tipped.css"/>
<link rel="stylesheet" href="/css/glyphicon.css"/>
<link rel="stylesheet" href="/css/statistics.css"/>
<link rel="stylesheet" href="/css/log.css"/>
<link rel="stylesheet" href="/css/jquery.dataTables.css"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Titillium+Web:400,300,600,700,200"/>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Oswald:700"/>
<script type="text/javascript">
var onWindowLoad = function() {
$("#status").fadeOut();
$("#preloader").fadeOut("slow");
$("body").css("overflow","visible").delay(1000);
};
$(window).load(onWindowLoad);
</script>
<script type="text/javascript">
var wsUri = "ws://realtime.gamblecsgo.com:8080";
</script>
<script type="text/javascript" src="/js/jquery.noty.js"></script>
<script src="/js/hash.min.js"></script>
<script src="/js/WebSocketInitSnippet.js"></script>
<script src="/js/jquery.mCustomScrollbar.js"></script>
<script src="/js/various.js"></script>
<script src="/js/popups.js"></script>
<script src="/js/tipsy.js"></script>
<script src="/js/tipped.js"></script>
<script src="/js/spin.min.js"></script>
<script src="/js/inventory.js"></script>
<script src="/js/chat.js"></script>
<script src="/js/jackpot.js"></script>
<script src="/js/jquery.blockUI.js"></script>
<script src="/js/emojify.min.js"></script>
<script src="/js/jquery.dataTables.js"></script>
<script type="text/javascript">
</script>
<script>
window.onload = function() {var options = document.getElementsByTagName("option");
for(var i = 0; i <= options.length; i++) {
    if(options[i] != undefined)
        options[i].value = options[i].innerHTML;
}}</script></head>
<body ondragstart="return false;">
<div id="preloader">
<div id="status">
&nbsp;
</div>
</div>
<div id="overlay" style="display:none">
</div>
<header id="hdr">
<a id="logo" href="#">CSGOAnte</a>
<ul>
   
<li><a class="clickable">Home</a></li>
<li><a class="clickable" onclick="openPopup('aboutPopup')">About</a></li>
<li><a class="clickable" onclick="openPopup('provablyFairPopup')">Provably Fair</a></li>
<li><a class="clickable" onclick="openPopup('termsPopup')">Terms</a></li>
<?php
$trade12 = ($_SESSION["steam_personaname"])  ;
				if(!isset($_SESSION["steamid"])) {
					steamlogin();
					echo "<li><a class=\"clickable\" onclick=\"openPopup('loginPopup')\">Log in</a></li>";
				} else {
                  echo  "<li style=\"min-width: 100px\"><a href=\"\" target=\"_blank\">
<img src=\"https://steamcdn-a.akamaihd.net/steamcommunity/public/images/avatars/fe/fef49e7fa7e1997310d705b2a6158ff8dc1cdfeb.jpg\" class=\"user_photo\">$trade12</a><ul class=\"dropdown\">
<li class=\"dropdown_item\"><a class=\"clickable\" onclick=\"openPopup('settingsPopup')\">Settings</a></li>
<li class=\"dropdown_item\"><a href=\"/steamauth/logout.php\" target=\"_self\">Log out</a></li></ul></li>";
                 
					
				}
				?>


</ul>
</header>
<div class="content">
<div class="jackpot">
<div id="container_items">
<ul id="jackpot_items_list">
</ul>
</div>
<div class="winner_picker">
<div class="winner_picker_betters_list_outer">
<ul class="winner_picker_betters_list">
</ul>
</div>
<div class="winner_picker_selector">
</div>
</div>
</div>
<div id="pot_status_bar">
<div class="pot_status_timer">
</div>
<div class="pot_status_progress">
</div>
<div class="pot_status_text">
$0.00
</div>
</div>
</div>
<div class="app_main">
<div id="inventory">
<div class="inventory_header">
INVENTORY
</div>
<div class="inventory_selector">
<ul style='text-align:center'>
<li id='inventory_tab_both' class='inventory_tab inventory_tab_selected'>
BOTH
</li>
<li id='inventory_tab_virtual' class='inventory_tab inventory_tab_deselected'>
VIRTUAL
</li>
<li id='inventory_tab_steam' class='inventory_tab inventory_tab_deselected'>
STEAM
</li>
</ul>
</div>
<input type="text" class="item_search_input" placeholder="Search item(s)">
<div class="inventory_items scroll-wrapper-vertical">
<div class="inventory_items_container">
</div>
</div>
<div class="inventory_deposit_area">
    <?php
				if(isset($_SESSION["steamid"])) { $trade = $tradeurl ;
					//echo '<a href="'.$trade.'" target="_blank" class="greenbutton">Deposit Items</a>';
                    
                    echo  "<a href=$trade target=\"_blank\" class=\"greenbutton\"><input type=\"button\"  class=\"inventory_deposit\" value=\"Deposit($0.00)\"> <hr><input type=\"button\" class=\"inventory_withdraw\" value=\"Withdraw\" style=\"display: none;\"></a>" ;
 
                     }else{
                    echo  "<input type=\"button\" onclick=\"openPopup('loginPopup')\" class=\"inventory_deposit\" value=\"Deposit
($0.00)\"/><hr><input type=\"button\" class=\"inventory_withdraw\" value=\"Withdraw\" style=\"display: none;\"/>";
}
	?>
</div>
</div>
<div class="various">
<div class="statistics_header">
STATISTICS
<div id="inventory_arrow" class="arrow arrow_left arrow_collapsed">
</div>
</div>
<div class="statistics_block">
<div class="statistics_block_first_line">
Pot items
</div>
<div id="statistics_pot_items" class="statistics_block_second_line">
0/0
</div>
</div>
<div class="statistics_block">
<div class="statistics_block_first_line">
Your deposit
</div>
<div class="statistics_block_second_line" id="your-deposit-stats">
$0.00
</div>
</div>
<div class="statistics_block">
<div class="statistics_block_first_line">
Your odds
</div>
<div class="statistics_block_second_line" id="your-odds-stats">
0%
</div>
</div>
<div class="statistics_block">
<div class="statistics_block_first_line">
Players online
</div>
<div class="statistics_block_second_line" id="players-online">
0
</div>
</div>
<div class="statistics_block">
<div class="statistics_block_first_line">
Min. deposit
</div>
<div class="statistics_block_second_line" id="min-deposit">
$0.15</div></div></div>
<div class="log">
<div class="statistics_header">
POT LOG
<div id="chat_arrow" class="arrow arrow_right arrow_collapsed">
</div>
</div>
<div data="50.html" id="log-items" class="log_items scroll-wrapper-vertical">
<div id="log-items-container" class="log_items_container">
</div>
</div>
</div>
<div data="100.html" id="chatbox" class="null">
<div id="messages" class="scroll-wrapper-vertical">
</div>
<input type="text" id="chat_message_input" placeholder="Insert message" maxlength="140"/>
<input type="button" id="chat_message_submit" value="Submit"/>
</div>
</div>
<div class="popupWrapper" id="loginPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Login</span>
</h3>
<div class="post_body">
Please login on the steam website <a id="login-why" style="cursor: pointer">(why?)</a>
<br>
<br>
<a href="?login"><img src="/img/sits_small.png" border="0"></a></div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>
var popuploginPopup = $("#loginPopup");
var resizePopuploginPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popuploginPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popuploginPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popuploginPopup.height() / 2)) + "px");}
$(window).resize(resizePopuploginPopup);
popuploginPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopuploginPopup);
$(window).load(function() { resizePopuploginPopup(); });
</script>

<div class="popupWrapper" id="settingsPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Settings</span>
</h3>
<div class="post_body">
Please supply your trade url, we need this URL to send you trade offers of your winnings.
<br>
<br>
Copy it from here:
<br>
<a href="https://steamcommunity.com/id/me/tradeoffers/privacy#trade_offer_access_url" target="_blank"><img src="/img/trade_url_button.png" width="154" height="23" border="0"></a>
<br>
And paste it here:
<br>
<input type="text" id="trade_url_input" value="<?=$_SESSION["tradeurl"]?>" placeholder="https://steamcommunity.com/tradeoffer/new/?partner=xxx&amp;token=yyy"/>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>

<script>
var popupsettingsPopup = $("#settingsPopup");
var resizePopupsettingsPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupsettingsPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupsettingsPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupsettingsPopup.height() / 2)) + "px");}
$(window).resize(resizePopupsettingsPopup);
popupsettingsPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupsettingsPopup);
$(window).load(function() { resizePopupsettingsPopup(); });
</script>
<div class="popupWrapper" id="aboutPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">About</span>
</h3>
<div class="post_body">
We are a CS:GO skin jackpot site that uses a
<a href="#" onclick="closePopups(); openPopup('provablyFair')">provably fair betting system.</a>
<br>
<br>
To play the game you simply deposit skins into the pot. For every $0.01 you get one ticket.
These tickets are then used to determine the winner!
<br>
<br>
The house fee is 0-8% of the total pot. We will only take ONE item, unlike most other sites that will take all your good stuff and give you crappy skins in return! If there is no item within the fee range, no fee will be taken at all!
<br>
<br>
Good luck!
<br>
<br>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popupaboutPopup = $("#aboutPopup");
var resizePopupaboutPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupaboutPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupaboutPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupaboutPopup.height() / 2)) + "px");}
$(window).resize(resizePopupaboutPopup);
popupaboutPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupaboutPopup);
$(window).load(function() { resizePopupaboutPopup(); });
</script>
<div class="popupWrapper" id="tradeConfirmPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Trade Confirmation</span>
</h3>
<div class="post_body">
<div class="brs"><br><br><br><br></div><div id="trade-confirm-spinner"><br><br></div>
<div id="trade-confirm-contents"></div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popuptradeConfirmPopup = $("#tradeConfirmPopup");
var resizePopuptradeConfirmPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popuptradeConfirmPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popuptradeConfirmPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popuptradeConfirmPopup.height() / 2)) + "px");}
$(window).resize(resizePopuptradeConfirmPopup);
popuptradeConfirmPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopuptradeConfirmPopup);
$(window).load(function() { resizePopuptradeConfirmPopup(); });
</script>
<div class="popupWrapper" id="withdrawalsPopup" style="z-index: 10001; display: none;">
<div class='popupInner' style='width: 800px; '>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Withdrawals</span>
</h3>
<div class="post_body">
<div class="brs"><br><br><br><br></div><div id="withdrawals-spinner"><br><br></div>
<div id="withdrawals-contents"></div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popupwithdrawalsPopup = $("#withdrawalsPopup");
var resizePopupwithdrawalsPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupwithdrawalsPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupwithdrawalsPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupwithdrawalsPopup.height() / 2)) + "px");}
$(window).resize(resizePopupwithdrawalsPopup);
popupwithdrawalsPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupwithdrawalsPopup);
$(window).load(function() { resizePopupwithdrawalsPopup(); });
</script>
<div class="popupWrapper" id="winnerPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">You WON!!!</span>
</h3>
<div class="post_body">
<div class="brs"><br><br><br><br></div><div id="winner-info-spinner"><br><br></div>
<div id="winner-info-contents"></div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popupwinnerPopup = $("#winnerPopup");
var resizePopupwinnerPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupwinnerPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupwinnerPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupwinnerPopup.height() / 2)) + "px");}
$(window).resize(resizePopupwinnerPopup);
popupwinnerPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupwinnerPopup);
$(window).load(function() { resizePopupwinnerPopup(); });
</script>
<div class="popupWrapper" id="provablyFairPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Provably Fair</span>
</h3>
<div class="post_body">
Our Provably Fair algorithm is quite simple but strong. When a game starts a seed and
percent are generated. The two numbers are then hashed
and given to you to verify the games fairness!
<div id="pv-popup">
<br>
<br>
Check a Round!
<br>
<br>
Hash:<br><input type="text" id="pv-hash" name="hash">
<br>
Secret:<br><input type="text" id="pv-secret" name="secret">
<br>
Percent:<br><input type="text" id="pv-percent" name="percent">
<br><br>
<input type="button" id="pv-submit" value="Submit">
<br><div id="pv-result"></div>
<br></div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popupprovablyFairPopup = $("#provablyFairPopup");
var resizePopupprovablyFairPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupprovablyFairPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupprovablyFairPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupprovablyFairPopup.height() / 2)) + "px");}
$(window).resize(resizePopupprovablyFairPopup);
popupprovablyFairPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupprovablyFairPopup);
$(window).load(function() { resizePopupprovablyFairPopup(); });
</script>
<div class="popupWrapper" id="termsPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Terms</span>
</h3>
<div class="post_body">
<b>Privacy</b>
<br>
Your Steam picture, username and profile link will be shown to other players after you place a bet, win a game or send a message in chat.
It will be publicly broadcasted to everyone if you are to win a game.
All your steam profile information at the time of deposit may be stored on our servers.
We will never sell, trade or share your personal data, ever (we seriously mean it!).
We do not store any personal data other than your steam user login and trade URL.
<br>
<br>
<b>Betting</b>
<br>
All deposits are final and non-refundable.
Once you click the deposit button and confirm the trade offer from the bot, you cannot get your items back.
<br>
<br>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popuptermsPopup = $("#termsPopup");
var resizePopuptermsPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popuptermsPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popuptermsPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popuptermsPopup.height() / 2)) + "px");}
$(window).resize(resizePopuptermsPopup);
popuptermsPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopuptermsPopup);
$(window).load(function() { resizePopuptermsPopup(); });
</script>
<div class="popupWrapper" id="enterPotPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Would you like to enter the pot?</span>
</h3>
<div class="post_body">
Your items have been added to your virtual inventory!
<br>
Would you like to enter the current pot with the following items?
<div id='enter-pot-contents'></div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popupenterPotPopup = $("#enterPotPopup");
var resizePopupenterPotPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupenterPotPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupenterPotPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupenterPotPopup.height() / 2)) + "px");}
$(window).resize(resizePopupenterPotPopup);
popupenterPotPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupenterPotPopup);
$(window).load(function() { resizePopupenterPotPopup(); });
</script>
<div class="popupWrapper" id="tradeHistoryPopup" style="z-index: 10001; display: none;">
<div class='popupInner' style='width: 850px; '>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Trade History</span>
</h3>
<div class="post_body">
<div id="trade-history-div">
<div class="brs"><br><br><br><br></div><div id="trade-history-spinner"><br><br></div>
</div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popuptradeHistoryPopup = $("#tradeHistoryPopup");
var resizePopuptradeHistoryPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popuptradeHistoryPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popuptradeHistoryPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popuptradeHistoryPopup.height() / 2)) + "px");}
$(window).resize(resizePopuptradeHistoryPopup);
popuptradeHistoryPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopuptradeHistoryPopup);
$(window).load(function() { resizePopuptradeHistoryPopup(); });
</script>
<div class="popupWrapper" id="statisticsPopup" style="z-index: 10001; display: none;">
<div class='popupInner'>
<div class="popupInnerBorder">
<div class="post_block">
<h3 class="row2">
<span style="font-weight: bold;">Statistics</span>
</h3>
<div class="post_body">
<div id="statistics-div">
<div class="brs"><br><br><br><br></div><div id="statistics-spinner"><br><br></div>
</div>
</div>
</div>
<div class="popupClose clickable" onclick="closePopups()">
</div>
</div>
</div>
</div>
<script>var popupstatisticsPopup = $("#statisticsPopup");
var resizePopupstatisticsPopup = function(){
var winWidth = $(window).width() * 1 / zoomLevel;
var winHeight = $(window).height() * 1 / zoomLevel;
popupstatisticsPopup.css("position", "absolute").css("left", ((winWidth / 2) - (popupstatisticsPopup.width() / 2)) + "px").css("top", ((winHeight / 2) - (popupstatisticsPopup.height() / 2)) + "px");}
$(window).resize(resizePopupstatisticsPopup);
popupstatisticsPopup.bind('DOMNodeInserted DOMNodeRemoved', resizePopupstatisticsPopup);
$(window).load(function() { resizePopupstatisticsPopup(); });
</script>
<input type="hidden" id="title" value="CSGOAnte">
</body>
</html>
