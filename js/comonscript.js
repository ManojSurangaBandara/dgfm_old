// JavaScript Document



var id;
var unitid;
var projType;

//function to get esr id for des page
function getEsrUnitID(id){
document.location.href="home.php?unitid="+id;
}
function getvaluetobillsearch(id){
document.location.href="DgfmSearch.php?place="+id;
}


//function to get add Sfhq bill page
function showbranchvalueToSfhq(id){
document.location.href="SfhqAddBills.php?brach_id="+id;
}


//function to get Edit SFHQ Bill
function showvaluetoEditsfhqbill(id,pid){
document.location.href="EditSfhqBills.php?projectid="+pid+"&branch_id="+id;
										
}

//function to get id for chiefacc page
function showbranchestochiefacc(id){
document.location.href="ChiefAccAddbills.php?brach_id="+id;
}

function viewbranchestoeditchifacc(id,pid){
document.location.href="EditBigUserBill.php?branch_id="+id+"&projectid="+pid;
}

//function to get procedure controller 
function showProceContToSfhq(prcon_id,opcon_id,brach_id){
document.location.href="SfhqAddBills.php?prcon_id="+prcon_id+"&opcon_id="+opcon_id+"&brach_id="+brach_id;
}

//function to get Operational controller
function showOperaContToSfhq(prcon_id,opcon_id,brach_id){
document.location.href="SfhqAddBills.php?prcon_id="+prcon_id+"&opcon_id="+opcon_id+"&brach_id="+brach_id;
}

//function to get Operational controller
function showProcEntiToSfhq(prcon_id,opcon_id,brach_id){
document.location.href="SfhqAddBills.php?prcon_id="+prcon_id+"&opcon_id="+opcon_id+"&brach_id="+brach_id;
}


//function to get esr id for des page
function showSupplierToSfhqforCorrect(id,newSupId){
document.location.href="SupplierDetailExporter.php?brach_id="+id;
}

//function to get esr id for des page
function showSupplierToSfhqforCorrect1(id){
document.location.href="SupplierDetailExporter.php?newSup_id="+id;
}
                                                    


//function to get esr id for des page
function showbranchvalueTonewmoneyallocation(id){
document.location.href="newmoneyallocation.php?brach_id="+id;
}


function showprocContobudget(id){
document.location.href="AssignVotestoOpsCon.php?pro_id="+id;
}


//function to get esr id for des page
function editbranchvalue(id,allocationid){
document.location.href="EditmoneyAllocation.php?brach_id="+id+"&allocationid="+allocationid;
}


function showbranchToEditSfhq(id){
document.location.href="EditSfhqBills.php?brach_id="+id;
}



//function to get esr id for admin page
function getEsrUnitIDadmin(id){
document.location.href="admin_home.php?unitid="+id;                                     
}


function getProjTypeESR(projType){
document.location.href="projects.php?projType="+projType;                                     
}







//////////////////////////////////////////////////////////////////////////////// DGFM
function getBranchId(brach_id){
document.location.href="new_project.php?brach_id="+brach_id;                                     
}

function getBranchIdToBigUser(brach_id){
document.location.href="ChiefAccAddbills.php?brach_id="+brach_id;                                     
}
// to edit bill details
function getBranchIdToEdit(brach_id,billid){
document.location.href="edit_project.php?projectid="+billid+"&branch_id="+brach_id;                                     
}


function getBillStatus(billstatus){
document.location.href="projects.php?billstatus="+billstatus;                                     
}

function getBillStatusToChiefAcc(billstatus,branch_id){
document.location.href="Chiefacc.php?status="+billstatus+"&branch_id="+branch_id;                                     
}


function getBillStatusToChiefAccviewpage(billstatus,branch_id){
document.location.href="ViewChiefAccount.php?status="+billstatus+"&branch_id="+branch_id;                                     
}


function getBillStatusTodgfmviewpagerelasfhq(billstatus,unit_dis_id,sfhq_id){
document.location.href="ViewSfhq.php?status="+billstatus+"&unit_dis_id="+unit_dis_id+"&sfhq_id="+sfhq_id;                                     
}


function getbillstatustopso(status,vote_id,branch_id,alloc){
document.location.href="ViewFullDetailsforPSO.php?status="+status+"&vote_id="+vote_id+"&branch_id="+branch_id+"&alloc="+alloc;}


function getBillStatusToSFHQ(billstatus,branch_id){
document.location.href="projects.php?status="+billstatus+"&branch_id="+branch_id;                                     
}



