<?php

namespace App\Models;

class SMSUtilities {
	private $connection;
	private $clientId;
	private $rawStringRecipients; //"08023241048,802425108,  , 019500763, 01-9500763,"
	private $formatedNumbers;
	private $totalZain;
	private $totalEtisalat;
	private $totalMTN;
	private $totalVisafone;
	private $totalStarcomms;
	private $totalMultilinks;
	private $totalUnknown;
	private $totalGLO;
	private $sortedNumbers;
	private $totalOtherNumber;
	private $tempArray;
	private $totalDuplicate;
	
	
	function __construct($rawStringRecipients, $connection, $clientId) {
		$this->setConnection ( $connection );
		$this->setRawStringRecipients ( $rawStringRecipients );
		$this->setClientId ( $clientId );
	
	}
	
	function splitRawStringedRecipients() {
		//explode the raw numbers
		$array = explode ( ",", $this->getRawStringRecipients () );
		$array2 = array ();
		foreach ( $array as $numbers ) {
			$numbers = trim ( $numbers );
			array_push ( $array2, $numbers );
		}
		$this->setTempArray ( $array2 );
	}
	
	function removeCDMAs()
	{
		$array = array();
		
		foreach($this->tempArray as $numbers)
		{
			if(substr($numbers,0,8)=='+2347025' ||
			   substr($numbers,0,8)=='+2347026' ||
			   substr($numbers,0,7)== '+234704' )
			   {
			   	array_push($array,$numbers);
			   }
			else if(substr($numbers,0,7)== '+234707' ||
			   
			   substr($numbers,0,7)== '+234702' ||
			   substr($numbers,0,7)== '+234709' ||
			   substr($numbers,0,7)== '+234819' ||
               substr($numbers,0,7)== '+234804')
			   {
			   	$this->setTotalUnknown(1);
			   }else{
			   	array_push($array,$numbers);
			   }
			
		}
		unset($this->tempArray);
		$this->tempArray = $array;
	}
	
	function removeDuplicateNumbers()
	{
		$count_before_unique = count($this->tempArray);
		$array = array_unique($this->tempArray);
		$count_after = count($array);
		unset($this->tempArray);
		$this->tempArray = $array;
		$count = $count_before_unique - $count_after;
		$this->setTotalDuplicate($count);
	}
	
	
	
	function ValidatePhoneNumber() 
	{
		$array = array ();
		//USA - '+1##########'
		$formats = array ('+234802','+234803','+234805','+234806','+234807','+234808','+234809','+2347025','+2347026','+234703','+234705','+234706','+234708','+234813','+234816','+234818','+234812','+234815','+234704',
		'+7','+20','+27','+30','+31','+32','+39','+40','+41','+43','+44','+45','+46','+47','+48','+51','+53','+55','+56','+57','+58','+60','+61','+62','+63','+64','+65','+66','+84','+90','+91','+92','+93','+94','+98','+212','+213','+216','+218','+220','+221','+222','+223','+224','+225','+226','+227','+228','+229','+230','+231','+232','+233','+234',
		'+235','+236','+237','+238','+240','+241','+242','+243','+244','+245','+248','+249','+250','+251','+253','+254','+255','+256','+257','+258','+260','+261','+262','+263','+264','+265','+266','+267','+268','+269','+297','+298','+299','+350','+351','+352','+353','+354','+355','+356','+357','+358','+359','+370','+371','+372','+373','+374','+375','+376','+377','+378','+380','+381','+382','+385','+386','+387','+389','+420','+421','+423','+501','+502','+503','+504','+505','+506','+507','+509','+590','+591','+592','+593','+594','+595','+596','+597','+598','+599','+673','+675','+676','+677','+678','+679','+682','+685','+852','+853','+855','+856','+880','+886','+960','+961','+962','+963','+964','+965','+966','+967','+968','+970','+971','+972','+973','+974','+975','+976','+977','+992','+993','+994','+995','+996','+998');
		//08024251048-- +2348024251048 - +
		foreach ( $this->tempArray as $numbers ) {
			$format = substr_replace ($numbers,"", -10,10 );
			$format1 = substr_replace ($numbers,"", -9,9 );
			$format2 = substr_replace ($numbers,"", -8,8 );
			$format3 = substr_replace ($numbers,"", -7,7 );
			//echo $format."<br>";
			if (in_array ( $format, $formats ) || in_array ( $format1, $formats ) || in_array ( $format2, $formats ) || in_array ( $format3, $formats )) {
				array_push ( $array, $numbers );
			} else {
				
				$this->setTotalUnknown ( 1 );
			}
		}
		unset($this->tempArray);
		$this->tempArray = $array;
	
	}
	/**
	 * @return the $connection
	 */
	public function getConnection() {
		return $this->connection;
	}
	
