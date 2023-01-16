// JavaScript Document

var id;
var type;
var url;

//function to delete user
function deleteunit(id){
var message = confirm("Are you sure you want to delete this Unit?")
if(message==true)
document.location.href="controller/unit.controller.php?mode=delete&unitid="+id;
}

//function to delete campaign
function deleteusers(id){
var message = confirm("Are you sure you want to delete this User?")
if(message==true)
document.location.href="controller/users.controller.php?mode=delete&userid="+id;
}



//function to delete Other account to re direct main page
function deleteotherAccount(id,type,url){
var message = confirm("Are you sure you want to delete this User?")
if(message==true)
document.location.href="controller/users.controller.php?mode=deleteotherAccount&userid="+id+"&type="+type+"&url="+url;
}






//function to delete press
function deletegebranch(id){
var message = confirm("Are you sure you want to delete this GE Center?")
if(message==true)
document.location.href="controller/ge.controller.php?mode=delete&geid="+id;
}




//function to delete money allocation
function deletemoneyallocation(id){
var message = confirm("Are you sure you want to delete this Money Allocation?")
if(message==true)
document.location.href="controller/money.controller.php?mode=delete&allocationid="+id;
}

/////////////////////////////////////////// DGFM


//function to delete Bills
function deleteprojects(id){
var message = confirm("Are you sure you want to delete this bill?")
if(message==true)
document.location.href="controller/projects.controller.php?mode=delete&billid="+id;
}

function deleteprojectsBigUser(id,bilno){
var message = confirm("Are you sure you want to delete this bill?")
if(message==true)
document.location.href="controller/projects.controller.php?mode=deleteBigUser&billid="+id+"&billno="+bilno;
}


function deletebillsSfhq(id,billno,sfhqid){
var message = confirm("Are you sure you want to delete this bill?")
if(message==true)
document.location.href="controller/projects.controller.php?mode=deleteSfhq&billid="+id+"&billno="+billno+"&sfhqid="+sfhqid;
}


//function to settle bill
function settlebill(id,userid){
	var message = confirm("Are you sure you want to settle this Bill?")
if(message==true)
document.location.href="controller/billcontroller.php?mode=settle&projrepid="+id+"&uid="+userid; 
}

//function to settle bill
function settlebillofBigUser(id,userid,branch_id){
	var message = confirm("Are you sure you want to settle this Voucher..?")
if(message==true)
document.location.href="controller/billcontroller.php?mode=settlebiguser&projrepid="+id+"&uid="+userid+"&branch_id="+branch_id; 
}

///Un Settle Director Finance bills

//function unsettlebillofBigUser(id,userid,branch_id){
//	var message = confirm("Are you sure you want to Unsettle this Voucher..?")
//if(message==true)
//document.location.href="controller/billcontroller.php?mode=unsettlebiguser&projrepid="+id+"&uid="+userid+"&branch_id="//+branch_id; 
//}

//

function changeStatusToPsoView(billstatus,vote_id,branch_id){
document.location.href="ViewFullDetailsforPSO.php?status="+billstatus+"&vote_id="+vote_id+"&branch_id="+branch_id;                                     
}

function SettleSfhqBill(id,userid,branch_id){
	var message = confirm("Are you sure you want to settle this Voucher..?")
if(message==true)
document.location.href="controller/billcontroller.php?mode=settlesfhqbil&projrepid="+id+"&uid="+userid+"&branch_id="+branch_id; 
}
//function to RTN bill
function RTNbillofBigUser(id,userid){
	var message = confirm("Are you sure you want to Return this Voucher..?")
if(message==true)
document.location.href="controller/billcontroller.php?mode=Returnbiguser&projrepid="+id+"&uid="+userid; 
}

////////////  Un Settle bills

function SetUnSettleSfhqBill(id,userid,branch_id){
	var message = confirm("Are you sure you want to Unsettle this Voucher..?")
if(message==true)
document.location.href="controller/billcontroller.php?mode=unsettlesfhqbil&projrepid="+id+"&uid="+userid+"&branch_id="+branch_id; 
}





///////////////


//function to delete news entry
function deleteprojectreport(id,pid){
var message = confirm("Are you sure you want to delete this Report?")
if(message==true)
document.location.href="controller/progress_report.controller.php?mode=delete&projrepid="+id+"&proID="+pid;
}

// function to delete progress report
function deleteSentProgressreport(id){
var message = alert("you can not delete sent Reports !")
}

// function to edit progress report
function editSentProgressreport(id){
var message = alert("you can not edit sent Reports !")
}


//function to delete news entry
function sendprojectreport(id,pid,uid){
	var message = confirm("Are you sure you want to send this Report?")
if(message==true)
document.location.href="controller/progress_report.controller.php?mode=send&projrepid="+id+"&proID="+pid+"&UID="+uid;
}

//function to delete Tembills Data
function deletetembills(id){
	var message = confirm("Are you sure you want to Delete Record?")
if(message==true)
document.location.href="controller/progress_report.controller.php?mode=deletetempbills&id="+id;
}
//------------------------------------------------------------
function delete_regiment(id){
var message = confirm("Are you sure you want to delete this regiment?")
if(message==true)
document.location.href="controller/regiment.controller.php?mode=delete&regiment_id="+id;
}
function delete_vote(vote_id){
var message = confirm("Are you sure you want to delete this vote?")
if(message==true)
document.location.href="controller/vote.controller.php?mode=delete&vote_id="+vote_id;
}
function delete_Sup(vote_id){
var message = confirm("Are you sure you want to delete this Supplier?")
if(message==true)
document.location.href="controller/vote.controller.php?mode=deleteSup&vote_id="+vote_id;
}
