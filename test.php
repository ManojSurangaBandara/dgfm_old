<?php



require_once('includes/config.php');
require_once('classes/db_con.php');
require_once('classes/common.class.php');
require_once('classes/projects.class.php');



    // define('DB_TYPE','mysql');
    // define('DB_HOST','localhost'); /*local developmet machine*/
    // define('DB_USER','root'); /*localhost credentials*/
    // define('DB_PWD','');
    // define('DB_DB',"2023.dgfm"); /*uncomment when putting to live server*/

    // require_once('./classes/db_con.php');

    function GetSupplierMobileNumbers(){
        $db1 = new db_con();

        $query = "SELECT sup.mobile
            FROM m_supplier_list as sup
            LEFT OUTER JOIN  m_sfhq as sfhq on sup.Related_sfhq_id = sfhq.ID
            LEFT OUTER JOIN  txt_bill_details as bill on bill.Bill_Name = sup.Sup_id
            WHERE sup.is_vehicle = 1 AND MONTH(bill.Recieved_Date) = 9";
        return $db1->GetAll($query);
    }

    $result = GetSupplierMobileNumbers();

    foreach($result as $row){
        echo $row[0];
        echo "<br/>";
    }
    
?>
