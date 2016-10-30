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
    U.$('leagueData').onclick = function () {
        location.href = "league_info.php";
    };
    U.addEvent(U.$('plusLeague'), 'mouseover', show);
}
function show() {
    U.$('cjLeague').style.display = "table-row";
    U.$('bottom-card').style.display = "table-row";
}
function hide() {
    U.$('cjLeague').style.display = "none";
//    U.$('bottom-card').style.display = "none";
}

