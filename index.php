<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');


     $val1=$_POST['street'];
    //$val1=str_replace('%','+',$val1);
   $val2=$_POST['city'];
  // $val2=str_replace('%','+',$val2);

   $val3=$_POST['state'];
   ///$val3=str_replace('%','+',$val3);

$file= "http://www.zillow.com/webservice/GetDeepSearchResults.htm?zws-id=X1-ZWz1dy6r8yd3ij_3fm17&address=".$val1."&citystatezip=".$val2."%2C+".$val3."&rentzestimate=true";

//$file=urlencode($file);
//$fileContents= file_get_contents($file);
//$fileContents = str_replace(array("\n", "\r", "\t"), '', $fileContents);
//$fileContents = trim(str_replace('"', "'", $fileContents));
$xml = simplexml_load_file($file);
date_default_timezone_set('America/Los_Angeles');

$output="{\"result\":{";
//echo $output;
if($xml->message[0]->code[0]=="0")
    {
    $val=$xml->response[0]->results[0]->result[0];
  $v1=$val->address[0];
        $img =" ";
        $img1=" ";
    $r40=" ";
    if((double)$val->zestimate[0]->valueChange>0){
        $r40="+";
    $img="http://cs-server.usc.edu:45678/hw/hw6/up_g.gif";}
    else  if((double)$val->zestimate[0]->valueChange<0){
        $r40="-";
        $img="http://cs-server.usc.edu:45678/hw/hw6/down_r.gif";}
    
    if((double)$val->rentzestimate[0]->valueChange>0){
    $img1="http://cs-server.usc.edu:45678/hw/hw6/up_g.gif";}
    else 
    if((double)$val->rentzestimate[0]->valueChange<0){
        $img1="http://cs-server.usc.edu:45678/hw/hw6/down_r.gif";}
     if(!isset($val->links->homedetails))
         {$output.="\"homedetails\":";
          $output.="\"N/A\",";
           $r1="N/A";
                   $results1=array("homedetails" => "N/A");
;
         }
        else
        {
           $output.="\"homedetails\":";
          $output.="\"".str_replace('/','\/',$val->links->homedetails)."\",";
        $results1=array("homedetails" => strval($val->links->homedetails));
            $r1=strval($val->links->homedetails);

        }
       // echo $output;
        if(!isset($val->address->street))
         {$output.="\"street\":";
          $output.="\"N/A\",";
            $results2=array("street" => "N/A");
          $r2="N/A";
         }
        else
        {
           $output.="\"street\":";
          $output.="\"".$val->address->street."\",";
                 $results2=array("street" => strval($val->address->street));
            $r2=$val->address->street;
        }
        //echo $output;
          $results=array_merge($results1,$results2);
         if(!isset($val->address->city))
         {$output.="\"city\":";
          $output.="\"N/A\",";
            $results2=array("city" => "N/A");
          $r3="N/A";
         }
        else
        {
           $output.="\"city\":";
          $output.="\"".$val->address->city."\",";   
                $results2=array("city" => strval($val->address->city));
               $r3=$val->address->city;
        }//echo $output;
         $results=array_merge($results,$results2);
      //echo $results;
           if(!isset($val->address->state))
         {$output.="\"state\":";
          $output.="\"N/A\",";
           $r4="N/A";
         }
        else
        {
           $output.="\"state\":";
          $output.="\"".$val->address->state."\",";
             $r4=$val->address->state;
        }//echo $output;
         if(!isset($val->address->zipcode))
         {$output.="\"zipcode\":";
          $output.="\"N/A\",";
            $r5="N/A";
         }
        else
        {
           $output.="\"zipcode\":";
          $output.="\"".$val->address->zipcode."\","; 
             $r5=$val->address->zipcode;
        }//echo $output;
           if(!isset($val->address->latitude))
         {$output.="\"latitude\":";
          $output.="\"N/A\",";
            $r6="N/A";
         }
        else
        {
           $output.="\"latitude\":";
          $output.="\"".$val->address->latitude."\","; 
             $r6=$val->address->latitude;
        }//echo $output;
           if(!isset($val->address->longitude))
         {$output.="\"longitude\":";
          $output.="\"N/A\",";
          $r7="N/A";
         }
        else
        {
           $output.="\"logitude\":";
          $output.="\"".$val->address->longitude."\","; 
              $r7=$val->address->longitude;
        }//echo $output;
           if(!isset($val->useCode))
         {$output.="\"useCode\":";
          $output.="\"N/A\",";
           $r8="N/A";
         }
        else
        {
           $output.="\"useCode\":";
          $output.="\"".$val->useCode."\",";
             $r8=$val->useCode;
        }//echo $output;
           if(!isset($val->lastSoldPrice))
         {$output.="\"lastSoldPrice\":";
          $output.="\"N/A\",";
           $r9="N/A";
         }
        else
        {
           $output.="\"lastSoldPrice\":";
          $output.="\"".number_format((double)$val->lastSoldPrice,2)."\","; 
              $r9=number_format((double)$val->lastSoldPrice,2);
        }//echo $output;
          if(!isset($val->yearBuilt))
         {$output.="\"yearBuilt\":";
          $output.="\"N/A\",";
             $r10="N/A";
         }
        else
        {
           $output.="\"yearBuilt\":";
          $output.="\"".$val->yearBuilt."\",";   
            $r10=$val->yearBuilt;
        }//echo $output;
     if(!isset($val->lastSoldDate))
         {$output.="\"lastSoldDate\":";
          $output.="\"N/A\",";
          $r11="N/A";
         }
    
        else
        {
           $output.="\"lastSoldDate\":";
          $output.="\"".date("d-M-Y",strtotime($val->lastSoldDate))."\",";
             $r11=date("d-M-Y",strtotime($val->lastSoldDate));
        }//echo $output;
        if(!isset($val->lotSizeSqFt))
         {$output.="\"lotSizeSqFt\":";
          $output.="\"N/A\",";
           $r12="N/A";
         }
        else
        {
           $output.="\"lotSizeSqFt\":";
          $output.="\"".number_format((double)$val->lotSizeSqFt,2)."\",";  
              $r12=number_format((double)$val->lotSizeSqFt,2);
        }//echo $output;
         if(!isset($val->zestimate->{'last-updated'}))
         {$output.="\"estimateLastUpdate\":";
          $output.="\"N/A\",";
          $r13="N/A";
         }
        else
        {
           $output.="\"estimateLastUpdate\":";
          $output.="\"".date("d-M-Y",strtotime($val->zestimate[0]->{'last-updated'}))."\","; 
              $r13=date("d-M-Y",strtotime($val->zestimate[0]->{'last-updated'}));
        }//echo $output;
         if(!isset($val->zestimate->amount))
         {$output.="\"estimateAmount\":";
          $output.="\"N/A\",";
           $r14="N/A";
         }
        else
        {
           $output.="\"estimateAmount\":";
          $output.="\"".number_format((double)$val->zestimate[0]->amount,2)."\",";    
             $r14=number_format((double)$val->zestimate[0]->amount,2);
        }//echo $output;
        if(!isset($val->finishedSqFt))
         {$output.="\"finishedSqFt\":";
          $output.="\"N/A\",";
          $r15="N/A";
         }
        else
        {
           $output.="\"finishedSqFt\":";
          $output.="\"".number_format((double)$val->finishedSqFt,2)."\","; 
             $r15=number_format((double)$val->finishedSqFt,2);
        }//echo $output;
         if(!isset($val->zestimate->valueChange))
         {$output.="\"estimateValueChange\":";          $output.="\"N/A\",";
         $r16="N/A";}
        else
        {
           $output.="\"estimateValueChange\":";
          $r16=number_format((double)abs($val->zestimate->valueChange),2); $output.="\"".number_format((double)abs($val->zestimate->valueChange),2)."\",";           
        }//echo $output;
    
         $r17=$img;
        $r18=$img1;
         $output.="\"imgn\":\"".str_replace('/','\/',$img)."\",";
          $output.="\"imgp\":\"".str_replace('/','\/',$img1)."\",";
        if(!isset($val->bathrooms))
         {$output.="\"bathrooms\":";
          $output.="\"N/A\",";
          $r19="N/A";
         }
        else
        {
           $output.="\"bathrooms\":";
          $output.="\"".$val->bathrooms."\","; 
            $r19=$val->bathrooms;
        }//echo $output;
        if(!isset($val->zestimate->valuationRange->low))
        {$output.="\"estimateValuationRangeLow\":";
          $output.="\"N/A\",";
         $r20="N/A";
        }
        
    else 
    {
         $output.="\"estimateValuationRangeLow\":";
          $output.="\"".number_format((double)$val->zestimate->valuationRange->low,2)."\","; 
        $r20=number_format((double)$val->zestimate->valuationRange->low,2);
    }//echo $output;
  if(!isset($val->zestimate->valuationRange->high))
        {$output.="\"estimateValuationRangeHigh\":";
          $output.="\"N/A\",";
         $r21="N/A";
        }
        
    else 
    {
         $output.="\"estimateValuationRangeHigh\":";
          $output.="\"".number_format((double)$val->zestimate->valuationRange->high,2)."\","; 
            $r21=number_format((double)$val->zestimate->valuationRange->high,2);
    }//echo $output;
         if(!isset($val->bedrooms))
         {$output.="\"bedrooms\":";
          $output.="\"N/A\",";
           $r22="N/A";}
        else
        {
           $output.="\"bedrooms\":";
          $output.="\"".$val->bedrooms."\","; 
            $r22=$val->bedrooms;
        }
         if(!isset($val->rentzestimate->{'last-updated'}))
         {$output.="\"restimateLastUpdate\":";
          $output.="\"N/A\",";
          $r23="N/A";
         }
        else
        {
           $output.="\"restimateLastUpdate\":";
          $output.="\"".date("d-M-Y",strtotime($val->rentzestimate[0]->{'last-updated'}))."\",";
            $r23=date("d-M-Y",strtotime($val->rentzestimate[0]->{'last-updated'}));
        }
     if(!isset($val->taxAssessmentYear))
         {$output.="\"taxAssessmentYear\":";
          $output.="\"N/A\",";
          $r24="N/A";
         }
        else
        {
           $output.="\"taxAssessmentYear\":";
          $output.="\"".$val->taxAssessmentYear."\",";   
              $r24=$val->taxAssessmentYear;
        }
  if(!isset($val->rentzestimate->valueChange))
         {$output.="\"restimateValueChange\":";
          $output.="\"N/A\",";
           $r25="N/A";
         }
        else
        {
           $output.="\"restimateValueChange\":";
          $output.="\"".number_format((double)abs($val->rentzestimate->valueChange),2)."\",";  
                 $r25=number_format((double)abs($val->rentzestimate->valueChange),2);
        }
 if(!isset($val->taxAssessment))
         {$output.="\"taxAssessment\":";
          $output.="\"N/A\",";
          $r26="N/A";
         }
        else
        {
           $output.="\"taxAssessment\":";
          $output.="\"".number_format((double)$val->taxAssessment,2)."\","; 
            
              $r26=number_format((double)$val->taxAssessment,2);
        }
  if(!isset($val->zestimate->amount))
         {$output.="\"estimateAmount\":";
          $output.="\"N/A\",";
           $r27="N/A";
         }
        else
        {
           $output.="\"estimateAmount\":";
          $output.="\"".number_format((double)$val->zestimate[0]->amount,2)."\",";    
             $r27=number_format((double)$val->zestimate[0]->amount,2);
        }
    

 if(!isset($val->rentzestimate->valuationRange->low))
        {$output.="\"restimateValuationRangeLow\":";
          $output.="\"N/A\",";
          $r28="N/A";        
        }
        
    else 
    {
         $output.="\"restimateValuationRangeLow\":";
          $output.="\"".number_format((double)$val->rentzestimate->valuationRange->low,2)."\","; 
        
        $r28=number_format((double)$val->rentzestimate->valuationRange->low,2); 
    }
  if(!isset($val->rentzestimate->valuationRange->high))
        {$output.="\"restimateValuationRangeHigh\":";
          $output.="\"N/A\",";
          $r29="N/A"; 
        }
        
    else 
    {
         $output.="\"restimateValuationRangeHigh\":";
          $output.="\"".number_format((double)$val->rentzestimate->valuationRange->high,2)."\","; 
        $r29=number_format((double)$val->rentzestimate->valuationRange->high,2); 
    }

$output.="},\"chart\":{\"1year\"{\"url\":";
$f1 = 'http://www.zillow.com/app?chartDuration=1year&chartType=partner&height=300&page=webservice%2FGetChart&service=chart&showPercent=true&width=600&zpid='.$val->zpid;
//$file_h = @get_headers($f);
//if($file_h[0] == 'HTTP/1.1 404 Not Found') {
// $output.="\"".str_replace('/','\/',$f)."\"},";  
//}
//else {
//    $output.="\"N/A\"},";
//}
$output.="\"5years\"{\"url\":";
$f2 = 'http://www.zillow.com/app?chartDuration=5years&chartType=partner&height=300&page=webservice%2FGetChart&service=chart&showPercent=true&width=600&zpid='.$val->zpid;
//$file_h = @get_headers($f);
//if($file_h[0] == 'HTTP/1.1 404 Not Found') {
// $output.="\"".str_replace('/','\/',$f)."\"},";  
//}
//else {
 //   $output.="\"N/A\"},";
//}
$output.="\"10years\"{\"url\":";
$f3 = 'http://www.zillow.com/app?chartDuration=10years&chartType=partner&height=300&page=webservice%2FGetChart&service=chart&showPercent=true&width=600&zpid='.$val->zpid;
//$file_h = @get_headers($f);
//if($file_h[0] == 'HTTP/1.1 404 Not Found') 
    //{
//        $output.="\"".str_replace('/','\/',$f)."\"}}}";  
//}
//else {
  //  $output.="\"N/A\"},";
//}
    
    $result =array(
"valid"=>"1",        
"homedetails"=>strval($r1),
"street"=>strval($r2),
"city"=>strval($r3),
"state"=>strval($r4),
"zipcode"=>strval($r5),
"latitude"=>strval($r6),
"longitude"=>strval($r7),
"useCode"=>strval($r8),
"lastSoldPrice"=>strval($r9),
"yearBuilt"=>strval($r10),
"lastSoldDate"=>strval($r11),
"lotSizeSqFt"=>strval($r12),
"estimateLastUpdate"=>strval($r13),
"estimateAmount"=>strval($r14),
"finishedSqFt"=>strval($r15),
"estimateValueChange"=>strval($r16),
"imgn"=>strval($r17),
"imgp"=>strval($r18),
"bathrooms"=>strval($r19),
"estimateValuationRangeLow"=>strval($r20),
"estimateValuationRangeHigh"=>strval($r21),
"bedrooms"=>strval($r22),
"restimateLastUpdate"=>strval($r23),
"taxAssessmentYear"=>strval($r24),
"restimateValueChange"=>strval($r25),
"taxAssessment"=>strval($r26),
"restimateAmount"=>strval($r27),
"restimateValuationRangeLow"=>strval($r28),
"restimateValuationRangeHigh"=>strval($r29),
"year1"=>strval($f1),
"years5"=>strval($f2),
"years10"=>strval($f3),
"valuesign"=>strval($r40),

    );
echo json_encode($result);
}
 else if($xml->message[0]->code[0]=="508")
    {
     $result =array("valid"=>"0");
     echo json_encode($result);
 }
?>