//function to get Branch ID and Bill Status , Sfhq for DGFM Home page
function getBranchTypeDGFM(bid,sid,status){
document.location.href="home.php?branch_id="+bid+"&sfhq_id="+sid+"&bill_status="+status;    

}

//function to get Branch ID and Bill Status , Sfhq for DGFM Home page
function getSFHQTypeDGFM(sfid,bid,status){
document.location.href="home.php?branch_id="+bid+"&sfhq_id="+sfid+"&bill_status="+status;  
}

function getBillStatusDGFM(status,bid,sfid){
document.location.href="home.php?branch_id="+bid+"&sfhq_id="+sfid+"&bill_status="+status;  
}


/////////////////////////////////////////////////////////////////////////////// DGFM

//function to get esr id and projtype for admin page
function getProjTypeadmin(id,projType){
document.location.href="admin_home.php?unitid="+id+"&projType="+projType;                                 
}

function getBillStatusToBigUser(branch_id,status){
document.location.href="Chiefacc.php?branch_id="+branch_id+"&status="+status;                                 
}

function getBillStatusToBigUserviewpage(branch_id,status){
document.location.href="ViewChiefAccount.php?branch_id="+branch_id+"&status="+status;                                 
}

function getBillStatusToBigUserviewpagetoSfhq(unit_dis_id,status,sfhq_id){
document.location.href="ViewSfhq.php?unit_dis_id="+unit_dis_id+"&status="+status+"&sfhq_id="+sfhq_id;                                 
}

function getbranchStatusToSFHQ(branch_id,status){
document.location.href="projects.php?branch_id="+branch_id+"&status="+status;                                 
}

function getOpsControllerId(opscon_id){
document.location.href="ProContView.php?OpsCon_Id="+opscon_id;                                 
}


//function to get esr id and projtype for DEs page
function getProjTypeDES(id,projType){
document.location.href="home.php?unitid="+id+"&projType="+projType;                                 
}


//function to get esr id for GE Center page
function getEsrUnitIDGE(id){
document.location.href="ge_branch.php?unitid="+id;
}


//function to get year to money allocation page
function getYears(id,vote,sfhq_id){
document.location.href="displaymoneyallocation.php?year_r="+id+"&voteCode="+vote+"&sfhq_id="+sfhq_id;    
}

function getAccountOffice(branch_id,id){
document.location.href="displaymoneyallocation.php?year_r="+id+"&branch_id="+branch_id;   
}

//function to get year and vote to money allocation page
function getvotecode(vote,id,branch_id){
document.location.href="displaymoneyallocation.php?year_r="+id+"&voteCode="+vote+"&branch_id="+branch_id;   
}


//function to get year to money allocation page
function getYearsvotsummery(id){
document.location.href="ViewVoteAmtSummery.php?year="+id;   
}



//function to get year and vote to money allocation page
function getvotecodevotesummery(vote,id){
document.location.href="ViewVoteAmtSummery.php?year="+id+"&voteCode="+vote;   
}



//function to get Project type id for new_project page
function GetProjectTypeId(id){
document.location.href="new_project.php?typeid="+id;
}

function getProjTypepr(id){
document.location.href="generateprogresreport.php?projType="+id;
}

function getProjTypeSentReport(id){
document.location.href="ViewSentProgresReport.php?projType="+id;
}




//function to get Project type id for edit_project page
function GetProjectTypeIdForEdit(id){
document.location.href="edit_project.php?typeid="+id;
}



//function to get project type id for admin page
function GetUserTypeId(id){
document.location.href="new_user.php?typeid="+id;
}

//function to get esr id for des Project progress report generation page
function getEsrUnitIDForProgressReport(id){
document.location.href="generateprogresreport.php?unitid="+id;
}
function getProjTypeDES_two(id,projType){
document.location.href="login_details.php?unitid="+id+"&projType="+projType;                                 
}

function unit_wise_user_name(id, user_type){
var unit_wise = 'unitwise';
document.location.href="login_details.php?unitid="+id+"&unit_wise="+unit_wise+"&user_type="+user_type;                                 
}



function ProjectTypeEdit(typeid,projectid){
document.location.href="edit_project.php?typeid="+typeid+"&projectid="+projectid;   
}




function select_user_type(id,user_type){
var get_user_type = true;
if((user_type=='1')|| (user_type=='2'))
{
	var disabled = 'disabled';
	
	document.location.href="login_details.php?unitid="+''+"&user_type="+user_type+"&user_type_select="
	+get_user_type+"&disabled="+disabled;
}

else
{
	document.location.href="login_details.php?unitid="+1+"&user_type="+user_type+"&user_type_select="+get_user_type;
}
}