	/**
	 * @return the $clientId
	 */
	public function getClientId() {
		return $this->clientId;
	}
	
	/**
	 * @return the $rawStringRecipients
	 */
	public function getRawStringRecipients() {
		return $this->rawStringRecipients;
	}
	
	/**
	 * @return the $formatedNumbers
	 */
	public function getFormatedNumbers() {
		return $this->formatedNumbers;
	}
	
	/**
	 * @return the $totalZain
	 */
	public function getTotalZain() {
		return $this->totalZain;
	}
	
	/**
	 * @return the $totalEtisalat
	 */
	public function getTotalEtisalat() {
		return $this->totalEtisalat;
	}
	
	/**
	 * @return the $totalMTN
	 */
	public function getTotalMTN() {
		return $this->totalMTN;
	}
	
	/**
	 * @return the $totalVisafone
	 */
	public function getTotalVisafone() {
		return $this->totalVisafone;
	}
	
	/**
	 * @return the $totalStarcomms
	 */
	public function getTotalStarcomms() {
		return $this->totalStarcomms;
	}
	
	/**
	 * @return the $totalMultilinks
	 */
	public function getTotalMultilinks() {
		return $this->totalMultilinks;
	}
	
	/**
	 * @return the $totalUnknown
	 */
	public function getTotalUnknown() {
		return $this->totalUnknown;
	}
	
	/**
	 * @return the $totalGLO
	 */
	public function getTotalGLO() {
		return $this->totalGLO;
	}
	
	/**
	 * @return the $sortedNumbers
	 */
	public function getSortedNumbers() {
		return $this->sortedNumbers;
	}
	
	/**
	 * @return the $totalOtherNumber
	 */
	public function getTotalOtherNumber() {
		return $this->totalOtherNumber;
	}
	
	/**
	 * @param $connection the $connection to set
	 */
	public function setConnection($connection) {
		$this->connection = $connection;
	}
	
	/**
	 * @param $clientId the $clientId to set
	 */
	public function setClientId($clientId) {
		$this->clientId = $clientId;
	}
	
	/**
	 * @param $rawStringRecipients the $rawStringRecipients to set
	 */
	public function setRawStringRecipients($rawStringRecipients) {
		$this->rawStringRecipients = $rawStringRecipients;
	}
	
	/**
	 * @param $formatedNumbers the $formatedNumbers to set
	 */
	public function setFormatedNumbers($formatedNumbers) {
		$this->formatedNumbers = $formatedNumbers;
	}
	
	/**
	 * @param $totalZain the $totalZain to set
	 */
	public function setTotalZain($totalZain) {
		$this->totalZain = $totalZain;
	}
	
	/**
	 * @param $totalEtisalat the $totalEtisalat to set
	 */
	public function setTotalEtisalat($totalEtisalat) {
		$this->totalEtisalat = $totalEtisalat;
	}
	
	/**
	 * @param $totalMTN the $totalMTN to set
	 */
	public function setTotalMTN($totalMTN) {
		$this->totalMTN = $totalMTN;
	}
	
	/**
	 * @param $totalVisafone the $totalVisafone to set
	 */
	public function setTotalVisafone($totalVisafone) {
		$this->totalVisafone = $totalVisafone;
	}
	
	/**
	 * @param $totalStarcomms the $totalStarcomms to set
	 */
	public function setTotalStarcomms($totalStarcomms) {
		$this->totalStarcomms = $totalStarcomms;
	}
	
	/**
	 * @param $totalMultilinks the $totalMultilinks to set
	 */
	public function setTotalMultilinks($totalMultilinks) {
		$this->totalMultilinks = $totalMultilinks;
	}
	
	/**
	 * @param $totalUnknown the $totalUnknown to set
	 */
	public function setTotalUnknown($totalUnknown) {
		$this->totalUnknown = $this->totalUnknown + $totalUnknown;
	}
	
	/**
	 * @param $totalGLO the $totalGLO to set
	 */
	public function setTotalGLO($totalGLO) {
		$this->totalGLO = $totalGLO;
	}
	
	/**
	 * @param $sortedNumbers the $sortedNumbers to set
	 */
	public function setSortedNumbers($sortedNumbers) {
		$this->sortedNumbers = $sortedNumbers;
	}
	
