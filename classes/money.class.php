<?php 
class Money{
	
	public $username 		= NULL;
	public $password 		= NULL;
	public $usertype 		= NULL;
	public $progressID 		= NULL;	
	public $unit_id 		= NULL;
	public $gecenter 		= NULL;
	public $cmbproject 		= NULL;
	public $allocationid 	= NULL;
	public $year		 	= NULL;
	public $id			 	= NULL;
	public $unit_name		= NULL;
	public $amount			= NULL;
	public $description		= NULL;	
	public $user_id			= NULL;
	public $today		    = NULL;
	
		
	
	
	
	
	
//constructor
	private function __construct()
	{
		
	}


	public static function GetMenu($logingID){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM menus WHERE login_type='$logingID' AND active =1";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	public static function GetUnitName(){
		$db1 = new db_con();
		$sqlselect = "SELECT * FROM units";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	

	
	
	public static function DeleteMoneyAllocation($allocationid)
	{
		$db1 = new db_con();
		$sqldelete = "DELETE FROM m_money_allocation WHERE 	allocationid = $allocationid";
		$data = $db1->Execute($sqldelete);
		return $data;

	}
	
	public static function getMoneyAllocationDetails($year,$branch_id){
		
		$db1 = new db_con();
		$sqlselect = "SELECT M.allocationid  FROM m_money_allocation M
					INNER JOIN votes AS V ON M.Vot_Number = V.vote_id  
					WHERE M.year=$year AND M.branch_id=$branch_id ";
					
					//, M.year, M.Vot_Number, M.amount, M.description , V.vote_number
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
		
	public static function getSFHQLevleAllocationDetails($year,$branch_id){
		
		$db1 = new db_con();
		$sqlselect = "SELECT M.allocationid  FROM m_money_allocation M
					INNER JOIN votes AS V ON M.Vot_Number = V.vote_id  
					WHERE M.year=$year AND M.branch_id=$branch_id AND M.from_branch=1 ";
					
					//, M.year, M.Vot_Number, M.amount, M.description , V.vote_number
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	public static function getBranchViewMoneyAllocation($year,$branch_id){
		
		$db1 = new db_con();
		$sqlselect = "SELECT M.year,SUM(M.amount),V.vote_id   
		FROM m_money_allocation M
		INNER JOIN votes AS V ON M.Vot_Number=V.vote_id 
		WHERE M.year=$year AND M.branch_id=$branch_id 
		GROUP BY V.vote_id ";
					
					//, M.year, M.Vot_Number, M.amount, M.description , V.vote_number
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	public static function getBranchViewMoneyAllocationPagination($year,$branch_id,$start, $length){
		$db1 = new db_con();
		$sqlselect = "SELECT
	V.vote_id,
	V.vote_number,
	SUM(M.amount) as FromBudget,
  (SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=0 ) as DteofFin,
 (SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=1 ) as West ,
 (SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=2 ) as Wanni,
 (SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=3 ) as East,
(SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=4 ) as Jaffna,
(SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=5 ) as Kln,
(SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=6 ) as Mul,
(SELECT SUM(amount) FROM m_money_allocation WHERE YEAR = $year AND branch_id = $branch_id AND from_branch = 1 AND Vot_number=V.vote_id AND Sfhq_id=7 ) as Cen,

(SELECT SUM(b.Amount) FROM vote_bill_amount AS b
	INNER JOIN txt_bill_details AS t ON t.Bill_No = b.Bill_No
	AND t.Bill_Id = b.Bill_Id AND b.Bill_Staus = 1 
	WHERE b.Vote_ID = V.vote_id AND b.Current_Year = $year AND b.Bill_Staus = 1
	GROUP BY V.vote_id
) AS DteExpend,	

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=1 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=1 and a.branch_id = $branch_id
group by ab.Vote_ID )  as WestExped,

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=2 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=2 and a.branch_id = $branch_id
group by ab.Vote_ID )  as WanniExpend,

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=3 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=3 and a.branch_id = $branch_id
group by ab.Vote_ID )  as EastExpend,

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=4 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=4 and a.branch_id = $branch_id
group by ab.Vote_ID )  as JaffnaExpend,

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=5 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=5 and a.branch_id = $branch_id
group by ab.Vote_ID )  as KilinoExpend,

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=6 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=6 and a.branch_id = $branch_id
group by ab.Vote_ID )  as MulaExpend,	

(select SUM(ab.Amount) from sfhq_vote_bill_amount as ab 
INNER JOIN sfhq_bill_details as a on a.Bill_No=ab.Bill_No and a.Bill_Id=ab.Bill_Id 
and a.sfhq_id=7 and ab.Bill_Staus=1 Where ab.Vote_ID=V.vote_id and ab.Current_Year=$year and ab.Bill_Staus=1 
and a.sfhq_id=7 and a.branch_id = $branch_id
group by ab.Vote_ID )  as CenExpend

	
FROM
	m_money_allocation M
