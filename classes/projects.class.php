<?php 
class Projects{
	
	
	public $project_id			 	 = NULL;
	public $project_reference_id 	 = NULL;
	public $project_name 			 = NULL;
	public $project_status 			 = true;
	public $project_allocated_amount = 0.0;
	public $project_start_date 		= NULL;
	public $project_end_date 		= NULL;
	public $project_location 		= NULL;
	public $project_type 			= NULL;
	public $date_of_tender_called 	= NULL;
	public $date_of_tender_opened  	= NULL;
	public $date_of_tec_appointed 	= NULL;
	public $date_of_tb_appointed 	= NULL;
	public $name_of_contractor 		= NULL;
	public $awarded_date 			= NULL;
	public $extension_given  		= NULL;
	public $proj_allocated_stations = NULL;	
	public $proj_created_date 		= NULL;
	public $proj_created_user 		= NULL;
	public $project_Description 	= NULL;
	public $esr_unit_id			 	= NULL;
	public $ge_id			 		= NULL;
	public $projType		 		= NULL;
	
	
	
//constructor
	private function __construct()
	{
		
	}
	
	



public static function convertNumber($num)
{
   list($num, $dec) = explode(".", $num);

   $output = "";

   if($num[0] == "-")
   {
      $output = "negative ";
      $num = ltrim($num, "-");
   }
   else if($num[0] == "+")
   {
      $output = "positive ";
      $num = ltrim($num, "+");
   }
   
   if($num[0] == "0")
   {
      $output .= "zero";
   }
   else
   {
      $num = str_pad($num, 36, "0", STR_PAD_LEFT);
      $group = rtrim(chunk_split($num, 3, " "), " ");
      $groups = explode(" ", $group);

      $groups2 = array();
      foreach($groups as $g) $groups2[] = Projects :: convertThreeDigit($g[0], $g[1], $g[2]);

      for($z = 0; $z < count($groups2); $z++)
      {
         if($groups2[$z] != "")
         {
            $output .= $groups2[$z].Projects :: convertGroup(11 - $z).($z < 11 && !array_search('', array_slice($groups2, $z + 1, -1))
             && $groups2[11] != '' && $groups[11][0] == '0' ? " and " : ", ");
         }
      }

      $output = rtrim($output, ", ");
   }

   if($dec > 0)
   {
      $output .= " point";
      for($i = 0; $i < strlen($dec); $i++) $output .= " ".Projects :: convertDigit($dec[$i]);
   }

   return $output;
}

public static function convertGroup($index)
{
   switch($index)
   {
      case 11: return " decillion";
      case 10: return " nonillion";
      case 9: return " octillion";
      case 8: return " septillion";
      case 7: return " sextillion";
      case 6: return " quintrillion";
      case 5: return " quadrillion";
      case 4: return " trillion";
      case 3: return " billion";
      case 2: return " million";
      case 1: return " thousand";
      case 0: return "";
   }
}

public static function convertThreeDigit($dig1, $dig2, $dig3)
{
   $output = "";

   if($dig1 == "0" && $dig2 == "0" && $dig3 == "0") return "";

   if($dig1 != "0")
   {
      $output .= Projects :: convertDigit($dig1)." hundred";
      if($dig2 != "0" || $dig3 != "0") $output .= " and ";
   }

   if($dig2 != "0") $output .= Projects :: convertTwoDigit($dig2, $dig3);
   else if($dig3 != "0") $output .= Projects :: convertDigit($dig3);

   return $output;
}

public static function convertTwoDigit($dig1, $dig2)
{
   if($dig2 == "0")
   {
      switch($dig1)
      {
         case "1": return "ten";
         case "2": return "twenty";
         case "3": return "thirty";
         case "4": return "forty";
         case "5": return "fifty";
         case "6": return "sixty";
         case "7": return "seventy";
         case "8": return "eighty";
         case "9": return "ninety";
      }
   }
   else if($dig1 == "1")
   {
      switch($dig2)
      {
         case "1": return "eleven";
         case "2": return "twelve";
         case "3": return "thirteen";
         case "4": return "fourteen";
         case "5": return "fifteen";
         case "6": return "sixteen";
         case "7": return "seventeen";
         case "8": return "eighteen";
         case "9": return "nineteen";
      }
   }
   else
   {
      $temp = Projects :: convertDigit($dig2);
      switch($dig1)
      {
         case "2": return "twenty-$temp";
         case "3": return "thirty-$temp";
         case "4": return "forty-$temp";
         case "5": return "fifty-$temp";
         case "6": return "sixty-$temp";
         case "7": return "seventy-$temp";
         case "8": return "eighty-$temp";
         case "9": return "ninety-$temp";
      }
   }
}
      
public static function convertDigit($digit)
{
   switch($digit)
   {
      case "0": return "zero";
      case "1": return "one";
      case "2": return "two";
      case "3": return "three";
      case "4": return "four";
      case "5": return "five";
      case "6": return "six";
      case "7": return "seven";
      case "8": return "eight";
      case "9": return "nine";
   }
}
	
	
	public static function GetdataPDF(){
		$db1 = new db_con();
		
		$sqlselect = "SELECT d.Bill_Id,d.Bill_No,d.Bill_Name,d.Amount,c.Unit,d.Recieved_Date,d.Unit_Id 
									FROM txt_bill_details as d
					  				INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
									ORDER BY d.Unit_Id  ";
		//$sqlselect = "SELECT d.Bill_Id,d.Bill_No,d.Bill_Name,d.Amount,d.Recieved_Date,d.Unit_Id FROM txt_bill_details as d ";
		//echo $sqlselect; 
		$data = $db1->GetAll($sqlselect);
		
		return $data;	
	}
	
