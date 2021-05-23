<?php
/*
Copyright (c) 2010 Silversyclops.net
Creater : John Joe
Email : johndeveloper2008@gmail.com
*/
App::uses('Helper', 'View');
class NumToWordHelper extends Helper{
	
	var $word;
	
function CalculateTenth($twoDigitData)
{
	$firstDigit = floor($twoDigitData/10);
	$secondDigit = $twoDigitData % 10;
	
	switch($firstDigit)
	{
		case 0:
		$firstString = "";
		break;
		
		case 1:
		switch($secondDigit)
		{
			case 0:
			return __("ten");
			break;
		
			case 1:
			return __("eleven");
			break;
		
			case 2:
			return __("twelve");
			break;
		
			case 3:
			return __("thirteen");
			break;
		
			case 4:
			return __("fourteen");
			break;
		
			case 5:
			return __("fiveteen");
			break;
		
			case 6:
			return __("sixteen");
			break;
		
			case 7:
			return  __("seventeen");
			break;
		
			case 8:
			return __("eighteen");
			break;
		
			case 9:
			return __("nineteen");
			break;
		
			default:
			return __("Error");
			
		}
		break;
		
		case 2:
		$firstString = __("twenty");
		break;
		
		case 3:
		$firstString = __("thirty");
		break;
		
		case 4:
		$firstString = __("forty");
		break;
		
		case 5:
		$firstString = __("fifty");
		break;
		
		case 6:
		$firstString = __("sixty");
		break;
		
		case 7:
		$firstString = __("seventy");
		break;
		
		case 8:
		$firstString = __("eighty");
		break;
		
		case 9:
		$firstString = __("ninety");
		break;
		
		default:
		return __("Error");
	}
	
	switch($secondDigit)
	{
		case 0:
		$secondString = "";
		break;
		
		case 1:
		$secondString = __("one");
		break;
		case 2:
		$secondString = __("two");
		break;
		
		case 3:
		$secondString = __("three");
		break;
		
		case 4:
		$secondString = __("four");
		break;
		
		case 5:
		$secondString = __("five");
		break;
		
		case 6:
		$secondString = __("six");
		break;
		
		case 7:
		$secondString = __("seven");
		break;
		
		case 8:
		$secondString = __("eight");
		break;
		
		case 9:
		$secondString = __("nine");
		break;
		
		default:
		return __("Error");
	}
	
	return $firstString." ".$secondString;	
	 
}

function CalculateLastSeven($num)
{
	$length = strlen($num);
	if($length > 5)
	{
		$tenth = substr($num,-2,2); 
		$hundred = substr($num,-3,1);
		
		if($hundred == 0)
			$hundredString = "";
		else
			$hundredString = __(" hundred ");
			
		$thousand = substr($num,-5,2);
		
		if($thousand == 0)
			$thousandString = "";
		else
			$thousandString = __(" thousand ");
		
		if($length == 6)
			$lakh = substr($num,-6,1);
		else
			$lakh = substr($num,-7,2);
			
		if($lakh == 0)
			$lakhString = "";
		else
			$lakhString = __(" lakh ");
		
		return $this->CalculateTenth($lakh).$lakhString.$this->CalculateTenth($thousand).$thousandString.$this->CalculateTenth($hundred).$hundredString.$this->CalculateTenth($tenth);
	}
	else if($length < 6 &&  $length > 3)
	{
		$tenth = substr($num,-2,2); 
		$hundred = substr($num,-3,1);
		
		if($hundred == 0)
			$hundredString = "";
		else
			$hundredString = __(" hundred ");
			
		$thousand = substr($num,-5,2);
		
		if($length == 4)
			$thousand = substr($num,-4,1);
		else
			$thousand = substr($num,-5,2);
		
		if($thousand == 0)
			$thousandString = "";
		else
			$thousandString = __(" thousand ");
		
		return $this->CalculateTenth($thousand).$thousandString.$this->CalculateTenth($hundred).$hundredString.$this->CalculateTenth($tenth);
	}
	else if($length < 4 &&  $length > 2)
	{
		$tenth = substr($num,-2,2); 
		$hundred = substr($num,-3,1);
		
		if($hundred == 0)
			$hundredString = "";
		else
			$hundredString = __(" hundred ");
		
		return $this->CalculateTenth($hundred).$hundredString.$this->CalculateTenth($tenth);
	}
	else if($length < 3)
	{
		return $this->CalculateTenth($num);
	}
	
	else
	{
		return __("morethan7");
	}
}

function Convert($string)
{
	$paise='';
	if(stristr($string,".") && substr(stristr($string,"."),1,2)!="00")
	{
		$beforedecimal=substr($string,0,strpos($string,"."));
		$aftedecimal=substr(stristr($string,"."),1,2);
		$decimalconverted = $this->CalculateLastSeven($aftedecimal);
		$paise=" & ".$decimalconverted." Paise";
	}
	elseif(stristr($string,".") && substr(stristr($string,"."),1,2)=="00")
	{
		$beforedecimal=substr($string,0,strpos($string,"."));
	   
	}
	else
	{
		$beforedecimal=substr($string,0);
	}
	$totalLength = strlen($beforedecimal);
	$startString = substr($beforedecimal,0,$totalLength % 7);
	$converted = $this->CalculateLastSeven($startString);
	$start = $totalLength % 7;
//	$i = 0;
	$croreString='';
	while($part = substr($beforedecimal,$start,7))
	{
		if($startString != 0)
			$croreString = " crore ";
		$converted.= $croreString.$this->CalculateLastSeven($part);
		$start += 7;
	}
	
	return ucwords($converted.__(" Rupees ").$paise);
}

function NumberToWord($string)
{
	return $this->Convert($string);
}
}
?>