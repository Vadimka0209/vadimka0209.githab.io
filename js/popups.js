function closePopups(){$('#overlay').hide();$('.popupWrapper').hide();$('body > *').removeClass('blur-filter');};function isPopupOpen(){return $("#overlay").is(":visible");}
function openPopup(popupID){if(popupID==='statisticsPopup'){emptyStatisticsPopup();doSend("open_statistics_popup");}else if(popupID==='tradeHistoryPopup'){emptyTradeHistoryPopup();doSend("open_trade_history_popup");}
var popup=$("#"+ popupID);$("#overlay").fadeIn();popup.fadeIn();$("body > *").addClass("blur-filter");$(".popupWrapper").removeClass("blur-filter");}
function openTradeConfirmPopup(){openPopup("tradeConfirmPopup");$("#trade-confirm-spinner").empty();$("#trade-confirm-contents").empty();$(".brs").show();var spinner=new Spinner().spin(document.getElementById("trade-confirm-spinner"));setTimeout(function(){if($("#trade-confirm-contents").is(':empty')){spinner.stop();$(".brs").hide();$("#trade-confirm-contents").append("<p>An error occurred!<br>Please note you can only queue up to 5 offers from one bot, you might have to decline some offers.</p>");}},20000);}
function openWithdrawalsPopup(){openPopup("withdrawalsPopup");$("#withdrawals-spinner").empty();$("#withdrawals-contents").empty();$(".brs").show();var spinner=new Spinner().spin(document.getElementById("withdrawals-spinner"));setTimeout(function(){if($("#withdrawals-contents").is(':empty')){spinner.stop();$(".brs").hide();$("#withdrawals-contents").append("<p>An error occurred!<br>Please try again later.</p>");}},20000);}
function updateTradeConfirmPopupError(msg){$("#trade-confirm-spinner").empty();$("#trade-confirm-contents").empty();$(".brs").hide();$("#trade-confirm-contents").append(msg);}
function loadWithdrawalsTable(withdrawals){$("#withdrawals-spinner").empty();$("#withdrawals-contents").empty();$(".brs").hide();var htmlValue="<table id='withdrawalsPopupTable'>"+"<thead>"+"<tr>"+"<th>Secret</th>"+"<th>Message</th>"+"<th>Items</th>"+"<th>Link</th>"+"</tr>"+"</thead>"+"<tbody>";for(var i=0;i<withdrawals.length;i++){var withdrawal=withdrawals[i];htmlValue+="<tr>";htmlValue+="<td>";htmlValue+=withdrawal.secret;htmlValue+="</td>";htmlValue+="<td>";htmlValue+=withdrawal.message;htmlValue+="</td>";htmlValue+="<td>";htmlValue+=withdrawal.items;htmlValue+="</td>";htmlValue+="<td>";if(withdrawal.link.startsWith("http")){htmlValue+="<a href='"+ withdrawal.link+"'>Link</a>";}else{htmlValue+="-";}
htmlValue+="</td>";htmlValue+="</tr>";}
htmlValue+="</tbody>"+"</table>";$("#withdrawals-contents").append(htmlValue);$('#withdrawalsPopupTable').DataTable({'paging':false,'ordering':false,'info':false,'scrollY':'300px','scrollCollapse':true,'searching':false});}
function updateWithdrawalsPopupError(msg){$("#withdrawals-spinner").empty();$("#withdrawals-contents").empty();$(".brs").hide();$("#withdrawals-contents").append(msg);}
function updateTradeConfirmPopup(token,betValue,tradeURL){$("#trade-confirm-spinner").empty();$("#trade-confirm-contents").empty();$(".brs").hide();$("#trade-confirm-contents").append('<p>Are you sure you want to <b>add $'+ Number(betValue/100).toFixed(2)+' to your virtual inventory</b>?<br>You can withdraw these items at any time.<br><br>Secret Token: <b>'+ token+'</b> (This should match secret token in the Steam Trade Window)</p><br>'+'<input type="button" id="trade-url-btn" value="Confirm" onclick="openInNewTab(\''+ tradeURL+'\')"/>');}
function openWinnerPopup(value){openPopup("winnerPopup");$("#winner-info-spinner").empty();$("#winner-info-contents").empty();$(".brs").hide();$("#winner-info-contents").append('<p>Congratulations you have won!!<br> The total value of your winnings is: $'+
Number(value/100).toFixed(2)+' in CSGO items, they have been deposited into your virtual inventory.</p><br>');}
var tradeHistorySpinner;var statisticsSpinner;function updateStatisticsPopup(html){statisticsSpinner.stop();$("#statistics-spinner").empty();$("#statistics-div").empty();$(".brs").hide();$("#statistics-div").append(html);}
function emptyStatisticsPopup(){$("#statistics-div").empty();statisticsSpinner=new Spinner().spin(document.getElementById("statistics-spinner"));}
function updateTradeHistoryPopup(html){tradeHistorySpinner.stop();$("#trade-history-spinner").empty();$("#trade-history-div").empty();$(".brs").hide();$("#trade-history-div").append(html);}
function emptyTradeHistoryPopup(){$("#trade-history-div").empty();tradeHistorySpinner=new Spinner().spin(document.getElementById("trade-history-spinner"));}
function confirmBet(itemsToConfirm){var items=itemsToConfirm.items;items.sort(function(a,b){return b.price- a.price;});openPopup("enterPotPopup");$("#enter-pot-contents").empty();var rows=Math.ceil(items.length/6);var containerHeight=4+ 70*rows;var itemsHTMLValue='<div id="confirm-items" style="height: '+ containerHeight+'px; margin-top: 5px; margin-bottom: 5px;">';for(var i=0;i<items.length;i++){var item=items[i];item.id='_'+ item.id;item.isVirtual=false;var itemDiv=getInventoryItemDivText(item);itemsHTMLValue+=itemDiv;}
itemsHTMLValue+='</div>';var itemsDiv=$(itemsHTMLValue);itemsDiv.children().each(function(){var child=$(this);child.tipsy({gravity:'w'});});var addItemsFunction=function(){var itemsToDeposit=[];for(var i=0;i<items.length;i++){var item=items[i];itemsToDeposit.push(item.id.substring(1)+':true');}
if(itemsToDeposit.length==0){return;}
doSend('deposit'+ JSON.stringify(itemsToDeposit));};var enterButtonDiv=$('<input type="button" id="enter-pot-btn" style="width:80px; height:48px;" value="Enter"/>');enterButtonDiv.click(addItemsFunction);var closeButtonDiv=$('<input type="button" id="close-confirm-btn" style="width:80px; height:48px; margin-left: 4px;" value="Close" onclick="closePopups()"/>');$("#enter-pot-contents").append(itemsDiv).append(enterButtonDiv).append(closeButtonDiv);resizePopupenterPotPopup();}
$(window).load(function(){$("#overlay").click(closePopups);});