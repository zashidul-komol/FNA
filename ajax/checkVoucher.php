<?php
    include('../config/dbinfo.inc.php'); // your db connection

    $voucher = $_GET['voucher'];

    $q = mysql_query("SELECT VOUCHERNO FROM fna_expanse WHERE VOUCHERNO='$voucher'");

    if(mysql_num_rows($q)>0){
        echo "exists";
    }else{
        echo "ok";
    }
    //echo $TOTQNTY;
/*
    $voucher           = $_REQUEST['vno'];
    $module_array      = array();
    $getModuleQuery = "
                        SELECT  
                                VOUCHERNO
                        FROM    
                                fna_expanse 
                        WHERE   VOUCHERNO = '".$voucher."'";

    $getModuleStatement             = mysql_query($getModuleQuery);
    while($getModuleStatementData   = mysql_fetch_array($getModuleStatement)) {
        $VOUCHERNO                  = $getModuleStatementData["VOUCHERNO"];
        $module_array[]             = array('optionValue'=>$VOUCHERNO,'optionDisplay'=>$VOUCHERNO);
    }
    echo json_encode($module_array);
    */
?>
