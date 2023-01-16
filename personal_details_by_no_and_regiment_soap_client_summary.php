<?php

/*

FUNCTION ARGUMENTS

ARGUMENT 1
OFFICER / OR SERVICE NO
EG :- O/68687

ARGUMENT 2	
REGIMENT NO GIVEN ACCORDING TO THE FOLLOWING LIST
SLAC	=	1
SLA		=	2
SLE		=	3
SLSC	=	4
SLLI	=	5
SLSR	=	6
GW		=	7
GR		=	8
VIR		=	9
MIR		=	10
CDO		=	11
SF		=	12
MIC		=	13
CES		=	14
SLASC	=	15
SLAMC	=	16
SLAOC	=	17
SLEME	=	18
SLCMP	=	19
SLAGSC	=	20
SLAWC	=	21
SLRC	=	22
SLPC	=	23
SLNG	=	24
ALL		=	ALL

*/


// Pull in the NuSOAP code
require_once('lib/nusoap.php');

//	READ VALUES SEND BY THE GET
$no = $_GET['no'];
$regiment = $_GET['regiment'];



// Create the client instance
//	$client = new soapclient('http://127.0.0.1/ARMY_CENTRAL_HR/services/personal_details_by_no_and_regiment_soap_server_summary.php');
$client = new soapclient('http://172.16.0.22/hr/services/personal_details_by_no_and_regiment_soap_server_summary.php');

// Call the SOAP method
$result = $client->call('get_officer_or_details_by_no_and_regiment',array(array('no' => $no),array('regiment' => $regiment)));
echo $result[0]['full_name'];
// Display the result
echo "<pre>";
print_r($result); 
echo "</pre>";
?>