INNER JOIN votes AS V ON M.Vot_Number = V.vote_id
WHERE
	M.YEAR = $year
AND M.branch_id = $branch_id
AND M.from_branch = 0
GROUP BY
	V.vote_id
	 limit $start, $length";
		
	//	 echo $sqlselect;
	  //   die();
		
		$data = $db1->GetAll($sqlselect);	
		return $data;	
	}
	
	
	
	public static function getMoneyAllocationDetailsPagination($year,$branch_id,$start, $length){
		$db1 = new db_con();
		$sqlselect = "SELECT M.allocationid,M.year,M.createdate,M.amount,M.description,V.vote_id,V.vote_number   
		FROM m_money_allocation M
		INNER JOIN votes AS V ON M.Vot_Number=V.vote_id 
		WHERE M.year=$year AND M.branch_id=$branch_id  limit $start, $length";
		
		//echo $sqlselect;
		//die();
		
		$data = $db1->GetAll($sqlselect);	
		return $data;	
	}
	
		
	public static function getSFHQLevelAllocationDetailsPagination($year,$branch_id,$start, $length){
		$db1 = new db_con();
		$sqlselect = "SELECT M.allocationid,M.year,M.createdate,M.amount,M.description,V.vote_id,V.vote_number,s.Name  
		FROM m_money_allocation M
		INNER JOIN votes AS V ON M.Vot_Number=V.vote_id 
		INNER JOIN m_sfhq AS s on s.ID=M.Sfhq_id
		WHERE M.year=$year AND M.branch_id=$branch_id AND M.from_branch=1  
		Order by s.Name limit $start, $length";
		
		//echo $sqlselect;
		//die();
		
		$data = $db1->GetAll($sqlselect);	
		return $data;	
	}
	
	
	
	
	
		public static function getMoneyAllocationvtSummery($year){
		
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_number,V.description,
					IFNULL((SELECT SUM(MA.amount) FROM m_money_allocation AS MA WHERE year = '$year' AND Vot_Number = V.vote_id
					GROUP BY Vot_Number),0) AS ALLOCATION

					,IFNULL((SELECT SUM(VBA.Amount) AS TripoliExpen FROM vote_bill_amount AS VBA WHERE VBA.Current_Year= '$year' 
					AND VBA.Bill_Staus = 1 AND V.vote_id = VBA.Vote_ID  GROUP BY VBA.Vote_ID),0) AS TU

					,IFNULL((SELECT SUM(SA.Amount) AS RegAccExpen FROM sfhq_vote_bill_amount AS SA WHERE SA.Current_Year= '$year' 
					AND SA.Bill_Staus = 1 AND V.vote_id = SA.Vote_ID  GROUP BY SA.Vote_ID),0) AS RU

					,((IFNULL((SELECT SUM(VBA.Amount) AS TripoliExpen FROM vote_bill_amount AS VBA	WHERE VBA.Current_Year= '$year' 
				     AND VBA.Bill_Staus = 1 AND V.vote_id = VBA.Vote_ID  GROUP BY VBA.Vote_ID),0) ) + (IFNULL((SELECT SUM(SA.Amount) AS RegAccExpen 					 FROM sfhq_vote_bill_amount AS SA WHERE SA.Current_Year= '$year' AND SA.Bill_Staus = 1 
					 AND V.vote_id = SA.Vote_ID  GROUP BY SA.Vote_ID),0))) as total

				   ,(IFNULL((SELECT SUM(MA.amount) FROM m_money_allocation AS MA WHERE year = '$year' AND Vot_Number = V.vote_id
					GROUP BY Vot_Number),0) -  (((IFNULL((SELECT SUM(VBA.Amount) AS TripoliExpen FROM vote_bill_amount AS VBA					
					WHERE VBA.Current_Year= '$year' AND VBA.Bill_Staus = 1 AND V.vote_id = VBA.Vote_ID  GROUP BY VBA.Vote_ID),0) ) 
					+ (IFNULL((SELECT SUM(SA.Amount) AS RegAccExpen FROM sfhq_vote_bill_amount AS SA					
					WHERE SA.Current_Year= '$year' AND SA.Bill_Staus = 1 AND V.vote_id = SA.Vote_ID  
					GROUP BY SA.Vote_ID),0))) ) ) NOWINHAND

					FROM votes AS V ";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	public static function getMoneyAllocationDetailsvtSummeryPagination($year,$start, $length){
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_number,V.description,
					IFNULL((SELECT SUM(MA.amount) FROM m_money_allocation AS MA WHERE year = '$year' AND Vot_Number = V.vote_id
					GROUP BY Vot_Number),0) AS ALLOCATION

					,IFNULL((SELECT SUM(VBA.Amount) AS TripoliExpen FROM vote_bill_amount AS VBA WHERE VBA.Current_Year= '$year' 
					AND VBA.Bill_Staus = 1 AND V.vote_id = VBA.Vote_ID  GROUP BY VBA.Vote_ID),0) AS TU

					,IFNULL((SELECT SUM(SA.Amount) AS RegAccExpen FROM sfhq_vote_bill_amount AS SA WHERE SA.Current_Year= '$year' 
					AND SA.Bill_Staus = 1 AND V.vote_id = SA.Vote_ID  GROUP BY SA.Vote_ID),0) AS RU

					,((IFNULL((SELECT SUM(VBA.Amount) AS TripoliExpen FROM vote_bill_amount AS VBA	WHERE VBA.Current_Year= '$year' 
				     AND VBA.Bill_Staus = 1 AND V.vote_id = VBA.Vote_ID  GROUP BY VBA.Vote_ID),0) ) + (IFNULL((SELECT SUM(SA.Amount) AS RegAccExpen 					 FROM sfhq_vote_bill_amount AS SA WHERE SA.Current_Year= '$year' AND SA.Bill_Staus = 1 
					 AND V.vote_id = SA.Vote_ID  GROUP BY SA.Vote_ID),0))) as total

				   ,(IFNULL((SELECT SUM(MA.amount) FROM m_money_allocation AS MA WHERE year = '$year' AND Vot_Number = V.vote_id
					GROUP BY Vot_Number),0) -  (((IFNULL((SELECT SUM(VBA.Amount) AS TripoliExpen FROM vote_bill_amount AS VBA					
					WHERE VBA.Current_Year= '$year' AND VBA.Bill_Staus = 1 AND V.vote_id = VBA.Vote_ID  GROUP BY VBA.Vote_ID),0) ) 
					+ (IFNULL((SELECT SUM(SA.Amount) AS RegAccExpen FROM sfhq_vote_bill_amount AS SA					
					WHERE SA.Current_Year= '$year' AND SA.Bill_Staus = 1 AND V.vote_id = SA.Vote_ID  
					GROUP BY SA.Vote_ID),0))) ) ) NOWINHAND

					FROM votes AS V  limit $start, $length";
		$data = $db1->GetAll($sqlselect);
	//	echo $sqlselect;
		return $data;	
	}
	
	
	public static function SelectMoneyAllocationDetailRow($id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT a.allocationid,a.`year`,a.amount,a.description,v.vote_id,v.vote_number,
		b.branch_id,b.branch_name,a.Sfhq_id 
		FROM m_money_allocation as a
		INNER JOIN votes as v on v.vote_id=a.Vot_Number
		INNER JOIN m_branches as b on b.branch_id=a.branch_id
		WHERE a.allocationid=$id";
		//echo $sqlselect ;
		//die();
		
		$data = $db1->GetAll($sqlselect);
		return $data;
	}
	
	
	
	public static function SaveMoneyAllocation($year,$vote,$amount,$description,$user_id,$today,$brach_id){
		
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO  m_money_allocation (year,Vot_Number,amount,branch_id,description,createby,createdate) 
						VALUES ($year,$vote,'$amount',$brach_id,'$description','$user_id','$today');";
	//	echo $sqlinsert; exit;
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	public static function SaveSFHQlevelAllocation($year,$brach_id,$vote,$sfhq_id,$amount,$description,$user_id,$today){
		
		$db1 = new db_con();
		$sqlinsert = "INSERT INTO  m_money_allocation (year,Vot_Number,amount,branch_id,description,createby,createdate,from_branch,Sfhq_id) 
						VALUES ($year,$vote,'$amount',$brach_id,'$description','$user_id','$today',1,$sfhq_id);";
	//	echo $sqlinsert; exit;
		$data = $db1->Execute($sqlinsert);
		return $data;	
	}
	
	public static function ChecktheAllocationCondition($year,$brach_id,$vote,$sfhq_id,$amount){
		
		$db1 = new db_con();
		$sqlinsert = " Select (SELECT IFNULL(SUM(amount),0)  	
			FROM m_money_allocation 
			WHERE YEAR = $year AND branch_id = $brach_id 
			AND from_branch = 0 AND Vot_Number = $vote) AS Alloc,
			
			(SELECT IFNULL(SUM(amount),0)  
			FROM m_money_allocation 
			WHERE YEAR = $year AND branch_id = $brach_id 
			AND from_branch = 1 AND Vot_Number = $vote) as Expend ;";
			
	//	echo $sqlinsert; exit;
		
		$data = $db1->GetAll($sqlinsert);
		return $data;	
	}
	
	
	
	                          
	
	public static function MoneyAllocationUpdate($year,$vote,$brach_id,$amount,$description,$allocationid,$user_id,$today,$AccountOffice)
	{
		$db1 = new db_con();		
		$sqlupdate = "UPDATE m_money_allocation SET 
					year=$year,
					Vot_Number=$vote,
					branch_id=$brach_id,
					amount='$amount',
					description='$description',					
					modifyby=$user_id,
					modifydate='$today',		
					Sfhq_id=$AccountOffice			
					WHERE allocationid=$allocationid";
					
			//	echo $sqlupdate;
			//	die();
					
		$data = $db1->Execute($sqlupdate);
		return $data;
	}

	
	

}

?>