	/**
	 * @param $totalOtherNumber the $totalOtherNumber to set
	 */
	public function setTotalOtherNumber($totalOtherNumber) {
		$this->totalOtherNumber = $totalOtherNumber;
	}
	/**
	 * @return the $tempArray
	 */
	public function getTempArray() {
		return $this->tempArray;
	}
	
	/**
	 * @param $tempArray the $tempArray to set
	 */
	public function setTempArray($tempArray) {
		$this->tempArray = $tempArray;
	}
	

	function formatInternationalNumbers() {
		$array = $this->getTempArray();
		$newArray = array();
		foreach ( $array as $number ) {
			$no = $this->changeToInternationalFormat($number);
			if($no !=0)
			{
				array_push($newArray,$no);
			}
			else{
				$this->setTotalUnknown(1);
			}
		
		}
		unset($this->tempArray);
		$this->tempArray = $newArray;
		//foreach()
	}
	
	function changeToInternationalFormat($numbers) {
		$number = str_replace(" ","",$numbers);
		if (substr ( $number, 0, 1 ) == "+") {
			return $number;
		}
		$test = substr ( $number, 0, 3 );
		
		switch ($test) {
			case "009" :
				$number = substr_replace ( $number, "+", 0, 3 );
				return $number;
				break;
			
			case "080" :
				$number = substr_replace ( $number, "+23480", 0, 3 );
				return $number;
				break;
			
			case "070" :
				$number = substr_replace ( $number, "+23470", 0, 3 );
				return $number;
				break;
			
			case "071" :
				$number = substr_replace ( $number, "+23471", 0, 3 );
				return $number;
				break;
			
			case "081" :
				$number = substr_replace ( $number, "+23481", 0, 3 );
				return $number;
				break;
			
			case "234" :
				$number = substr_replace ( $number, "+234", 0, 3 );
				return $number;
				break;
			
			case "708" :
				$number = substr_replace ( $number, "+234708", 0, 3 );
				return $number;
				break;
			
			case "709" :
				$number = substr_replace ( $number, "+234709", 0, 3 );
				return $number;
				break;
			
			case "802" :
				$number = substr_replace ( $number, "+234802", 0, 3 );
				return $number;
				break;
			
			case "803" :
				$number = substr_replace ( $number, "+234803", 0, 3 );
				return $number;
				break;
			
			case "804" :
				$number = substr_replace ( $number, "+234804", 0, 3 );
				return $number;
				break;
			
			case "805" :
				$number = substr_replace ( $number, "+234805", 0, 3 );
				return $number;
				break;
			
			case "806" :
				$number = substr_replace ( $number, "+234806", 0, 3 );
				return $number;
				break;
			
			case "807" :
				$number = substr_replace ( $number, "+234807", 0, 3 );
				return $number;
				break;
			
			case "808" :
				$number = substr_replace ( $number, "+234808", 0, 3 );
				return $number;
				break;
			
			case "809" :
				$number = substr_replace ( $number, "+234809", 0, 3 );
				return $number;
				break;
			
			case "813" :
				$number = substr_replace ( $number, "+234813", 0, 3 );
				return $number;
				break;
			
			case "818" :
				$number = substr_replace ( $number, "+234818", 0, 3 );
				return $number;
				break;
			
			case "816" :
				$number = substr_replace ( $number, "+234816", 0, 3 );
				return $number;
				break;
			
			case "702" :
				$number = substr_replace ( $number, "+234702", 0, 3 );
				return $number;
				break;
			
			case "703" :
				$number = substr_replace ( $number, "+234703", 0, 3 );
				return $number;
				break;
			
			case "704" :
				$number = substr_replace ( $number, "+234704", 0, 3 );
				return $number;
				break;
			
			case "705" :
				$number = substr_replace ( $number, "+234705", 0, 3 );
				return $number;
				break;
			
			case "706" :
				$number = substr_replace ( $number, "+234706", 0, 3 );
				return $number;
				break;
			
			case "707" :
				$number = substr_replace ( $number, "+234707", 0, 3 );
				
				return $number;
				break;
			default :
				return 0;
				break;
		
		}
	}
	/**
	 * @return the $totalDuplicate
	 */
	public function getTotalDuplicate() {
		return $this->totalDuplicate;
	}

	/**
	 * @param $totalDuplicate the $totalDuplicate to set
	 */
	public function setTotalDuplicate($totalDuplicate) {
		$this->totalDuplicate = $totalDuplicate;
	}


}

?>