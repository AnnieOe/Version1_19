window.onload = init;
/*
 * Basic Java Template
 * Created By: Annie Oesterle
 * Created On: 6/17/2016
 */

//*****global*****
'use strict';

//*****Functions*****
function init() {
    U.$('createLeague').onclick = function () {
        location.href = "create.php";
    };
    U.$('joinLeague').onclick = function () {
        location.href = "join.php";
    };
    U.addEvent(U.$('leagueData'), 'click', toleague);
    
    U.addEvent(U.$('plusLeague'), 'mouseover', show);
}
function toleague(){
  location.href = "league_info.php";
  }
function show() {
    U.$('cjLeague').style.display = "table-row";
    U.$('bottom-card').style.display = "table-row";
}
function hide() {
    U.$('cjLeague').style.display = "none";
}

