<?php

// require_once('../../../private/initialize.php');
$link = mysqli_init();

$link->real_connect("45.56.114.19", "ross", "J&L[[tZr3JzC[c_4PK5u#G+%", "lsdi",NULL,NULL,MYSQLI_CLIENT_COMPRESS);

date_default_timezone_set("America/New_York");
ini_set("auto_detect_line_endings", true);
// mojo1
$times_sold = '0';
$currdate = date("Y-m-d H:i:s", time());
$client_name = 'KPN Network';
$vertical = 'Diabetic';
$fixed_string = "nm=013bdrq2urxga6";
$vendor_id = 'ShareCare';
$campaign_id = '4232821';
$error = '';
$leadID = '';

	$email = $_REQUEST['email'];
     if ($email == "") {
        $error .= "<h2>ERROR -- Email is required </h2><br>";
    }

    	$fname = $_REQUEST['fname'];
    if ($fname == "") {
    	$error .= "<h2>ERROR -- First Name is required </h2><br> ";
    	}

	$lname = $_REQUEST['lname'];
    if ($lname == "") {
        $error .= "<h2>ERROR -- Last Name is required </h2><br> ";
    }

  	$address = $_REQUEST['address'];
    if ($address == "") {
        $error .= "<h2>ERROR -- Address is required </h2><br> ";
    }

	$address2 = $_REQUEST['address2'];
	$city = $_REQUEST['city'];
     if ($city == "") {
        $error .= "<h2>ERROR -- City is required </h2><br>";
    }

	$state = $_REQUEST['state'];
    if ($state == "") {
        $error .= "<h2>ERROR -- State is required </h2><br> ";
    }

	$zip = $_REQUEST['zip'];
    if ($zip == "") {
        $error .= "<h2>ERROR -- Zip Code is required </h2><br> ";
    }

	$phone = $_REQUEST['phone'];
    if ($phone == "") {
        $error .= "<h2>ERROR -- Phone Number is required </h2><br> ";
    }

    	$phone2 = $_REQUEST['phone2'];
    	$date_of_birth = $_REQUEST['date_of_birth'];
	if ($date_of_birth == "") {
   	     $error .= "<h2>ERROR -- Date of Birth is required </h2><br>  ";
  	  }

	$gender = $_REQUEST['gender'];
	$ip = $_REQUEST['ip'];
	if ($ip == "") {
   	     $error .= "<h2>ERROR -- IP Address is required </h2><br> ";
  	  }

	$url = $_REQUEST['url'];
	if ($url == "") {
   	     $error .= "<h2>ERROR -- Url is required </h2><br>";
	}



	$pub_id = $_REQUEST['pub_id'];
	if ($pub_id == "") {
   	     $error .= "<h2>ERROR -- PubID is required </h2><br>";
  	  }


	$sub_id = $_REQUEST['sub_id'];
	$express_consent = $_REQUEST['express_consent'];

	$opt_in_date_time = $_REQUEST['opt_in_date_time'];
	if ($opt_in_date_time == "") {
   	     $error .= "<h2>ERROR -- Opt In Date & Time is required </h2><br>";
  	  }

	$jornaya_id = $_REQUEST['jornaya_id'];
//	if ($jornaya_id == "") {
//   	     $error .= "<h2>ERROR -- Jornaya ID is required </h2><br>";
//  	  }

	$trusted_cert_url = $_REQUEST['trusted_cert_url'];
	if (($jornaya_id == "") and ($trusted_cert_url == "")) {
   	     $error .= "<h2>ERROR -- trusted_cert_url OR jornaya ID is required </h2><br>";
  	  }


	$optional1 = $_REQUEST['optional1'];

	$optional2 = $_REQUEST['optional2'];
////	if ($optional2 == "") {
////   	     $error .= "<h2>ERROR -- Jornaya ID is required </h2><br>";
////  	  }


	$optional3 = $_REQUEST['optional3'];