	public static function Genarate_Daily_Bill_Summary($dte_id,$status,$todate,$txt_as_at_date,$user_type_id ){
		$db1 = new db_con();
		
		$sqlselect = "	SELECT 
						b.Bill_No
						,s.Sup_Name	
			 ,(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id  ) as Ammount 
						,t.branch_name
									FROM txt_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
									INNER JOIN m_branches as t on t.branch_id = b.branch_id
									where b.Bill_Status = '$status' 									
									and b.Create_Date between '$txt_as_at_date' and '$todate'
									and b.branch_id = '$dte_id' 
									and b.UserTypeId ='$user_type_id ' ORDER BY b.Bill_No ASC ";
								
								
								
					
					  
		//echo $sqlselect; 			  
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function Genarate_Daily_Bill_Summary_All_Branch($status,$todate,$txt_as_at_date,$user_type_id ){
		$db1 = new db_con();
		
		$sqlselect = "	SELECT b.Bill_No ,s.Sup_Name ,
		(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id ) as Ammount,
				t.branch_name 
		FROM 	txt_bill_details as b INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id
 		INNER JOIN m_branches as t on t.branch_id = b.branch_id 
		where 	b.Bill_Status = '$status' 
		and  b.Create_Date between '$txt_as_at_date' and '$todate' and  b.UserTypeId ='$user_type_id '
 		ORDER BY b.Bill_No ASC ";
			  
		//echo $sqlselect; 			  
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
	public static function Get_Branch_Id($dte)
	{
		$db1 = new db_con();
		$sqlselect = "select branch_id from m_branches where branch_name= '$dte'";
		//echo $sqlselect;	
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}
	
		
	//////////////////#####################################################################           DGFM
	
	public static function GetMaxIDandYear(){
		$db1 = new db_con();
		$sqlselect = "SELECT MAX(Bill_No) as maxbillno FROM txt_bill_details ";
		//echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetMaxIDandYearforsfhq($sfhq_id){
		$db1 = new db_con();
		$sqlselect = "SELECT MAX(Bill_No) as maxbillno 
					  FROM sfhq_bill_details WHERE Sfhq_Id = $sfhq_id ";
		//echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
		public static function GetAllBillsDGFM($unitid,$projType,$txt,$user_id,$sfhq_id,$branch_id){
		$db1 = new db_con();
		$sqlselect = "SELECT d.Bill_Id,d.Bill_No,d.Bill_Name,d.Amount,c.Unit,d.Recieved_Date,d.Unit_Id 
		FROM txt_bill_details as d
					  INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
									where d.Bill_Status = $projType 									
									and d.Bill_No like '%$txt%' 
									and d.Sfhq_Id = $sfhq_id ORDER BY d.Unit_Id,d.Recieved_Date ASC  ";
									
									
		//echo $sqlselect; 
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetAllBillsDGFMPagination($unitid,$projType,$txt,$user_id,$sfhq_id,$branch_id,$start, $length){
		$db1 = new db_con();
		$sqlselect = "SELECT d.Bill_Id,d.Bill_No,d.Bill_Name,d.Amount,c.Unit,d.Recieved_Date,d.Unit_Id 
		FROM txt_bill_details as d
					  INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
									where d.Bill_Status = $projType 									
									and d.Bill_No like '%$txt%' 
									and d.Sfhq_Id = $sfhq_id ORDER BY d.Unit_Id,d.Recieved_Date ASC  
									limit $start, $length  ";
									
		//echo $sqlselect; 
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}

	public static function GetAllBillsDGFMToBigUser($branch_id,$status,$search,$user_type_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id	 	 	 	 
									FROM txt_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
									where b.Bill_Status = $status 									
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									
									
									
									and b.branch_id = $branch_id 
									 ORDER BY b.Bill_No ASC  ";
									
									
		//echo $sqlselect; 
		//AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetSFHQbillsNoIdea($branch_id,$status,$search,$user_type_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id	 	 	 	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status 									
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									
									
									
									and b.branch_id = $branch_id 
									 ORDER BY b.Bill_No ASC  ";
									
									
		//echo $sqlselect; die();
		//AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetAllBillsDGFMToBigestUser($sfhq_id,$status,$search,$unit_dis_id)
	{
		if($unit_dis_id == 0)
		{
			$unit_dis_id = 'Unit_Id';
		}
		
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id	FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status 									
					and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
					and b.Unit_Id =  $unit_dis_id
									AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
									and b.Sfhq_Id = $sfhq_id 
									ORDER BY b.Bill_No ASC  ";
									
			//		,b.Bill_No,b.Sup_Code,b.Recieved_Date,
		//(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id  ) as Ammount
		//,s.Sup_Name,b.Bill_Settled_Date,b.Modified_Date,b.Bill_ref_no							
		
		
		//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetSFHQbilltoviewtoPSO($status,$search,$branch_id,$vote_id,$log_year)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT  b.Bill_Id,b.Bill_No,s.Sup_Name,b.Recieved_Date,v.Amount
		,b.Bill_Settled_Date,t.rtn_date,'Dte of Fin' as sfhq
					from txt_bill_details as b
					INNER JOIN vote_bill_amount as v on v.Bill_Id=b.Bill_Id and v.Bill_No=b.Bill_No 
					and v.Vote_ID=$vote_id AND v.Bill_Staus=$status  	
 					INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id and s.Sup_Name like '%$search%'
					LEFT OUTER JOIN return_details as t on t.Bill_Id = b.Bill_Id
					where b.Bill_Status=$status 									
					
					
					and v.Vote_ID=$vote_id	
					AND EXTRACT(YEAR FROM b.Recieved_Date)=$log_year							
					 
					 UNION ALL
					 
					SELECT b.Bill_Id,b.Bill_No,s.Sup_Name,b.Recieved_Date,v.Amount
					,b.Bill_Settled_Date,t.rtn_date,sf.name as sfhq
					 FROM sfhq_bill_details as b 
					  INNER JOIN sfhq_vote_bill_amount as v on v.bill_no=b.bill_no 
					  and v.sfhq_id=b.sfhq_id and v.bill_id=b.bill_id and v.Vote_ID=$vote_id and v.Bill_Staus=$status
					  	
					  INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id and s.Sup_Name like '%$search%'
					 LEFT OUTER JOIN sfhq_return_details as t on t.Bill_Id=b.Bill_Id
					  Inner join m_sfhq as sf on sf.id=b.sfhq_id
					 where b.Bill_Status=$status 									
					
					and b.branch_Id=$branch_id
					and v.vote_id=$vote_id
					AND EXTRACT(YEAR FROM b.Recieved_Date)=$log_year							
					ORDER BY sfhq";
									
	//	echo $sqlselect; 
	  // die();
	
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetSFHQbilltoviewtoPSOPagination($status,$search,$branch_id,$vote_id,$log_year,$current1, $length)
	{
		
		$db1 = new db_con();
		$sqlselect = "SELECT  b.Bill_Id
					from txt_bill_details as b
					INNER JOIN vote_bill_amount as v on v.Bill_Id=b.Bill_Id and v.Bill_No=b.Bill_No 
					and v.Vote_ID=$vote_id AND v.Bill_Staus=$status 	
 					INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
					LEFT OUTER JOIN return_details as t on t.Bill_Id = b.Bill_Id
					where b.Bill_Status=$status 									
					and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
					
					and v.Vote_ID=$vote_id	
					AND EXTRACT(YEAR FROM b.Recieved_Date)=$log_year								
					 
					 UNION ALL
					 
					SELECT b.Bill_Id
					FROM sfhq_bill_details as b 
					INNER JOIN sfhq_vote_bill_amount as v on v.bill_no=b.bill_no 
					and v.sfhq_id=b.sfhq_id and v.bill_id=b.bill_id and v.Vote_ID=$vote_id and v.Bill_Staus=$status 		
					INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
					LEFT OUTER JOIN sfhq_return_details as t on t.Bill_Id=b.Bill_Id
					Inner join m_sfhq as sf on sf.id=b.sfhq_id
					where b.Bill_Status=$status 									
					and ( b.Bill_No like '%$search%'||s.Sup_Name like '%$search%' )
					and b.branch_Id=$branch_id
					and v.vote_id=$vote_id
					AND EXTRACT(YEAR FROM b.Recieved_Date)=$log_year							
					ORDER BY sfhq
					limit $start, $length  ";
								
		//echo $sqlselect; 
		//die();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetAllBillsDGFMToSFHQ($branch_id,$status,$search,$user_type_id,$sfhq_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id		 	 	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status 	
									and b.Sfhq_Id = $sfhq_id
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									
									
									and b.branch_id = $branch_id 
									and b.UserTypeId ='$user_type_id' ORDER BY b.Bill_No ASC  ";
									
									
		//echo $sqlselect; 
		
		///////////////AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetAllBillsDGFMToBigUserAll($status,$search,$user_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id	 	 
									FROM txt_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
									where b.Bill_Status = $status
								
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									 ORDER BY b.Bill_No ASC  ";
									
									
		//echo $sqlselect; 
		//	AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetBillsofSFHQ($status,$search,$user_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id	 	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status
								
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									 ORDER BY b.Bill_No ASC  ";
									
									
		//echo $sqlselect; die();
		//	AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	public static function GetVoteOutStandingforSfhq($sup_id,$from,$to){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No
		,v.vote_number 	
		,v.description
		,b.Recieved_Date
		,b.Bill_Settled_Date
		,(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id  ) as Ammount
		,s.Sup_Name
		 	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id
									
									INNER JOIN sfhq_vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id  
									INNER JOIN votes as v on v.vote_id = vb.Vote_ID 
									
									where b.Recieved_Date BETWEEN '$from' AND '$to'	
									AND s.Sup_id = $sup_id										
									ORDER BY vb.Vote_ID,b.Bill_Settled_Date DESC ";
									
						//b.Bill_Status = 1 AND 			
	//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	
	
	
		public static function GetExpenditureDetailsReportdgfm($year){
		$db1 = new db_con();
		$sqlselect = "SELECT 0 AS Sfhq_Id ,SUM(Amount) as Exp
		,(select SUM(amount) from m_money_allocation where sfhq_id=0 and year=$year) as Alloc 
		,'DTE OF FIN' 
		FROM vote_bill_amount 
		WHERE Current_Year=$year AND Bill_Staus=1
		
		UNION 
		
		SELECT b.Sfhq_Id as Sfhq_Id ,SUM(b.Amount) as Exp		
		,(select SUM(amount) from m_money_allocation where sfhq_id=b.sfhq_id and year=$year) as Alloc  
		,s.Name
		FROM sfhq_vote_bill_amount as b		
		INNER JOIN m_sfhq as s on s.Id=b.sfhq_id
		WHERE b.Current_Year=$year AND b.Bill_Staus=1
		GROUP BY Sfhq_Id 
		ORDER BY Sfhq_Id";
		
		//echo $sqlselect;
		//die();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetExpenditureDetailsReporttoPsoview($year,$branch_id,$status,$vote_id){
		$db1 = new db_con();
		$sqlselect = "SELECT 0 AS Sfhq_Id ,SUM(b.Amount) as Exp
		,(select SUM(amount) from m_money_allocation where sfhq_id=0 and year=$year and 
		Vot_Number=$vote_id and from_branch=1) as Alloc
		,'DTE OF FIN' as Sfhq_Name
		FROM vote_bill_amount as b
		INNER JOIN txt_bill_details as t on t.Bill_No=b.Bill_No and t.Bill_Id=b.Bill_Id
		and b.Vote_ID=$vote_id AND b.Bill_Staus=1 
		LEFT OUTER JOIN return_details as rt on rt.Bill_Id = b.Bill_Id
		WHERE b.Current_Year =$year AND b.Bill_Staus=1 and t.Branch_id=$branch_id 
		GROUP BY b.Current_Year
		
		UNION ALL
		
		SELECT b.Sfhq_Id as Sfhq_Id ,SUM(b.Amount) as Exp		
		,(select SUM(amount) from m_money_allocation where sfhq_id=b.sfhq_id and year=$year 
		and Vot_Number=$vote_id and from_branch=1 ) as Alloc
		,s.Name
		FROM sfhq_vote_bill_amount as b	
		INNER JOIN sfhq_bill_details as a on a.Bill_No=b.Bill_No and a.Bill_Id=b.Bill_Id and a.sfhq_id=b.sfhq_id
		and b.Vote_ID=$vote_id and b.Bill_Staus=1 
		INNER JOIN m_sfhq as s on s.ID=a.sfhq_id
		LEFT OUTER JOIN sfhq_return_details as rrt on rrt.Bill_Id=b.Bill_Id
		WHERE b.Bill_Staus=1  and a.Branch_id=$branch_id
		
		GROUP BY a.Sfhq_Id 
		ORDER BY Sfhq_Id";
		
		
		//echo $sqlselect;
	  //  die();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	//public static function GetBudgetReporttoPsoview($new_year,$branch_id,$status,$vote_id){
		//$db1 = new db_con();
		//$sqlselect = "select Sfhq_id,sum(amount) as Amnt FROM m_money_allocation 				
							//	WHERE year=$new_year and Vot_Number=$vote_id
							//	GROUP BY Sfhq_id 
							//	ORDER BY Sfhq_id";
		//echo $sqlselect;
		//$data = $db1->GetAll($sqlselect);
		//return $data;	
	//}
	
	
		public static function GetAllocationRecurrent($year){
		$db1 = new db_con();
		$sqlselect = "select m.Sfhq_id,sum(m.amount) as Amnt FROM m_money_allocation as m 	
						Inner join votes as v on v.vote_id = m.Vot_Number 
								WHERE m.year ='$year' and v.vt_type=1
								GROUP BY m.Sfhq_id 
								ORDER BY m.Sfhq_id";
		//echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
		public static function GetAllocationCapital($year){
		$db1 = new db_con();
		$sqlselect =  "select m.Sfhq_id,sum(m.amount) as Amnt FROM m_money_allocation as m 	
						Inner join votes as v on v.vote_id = m.Vot_Number 
								WHERE m.year ='$year' and v.vt_type=2
								GROUP BY m.Sfhq_id 
								ORDER BY m.Sfhq_id";
		//echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}	
	
		public static function GetAllocationOther($year){
		$db1 = new db_con();
		$sqlselect =  "select m.Sfhq_id,sum(m.amount) as Amnt FROM m_money_allocation as m 	
						Inner join votes as v on v.vote_id = m.Vot_Number 
								WHERE m.year ='$year' and v.vt_type=0
								GROUP BY m.Sfhq_id 
								ORDER BY m.Sfhq_id";
		//echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	
	
	public static function GetExpenditureDetailsLy($year){
		$db1 = new db_con();
		$sqlselect = "SELECT 0 AS Sfhq_Id,SUM(Amount) FROM vote_bill_amount
						WHERE Current_Year ='$year' AND Bill_Staus=1
						GROUP BY Current_Year 						
						
						UNION
						
						SELECT Sfhq_Id,SUM(Amount) FROM sfhq_vote_bill_amount
						WHERE Current_Year ='$year' AND Bill_Staus =1
						GROUP BY Sfhq_Id 
						ORDER BY Sfhq_Id";
		//echo $sqlselect;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
		public static function GetSupplierAgeAnalysisforSfhq($date_as_at,$sfhq_id){
				
		$lstyear= ($date_as_at - 1);
		$thisyear= $date_as_at ;
		
		$db1 = new db_con();
		$sqlselect = "SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
						FROM sfhq_vote_bill_amount as vb 
						INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
						WHERE (vb.Bill_Staus = 0 OR vb.Bill_Staus = 3) 
						and vb.Sfhq_Id = '$sfhq_id'					
						GROUP BY vb.Sup_Code ,vb.Recieved_Month
						ORDER BY V.Sup_id ,vb.Recieved_Month";									
								
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetSFHQsupplieragereport($received_asat,$rtptype,$group){
		
		if($rtptype==4)
		{
			$rtptype ='0  OR  vb.Bill_Staus=3' ; 
		}
				
		$db1 = new db_con();
		$sqlselect = "SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
						FROM sfhq_vote_bill_amount as vb 
						INNER JOIN sfhq_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
						INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
						WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat'  
						GROUP BY vb.Sup_Code ,vb.Recieved_Month
						ORDER BY V.Sup_id ,vb.Recieved_Month";									
				
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
        
        //12-12-2015 added public static function for get all sfhq suppliers age data to SFHQ type 0 login
        public static function GetAllSupplierAgeAnalysisforSfhq($date_as_at){
		
		//$lstyear= (date("Y", strtotime($date_as_at)) - 1);
		//$thisyear= date("Y", strtotime($date_as_at)) ;
		//$thismonth= date("M", strtotime($date_as_at));	
		
			
		$lstyear= ($date_as_at - 1);
		$thisyear= $date_as_at ;
		
		$db1 = new db_con();
		$sqlselect = "SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
						FROM sfhq_vote_bill_amount as vb 
						INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
						WHERE (vb.Bill_Staus = 0 OR vb.Bill_Staus = 3)					
						GROUP BY vb.Sup_Code ,vb.Recieved_Month
						ORDER BY V.Sup_id ,vb.Recieved_Month";									
							// AND vb.Current_Year = '$thisyear'  this was remove after bill status to get this year only		
		//echo $sqlselect;exit;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
        //12-12-2015 end of public static function
	
	public static function GetAgeAnalysisforSfhq($received_asat,$sfhq_id,$rtptype){
		
		if($rtptype==4)
		{
			$rtptype = '0  OR  vb.Bill_Staus =  3' ;
		}
		      
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)) as alloc
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = V.vote_id AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = V.vote_id AND ab.Bill_Staus = 1),0)
) as remain
						FROM sfhq_vote_bill_amount as vb 
						INNER JOIN sfhq_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
						INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
						WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date <= '$received_asat' AND vb.Sfhq_Id = '$sfhq_id'
						GROUP BY vb.Vote_ID ,vb.Recieved_Month
						ORDER BY vb.Vote_ID ,vb.Recieved_Month";
						
						//echo $sqlselec;
						//die();
								
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	   
	    public static function GetAllAgeAna_DFin($received_asat,$rtptype,$group){
		
		if($rtptype==4)
		{
			$rtptype = '0  OR  vb.Bill_Staus=3' ; 
		}
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)) as alloc
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = V.vote_id AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = V.vote_id AND ab.Bill_Staus = 1),0)
) as remain
		FROM vote_bill_amount AS vb 
		INNER JOIN txt_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
		INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
		WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat' 
		GROUP BY vb.Vote_ID,vb.Recieved_Month
		UNION ALL	
		SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)) as alloc
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = V.vote_id AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = V.vote_id AND ab.Bill_Staus = 1),0)
) as remain
		FROM sfhq_vote_bill_amount AS vb 
		INNER JOIN sfhq_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
		INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
		WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat' 
		GROUP BY vb.Vote_ID,vb.Recieved_Month";		 		
		
		//echo $sqlselect;
		//die ();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	} 
	
	
	
	 public static function GetAllSupAgeof_DFin($received_asat,$rtptype,$group){
		
		if($rtptype==4)
		{
			$rtptype = '0  OR  vb.Bill_Staus=3' ; 
		}
		$db1 = new db_con();
		$sqlselect = "SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
		FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
		INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
		WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat' 				
		GROUP BY vb.Sup_Code ,vb.Recieved_Month
		UNION ALL	
		SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
		FROM sfhq_vote_bill_amount as vb 
		INNER JOIN sfhq_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
		INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
		WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat'  
		GROUP BY vb.Sup_Code ,vb.Recieved_Month";		 		
			
		$data = $db1->GetAll($sqlselect);
		return $data;	
	} 
	
	
	   
	   
	   public static function GetDteAgeAna_DFin($received_asat,$rtptype,$group){
		
		if($rtptype==4)
		{
			$rtptype = '0  OR  vb.Bill_Staus=3' ; 
		}
	
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)) as alloc
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = V.vote_id AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = V.vote_id AND ab.Bill_Staus = 1),0)
) as remain
		FROM vote_bill_amount AS vb 
		INNER JOIN txt_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
		INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
		WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat' 
		GROUP BY vb.Vote_ID,vb.Recieved_Month 
		ORDER BY vb.Vote_ID,vb.Recieved_Month";
						 		
	//	echo $sqlselect;
	//	die ();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	} 
	
	
	public static function GetAccAgeAna_DFin($received_asat,$rtptype,$group){
		
		if($rtptype==4)
		{
			//this was change on 04 May 2018 not uploaded
			$rtptype ='0  OR  vb.Bill_Staus=3' ; 
			//$rtptype = $rtptype;
		}
		
			
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)) as alloc
		, (IFNULL((SELECT SUM(amount) FROM m_money_allocation WHERE Vot_Number = V.vote_id) ,0)
- IFNULL((SELECT SUM(vb.Amount) FROM vote_bill_amount as vb 
		INNER JOIN txt_bill_details as b ON b.Bill_No = vb.Bill_No AND b.Bill_Id = vb.Bill_Id AND b.Bill_Status = 1		
		WHERE vb.Vote_ID = V.vote_id AND vb.Bill_Staus = 1),0) 
- IFNULL((SELECT SUM(Amount) FROM sfhq_vote_bill_amount AS ab
		INNER JOIN sfhq_bill_details AS a ON a.Bill_No = ab.Bill_No AND a.Bill_Id = ab.Bill_Id AND a.sfhq_id = ab.sfhq_id 
AND ab.Bill_Staus = 1 WHERE ab.Vote_ID = V.vote_id AND ab.Bill_Staus = 1),0)
) as remain
		FROM sfhq_vote_bill_amount AS vb 
		INNER JOIN sfhq_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
		INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
		WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat' 
		GROUP BY vb.Vote_ID,vb.Recieved_Month 
		ORDER BY vb.Vote_ID,vb.Recieved_Month";
						 			
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
       
	   	
	public static function GetAgeAnalysisfortRIPOLI($date_as_at,$rtptype){
		
		if($rtptype==0)
		{
			//this was change on 04 May 2018 not uploaded
			$rtptype = '0  OR  vb.Bill_Staus =  3' ; 
			//$rtptype = $rtptype;
		}
		
		
		
        if($rtptype==1)
		{
			$rtptype = $rtptype;
		}

		$thisyear = $date_as_at ;
		
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
						FROM vote_bill_amount as vb 
						INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
						WHERE (vb.Bill_Staus = $rtptype )  
						GROUP BY vb.Vote_ID ,vb.Recieved_Month
						ORDER BY vb.Vote_ID ,vb.Recieved_Month";
						 		
		//echo $sqlselect;
		//die ();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
        
        
        //11-12-2015 added public static function for get all sfhq related vote age data to sfhq 0 type login
        public static function GetAllAgeAnalysisforSfhq($date_as_at,$rtptype){
		
		if($rtptype==0)
		{
			$rtptype = '0  OR  vb.Bill_Staus =  3' ;
		}
		
        if($rtptype==1)
		{
			$rtptype = $rtptype;
		}
		
		$thisyear= $date_as_at ;
		
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_id,V.vote_number,V.description,'B/F',vb.Recieved_Month,SUM(vb.Amount) 
						FROM sfhq_vote_bill_amount as vb 
						INNER JOIN votes AS V ON V.vote_id = vb.Vote_ID 
						WHERE (vb.Bill_Staus = $rtptype)
						GROUP BY vb.Vote_ID ,vb.Recieved_Month
						ORDER BY vb.Vote_ID ,vb.Recieved_Month";
									
								//echo $sqlselect;exit;
		//AND vb.Current_Year = '$thisyear'
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
        //11-12-2015 end public static function
	
	public static function GetSupplierAgefordtefin($received_asat,$rtptype,$group){
	if($rtptype==4)
		{
			$rtptype = '0  OR  vb.Bill_Staus=3' ; 
		}
		$db1 = new db_con();
		$sqlselect = "SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
						FROM vote_bill_amount as vb 
						INNER JOIN txt_bill_details as tx on tx.Bill_Id= vb.Bill_Id and tx.Bill_No=vb.Bill_No
						INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
						WHERE (vb.Bill_Staus = $rtptype) and tx.Recieved_Date < '$received_asat' 				
						GROUP BY vb.Sup_Code ,vb.Recieved_Month
						ORDER BY vb.Sup_Code ,vb.Recieved_Month
						";
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
		public static function GetSupplierAgeAnalysisfortRIPOLI($date_as_at){
		
		$lstyear= ($date_as_at - 1);
		$thisyear= $date_as_at ;
	
		
		$db1 = new db_con();
		$sqlselect = "SELECT V.Sup_id,V.Sup_Code,V.Sup_Name,'B/F',vb.Recieved_Month,SUM(vb.Amount) 	
						FROM vote_bill_amount as vb 
						INNER JOIN m_supplier_list AS V ON V.Sup_id = vb.Sup_Code
						WHERE (vb.Bill_Staus = 0 OR vb.Bill_Staus = 3) 						
						GROUP BY vb.Sup_Code ,vb.Recieved_Month
						ORDER BY vb.Sup_Code ,vb.Recieved_Month
						";
									 	
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	

	public static function GetSupplierOutstandforSfhq($date_as_at,$sfhq_id,$rtptype ){
		
	//	$lstyear= (date("Y", strtotime($date_as_at)) - 1);
	//	$thisyear= date("Y", strtotime($date_as_at)) ;
		
		if($rtptype==4)
		{
			$rtptype = '0  OR  T.Bill_Status =  3' ;
		}
		
      		
		$db1 = new db_con();
		$sqlselect =  " SELECT V.Sup_Code,s.Sup_Name,SUM(V.Amount),Hm_address,s.Contact_no,s.Email_Add,s.vat_no 
		FROM sfhq_vote_bill_amount AS V
		INNER JOIN m_supplier_list as s on V.Sup_Code =s.Sup_id
		INNER JOIN sfhq_bill_details AS T ON T.Bill_Id=V.Bill_Id						
		WHERE (T.Bill_Status = $rtptype) AND T.Invoice_date < '$date_as_at' AND T.Sfhq_Id ='$sfhq_id' 
		GROUP BY V.Sup_Code";	
						
		//echo $sqlselect;exit;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	public static function GetSupOutsForTripoli($date_as_at,$rtptype){
		
		//$lstyear = (date("Y", strtotime($date_as_at)) - 1);
		//$thisyear = date("Y", strtotime($date_as_at)) ;
		//$thismonth= date("M", strtotime($date_as_at));		
		
		if($rtptype==4)
		{
			$rtptype = '0  OR  T.Bill_Status =  3' ;
		}
		
		
		
		$db1 = new db_con();
		$sqlselect = " SELECT V.Sup_Code,s.Sup_Name,SUM(V.Amount),s.Hm_address,s.Contact_no,s.Email_Add,s.vat_no 
		FROM txt_bill_details AS T
		INNER JOIN vote_bill_amount AS V ON T.Bill_Id=V.Bill_Id	
		INNER JOIN m_supplier_list as s on V.Sup_Code =s.Sup_id
		WHERE (T.Bill_Status = $rtptype) AND T.Invoice_date < '$date_as_at'		
		GROUP BY V.Sup_Code";
						
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
        
        //12-12-2015 added public static function for get all sfhq supplier outstanding to sfhq type 0 login
        public static function GetAllSupplierOutstandforSfhq($date_as_at,$rtptype ){
		
		$lstyear= (date("Y", strtotime($date_as_at)) - 1);
		$thisyear= date("Y", strtotime($date_as_at)) ;
		
		if($rtptype==0)
		{
			$rtptype = '0  OR  T.Bill_Status =  3' ;
		}
		
        if($rtptype==1)
		{
			$rtptype = $rtptype;
		}
		
		$db1 = new db_con();
		$sqlselect =  " SELECT V.Sup_Code,s.Sup_Name,SUM(V.Amount),Hm_address,s.Contact_no,s.Email_Add,s.vat_no FROM sfhq_vote_bill_amount AS V
						
						INNER JOIN m_supplier_list as s on V.Sup_Code =s.Sup_id
						INNER JOIN sfhq_bill_details AS T ON T.Bill_Id=V.Bill_Id						
						WHERE (T.Bill_Status = $rtptype) AND T.Invoice_date < '$date_as_at'							
						GROUP BY V.Sup_Code";	
						
						
						
		//echo $sqlselect;exit;
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	//12-12-2015 end public static function
	
	
	
	public static function GetVoteBalanceforSfhq($sup_id,$from,$to){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No
		,v.vote_number 	
		,v.description
		,b.Recieved_Date
		,b.Bill_Settled_Date
		,(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id  ) as Ammount
		,s.Sup_Name
		 	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id
									
									INNER JOIN sfhq_vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id  
									INNER JOIN votes as v on v.vote_id = vb.Vote_ID 
									
									where b.Recieved_Date BETWEEN '$from' AND '$to'	
									AND s.Sup_id = $sup_id										
									ORDER BY vb.Vote_ID,b.Bill_Settled_Date DESC ";
									
						//b.Bill_Status = 1 AND 			
	//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	public static function GetSupplierOUtstandingTripoliG34($sup_id,$from,$to){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No	
		,b.Bill_ref_no
		,(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Sup_Code ='$sup_id' AND Bill_Staus=1  group by a.Bill_Id  ) as Ammount
		,vt.vote_number
		
		 	 
									FROM txt_bill_details as b
									Inner join vote_bill_amount as vba on vba.Bill_Id=b.Bill_Id
									Inner join votes as vt on vt.vote_id = vba.Vote_ID
									where b.Bill_Settled_Date BETWEEN '$from' AND '$to'										
									AND b.Bill_Name = '$sup_id' AND Bill_Status = 1								
									ORDER BY b.Recieved_Date DESC ";
									
								
	//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
//	public static function GetSupplierStatementforTripoli($sup_id,$from,$to){
//		$db1 = new db_con();
//		$sqlselect = "SELECT b.Bill_Id
//		,b.Bill_No
//		,v.vote_number 	
//		,v.description
//		,b.Recieved_Date
//		,b.Bill_Settled_Date
//		,(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Sup_Code ='$sup_id'  group by a.Bill_Id  ) as Ammount
//		,s.Sup_Name
//		,b.Bill_ref_no		
//		,b.remarks
//		,b.Bill_Status
//		,Invoice_date
//		 	 
//		 	 
//									FROM txt_bill_details as b 
//									INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id
//									
//									INNER JOIN vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id  
//									INNER JOIN votes as v on v.vote_id = vb.Vote_ID 
//									
//									where b.Recieved_Date BETWEEN '$from' AND '$to'	
//									AND s.Sup_id = '$sup_id'										
//									ORDER BY vb.Vote_ID,b.Recieved_Date DESC ";
//									
//								
//	//echo $sqlselect; exit; 
//		//and b.UserTypeId ='$user_type_id'
//		$data = $db1->GetAll($sqlselect);
//		return $data;	
//	}
	
        //hanged public static function get all supplier's supplier statements for 0 user accounts
        public static function GetSupplierStatementforTripoli($sfhq_id,$sup_id,$from,$to){
		$db1 = new db_con();
                
                if($sfhq_id == 0){
                    
                    $sqlselect = "SELECT b.Bill_Id
                    ,b.Bill_No
                    ,v.vote_number 	
                    ,v.description
                    ,b.Recieved_Date
                    ,b.Bill_Settled_Date
                    ,(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Sup_Code ='$sup_id'  group by a.Bill_Id  ) as Ammount
                    ,s.Sup_Name
                    ,b.Bill_ref_no		
                    ,b.remarks
                    ,b.Bill_Status
                    ,Invoice_date
					
					,b.Invoice_No 
					,b.G35_No
					,b.G35_Date
					,s.Hm_address
					,s.Vat_No			
					,b.Cheque_No
					,b.Cheque_Date
					,b.Cheque_Date		
									
					,b.bill_period_from
					,b.bill_period_to
					
                    FROM txt_bill_details as b 
                    INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id
                    INNER JOIN vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id  
                    INNER JOIN votes as v on v.vote_id = vb.Vote_ID 

                    where b.Recieved_Date BETWEEN '$from' AND '$to'	
                    AND s.Sup_id = $sup_id										
                    ORDER BY vb.Vote_ID,b.Recieved_Date DESC ";


                   // echo $sqlselect; die(); 
                    //and b.UserTypeId ='$user_type_id'
                    $data = $db1->GetAll($sqlselect);
                }
                else{
                    $sqlselect = "SELECT b.Bill_Id
                    ,b.Bill_No
                    ,v.vote_number 	
                    ,v.description
                    ,b.Recieved_Date
                    ,b.Bill_Settled_Date
                    ,(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id AND  a.Sfhq_Id ='$sfhq_id' group by a.Bill_Id  ) as Ammount
                    ,s.Sup_Name
                    ,b.Bill_ref_no
                    ,b.remarks
                    ,b.Bill_Status
                    ,b.Invoice_date			
					
					,b.Invoice_No 
					,b.G35_No
					,b.G35_Date
					,s.Hm_address
					,s.Vat_No
					
					,b.Cheque_No
					,b.Cheque_Date
					,b.Cheque_Ent_Date
					,b.bill_period_from
					,b.bill_period_to
					
					
                     FROM sfhq_bill_details as b 
                     INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id

                    INNER JOIN sfhq_vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id  
                    INNER JOIN votes as v on v.vote_id = vb.Vote_ID 

                    where b.Recieved_Date BETWEEN '$from' AND '$to'	
                     AND s.Sup_id = $sup_id	AND b.Sfhq_Id = '$sfhq_id'									
                    ORDER BY vb.Vote_ID,b.Recieved_Date DESC ";

                                                    //b.Bill_Status = 1 AND 			
                    //echo $sqlselect;exit; 
                    //and b.UserTypeId ='$user_type_id'
                    $data = $db1->GetAll($sqlselect);
                }
		
		return $data;	
	}
	
	public static function GetSupplierStatementforSfhq($sup_id,$from,$to,$sfhq_id){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No
		,v.vote_number 	
		,v.description
		,b.Recieved_Date
		,b.Bill_Settled_Date
		,(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id AND  a.Sfhq_Id =$sfhq_id group by a.Bill_Id  ) as Ammount
		,s.Sup_Name
		,b.Bill_ref_no
		,b.remarks
		,b.Bill_Status
		,b.Invoice_date
		
		,b.Invoice_No 
		,b.G35_No
		,b.G35_Date
		,s.Hm_address
		,s.Vat_No
		
		,b.Cheque_No
		,b.Cheque_Date
		,b.Cheque_Ent_Date
		,b.bill_period_from
		,b.bill_period_to
		
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id
									
									INNER JOIN sfhq_vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id  
									INNER JOIN votes as v on v.vote_id = vb.Vote_ID 
									
									where b.Recieved_Date BETWEEN '$from' AND '$to'	
									AND s.Sup_id = $sup_id	AND b.Sfhq_Id = $sfhq_id									
									ORDER BY vb.Vote_ID,b.Recieved_Date DESC ";
									
						//b.Bill_Status = 1 AND 			
	//echo $sqlselect;die(); 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetDailyReportforSfhq($bilstatus,$from,$to,$sfhq_id,$dtrange,$veh_val,$vt_type,$sup_type_id){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No
		,br.branch_name
		,s.Sup_Name
		,v.vote_number 
		,vb.Amount
		,b.Invoice_date
		,b.Recieved_Date
		,b.Bill_ref_no	
		,b.remarks
		,b.Create_Date		
		,b.Bill_Settled_Date	
		,rt.rtn_date
		,rtn.rtn_reason_detail		
		,b.Invoice_No   
		,b.G35_No
		,b.G35_Date
		,s.Hm_address
		,s.Vat_No
		,b.Cheque_No
		,b.Cheque_Date
		,b.file_ref
		,s.address_line1
		,s.address_line2
		,s.address_line3
		,s.address_line4
		,b.bill_period_from
		,b.bill_period_to	
		,vt.vt_type_name
		,(CASE
		when s.is_vehicle=0 then ' '
		when s.is_vehicle=1 then s.civil_veh_no
		else 'wrong'
		END ) as vehNo
        ,l.Veh_Place
        ,b.ledger_date
		,s.mobile
		,rt.act_date
		
		FROM sfhq_bill_details as b 
		INNER JOIN m_supplier_list as s on b.Sup_Code=s.Sup_id	AND s.sup_type_id=$sup_type_id									
		LEFT OUTER JOIN sfhq_vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id and vb.Bill_No=b.Bill_No  
		INNER JOIN votes as v on v.vote_id = vb.Vote_ID 
		LEFT JOIN vote_type as vt on vt.vt_type_id=v.vt_type
		LEFT OUTER JOIN sfhq_return_details as rt on rt.Bill_Id=b.Bill_Id 
		LEFT OUTER JOIN  m_return as rtn on rt.rtn_reason=rtn.rtn_id 
        LEFT OUTER JOIN m_veh_run_place as l on l.Veh_Run_Place_Id=b.veh_run_pl_id
		INNER JOIN m_branches as br on br.branch_id= b.branch_id
        
		
		where ".$dtrange." BETWEEN '$from' AND '$to'	
		AND b.Bill_Status = $bilstatus
		and b.Sfhq_Id = $sfhq_id
		AND s.is_vehicle=$veh_val
		AND vt_type_id=$vt_type		
		ORDER BY b.Bill_No ASC";
									
								
	//	echo $sqlselect; die();
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetDailyReportforTripoli($bilstatus,$from,$to,$dtrange,$veh_val,$vt_type,$sup_type_id){
		
			
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No
		,br.branch_name
		,s.Sup_Name
		,v.vote_number 
		,vb.Amount
		,b.Invoice_date
		,b.Recieved_Date
		,b.Bill_ref_no	
		,b.remarks
		,b.Create_Date		
		,b.Bill_Settled_Date
		,rt.rtn_date
		,rtn.rtn_reason_detail		
		,b.Invoice_No   
		,b.G35_No
		,b.G35_Date
		,s.Hm_address
		,s.Vat_No
		,b.Cheque_No
		,b.Cheque_Date
		,b.file_ref
		,s.address_line1
		,s.address_line2
		,s.address_line3
		,s.address_line4
		,b.bill_period_from
		,b.bill_period_to
		,vt.vt_type_name
		,(CASE
		when s.is_vehicle=0 then ' '
		when s.is_vehicle=1 then s.civil_veh_no
		else 'wrong'
		END ) as vehNo
		,l.Veh_Place
        ,b.ledger_date
		,s.mobile
		,rt.act_date
        
		FROM txt_bill_details as b 
		INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id AND s.sup_type_id=$sup_type_id									
		LEFT OUTER JOIN vote_bill_amount as vb on vb.Bill_Id=b.Bill_Id and vb.Bill_No = b.Bill_No
		INNER JOIN votes as v on v.vote_id = vb.Vote_ID 
		LEFT JOIN vote_type as vt on vt.vt_type_id=v.vt_type
		LEFT OUTER JOIN return_details as rt on rt.Bill_Id=b.Bill_Id 
		LEFT OUTER JOIN  m_return as rtn on rt.rtn_reason=rtn.rtn_id 
        LEFT OUTER JOIN m_veh_run_place as l on l.Veh_Run_Place_Id=b.veh_run_pl_id
		INNER JOIN m_branches as br on br.branch_id= b.branch_id
		
		where ".$dtrange." BETWEEN '$from' AND '$to'	
		AND b.Bill_Status = $bilstatus	
		AND s.is_vehicle=$veh_val	
		AND vt_type_id=$vt_type								
		ORDER BY b.Bill_No ASC";
									
										
    //	echo $sqlselect; die();
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
		
		
		
		
	}
	
	public static function GetRtnReportforDte($rtnin_from,$rtnin_to,$received_asat){
		$db1 = new db_con();
		$sqlselect = "SELECT    
						DISTINCT b.Bill_Id,
						b.Bill_No,
						br.branch_name,
						s.Sup_Name,
						v.vote_number,
						vb.Amount,
						b.Invoice_date,
						b.Recieved_Date,
						b.Create_Date,
						b.Invoice_No,
						b.G35_Date,
						b.G35_No,						
						b.Bill_ref_no,
						b.remarks,
						b.Modified_Date
						
									
					FROM
						txt_bill_details AS b
					INNER JOIN vote_bill_amount AS vb ON vb.Bill_Id = b.Bill_Id
					AND vb.Bill_No = b.Bill_No
					INNER JOIN m_supplier_list AS s ON b.Bill_Name = s.Sup_id
					INNER JOIN votes AS v ON v.vote_id = vb.Vote_ID
					INNER JOIN m_branches AS br ON br.branch_id = b.branch_id
					INNER JOIN return_details AS r ON r.Bill_Id = b.Bill_Id
					WHERE
						b.Bill_Id IN (
							SELECT DISTINCT
								Bill_Id
							FROM
								return_details
							WHERE
								act_date > 0
						)
					AND b.Bill_Status = 0
					AND r.act_date BETWEEN '$rtnin_from' AND '$rtnin_to'
					AND b.Recieved_Date <= '$received_asat'
					ORDER BY v.vt_type,b.Bill_No";	
				
    	//echo $sqlselect; 
		//die();
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetVoteStatementforTripoli($vote_id,$rtptype,$from,$to,$dtrange){
		$db1 = new db_con();
		
		if($rtptype==0)
		{
			$rtptype = '0  OR  t.Bill_Staus =  3' ;
		}
		
        if($rtptype==1)
		{
			$rtptype = $rtptype;
			
		}
		
		if($rtptype==2)
		{
			$rtptype = '0' ;
		}
		
		$sqlselect = " SELECT t.Bill_No
								,S.Sup_Name
								,t.Amount
								,D.Invoice_date
								,D.Bill_Settled_Date
								,D.Recieved_Date
								,D.remarks 
								,D.Invoice_No   
								,D.G35_No
								,D.G35_Date
								,S.Hm_address
								,S.Vat_No
								
						FROM vote_bill_amount  as t
						INNER JOIN txt_bill_details AS D ON D.Bill_Id = t.Bill_Id and D.Bill_No=t.Bill_No
						INNER JOIN m_supplier_list AS S ON S.Sup_id=t.Sup_Code
						
						WHERE t.Bill_Staus = $rtptype 
						and t.Vote_ID = $vote_id 
						and ".$dtrange." BETWEEN '$from' and '$to'										
						ORDER BY t.Bill_No,D.Recieved_Date DESC ";
									
								
	//echo $sqlselect; exit;
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
        
        //12-12-2015 added public static function for get all sfhq vote statement data to sfhq tyoe 0 login
        public static function GetVoteStatementforAllSfhq($vote_id,$rtptype,$from,$to){
		$db1 = new db_con();
		
		if($rtptype==0)
		{
			$rtptype = '0  OR  t.Bill_Staus =  3' ;
		}
		
        if($rtptype==1)
		{
			$rtptype = $rtptype;
		}
		
		if($rtptype==2)
		{
			$rtptype = '0' ;
		}
		
		$sqlselect = " SELECT t.Bill_No
							,S.Sup_Name
							,t.Amount
							,D.Invoice_date
							,D.Bill_Settled_Date
							,D.Recieved_Date
							,D.remarks 
							,D.Invoice_No   
							,D.G35_No
							,D.G35_Date
							,S.Hm_address
							,S.Vat_No
							,D.Sfhq_Id
		
							
							
					    FROM sfhq_vote_bill_amount  as t
						INNER JOIN sfhq_bill_details AS D ON D.Bill_Id = t.Bill_Id
						INNER JOIN m_supplier_list AS S ON S.Sup_id=t.Sup_Code
						
						WHERE (t.Bill_Staus = $rtptype) and t.Vote_ID = '$vote_id' 
						AND D.Recieved_Date BETWEEN '$from' AND '$to'										
						ORDER BY D.Sfhq_Id,t.Bill_No,D.Recieved_Date DESC  ";
									
						//b.Bill_Status = 1 AND 			
	//echo $sqlselect; exit;
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	public static function Psoviewfromallstation($vote_id,$rtptype,$from,$to,$dtrange){
		$db1 = new db_con();
		
		if($rtptype==0)
		{
			$rtptype = 0 ;
		}
		
        if($rtptype==1)
		{
			$rtptype = 1;
			
		}
		
		if($rtptype==3)
		{
			$rtptype = 3 ;
		}
        
        if($rtptype==4)
		{
			$rtptype = 't.Bill_Staus' ;
		}
		
		
	
		
		$sqlselect = " SELECT t.Bill_No,S.Sup_Name,t.Amount
								,D.Invoice_date
								,D.Bill_Settled_Date
								,D.Recieved_Date
								,D.remarks 
								,D.Invoice_No   
								,D.G35_No
								,D.G35_Date
								,CONCAT(S.address_line1,' ',S.address_line2,' ',S.address_line3,' ',S.address_line4) as addrs
								,S.Vat_No
								,'DFIN'
								,(CASE
                                when D.Bill_Status=0 then 'Not Settle'
                                when D.Bill_Status=1 then 'Settled'
                                when D.Bill_Status=3 then 'Returened'
                                else 'wrong'
                                END ) as Status
                                
						FROM vote_bill_amount  as t
						INNER JOIN txt_bill_details AS D ON D.Bill_Id = t.Bill_Id and D.Bill_No=t.Bill_No
						INNER JOIN m_supplier_list AS S ON S.Sup_id=t.Sup_Code
						
						WHERE t.Bill_Staus = $rtptype 
						and t.Vote_ID = $vote_id 
						and ".$dtrange." BETWEEN '$from' and '$to'										
						
						UNION ALL
						
							 SELECT t.Bill_No
							,S.Sup_Name
							,t.Amount
							,D.Invoice_date
							,D.Bill_Settled_Date
							,D.Recieved_Date
							,D.remarks 
							,D.Invoice_No   
							,D.G35_No
							,D.G35_Date
							,CONCAT(S.address_line1,' ',S.address_line2,' ',S.address_line3,' ',S.address_line4) as addrs
							,S.Vat_No							
                            ,(CASE
                                when D.Sfhq_Id=1 then 'SFHQ(West)'
                                when D.Sfhq_Id=2 then 'SFHQ(W)'
                                when D.Sfhq_Id=3 then 'SFHQ(E)'
                                when D.Sfhq_Id=4 then 'SFHQ(J)'
                                when D.Sfhq_Id=5 then 'SFHQ(KLN)'
                                when D.Sfhq_Id=6 then 'SFHQ(MLT)'
                                when D.Sfhq_Id=7 then 'SFHQ(Cen)'
                                else 'wrong'
                                END ) as Sfhq
                            ,(CASE
                                when D.Bill_Status=0 then 'Not Settle'
                                when D.Bill_Status=1 then 'Settled'
                                when D.Bill_Status=3 then 'Returened'
                                else 'wrong'
                                END ) as Status
							
					    FROM sfhq_vote_bill_amount  as t
						INNER JOIN sfhq_bill_details AS D ON D.Bill_Id = t.Bill_Id
						INNER JOIN m_supplier_list AS S ON S.Sup_id=t.Sup_Code
						
						WHERE (t.Bill_Staus = $rtptype) and t.Vote_ID = $vote_id 
						and ".$dtrange." BETWEEN '$from' and '$to'								
						ORDER BY Bill_No";
									
								
	//echo $sqlselect; die();
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
        //12-12-2012 end public static function		
		
		
		
	
	public static function GetDirectorateSummeryforTripoli($branch_id,$billstatus,$txt_as_at_date,$txt_to_date){
		$db1 = new db_con();
		$sqlselect = "  SELECT b.Bill_Id
								,b.Bill_No
								,s.Sup_Name
								,b.Recieved_Date
								,(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id ) as Ammount 
								,b.Bill_Settled_Date
								,R.rtn_date
								,rtn.rtn_reason_detail
								,b.Invoice_date
								,b.Bill_ref_no
								,b.remarks
								,vt.vote_number	
								,b.Invoice_No  
								,b.G35_No
								,b.G35_Date
								,s.Hm_address
								,s.Vat_No 
																							 
									 
								FROM txt_bill_details as b 
								Inner join vote_bill_amount as vba on vba.Bill_Id=b.Bill_Id
								Inner join votes as vt on vt.vote_id = vba.Vote_ID
								INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 									
								LEFT OUTER JOIN return_details R ON R.Bill_Id=b.Bill_Id
								LEFT OUTER JOIN  m_return as rtn on R.rtn_reason=rtn.rtn_id 
								where b.Bill_Status = $billstatus 	
								and b.Recieved_Date between '$txt_as_at_date' and '$txt_to_date'
								and b.branch_id = $branch_id 
																
								ORDER BY b.Bill_No ASC  ";
																	
								
	//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetSupplierOutstandingInLieu34forSfhq($sup_id,$from,$to,$sfhq_id){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
		,b.Bill_No
		,b.Bill_ref_no	
		,(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id AND Bill_Staus=1 AND  a.Sfhq_Id ='$sfhq_id'
		group by a.Bill_Id ) 
		as Ammount 
		,vt.vote_number	
									FROM sfhq_bill_details as b 	
									Inner join sfhq_vote_bill_amount as vba on vba.Bill_Id=b.Bill_Id and vba.Sfhq_Id ='$sfhq_id'
									Inner join votes as vt on vt.vote_id = vba.Vote_ID
									where b.Bill_Settled_Date BETWEEN '$from' AND '$to'	
									AND b.Sup_Code = $sup_id	AND b.Sfhq_Id = '$sfhq_id' AND b.Bill_Status = 1									
									ORDER BY b.Recieved_Date DESC ";									
									
	 //   echo $sqlselect; 		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetVotewiseSumforG34forSfhq($sup_id,$from,$to,$sfhq_id){
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_number,SUM(VB.Amount)
						FROM sfhq_bill_details AS b
						INNER JOIN sfhq_vote_bill_amount AS VB ON VB.Bill_Id=b.Bill_Id 
						INNER JOIN votes AS V ON V.vote_id=VB.Vote_ID						
						WHERE b.Bill_Settled_Date BETWEEN '$from' AND '$to' 
						AND b.Sup_Code = $sup_id AND b.Sfhq_Id = '$sfhq_id' AND b.Bill_Status = 1							
						GROUP BY V.vote_id";									
									
	 //  echo $sqlselect; 		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
		public static function GetVotewiseSumforG34forTripoli($sup_id,$from,$to){
		$db1 = new db_con();
		$sqlselect = "SELECT V.vote_number,SUM(VB.Amount)
						FROM txt_bill_details AS b
						INNER JOIN vote_bill_amount AS VB ON VB.Bill_Id=b.Bill_Id 
						INNER JOIN votes AS V ON V.vote_id=VB.Vote_ID						
						WHERE b.Bill_Settled_Date BETWEEN '$from' AND '$to' 
						AND b.Bill_Name = $sup_id AND b.Bill_Status = 1							
						GROUP BY V.vote_id";									
									
	   // echo $sqlselect; 		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	public static function GetDirSummeryforSfhq($branch_id,$billstatus,$sfhq_id,$txt_as_at_date,$txt_to_date ){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id
								,b.Bill_No
								,s.Sup_Name
								,b.Recieved_Date
								,(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id ) as Ammount 
								,b.Bill_Settled_Date
								,R.rtn_date
								,rtn.rtn_reason_detail
								,b.Invoice_date
								,b.Bill_ref_no
								,b.remarks
								,vt.vote_number	 
								,b.Invoice_No   
								,b.G35_No
								,b.G35_Date
								,s.Hm_address
								,s.Vat_No
								
								
								FROM sfhq_bill_details as b 
								Inner join  sfhq_vote_bill_amount as vba on vba.Bill_Id=b.Bill_Id
								Inner join votes as vt on vt.vote_id = vba.Vote_ID							
								
								INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 	
								LEFT OUTER JOIN  sfhq_return_details R ON R.Bill_Id=b.Bill_Id
								LEFT OUTER JOIN  m_return as rtn on R.rtn_reason=rtn.rtn_id 
								where b.Bill_Status = $billstatus 
								and b.Recieved_Date between '$txt_as_at_date' and '$txt_to_date'
								and b.branch_id = $branch_id 
								and  b.Sfhq_Id= '$sfhq_id'						
								ORDER BY b.Bill_No ASC";
						
	//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	public static function GetVoteStatementforSfhq($vote_id,$rtptype,$from,$to,$sfhq_id,$dtrange){
		$db1 = new db_con();
		
		if($rtptype==0)
		{
			$rtptype = '0  OR  t.Bill_Staus =  3' ;
		}
		
        if($rtptype==1)
		{
			$rtptype = $rtptype;
		}
		
		if($rtptype==2)
		{
			$rtptype = '0' ;
		}
		
		$sqlselect = " SELECT t.Bill_No
								,S.Sup_Name
								,t.Amount
								,D.Invoice_date
								,D.Bill_Settled_Date
								,D.Recieved_Date
								,D.remarks 								
								,D.Invoice_No   
								,D.G35_No
								,D.G35_Date
								,S.Hm_address
								,S.Vat_No
								
					    FROM sfhq_vote_bill_amount  as t
						INNER JOIN sfhq_bill_details AS D ON D.Bill_Id = t.Bill_Id and D.Bill_No=t.Bill_No
						INNER JOIN m_supplier_list AS S ON S.Sup_id=t.Sup_Code
						
						WHERE (t.Bill_Staus = $rtptype) and t.Vote_ID =$vote_id 
						AND ".$dtrange." BETWEEN '$from' AND '$to' and  t.Sfhq_Id=$sfhq_id										
						ORDER BY t.Bill_No,D.Recieved_Date DESC  ";
									
						//b.Bill_Status = 1 AND 			
	//echo $sqlselect; exit;
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function Getsupplieralllist(){
		$db1 = new db_con();
		
				
		$sqlselect = " SELECT s.*,b.Bnk_Code FROM m_supplier_list as s 
		LEFT JOIN m_bank as b on b.bnk_Auto_id=s.Bank_id		
		ORDER BY s.Sup_Name";									
		//b.Bill_Status = 1 AND 			
	//echo $sqlselect; exit;
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	
	public static function GetAllBillsDGFMToSFHQAll($status,$search,$user_type_id,$sfhq_id){
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id	 	 	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status 
									
									
									
									and b.Sfhq_Id = $sfhq_id
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									and b.UserTypeId ='$user_type_id' ORDER BY b.Bill_No ASC  ";
									
									
	 //echo $sqlselect; 
		/////AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetDirecterateData($dte,$status,$todate,$txt_as_at_date)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT m_branches.branch_id,m_branches.branch_name FROM m_branches";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}	
	
	public static function GetSupplierName($sup_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT Sup_Name,Related_sfhq_id FROM m_supplier_list where Sup_id = $sup_id ";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
	
	
	public static function GetTypesofVotes($vt_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT vt_type_name FROM vote_type where vt_type_id =$vt_id";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
	
	public static function GetSFHQName($sfhq_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT Name FROM m_sfhq where ID =$sfhq_id";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
	
	
        //11-12-2015 added public static function
        	public static function GetSupplierSfhq($sup_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT Related_sfhq_id FROM  m_supplier_list where Sup_id = $sup_id ";
		$data = $db1->GetAll($sqlselect);
		//echo $sqlselect;
		return $data;		
	}
        //11-12-2015 End of adding
		public static function GetVoteName($vote_id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT description FROM  votes where vote_id 	 = $vote_id ";
		$data = $db1->GetAll($sqlselect);
		return $data;		
	}	
	public static function GetAllBillsDGFMPaginationToBigUser($branch_id,$status,$search,$user_type_id,$start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Bill_Name,b.Recieved_Date,
		(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Bill_No = b.Bill_No group by a.Bill_Id ) as Ammount 
		,s.Sup_Name	 ,
		(select vote_number from votes as v where v.vote_id=b.Settled_Vote_ID group by  v.vote_id ) as vote_name,
(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) as branch_name ,b.Bill_Settled_Date,b.Modified_Date,b.Bill_ref_no,b.branch_id	 
									FROM txt_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
									where b.Bill_Status = $status 									
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									and b.branch_id = $branch_id 
									
									
									 ORDER BY b.Bill_No ASC 
									limit $start, $length  ";
								
		//echo $sqlselect; 
		//die();
		//                 AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetAllBillsDGFMPaginationToBigestUser($sfhq_id,$status,$search,$unit_dis_id,$start, $length)
	{
		if($unit_dis_id == 0)
		{
			
			$unit_dis_id = 'Unit_Id';
		}
		
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Sup_Code,b.Recieved_Date,
		(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id group by a.Bill_Id ) as Ammount 
		,s.Sup_Name	 ,
		(select vote_number from votes as v where v.vote_id=b.Settled_Vote_ID group by  v.vote_id ) as vote_name,
(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) as branch_name ,b.Bill_Settled_Date,b.Modified_Date,b.Bill_ref_no	 
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
					where b.Bill_Status = $status 									
					and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
					and b.Unit_Id =  $unit_dis_id
									and b.Sfhq_Id = $sfhq_id 
									AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
									 ORDER BY b.Bill_No ASC 
									limit $start, $length  ";
								
		//echo $sqlselect; 
		//and b.UserTypeId ='$user_type_id'
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetAllBillsDGFMPaginationToSFHQ($branch_id,$status,$search,$user_type_id,$sfhq_id,$start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Sup_Code,b.Recieved_Date,
		(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Bill_No= b.Bill_No group by a.Bill_Id ) as Ammount 
		,s.Sup_Name	 ,
		(select vote_number from votes as v where v.vote_id=b.Settled_Vote_ID group by  v.vote_id ) as vote_name,
		(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) as branch_name,b.Bill_Settled_Date,b.Modified_Date	
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status 	
									and b.Sfhq_Id = $sfhq_id
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									and b.branch_id = $branch_id 
									
									
									and b.UserTypeId ='$user_type_id' ORDER BY b.Bill_No ASC 
									limit 5  ";
									//limit $start, $length  ";
								
		//echo $sqlselect; 
		//die();
		//////////////AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetAllBillsDGFMPaginationToBigUserAll($status,$search,$user_type_id,$start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Bill_Name,b.Recieved_Date,
 				(select sum(a.Amount) from vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Bill_No = b.Bill_No group by a.Bill_Id ) as  Ammount,
				   s.Sup_Name,
 				(select vote_number from votes as v where v.vote_id=b.Settled_Vote_ID group by  v.vote_id ) as vote_name,
(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) as branch_name,b.Bill_Settled_Date,b.Modified_Date,b.Bill_ref_no,b.branch_id
 					FROM 
						txt_bill_details as b INNER JOIN m_supplier_list as s on b.Bill_Name =s.Sup_id 
						where  b.Bill_Status = $status
						
					
						
						and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
						 ORDER BY b.Bill_No ASC limit $start, $length  ";
		//echo $sqlselect; 
		//die();
		////////////////////AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE()) this must go to above space

		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function SFHQBilltoPrint($status,$search,$user_type_id,$sfhq_id,$start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Sup_Code,b.Recieved_Date,
 			(select sum(a.Amount) from sfhq_vote_bill_amount as a 
			where a.Bill_Id=b.Bill_Id and a.Bill_No= b.Bill_No group by a.Bill_Id ) as  Ammount 
			,s.Sup_Name
			,b.branch_id,
			(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) 
			as branch_name,
			b.Bill_Settled_Date,
			b.Modified_Date,
			b.branch_id	
 			FROM sfhq_bill_details as b 
			INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
			where  b.Bill_Status = $status
			and b.Sfhq_Id = $sfhq_id					
			and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
			
			ORDER BY b.Bill_No ASC 
			limit $start, $length  ";
	
	//echo $sqlselect; die();
			$data = $db1->GetAll($sqlselect);
			return $data;	
	}
	
	
	public static function SFHQPrintingBills($branch_id,$status,$search,$user_type_id,$sfhq_id,$start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Sup_Code,b.Recieved_Date,
		(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Bill_No= b.Bill_No group by a.Bill_Id ) as Ammount 
		,s.Sup_Name	 ,
		(select vote_number from votes as v where v.vote_id=b.Settled_Vote_ID group by  v.vote_id ) as vote_name,
		(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) as branch_name,b.Bill_Settled_Date,b.Modified_Date	
									FROM sfhq_bill_details as b 
									INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
									where b.Bill_Status = $status 	
									and b.Sfhq_Id = $sfhq_id
									and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
									and b.branch_id = $branch_id 
									
									
									
									ORDER BY b.Bill_No ASC 									
									limit $start, $length  ";
								
		//echo $sqlselect; 
		//die();
		//                 AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	public static function GetUserAccountCount($status,$branch_id){
		$db1 = new db_con();
		$sqlselect = "select user_name from users where sfhq_id=$branch_id and isactive=$status
						 ORDER BY user_name ";
									
									
		//echo $sqlselect; 
		//	AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	public static function GetAllUserDetails($status,$branch_id,$start, $length)
	{
		$db1 = new db_con();
		
		if($branch_id==0){
		
		$sqlselect = "select u.user_id,u.user_name,u.Name,b.branch_name,u.Telephone,u.active_date
		,u.deactive_date,u.Isprivilege_user 
		from users as u
		inner join m_branches as b on b.branch_id=u.branch_id 
		where u.sfhq_id=$branch_id and u.isactive=$status
		ORDER BY b.branch_name limit $start, $length  ";
		
		} else if($branch_id>0){
		
		$sqlselect = "select u.user_id,u.user_name,u.Name,(select Name from m_sfhq where ID=$branch_id),u.Telephone,u.active_date,u.deactive_date,u.Isprivilege_user
		,u.deactive_date 
		from users as u
		
		where u.sfhq_id=$branch_id and u.isactive=$status
		limit $start, $length  ";	
			
		}
		//echo $sqlselect; 
		//die();
		
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
	
	
	public static function GetAllBillsDGFMPaginationToSFHQAll($status,$search,$user_type_id,$sfhq_id,$start, $length)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT b.Bill_Id,b.Bill_No,b.Sup_Code,b.Recieved_Date,
 			(select sum(a.Amount) from sfhq_vote_bill_amount as a where a.Bill_Id=b.Bill_Id and a.Bill_No= b.Bill_No group by a.Bill_Id ) as  Ammount 
			,s.Sup_Name
			,b.branch_id,
(select branch_name from m_branches as mb where mb.branch_id=b.branch_id group by  mb.branch_id) as branch_name,b.Bill_Settled_Date,b.Modified_Date,b.branch_id	
 					
					FROM sfhq_bill_details as b 
						INNER JOIN m_supplier_list as s on b.Sup_Code =s.Sup_id 
						where  b.Bill_Status = $status
						and b.Sfhq_Id = $sfhq_id
						
						
						and ( b.Bill_No like '%$search%' ||  s.Sup_Name like '%$search%' )
						and b.UserTypeId ='$user_type_id' ORDER BY b.Bill_No ASC 
						limit 5  ";
						//limit $start, $length  ";
		//echo $sqlselect; 
		//die();
		
		
		////////////AND EXTRACT(YEAR FROM b.Recieved_Date) = EXTRACT(YEAR FROM CURDATE())
		$data = $db1->GetAll($sqlselect);
		return $data;	
	}
	
		
	public static function get_all_regiment_namesDGFM($sfhq_id,$branch_id)
	{
		$db1 = new db_con();
		$sql = "select * from m_unit_distribution_chart WHERE Sfhq_Id = $sfhq_id AND branch_id 	= $branch_id";
		//echo $sql ;
		//die ();
		$data = $db1->GetAll($sql);		
		return $data;
	}
	
	
		public static function get_MatchedSupplier($sfhq_id,$str1,$str2,$str3,$str4)
	{
		$db1 = new db_con();
		//$sql = "select * from m_supplier_list WHERE Related_sfhq_id='$sfhq_id' AND Sup_Name like '%$branch_id%'";
			 		
        $sql = "select * from temp_all_modsupplier WHERE 
					supName LIKE '%$str1%'  || supName LIKE '%$str2%' 
				  order by supName ASC  ";
								
		//echo $sql ; ASC
		//die ();
		$data = $db1->GetAll($sql);		
		return $data;
		//return $sql;
		
	}
	
	
	
	public static function get_all_regiment_namesDGFM1($branch_id,$sfhq_id)
	{
		$db1 = new db_con();
		$sql = "select * from m_unit_distribution_chart WHERE branch_id = $branch_id and  Sfhq_Id = $sfhq_id";
		//echo $sql ;
		$data = $db1->GetAll($sql);		
		return $data;
	}
	
	
	
	public static function get_all_PayeeListforDGFM()
	{
		$db1 = new db_con();
		$sql = "select * from m_unit_distribution_chart ";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	public static function GetBranchName($branch_id)
	{
		$db1 = new db_con();
		$sql = "select * from m_branches  where branch_id = $branch_id";
	//	echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	
	
	public static function get_all_branches()
	{
		$db1 = new db_con();
		$sql = "select * from m_branches ORDER BY  branch_name";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	
	
	public static function get_all_Operationalbranches()
	{
		$db1 = new db_con();
		$sql = "SELECT 	* FROM 	m_branches WHERE IsController=1 ORDER BY branch_name";
		return $db1->GetAll($sql);
	}
	
	
	public static function get_all_OpstoProcController($pro_id)
	{
		$db1 = new db_con();
		$sql = "SELECT 	o.Ope_Con_Id,m.branch_name FROM pro_ope_controllerchart as o
		INNER JOIN m_branches as m on m.branch_id=o.Ope_Con_Id WHERE Proc_Con_Id=$pro_id";
		//echo $sql ;
		//die();
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
		
	public static function get_all_ProController()
	{
		$db1 = new db_con();
		$sql = "SELECT branch_id,branch_name FROM 	m_branches WHERE IsPosCon=1 ORDER BY branch_name";
	//	echo $sql ;
		//die();
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	public static function get_all_branchestosfhq()
	{
		$db1 = new db_con();
		$sql = "select * from m_branches WHERE Related_to_sfhq =1 ORDER BY  branch_name";		
			
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
		
	
	
	public static function get_all_OpesController($pro_Con_Id)
	{
		$db1 = new db_con();
		
		$sql = "select $pro_Con_Id as pro_Con_Id,branch_name from m_branches WHERE branch_id=$pro_Con_Id
		UNION ALL
		select pc.Ope_Con_Id, b.branch_name from pro_ope_controllerchart as pc 
		Inner join m_branches as b on b.branch_id=pc.Ope_Con_Id
		WHERE pc.Proc_Con_Id=$pro_Con_Id";		
			
		
		$data = $db1->GetAll($sql);
		//echo $data ;
	//	die();
		
		return $data;
	}
	
	
	public static function get_all_branchestosfhqnotall($sfhq_id)
	{
		$db1 = new db_con();
		$sql = "select DISTINCT(p.Branch_ID),b.branch_name from pso_view_chart as p
				INNER JOIN m_branches as b on b.branch_id=p.Branch_ID and b.Related_to_sfhq=1 
				ORDER BY b.branch_name";
		
		//$sql = "SELECT DISTINCT(b.branch_id),b.branch_name,b.Related_to_sfhq from m_unit_distribution_chart as u
		//		INNER JOIN m_branches as b on b.branch_id = u.branch_id
		//		where u.Sfhq_Id = $sfhq_id and b.Related_to_sfhq = 1 ORDER BY b.branch_name ASC";
		
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	
	// Get bank names
	public static function get_all_BankDetails()
	{
		$db1 = new db_con();
		$sql = "select * from m_bank order by Bnk_Code ASC ";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
    
    public static function get_VehRunPlace($Sfhq_Id)
	{
		$db1 = new db_con();
		$sql = "select * from m_veh_run_place where Rel_RAO_Id=$Sfhq_Id";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	//
	
	// Get bank location details
	public static function get_all_Banklocation()
	{
		$db1 = new db_con();
		$sql = "select * from tbllocation order by location ASC ";
		
		$data = $db1->GetAll($sql);
		//echo $sql ;
		return $data;
	}
	//
	
	public static function get_all_Sfhq()
	{
		$db1 = new db_con();
		$sql = "select * from m_sfhq ORDER BY  ID";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	public static function get_all_Unit_related_Sfhq($sfhq_id)
	{
		$db1 = new db_con();
		$sql = "select * from m_unit_distribution_chart WHERE Sfhq_Id = $sfhq_id";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	public static function get_all_branches_without_alloption()
	{
		$db1 = new db_con();
		$sql = "select * from m_branches 
				where branch_id != '6'
				ORDER BY  branch_name";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	public static function get_all_OpsController()
	{
		$db1 = new db_con();
		$sql = "select DISTINCT(p.Branch_ID),b.branch_name from pso_view_chart as p
INNER JOIN m_branches as b on b.branch_id=p.Branch_ID and b.Related_to_sfhq=1 ORDER BY b.branch_name";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	

	
	public static function GetBillAmountandVotes($id){
		$db1 = new db_con();
		$sqlselect = "SELECT Bill_No,Vote_ID, Amount FROM vote_bill_amount WHERE Bill_No = $id";
		
	///	echo $sqlselect;
		$data = $db1->GetAll($sqlselect);		
		return $data;
	}
	
	
	public static function GetBillDataToBigUser($id,$user_type)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT  d.Bill_Id
		,d.Bill_No
		,d.Bill_Name		
		,d.Recieved_Date 
		,d.Invoice_date		
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,d.Bill_Settled_Date	
		,d.Bill_ref_no
		,s.Sup_Name
		,d.details
		,(SELECT rtn_reason FROM return_details WHERE Bill_Id = $id AND Auto_id = (SELECT MAX(Auto_id) FROM return_details WHERE Bill_Id = $id GROUP BY Bill_Id))
		,(SELECT Auto_id FROM return_details WHERE Bill_Id = $id AND Auto_id = (SELECT MAX(Auto_id) FROM return_details WHERE Bill_Id = $id GROUP BY Bill_Id))
		,d.Invoice_No
		,d.G35_No
		,d.G35_Date
		,CONCAT(s.address_line1,' ',s.address_line2,' ',s.address_line3,' ',s.address_line4) as sddr
		,s.Vat_No
		,d.Cheque_No
		,d.Cheque_Date
		,s.address_line2
		,s.address_line3
		,s.address_line4
		,d.file_ref
		,d.bill_period_from
		,d.bill_period_to
		,s.Act_No,k.Bnk_Code,s.bnk_loc_id
		,s.nic,s.mobile
		,d.ledger_date
		
		FROM txt_bill_details as d
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Bill_Name
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 	
		LEFT JOIN m_bank as k on k.bnk_Auto_id=s.Bank_id		
		
		where d.Bill_Id = $id ";
		//and d.UserTypeId =$user_type 
		//echo $sqlselect;
	//die();
		
		$data = $db1->GetAll($sqlselect);			
		return $data;
	}
	
	
	public static function GetBillDataToSFHQ($sfhq_id,$id,$user_type)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT  
		d.Bill_Id   
		,d.Bill_No
		,d.Sup_Code		
		,d.Recieved_Date 
		,d.Invoice_date		
		,d.Bill_Status
		,d.remarks
		,b.branch_name
		,d.Bill_Settled_Date	
		,d.Bill_ref_no
		,s.Sup_Name		
		,u.Unit
		,(SELECT rtn_reason FROM sfhq_return_details WHERE Bill_Id = $id AND Auto_id = (SELECT MAX(Auto_id) FROM sfhq_return_details WHERE Bill_Id = $id GROUP BY Bill_Id)) as rtn_reason
		,(SELECT Auto_id FROM sfhq_return_details WHERE Bill_Id = $id AND Auto_id = (SELECT MAX(Auto_id) FROM sfhq_return_details WHERE Bill_Id = $id GROUP BY Bill_Id)) as Auto_no
		,b.branch_id
		,d.Unit_Id
		,d.details
		,d.Invoice_No 
		,d.G35_No
		,d.G35_Date
		,CONCAT(s.address_line1,' ',s.address_line2,' ',s.address_line3,' ',s.address_line4) as sddr
		,s.address_line2
		,s.address_line3
		,s.address_line4
		,s.Vat_No
		,d.Cheque_Date
		,d.Cheque_No
		,d.bill_period_from
		,d.bill_period_to
		,d.file_ref
		,s.Act_No
		,k.Bnk_Code
		,s.bnk_loc_id
		,s.nic
		,s.mobile
		,d.ledger_date
		
		FROM sfhq_bill_details as d		
		
		INNER JOIN m_supplier_list as s on s.Sup_id =d.Sup_Code
		INNER JOIN m_unit_distribution_chart as u on u.Distribution_Id = d.Unit_Id 
		INNER JOIN  m_branches as b on d.branch_id=b.branch_id 	
		LEFT JOIN m_bank as k on k.bnk_Auto_id=s.Bank_id		
		
		where d.Bill_Id = $id and d.Sfhq_Id = $sfhq_id   ";
	//	echo $sqlselect; die();
		
		$data = $db1->GetAll($sqlselect);		
		return $data;
	}
	
		public static function GetBillDataToEdit($id)
	{
		$db1 = new db_con();
		$sqlselect = "SELECT 	d.Bill_Id,
								b.branch_name,
								d.Bill_No,
								d.Bill_Name,
								d.Amount,
								c.Unit,
								d.Recieved_Date,
								d.remarks,
								d.Unit_Id,
								d.branch_id, 
								d.Picture
							  FROM txt_bill_details as d
							  INNER JOIN m_unit_distribution_chart as c on d.Unit_Id=c.Distribution_Id 
							  INNER JOIN m_branches as b on d.branch_id=b.branch_id
							  WHERE d.Bill_Id =$id";
	//	echo $sqlselect;
		$data = $db1->GetAll($sqlselect);		
		return $data;
	}
	
	
	
	//////////////############################################################################## DGFM

	
	public static function DeleteProject($id,$bill_no)
	{
		$user_id=$_SESSION['userID'];
		$today=date('Y-m-d');
		
		$db1 = new db_con();
		
		$ins = "INSERT INTO del_dfin_bill_details ( Bill_No,Bill_ref_no,Sup_Code,Recieved_Date,	Invoice_No,
		G35_No,G35_Date,Invoice_date,Vote_ID,Amount,Cheque_No,Returned_Date,Create_Date,Create_User_ID,
		Deleted_Date,Deleted_User_ID)
		SELECT s.Bill_No,s.Bill_ref_no,s.Bill_Name,s.Recieved_Date,s.Invoice_No,s.Invoice_date,s.G35_No,
		s.G35_Date,v.Vote_ID,v.Amount,s.Cheque_No,r.rtn_date,s.Create_Date,s.Create_User_ID,'$today',
		$user_id
		FROM txt_bill_details AS s
		INNER JOIN vote_bill_amount AS v ON v.Bill_Id = s.Bill_Id AND v.Bill_No = s.Bill_No
		LEFT JOIN ( SELECT * FROM return_details WHERE Bill_Id = $id ORDER BY Auto_id DESC LIMIT 1 ) AS r 
		ON r.Bill_Id = v.Bill_Id WHERE v.Bill_Id = $id AND v.Bill_No = '$bill_no'";
		
		$sqldelete3  = "DELETE FROM return_details WHERE Bill_Id = $id";	
		$sqldelete2  = "DELETE FROM txt_bill_details WHERE Bill_Id = $id and Bill_No = $bill_no ";	
		$sqldelete1  = "DELETE FROM vote_bill_amount WHERE Bill_Id = $id  and Bill_No = $bill_no";	
		
		$insdata = $db1->Execute($ins);	
		
		if($insdata==1){
			
		$data3 = $db1->Execute($sqldelete3);
		$data1 = $db1->Execute($sqldelete1);
		$data2 = $db1->Execute($sqldelete2);
			
		}
		
		return $insdata;

	}
	
	public static function DeleteBillDetailsSfhq($id,$bill_no,$sfhqid)
	{
		$user_id=$_SESSION['userID'];
		$today=date('Y-m-d');
		
		$db1 = new db_con();
		
		$ins = "INSERT INTO del_sfhq_bill_details ( Bill_No,Bill_ref_no,Sup_Code,Recieved_Date,	Invoice_No,
		G35_No,G35_Date,Invoice_date,Sfhq_Id,Vote_ID,Amount,Cheque_No,Returned_Date,Create_Date,Create_User_ID,
		Deleted_Date,Deleted_User_ID)
		SELECT s.Bill_No,s.Bill_ref_no,s.Sup_Code,s.Recieved_Date,s.Invoice_No,s.G35_No,s.G35_Date,s.Invoice_date,
		s.Sfhq_Id,v.Vote_ID,v.Amount,s.Cheque_No,r.rtn_date,s.Create_Date,s.Create_User_ID,'$today',$user_id
		FROM sfhq_bill_details AS s
		INNER JOIN sfhq_vote_bill_amount AS v ON v.Bill_Id = s.Bill_Id AND v.Bill_No = s.Bill_No
		LEFT JOIN (select * from sfhq_return_details where Bill_Id=$id ORDER BY Auto_id DESC limit 1) AS r 
		ON r.Bill_Id = v.Bill_Id
		WHERE v.Bill_Id = $id and v.Bill_No='$bill_no' and s.Sfhq_Id=$sfhqid";
		
		
		
$sqldelete1  = "DELETE FROM sfhq_vote_bill_amount WHERE Bill_No = $bill_no and Bill_Id = $id and Sfhq_Id =$sfhqid ";
$sqldelete2  = "DELETE FROM sfhq_bill_details WHERE Bill_Id = $id and Bill_No = $bill_no and Sfhq_Id =$sfhqid ";	
$sqldelete3  = "DELETE FROM sfhq_return_details WHERE Bill_Id = $id ";	
		
		//echo $ins; die();
		
		$insdata = $db1->Execute($ins);	
		
		if($insdata==1){
			
		$data3 = $db1->Execute($sqldelete3);		
		$data1 = $db1->Execute($sqldelete2);
		$data2 = $db1->Execute($sqldelete1);
			
		}
		return $insdata;
	
		
		//echo $sqldelete3;
		//echo $sqldelete2;
		//echo $sqldelete1;
		
		//die ();
	}
	
	public static function CancelProject($id,$status,$com_status)
	{
		$db1 = new db_con();
		$sqlcancel = "UPDATE  txt_bill_details T  
					INNER JOIN vote_bill_amount V ON V.Bill_Id =T.Bill_Id
					SET T.Bill_Status = $com_status ,T.Modified_Date = ".date('y-m-d')." 
					,V.Bill_Staus= $com_status
					WHERE T.Bill_Id =  $id";
		//echo $sqlcancel;
		$data = $db1->Execute($sqlcancel);
		return $data;

	}
	
		public static function CancelSfhqBills($id,$status,$com_status)
	{
		$db1 = new db_con();
		$sqlcancel = "UPDATE  sfhq_bill_details T
		INNER JOIN sfhq_vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		SET T.Bill_Status = $com_status 
		,V.Bill_Staus= $com_status,
		T.Modified_Date = ".date('y-m-d')." WHERE T.Bill_Id = $id";
		//echo $sqlcancel;
		$data = $db1->Execute($sqlcancel);
		return $data;

	}
	
	public static function SettleThisbill($id,$com_status,$vote_id,$today)
	{
		$db1 = new db_con();
		$sqlsettle = "UPDATE txt_bill_details T
		
		INNER JOIN vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		SET T.Bill_Status = $com_status 
		,V.Bill_Staus= $com_status
		T.Modified_Date = ".$today.", T.Bill_Settled_Date = ".$today." 
		, T.Settled_Vote_ID='$vote_id' 
		WHERE T.Bill_Id = $id";
		//echo $sqlsettle;
		
			
		
		$data = $db1->Execute($sqlsettle);
		return $data;

	}
	
	
	public static function SettleThisbillBigUser($id,$com_status,$today)
	{
		$db1 = new db_con();
		$sqlsettle = "UPDATE txt_bill_details T
		INNER JOIN vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		
		SET T.Bill_Status = $com_status , 
		T.Modified_Date = '".$today."'
		,V.Bill_Staus= $com_status,
		T.Bill_Settled_Date = '".$today."' 
		
				 
		WHERE T.Bill_Id = $id";
		
		//,T.Cheque_No = '$cheque_no' 
		//,T.Cheque_Date = '".$chequeDate."' 
		
		//echo $sqlsettle;
		//die();
		//$sqlsettle1 = "UPDATE vote_bill_amount SET Bill_Staus = $com_status WHERE Bill_Id = $id";
		//$data1 = $db1->Execute($sqlsettle1);
		//echo $sqlsettle1;
		$data = $db1->Execute($sqlsettle);
		return $data;

	}
	
	public static function setcheckdetails($id,$today,$cheque_no,$chequeDate,$file_ref)
	{
		$db1 = new db_con();
		$sqlsettle = "UPDATE txt_bill_details SET 
		Modified_Date = '$today',Cheque_No = '$cheque_no' ,Cheque_Date = '$chequeDate',file_ref='$file_ref' 				 
		WHERE Bill_Id = $id";
		//echo $sqlsettle;
		//die();
		//$sqlsettle1 = "UPDATE vote_bill_amount SET Bill_Staus = $com_status WHERE Bill_Id = $id";
		//$data1 = $db1->Execute($sqlsettle1);
		//echo $sqlsettle1;
		$data = $db1->Execute($sqlsettle);
		return $data;

	}
	
	// UnSettle DF Bills
	
	public static function UnSettleThisbillBigUser($id,$com_status,$today)
	{
		$db1 = new db_con();
		$sqlsettle = "UPDATE txt_bill_details T
		INNER JOIN vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		
		SET T.Bill_Status = 0 , 
		T.Modified_Date = '".$today."'
		,V.Bill_Staus= 0,
		T.Bill_Settled_Date = '1000-01-01'  
		WHERE T.Bill_Id = $id";
		//echo $sqlsettle;
		
		//$sqlsettle1 = "UPDATE vote_bill_amount SET Bill_Staus = $com_status WHERE Bill_Id = $id";
		//$data1 = $db1->Execute($sqlsettle1);
		//echo $sqlsettle1;
		$data = $db1->Execute($sqlsettle);
		return $data;

	}
	
	//
	
	public static function SettleThisbillSfhq($id,$com_status,$today,$cheque_no,$chequeDate)
	{
		$db1 = new db_con();
		$sqlsettle = "UPDATE sfhq_bill_details SET Bill_Status = $com_status , 
		Modified_Date = '".$today."', Bill_Settled_Date = '".$today."' 
		,Cheque_No = '$cheque_no' , Cheque_Date = '$chequeDate' ,Cheque_Ent_Date = '".$today."'
			
		  WHERE Bill_Id = $id";
		
		//echo $sqlsettle;		
		//die();
		
		$sqlsettle1 = "UPDATE sfhq_vote_bill_amount SET Bill_Staus = $com_status WHERE Bill_Id = $id";
		$data1 = $db1->Execute($sqlsettle1);
		$data  = $db1->Execute($sqlsettle);
		return $data;

	}
	
	
	////Un Settle
	public static function UnSettleThisbillSfhq($id,$today,$sfhq_id)
	{
		$db1 = new db_con();
		
		$sqlsettle ="UPDATE sfhq_bill_details T
		INNER JOIN sfhq_vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		
		SET T.Bill_Status = 0 , 
		T.Modified_Date = '".$today."'
		,V.Bill_Staus= 0,
		T.Bill_Settled_Date = '1000-01-01'  
		
		WHERE T.Bill_Id = $id and T.Sfhq_Id = $sfhq_id ";
		
		$data  = $db1->Execute($sqlsettle);
		//return $sqlsettle;
		return $data;
		
		
		
		//$sqlsettle = "update sfhq_bill_details set Bill_Status = 0, Bill_Settled_Date='1000-01-01' 
		//where sfhq_id = $sfhq_id and Bill_Id = $id";
		//echo $sqlsettle;
		
		//$sqlsettle1 = "update sfhq_vote_bill_amount set Bill_Staus = 0 
		//where sfhq_id= $sfhq_id and Bill_Id = $id";
		//$data1 = $db1->Execute($sqlsettle1);
		//$data  = $db1->Execute($sqlsettle);
		//return $data;







	}
	///
	
	
	
	public static function ReturnThisbillBigUser($id,$com_status,$today,$rtnreason,$user_id,$auto_id)
	{
		$db1 = new db_con();		
		
		
		if($com_status ==3){         // this is for return bill 
		$sqlrtn2 = "INSERT INTO return_details (Bill_Id,rtn_reason,rtn_date,rtn_user_id)	VALUES
		($id,'$rtnreason','".$today."',$user_id)";		
		
		$sqlrtn1 = "UPDATE txt_bill_details T
		INNER JOIN vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		SET T.Bill_Status = $com_status 
		,V.Bill_Staus= $com_status,
		T.Modified_Date = '".$today."' WHERE T.Bill_Id = $id";
		
		//	echo $sqlrtn1;
	//	echo $sqlrtn2;
		
		
		$data2 = $db1->Execute($sqlrtn2);
		$data1 = $db1->Execute($sqlrtn1);
		
		return $data2;
			
		}		
		else 		
		{
		$sqlrtn3 = "UPDATE txt_bill_details T
		INNER JOIN vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		SET T.Bill_Status = $com_status
		,V.Bill_Staus= $com_status,
		T.Modified_Date = '".$today."' WHERE T.Bill_Id = $id";
		
		
		$sqlrtn4 = "UPDATE return_details SET act_date = '".$today."' , 
		act_user_id = $user_id  WHERE Auto_id = $auto_id";
		
		//	echo $sqlrtn3;
		//echo $sqlrtn4;
		
		$data3 = $db1->Execute($sqlrtn3);
		$data4 = $db1->Execute($sqlrtn4);
		
		return $data4;
			
		}
		
	//	echo $sqlrtn1;
	//	echo $sqlrtn2;

	}
	
	
	public static function ReturnThisbillSfhq($id,$com_status,$today,$rtnreason,$user_id,$auto_id)
	{
		$db1 = new db_con();		
		
		
		if($com_status ==3){         // this is for return bill 
		$sqlrtn2 = "INSERT INTO sfhq_return_details (Bill_Id,rtn_reason,rtn_date,rtn_user_id)	VALUES
		($id,'$rtnreason','".$today."',$user_id)";		
		
		$sqlrtn1 = "UPDATE sfhq_bill_details T
		INNER JOIN sfhq_vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		SET T.Bill_Status = $com_status  
		,V.Bill_Staus= $com_status,
		T.Modified_Date = '".$today."' WHERE T.Bill_Id = $id";
		
		//	echo $sqlrtn1;
	//	echo $sqlrtn2;
		
		
		$data2 = $db1->Execute($sqlrtn2);
		$data1 = $db1->Execute($sqlrtn1);
		
		return $data2;
			
		}		
		else 		
		{
		$sqlrtn3 = "UPDATE sfhq_bill_details T
		INNER JOIN sfhq_vote_bill_amount V ON V.Bill_Id =T.Bill_Id
		SET T.Bill_Status = $com_status 
		,V.Bill_Staus= $com_status,
		T.Modified_Date = '".$today."' WHERE T.Bill_Id = $id";
		
		
		$sqlrtn4 = "UPDATE sfhq_return_details SET act_date = '".$today."' , 
		act_user_id = $user_id  WHERE Auto_id = $auto_id";
		
		//	echo $sqlrtn3;
		//echo $sqlrtn4;
		
		$data3 = $db1->Execute($sqlrtn3);
		$data4 = $db1->Execute($sqlrtn4);
		
		return $data4;
			
		}
		
	//	echo $sqlrtn1;
	//	echo $sqlrtn2;

	}
	
	
	public static function EnterChequeDetail($Bill_id,$cheque_no,$chequeDate,$today,$user_id,$file_ref)
	{
		$db1 = new db_con();	
		
		$sqlrtn2 = "UPDATE sfhq_bill_details set Cheque_No = '$cheque_no', 
		Cheque_Date = '$chequeDate' , 
		file_ref='$file_ref',
		Cheque_Ent_Date = '".$today."'  
		WHERE Bill_Id = $Bill_id ";		
		
		
		$data2 = $db1->Execute($sqlrtn2);
		
		return $data2;
	}
	
	
	
	
	public static function get_all_regiment_names()
	{
		$db1 = new db_con();
		$sql = "select * from all_army_regiments";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
		
	public static function get_all_Suplier($sfhq_id)
	{
		$db1 = new db_con();
	//	$sql = "select * from m_supplier_list WHERE Related_sfhq_id=$sfhq_id ORDER BY Sup_Name ASC";
		$sql = "select * from m_supplier_list ORDER BY Sup_Name ASC";
		//echo $sql ;
	//die();
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	
	
	
			
	public static function get_all_rtnreason()
	{
		$db1 = new db_con();
		$sql = "select * from m_return ORDER BY rtn_reason_detail ASC";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	
	

	public static function get_all_vote_names()
	{
		$db1 = new db_con();
		$sql = "select * from votes";
		//echo $sql ;
		$data = $db1->GetAll($sql);
		
		return $data;
	}
	public static function get_ess_name($unit__id)
	{
		//$unit_id = $_SESSION['unitID'];
		$db2 = new db_con();
		 $sql = "select * from ge where Esr_unit_id = '$unit__id'";
		$data = $db2->GetAll($sql);
		return $data;
	}
	
	
	
}

?>