////	if (($optional2 == "") and ($optional3 == "")) {
////   	     $error .= "<h2>ERROR -- trusted_cert_url (optional3) OR jornaya ID (optional2) is required </h2><br>";
////  	  }


          $new_id = $pub_id.$sub_id ;


	$date_to_parse = strtotime($date_of_birth);
	$dob_day = date('d',$date_to_parse);
	$dob_month = date('m',$date_to_parse);
	$dob_year = date('Y',$date_to_parse);
	$this_year = '2022';
	$ageB =  $this_year - $dob_year;

	$leadID = $jornaya_id ;
	if ($leadID == '') {
		$leadID = $trusted_cert_url ;
	}

	$post_url = "https://werewolfpinacolada.com/__ProcessLead?nm=013bdrq2urxga6&s=".$pub_id;

	$post_string = "&ad=".$address."&ct=".$city."&em=".$email."&fn=".$fname."&ln=".$lname."&dnsName=".$url."&hph=".$phone."&st=".$state."&dob=".$date_of_birth."&timestamp=".$opt_in_date_time."&IpAddress=".$ip."&JornayaLeadID=".$leadID."&pc=".$zip;

$ch = curl_init('');
curl_setopt($ch, CURLOPT_URL, $post_url);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
curl_setopt($ch, CURLOPT_TIMEOUT, 20);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_HTTPGET, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, ($post_string));

if ($error == '') {
		$page = (curl_exec($ch));
		$response = htmlspecialchars($page);
		echo $page;
		// echo $response,"\n";
		//echo "<h2>SUCCESS LEAD SUBMITTED</h2><br>";
	} else {
		echo $error,"\n";
		$page = "Not posted Validation errors";
	}



// echo "This campaign is Paused And No Longer Accepting Leads" ;

     if (strpos($page,'Success') == true){
     	$times_sold = '1';
	 }
 
        $sql = "INSERT INTO leads_2021
        SET email='".$email."',
	fname='".$fname."',
	lname='".$lname."',
	address='".$address."',
	address2='".$address2."',
	city='".$city."',
	state='".$state."',
	zip='".$zip."',
	phone='".$phone."',
	phone2='".$phone2."',
	date_of_birth='".$date_of_birth."',
	dob_m='".$dob_month."',
	dob_d='".$dob_day."',
	dob_y='".$dob_year."',
	age='".$ageB."',
	gender='".$gender."',
	ip='".$ip."',
	url='".$url."',
	campaign_id='".$campaign_id."',
	timestamp ='".$currdate."',
	pub_id='".$pub_id."',
	vendor_id='".$vendor_id."',
	sub_id='".$sub_id."',
	express_consent = '".$express_consent."',
	opt_in_date_time = '".$opt_in_date_time."',
	times_sold = '".$times_sold."',
        vertical = '".$vertical."',
	response = '".$page."',
	response2 = '".$page."',
        post_url = '".$post_url."',
        client_name = '".$client_name."',
	post_string = '".$post_string."',
	optional2='".$optional2."',
	optional3='".$optional3."',
	jornaya_id='".$jornaya_id."',
	trusted_cert_url='".$trusted_cert_url."',
	optional1='".$optional1."'";

// echo $sql;

       if($result = $link->query($sql)) {

       } else echo "error_400()" ;
                
                
  $sql4 = "INSERT INTO leads_2019
        SET email='".$email."',
	fname='".$fname."',
	lname='".$lname."',
	address='".$address."',
	address2='".$address2."',
	city='".$city."',
	state='".$state."',
	zip='".$zip."',
	phone='".$phone."',
	phone2='".$phone2."',
	date_of_birth='".$date_of_birth."',
	gender='".$gender."',
	ip='".$ip."',
	url='".$url."',
	campaign_id='".$campaign_id."',
	timestamp ='".$currdate."',
	pub_id='".$pub_id."',
	vendor_id='".$vendor_id."',
	sub_id='".$sub_id."',
	express_consent = '".$express_consent."',
	opt_in_date_time = '".$opt_in_date_time."',
	times_sold = '".$times_sold."',
        vertical = '".$vertical."',
	response = '".$page."',
	post_url = '".$post_url."',
        client_name = '".$client_name."',
	post_string = '".$post_string."',
	optional2='".$optional2."',
	optional3='".$optional3."',
	optional1='".$optional1."'";

// echo $sql;

       if($result = $link->query($sql4)) {

       } else echo "error_400()";
                

?>
