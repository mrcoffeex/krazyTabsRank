<?php

	function encryptIt( $q ) {
	    $cryptKey  = 'Helper4webcall:9997772595';
	    $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
	    return( $qEncoded );

	}

	function decryptIt( $q ) {
	    $cryptKey  = 'Helper4webcall:9997772595';
	    $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
	    return( $qDecoded );
	}

	function clean_string($value){

        include 'conf.php';
		
		if ($value == 0) {
            return $value;
        } else {
            if (!filter_var($value, FILTER_SANITIZE_STRING)) {
                header($input_error."?note=not_real_string");
            } else {
                return $value;
            }
        }
        
	} 

    function clean_email($value){

        include 'conf.php';

        if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
            header($input_error."?note=not_real_email");
        } else {
            return $value;
        }

    }

    function clean_int($value){

        if ($value == 0) {
            return $value;
        } else {
            if (!filter_var($value, FILTER_VALIDATE_INT)) {
                header($input_error."?note=not_real_int");
            } else {
                return $value;
            }
        }        
    }

    function clean_float($value){

        if ($value == 0) {
            return $value;
        } else {
            if (!filter_var($value, FILTER_VALIDATE_FLOAT)) {
                header($input_error."?note=not_real_float");
            } else {
                return $value;
            }
        }        
    }

    function RealNumber($value, $decimal){

        if ($value == 0) {
            $res = number_format(0, $decimal);
        }else if (is_nan($value)) {
            $res = 0;
        } else {
            if ($decimal == "") {
                $res = number_format($value);
            } else {
                $res = number_format($value, $decimal);
            }
        }
        
        return $res;
    }

    function calculateIfZero($value1, $value2, $operator, $decimal){

        if ($value1 == 0 || $value2 == 0) {
            $res = 0;
        }else{
            if ($operator == "multiply") {
                $res = RealNumber($value1 * $value2, $decimal);
            } else if ($operator == "division") {
                $res = RealNumber($value1 / $value2, $decimal);
            } else {
                $res = 0;
            }
        }

        return $res;
    }

	function get_curr_age($birthday){
        //values
        $date_now = strtotime(date("Y-m-d"));
        $value = strtotime($birthday);

        //subtract in seconds
        $date_diff = $date_now-$value;
        //convert in days
        $days = $date_diff / 86400;
        //convert in years
        $years = $days / 365.25;

        $months = $days / 30;

        $weeks = $days / 7;

        if ($days <= 28) {
            $finalset = $weeks;
            $age_ext = " weeks";
        }else if ($days <= 364) {
            $finalset = $months;
            $age_ext = " months";
        }else{
            $finalset = $years;
            $age_ext = " yrs";
        }

        //result
        $result = floor($finalset)." ".$age_ext;

        return $result;
    }

    function get_year_two_param($before, $later){
        //values
        $value_one = strtotime($later);
        $value_two = strtotime($before);

        //subtract in seconds
        $date_diff = $value_one-$value_two;
        //convert in days
        $days = $date_diff / 86400;
        //convert in years
        $years = $days / 365.25;

        //result
        $result = floor($years);

        return $result;
    }

    function get_timeage($basetime, $currenttime){
        $secs = $currenttime - $basetime;
        $days = $secs / 86400;

        if ($days < 1 ) {
            $age = 1;
        }else{
            $age = 1 + $days;
        }

        //classify weather day, month or year
        if ($age < 30.5) {
            $creditage = floor($age)." day(s)";
        }else if ($age >= 30.5 && $age < 365.25) {
            $creditage = floor(($age / 30.5))." month(s)";
        }else{
            $creditage = floor(($age / 265.25))." year(s)";
        }

        return $creditage;
    }

    function my_notify($note_text, $user, $type){

    	$my_notification_full = $note_text." - ".$user;
    	
    	//INSERT to database
    	$statement=dbaselink()->prepare("INSERT Into tabs_notification(
                                tabs_notif_type,
                                tabs_notif_text,
                                tabs_notif_date) 
                                Values(
                                    :mytype,
                                    :mynotification,
                                    NOW() )");
        $statement->execute([
            'mytype' => $type,
            'mynotification' => $my_notification_full
        ]);
    }

    function by_pin_get_user($my_pin, $my_type){

        $my_en_pin = clean_string(encryptIt($my_pin));
        
        //get the user id from 
        $statement=dbaselink()->prepare("SELECT tabs_user_id From tabs_optimum_secure Where 
                            tabs_sec_value = :pin AND 
                            tabs_sec_type = :mytype ");
        $statement->execute([
            'pin' => $my_en_pin,
            'mytype' => $my_type
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_user_id'];
    }

    function get_days($fromdate, $todate) {
        $fromdate = \DateTime::createFromFormat('Y-m-d', $fromdate);
        $todate = \DateTime::createFromFormat('Y-m-d', $todate);
        return new \DatePeriod(
            $fromdate,
            new \DateInterval('P1D'),
            $todate->modify('+1 day')
        );
    }

    function data_verify($my_ver_data){
        if ($my_ver_data == "") {
            $my_ver_data_value = "No Data";
        }else{
            $my_ver_data_value = $my_ver_data;
        }

        return $my_ver_data_value;
    }

    function my_randoms( $length ) {
        $chars = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";   

        $str="";
        
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

    function my_rand_str( $length ) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";   

        $str="";
        
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

    function my_rand_int( $length ) {
        $chars = "0123456789";   

        $str="";
        
        $size = strlen( $chars );
        for( $i = 0; $i < $length; $i++ ) {
            $str .= $chars[ rand( 0, $size - 1 ) ];
        }

        return $str;
    }

    function limitString($name, $limit){

        if (strlen($name) > $limit){
            $name = substr($name, 0, $limit) . '...';
        }else{
            $name = $name;
        }

        return $name;
    }

    function toAlpha($number){
        
        $alphabet = array('N', 'S', 'T', 'A', 'R', 'G', 'O', 'L', 'D', 'E');

        $count = count($alphabet);
        if ($number == 10){
            $alpha = "SN";
        } else if ($number <= $count) {
            return $alphabet[$number - 0];
        }
        $alpha = '';
        while ($number > 0) {
            $modulo = ($number - 0) % $count;
            $alpha  = $alphabet[$modulo] . $alpha;
            $number = floor((($number - $modulo) / $count));
        }
        return $alpha;
    }

    function previewImage($image, $default_image, $directory){

        if ($image == "empty" || $image == "") {
            $res = $default_image;
        }else{
            $res = $directory . "" . $image;
        }

        return $res;

    }

    function ezImageUpload($input, $location){

        $errors= array();
        $file_name = $_FILES[$input]['name'];
        $file_size =$_FILES[$input]['size'];
        $file_tmp =$_FILES[$input]['tmp_name'];
        $file_type=$_FILES[$input]['type'];
        $file_ext=strtolower(end(explode('.',$_FILES[$input]['name'])));

        $final_filename = date("YmdHis")."_".$file_name;

        $extensions= array("jpeg","jpg","png");

        if(in_array($file_ext,$extensions)=== false){
            $errors[]="extension not allowed, please choose a JPEG or PNG file.";
        }

        if($file_size > 10485760){
            $errors[]='File size must be excately 10 MB';
        }

        $file_directory = $location."".$final_filename;

        if(empty($errors)==true){
            move_uploaded_file($file_tmp, $file_directory);
            $res = $final_filename;
        }else{
            if ($file_tmp == "") {
                $res = "empty";
            }else{
                $res = "error";
            }
        }

        return $res;

    }

    function latest_code($ltable, $lcolumn, $lfirstcount){

        $statement=dbaselink()->prepare("SELECT :lcolumn FROM :ltable ORDER BY :lcolumn DESC LIMIT 1");
        $statement->execute([
            'lcolumn' => $lcolumn,
            'ltable' => $ltable
        ]);
        $latestrow=$statement->fetch(PDO::FETCH_ASSOC);
        $count=$statement->rowCount();

        if ($count == 0) {
            $mylatestcode = $lfirstcount;
        }else{
            $mylatestcode = $latestrow[$lcolumn] + 1;
        }

        return $mylatestcode;
    }

    function checkIfExist($table, $column, $value){

        $statement=dbaselink()->prepare("SELECT $column From $table
                                        Where
                                        $column = :my_column");
        $statement->execute([
            'my_column' => $value
        ]);

        $count=$statement->rowCount();

        return $count;
        
    }

    function compare_update($old_data , $new_data , $type_data){
        if ($old_data != $new_data) {
            $my_data_res = $type_data.": ".$old_data." -> ".$new_data." , ";
        }else{
            $my_data_res = "";
        }

        return $my_data_res;
    }

    function proper_date($datetime){

        if ($datetime == "") {
            $res = "";
        }else{
            $res = date("Md Y", strtotime($datetime));
        }

        return $res;

    }

    function proper_time($datetime){

        if ($datetime == "") {
            $res = "";
        }else{
            $res = date("g:i A", strtotime($datetime));
        }

        return $res;

    }

    function get_date_status($date){

        $thisdate = date("Y-m-d");
        $thistomorrow = date("Y-m-d", strtotime("+1 day"));
        $thisyesterday = date("Y-m-d", strtotime("-1 day"));

        if (date("Y") == date("Y", strtotime($date))) {
            if ($date == $thisdate) {
                $res = "Today";
            }else if ($date == $thistomorrow) {
                $res = "Tomorrow";
            }else if ($date == $thisyesterday) {
                $res = "Yesterday";
            }else{
                $res = date("Md", strtotime($date));
            }
        }else{
            $res = date("Md Y", strtotime($date));
        }

        return $res;

    }

    function validateChecked($value, $checkboxValue){

        if ($checkboxValue == $value) {
            $res = "checked";
        } else {
            $res = "";
        }
        
        return $res;
    }

    // methods_system_logs

    function get_system_logs_skin($type){

        if ($type == "auth") {
            $res = "text-tabs-yellow";
        }else if ($type == "insert") {
            $res = "text-success";
        }else if ($type == "delete") {
            $res = "text-warning";
        }else if ($type == "update") {
            $res = "text-info";
        }else if ($type == "attempt") {
            $res = "text-danger";
        }else{
            $res = "text-muted";
        }

        return $res;

    }

    function count_system_logs($date1, $date2){

        $statement=dbaselink()->prepare("SELECT tabs_notif_id From tabs_notification Where date(tabs_notif_date) BETWEEN :date1 AND :date2 ");
        $statement->execute([
            'date1' => $date1,
            'date2' => $date2
        ]);
        $countres=$statement->rowCount();

        return $countres;
    }

    //methods_users

    function countUsers(){

        $statement=dbaselink()->prepare("SELECT tabs_user_id From tabs_users
                                        Where
                                        tabs_user_id != :tabs_user_id");
        $statement->execute([
            'tabs_user_id' => 1
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }

    function selectUsers(){

        $statement=dbaselink()->prepare("SELECT * From tabs_users 
                                        Where
                                        tabs_user_id != :tabs_user_id
                                        Order By tabs_full_name ASC");
        $statement->execute([
            'tabs_user_id' => 1
        ]);

        return $statement;
    }

    function createUser($name, $username){

        $usercode = clean_string(date("YmdHis")."".my_randoms(8));
        $newpassword = clean_string(encryptIt(my_rand_str(8)));

        $statement=dbaselink()->prepare("INSERT INTO tabs_users(
            tabs_user_code, 
            tabs_full_name, 
            tabs_username, 
            tabs_password, 
            tabs_user_type, 
            tabs_user_status, 
            tabs_user_profile_img, 
            tabs_user_created, 
            tabs_user_updated
            ) 
            VALUES (
                :tabs_user_code,
                :tabs_full_name,
                :tabs_username,
                :tabs_password,
                :tabs_user_type,
                :tabs_user_status,
                :tabs_user_profile_img,
                NOW(),
                NOW()
            )");
        $statement->execute([
            'tabs_user_code' => $usercode, 
            'tabs_full_name' => $name, 
            'tabs_username' => $username, 
            'tabs_password' => $newpassword, 
            'tabs_user_type' => 0, 
            'tabs_user_status' => 0, 
            'tabs_user_profile_img' => ''
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function countUsernameDuplicatesExceptMine($username, $userId){

        $statement=dbaselink()->prepare("SELECT tabs_username From tabs_users 
                                        Where
                                        tabs_username = :tabs_username AND 
                                        tabs_user_id != :tabs_user_id");
        $statement->execute([
            'tabs_username' => $username,
            'tabs_user_id' => $userId
        ]);

        $count=$statement->rowCount();

        return $count;

    }

    function updateUser($name, $username, $password, $userId){

        $statement=dbaselink()->prepare("UPDATE tabs_users
            SET
            tabs_full_name = :tabs_full_name, 
            tabs_username = :tabs_username, 
            tabs_password = :tabs_password,
            tabs_user_updated = NOW()
            Where
            tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_full_name' => $name, 
            'tabs_username' => $username, 
            'tabs_password' => $password,
            'tabs_user_id' => $userId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function deactivateUser($userId){

        $statement=dbaselink()->prepare("UPDATE tabs_users
                                        SET
                                        tabs_user_status = :tabs_user_status
                                        Where
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_user_status' => 1,
            'tabs_user_id' => $userId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function activateUser($userId){

        $statement=dbaselink()->prepare("UPDATE tabs_users
                                        SET
                                        tabs_user_status = :tabs_user_status
                                        Where
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_user_status' => 0,
            'tabs_user_id' => $userId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function user_type($usertype){
        if ($usertype == 0) {
            $res = "dev";
        }else if ($usertype == 1) {
            $res = "judge";
        }else{
            $res = "none";
        }

        return $res;
    }

    function statusUser($status){

        if($status == 0){
            $res = "Active";
        }else{
            $res = "Deactivated";
        }

        return $res;

    }

    // methods_judges

    function countJudges(){
        
        $statement=dbaselink()->prepare("SELECT tabs_user_id From tabs_users
                                        Where
                                        tabs_user_type = :tabs_user_type AND 
                                        tabs_user_status = :tabs_user_status");
        $statement->execute([
            'tabs_user_type' => 1,
            'tabs_user_status' => 0
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }

    function countJudgesByEvent($eventId){
        
        $statement=dbaselink()->prepare("SELECT tabs_user_id From tabs_users
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_user_type = :tabs_user_type AND 
                                        tabs_user_status = :tabs_user_status");
        $statement->execute([
            'tabs_user_type' => 1,
            'tabs_user_status' => 0,
            'tabs_event_id' => $eventId
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }

    function countActiveJudge($eventId, $catId){
        
        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_user_id From tabs_results
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_cat_id' => $catId
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }

    function selectJudges(){

        $statement=dbaselink()->prepare("SELECT * From tabs_users 
                                        Where
                                        tabs_user_type = :tabs_user_type AND 
                                        tabs_user_status = :tabs_user_status
                                        Order By tabs_full_name ASC");
        $statement->execute([
            'tabs_user_type' => 1,
            'tabs_user_status' => 0
        ]);

        return $statement;
    }

    function selectJudgesByEvent($eventId){

        $statement=dbaselink()->prepare("SELECT * From tabs_users 
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_user_type = :tabs_user_type AND 
                                        tabs_user_status = :tabs_user_status
                                        Order By tabs_full_name ASC");
        $statement->execute([
            'tabs_user_type' => 1,
            'tabs_user_status' => 0,
            'tabs_event_id' => $eventId
        ]);

        return $statement;
    }
    
    function createJudge($name, $username, $eventId){

        $usercode = clean_string(date("YmdHis")."".my_randoms(8));
        $newpassword = clean_string(encryptIt(my_rand_str(8)));

        $statement=dbaselink()->prepare("INSERT INTO tabs_users(
            tabs_user_code, 
            tabs_full_name, 
            tabs_username, 
            tabs_password, 
            tabs_user_type, 
            tabs_user_status, 
            tabs_user_profile_img, 
            tabs_event_id, 
            tabs_user_created, 
            tabs_user_updated
            ) 
            VALUES (
                :tabs_user_code,
                :tabs_full_name,
                :tabs_username,
                :tabs_password,
                :tabs_user_type,
                :tabs_user_status,
                :tabs_user_profile_img,
                :tabs_event_id,
                NOW(),
                NOW()
            )");
        $statement->execute([
            'tabs_user_code' => $usercode, 
            'tabs_full_name' => $name, 
            'tabs_username' => $username, 
            'tabs_password' => $newpassword, 
            'tabs_user_type' => 1, 
            'tabs_user_status' => 0, 
            'tabs_user_profile_img' => '',
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function updateJudge($name, $username, $password, $eventId, $userId){

        $statement=dbaselink()->prepare("UPDATE tabs_users
            SET
            tabs_full_name = :tabs_full_name, 
            tabs_username = :tabs_username, 
            tabs_password = :tabs_password, 
            tabs_event_id = :tabs_event_id, 
            tabs_user_updated = NOW()
            Where
            tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_full_name' => $name, 
            'tabs_username' => $username, 
            'tabs_password' => $password,
            'tabs_event_id' => $eventId,
            'tabs_user_id' => $userId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function getJudgeName($judgeId){

        $statement=dbaselink()->prepare("SELECT tabs_full_name From tabs_users
                                        Where
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_user_id' => $judgeId
        ]);

        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_full_name'];

    }

    function transferJudge($judgeId, $eventId){

        $statement=dbaselink()->prepare("UPDATE
                                        tabs_users
                                        SET
                                        tabs_event_id = :tabs_event_id
                                        Where
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_user_id' => $judgeId
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }

    }

    // methods candidates

    function countCandidates(){
        
        $statement=dbaselink()->prepare("SELECT tabs_can_id From tabs_candidates");
        $statement->execute();
        $countres=$statement->rowCount();

        return $countres;

    }

    function countCandidatesByEvent($eventId){
        
        $statement=dbaselink()->prepare("SELECT tabs_can_id From tabs_candidates
                                        Where
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }

    function selectCandidates(){

        $statement=dbaselink()->prepare("SELECT * From tabs_candidates
                                        Order By tabs_can_number ASC");
        $statement->execute();

        return $statement;

    }

    function selectCandidatesByEvent($eventId){

        $statement=dbaselink()->prepare("SELECT * From tabs_candidates 
                                        Where
                                        tabs_event_id = :tabs_event_id 
                                        Order By tabs_can_number ASC");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        return $statement;

    }

    function createCandidate($number, $name, $designation, $image, $eventId){

        $statement=dbaselink()->prepare("INSERT INTO tabs_candidates
                                        (
                                            tabs_can_number, 
                                            tabs_can_name, 
                                            tabs_can_desc, 
                                            tabs_can_image, 
                                            tabs_can_created, 
                                            tabs_event_id
                                        )
                                        Values
                                        (
                                            :tabs_can_number, 
                                            :tabs_can_name, 
                                            :tabs_can_desc, 
                                            :tabs_can_image, 
                                            NOW(), 
                                            :tabs_event_id
                                        )");
        $statement->execute([
            'tabs_can_number' => $number,
            'tabs_can_name' => $name,
            'tabs_can_desc' => $designation,
            'tabs_can_image' => $image,
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function updateCandidate($number, $name, $designation, $image, $eventId, $canId){

        $statement=dbaselink()->prepare("UPDATE tabs_candidates 
                                        SET
                                        tabs_can_number = :tabs_can_number, 
                                        tabs_can_name = :tabs_can_name, 
                                        tabs_can_desc = :tabs_can_desc,
                                        tabs_can_image = :tabs_can_image,
                                        tabs_event_id = :tabs_event_id
                                        Where
                                        tabs_can_id = :tabs_can_id
                                        ");
        $statement->execute([
            'tabs_can_number' => $number,
            'tabs_can_name' => $name,
            'tabs_can_desc' => $designation,
            'tabs_can_image' => $image,
            'tabs_event_id' => $eventId,
            'tabs_can_id' => $canId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function countCandidateResults($canId){

        $statement=dbaselink()->prepare("SELECT tabs_result_id From tabs_results
                                        Where
                                        tabs_can_id = :tabs_can_id");
        $statement->execute([
            'tabs_can_id' => $canId
        ]);

        $count=$statement->rowCount();
        
        return $count;

    }

    function deleteCandidate($canId){

        //check results
        if (empty(countCandidateResults($canId))) {
            
            $statement=dbaselink()->prepare("DELETE FROM tabs_candidates
                                        Where
                                        tabs_can_id = :tabs_can_id");
            $statement->execute([
                'tabs_can_id' => $canId
            ]);

            if ($statement) {
                return true;
            }else{
                return false;
            }

        } else {

            return "has_record";

        } 

    }

    function checkCandidateNumberIfExist($eventId, $number){

        $statement=dbaselink()->prepare("SELECT tabs_can_id From tabs_candidates
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_can_number = :tabs_can_number");
        $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_can_number' => $number
        ]);
        $countres=$statement->rowCount();
        
        return $countres;
    }

    function getCandidateName($canId){

        $statement=dbaselink()->prepare("SELECT tabs_can_name From tabs_candidates
                                        Where
                                        tabs_can_id = :tabs_can_id");
        $statement->execute([
            'tabs_can_id' => $canId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $res['tabs_can_name'];

    }

    function getCandidateImage($canId){

        $statement=dbaselink()->prepare("SELECT tabs_can_image From tabs_candidates
                                        Where
                                        tabs_can_id = :tabs_can_id");
        $statement->execute([
            'tabs_can_id' => $canId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $res['tabs_can_image'];

    }

    function getCandidateNumber($canId){

        $statement=dbaselink()->prepare("SELECT tabs_can_number From tabs_candidates
                                        Where
                                        tabs_can_id = :tabs_can_id");
        $statement->execute([
            'tabs_can_id' => $canId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);
        
        return $res['tabs_can_number'];

    }

    function getCandidateIdByNumber($eventId, $number){

        $statement=dbaselink()->prepare("SELECT tabs_can_id From tabs_candidates
                                        Where
                                        tabs_can_number = :tabs_can_number AND 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_can_number' => $number,
            'tabs_event_id' => $eventId
        ]);
        $countres=$statement->rowCount();
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        if ($countres > 0) {
            return $res['tabs_can_id'];
        } else {
            return 0;
        }

    }

    function transferCandidate($canId, $eventId){

        $statement=dbaselink()->prepare("UPDATE
                                        tabs_candidates
                                        SET
                                        tabs_event_id = :tabs_event_id
                                        Where
                                        tabs_can_id = :tabs_can_id");
        $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_can_id' => $canId
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }

    }

    // methods_events

    function countEvents(){
        
        $statement=dbaselink()->prepare("SELECT tabs_event_id From tabs_events");
        $statement->execute();
        $countres=$statement->rowCount();

        return $countres;

    }

    function selectEvents(){

        $statement=dbaselink()->prepare("SELECT * From tabs_events 
                                        Order By tabs_event_id DESC");
        $statement->execute();

        return $statement;
    }

    function selectEventsRecent(){

        $statement=dbaselink()->prepare("SELECT * From tabs_events
                                        Where
                                        date(tabs_event_created) BETWEEN :created_from AND CURDATE()
                                        Order By tabs_event_id DESC LIMIT 10");
        $statement->execute([
            'created_from' => date("Y-m-d", strtotime("-6 days"))
        ]);

        return $statement;
    }

    function selectEventsById($eventId){

        $statement=dbaselink()->prepare("SELECT * From tabs_events 
                                        Where
                                        tabs_event_id = :tabs_event_id
                                        Order By tabs_event_id DESC");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        return $statement;
    }

    function selectEventsWithHighlights(){

        $statement=dbaselink()->prepare("SELECT 
                                        tabs_event_id,
                                        tabs_event_title,
                                        tabs_event_status
                                        From 
                                        tabs_events 
                                        Where
                                        tabs_event_status = :tabs_event_status
                                        Order By tabs_event_id ASC");
        $statement->execute([
            'tabs_event_status' => 1
        ]);

        return $statement;
    }

    function createEvent($title, $desc, $year){

        $statement=dbaselink()->prepare("INSERT INTO tabs_events
            (
                tabs_event_title, 
                tabs_event_desc, 
                tabs_event_year, 
                tabs_event_status,
                tabs_event_created, 
                tabs_event_updated
            )
            VALUES (
                :tabs_event_title,
                :tabs_event_desc,
                :tabs_event_year,
                :tabs_event_status,
                NOW(),
                NOW()
            )");
        $statement->execute([
            'tabs_event_title' => $title, 
            'tabs_event_desc' => $desc, 
            'tabs_event_year' => $year, 
            'tabs_event_status' => 0
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function updateEvent($title, $desc, $year, $eventId){

        $statement=dbaselink()->prepare("UPDATE tabs_events
            SET
            tabs_event_title = :tabs_event_title, 
            tabs_event_desc = :tabs_event_desc, 
            tabs_event_year = :tabs_event_year,
            tabs_event_updated = NOW()
            Where
            tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_title' => $title, 
            'tabs_event_desc' => $desc, 
            'tabs_event_year' => $year,
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function getEventTitle($eventId){

        $statement=dbaselink()->prepare("SELECT tabs_event_title From tabs_events
                                        Where
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_event_title'];

    }

    function validateCategory($catId, $eventId){

        $statement=dbaselink()->prepare("SELECT tabs_cat_id From tabs_categories
                                        Where
                                        tabs_cat_id = :tabs_cat_id AND 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_cat_id' => $catId,
            'tabs_event_id' => $eventId
        ]);

        $count=$statement->rowCount();

        return $count;

    }

    function validateCandidate($canId, $eventId){

        $statement=dbaselink()->prepare("SELECT tabs_can_id From tabs_candidates
                                        Where
                                        tabs_can_id = :tabs_can_id AND 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_can_id' => $canId,
            'tabs_event_id' => $eventId
        ]);

        $count=$statement->rowCount();

        return $count;

    }
    
    function getEventStatus($eventId){

        $statement=dbaselink()->prepare("SELECT tabs_event_status From tabs_events
                                        Where
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_event_status'];

    }

    function updateEventStatus($eventId){

        $status = getEventStatus($eventId);

        if ($status == 0) {
            $value = 1;
        } else {
            $value = 0;
        }
        
        $statement=dbaselink()->prepare("UPDATE tabs_events SET
                                        tabs_event_status = :tabs_event_status 
                                        WHERE
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_status' => $value,
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function eventCheckboxStatus($status){

        if ($status == 1) {
            $res = "checked";
        } else {
            $res = "";
        }
        
        return $res;
    }

    // methods_category

    function countCategories($eventId){

        $statement=dbaselink()->prepare("SELECT tabs_cat_id From tabs_categories
                                        Where
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }

    function selectCategories($eventId){

        $statement=dbaselink()->prepare("SELECT * From tabs_categories
                                        Where
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);
        
        return $statement;

    }

    function createCategory($title, $percentage, $eventId){

        $statement=dbaselink()->prepare("INSERT INTO tabs_categories
            (
                tabs_cat_title, 
                tabs_cat_percentage, 
                tabs_cat_status, 
                tabs_event_id
            )
            VALUES (
                :tabs_cat_title,
                :tabs_cat_percentage,
                :tabs_cat_status,
                :tabs_event_id
            )");
        $statement->execute([
            'tabs_cat_title' => $title, 
            'tabs_cat_percentage' => $percentage,
            'tabs_cat_status' => 0, 
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function updateCategory($title, $percentage, $catId){

        $statement=dbaselink()->prepare("UPDATE tabs_categories
                                        SET
                                        tabs_cat_title = :tabs_cat_title, 
                                        tabs_cat_percentage = :tabs_cat_percentage
                                        Where 
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_title' => $title, 
            'tabs_cat_percentage' => $percentage, 
            'tabs_cat_id' => $catId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function deleteCategory($catId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_categories 
                                        Where 
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function getCategoryTitle($catId){

        $statement=dbaselink()->prepare("SELECT tabs_cat_title From tabs_categories
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_cat_title'];

    }

    function getCategoryPercentage($catId){

        $statement=dbaselink()->prepare("SELECT tabs_cat_percentage From tabs_categories
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_cat_percentage'];

    }

    function getEventIdByCatId($catId){

        $statement=dbaselink()->prepare("SELECT tabs_event_id From tabs_categories
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_event_id'];

    }

    function getEventTitleByCatId($catId){

        $statement=dbaselink()->prepare("SELECT tabs_event_id From tabs_categories
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        $title = getEventTitle($res['tabs_event_id']);

        return $title;

    }

    function getCategoryStatus($catId){

        $statement=dbaselink()->prepare("SELECT tabs_cat_status From tabs_categories
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_cat_status'];

    }

    function updateCategoryStatus($catId){

        $status = getCategoryStatus($catId);

        if ($status == 0) {
            $value = 1;
        } else {
            $value = 0;
        }
        
        $statement=dbaselink()->prepare("UPDATE tabs_categories SET
                                        tabs_cat_status = :tabs_cat_status 
                                        WHERE
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_status' => $value,
            'tabs_cat_id' => $catId
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }
    }

    function categoryCheckboxStatus($status){

        if ($status == 0) {
            $res = "checked";
        } else {
            $res = "";
        }
        
        return $res;
    }

    function categoryStatusColor($status){

        if ($status == 0) {
            $res = "card-tale";
        } else {
            $res = "card-light-danger";
        }
        
        return $res;
    }

    function categoryStatusLink($status, $catId){

        if ($status == 0) {
            $res = "category?rand=".my_rand_str(30)."&cd=$catId";
        } else {
            $res = "./?note=cat_closed";
        }
        
        return $res;
    }

    // methods_criteria
    
    function countCriteria($catId){

        $statement=dbaselink()->prepare("SELECT tabs_cri_id From tabs_criterias
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);
        $countres=$statement->rowCount();

        return $countres;

    }
    
    function selectCriteria($catId){

        $statement=dbaselink()->prepare("SELECT * From tabs_criterias
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);

        return $statement;

    }

    function createCriteria($title, $desc, $min, $max, $percentage, $catId){

        $statement=dbaselink()->prepare("INSERT INTO tabs_criterias
            (
                tabs_cri_title, 
                tabs_cri_desc, 
                tabs_cri_score_min, 
                tabs_cri_score_max, 
                tabs_cri_percentage, 
                tabs_cat_id
            )
            VALUES (
                :tabs_cri_title, 
                :tabs_cri_desc, 
                :tabs_cri_score_min, 
                :tabs_cri_score_max, 
                :tabs_cri_percentage, 
                :tabs_cat_id
            )");
        $statement->execute([
            'tabs_cri_title' => $title, 
            'tabs_cri_desc' => $desc, 
            'tabs_cri_score_min' => $min, 
            'tabs_cri_score_max' => $max, 
            'tabs_cri_percentage' => $percentage, 
            'tabs_cat_id' => $catId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function updateCriteria($title, $desc, $min, $max, $percentage, $criId){

        $statement=dbaselink()->prepare("UPDATE tabs_criterias
                                        SET
                                        tabs_cri_title = :tabs_cri_title, 
                                        tabs_cri_desc = :tabs_cri_desc, 
                                        tabs_cri_score_min = :tabs_cri_score_min, 
                                        tabs_cri_score_max = :tabs_cri_score_max, 
                                        tabs_cri_percentage = :tabs_cri_percentage 
                                        Where
                                        tabs_cri_id = :tabs_cri_id");
        $statement->execute([
            'tabs_cri_title' => $title, 
            'tabs_cri_desc' => $desc, 
            'tabs_cri_score_min' => $min, 
            'tabs_cri_score_max' => $max, 
            'tabs_cri_percentage' => $percentage, 
            'tabs_cri_id' => $criId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function deleteCriteria($criId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_criterias 
                                        Where 
                                        tabs_cri_id = :tabs_cri_id");
        $statement->execute([
            'tabs_cri_id' => $criId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function getCategoryByCriteriaId($criId){

        $statement=dbaselink()->prepare("SELECT tabs_cat_id From tabs_criterias
                                        Where
                                        tabs_cri_id = :tabs_cri_id");
        $statement->execute([
            'tabs_cri_id' => $criId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_cat_id'];

    }

    function getCriteriaMax($criId){

        $statement=dbaselink()->prepare("SELECT tabs_cri_score_max From tabs_criterias
                                        Where
                                        tabs_cri_id = :tabs_cri_id");
        $statement->execute([
            'tabs_cri_id' => $criId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_cri_score_max'];

    }

    function getCriteriaMin($criId){

        $statement=dbaselink()->prepare("SELECT tabs_cri_score_min From tabs_criterias
                                        Where
                                        tabs_cri_id = :tabs_cri_id");
        $statement->execute([
            'tabs_cri_id' => $criId
        ]);
        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_cri_score_min'];

    }

    // methods_results

    function checkExistingResult($criId, $catId, $canId, $judgeId){

        $statement=dbaselink()->prepare("SELECT tabs_result_id FROM tabs_results
                                        Where
                                        tabs_cri_id = :tabs_cri_id AND 
                                        tabs_cat_id = :tabs_cat_id AND 
                                        tabs_can_id = :tabs_can_id AND 
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_cri_id' => $criId,
            'tabs_cat_id' => $catId,
            'tabs_can_id' => $canId,
            'tabs_user_id' => $judgeId
        ]);

        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_result_id'];

    }

    function createResult($eventId, $catId, $criId, $judgeId, $canId, $score){

        //check if exist
        $result = checkExistingResult($criId, $catId, $canId, $judgeId);

        if (!empty($result)) {
            //not empty so update
            $statement=dbaselink()->prepare("UPDATE tabs_results 
                                            SET
                                            tabs_result_score = :tabs_result_score,
                                            tabs_result_updated = NOW()
                                            Where
                                            tabs_result_id = :tabs_result_id");
            $statement->execute([
                'tabs_result_score' => $score, 
                'tabs_result_id' => $result
            ]);

        } else {
            //insert new
            $statement=dbaselink()->prepare("INSERT INTO tabs_results
                (
                    tabs_event_id, 
                    tabs_cat_id, 
                    tabs_cri_id, 
                    tabs_user_id, 
                    tabs_can_id, 
                    tabs_result_score, 
                    tabs_result_created, 
                    tabs_result_updated
                )
                VALUES (
                    :tabs_event_id, 
                    :tabs_cat_id, 
                    :tabs_cri_id, 
                    :tabs_user_id, 
                    :tabs_can_id, 
                    :tabs_result_score, 
                    NOW(), 
                    NOW()
                )");
            $statement->execute([
                'tabs_event_id' => $eventId, 
                'tabs_cat_id' => $catId, 
                'tabs_cri_id' => $criId, 
                'tabs_user_id' => $judgeId, 
                'tabs_can_id' => $canId,
                'tabs_result_score' => $score
            ]);
        }
        
        if ($statement) {
            return true;
        }else{
            return false;
        }

    }

    function getCandidateResultByCriteria($criId, $catId, $canId, $judgeId){

        $statement=dbaselink()->prepare("SELECT tabs_result_score FROM tabs_results
                                        Where
                                        tabs_cri_id = :tabs_cri_id AND 
                                        tabs_cat_id = :tabs_cat_id AND 
                                        tabs_can_id = :tabs_can_id AND 
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_cri_id' => $criId,
            'tabs_cat_id' => $catId,
            'tabs_can_id' => $canId,
            'tabs_user_id' => $judgeId
        ]);

        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_result_score'];

    }

    function getCandidateResultByEvent($eventId){

        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_can_id FROM tabs_results
                                        Where 
                                        tabs_event_id = :tabs_event_id 
                                        Order By tabs_result_score DESC");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        return $statement;

    }

    function countCandidateResultByEvent($eventId){

        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_can_id FROM tabs_results
                                        Where 
                                        tabs_event_id = :tabs_event_id 
                                        Order By tabs_result_score DESC");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        $count=$statement->rowCount();

        return $count;

    }

    function getCandidateResultByEventCategory($eventId, $catId){

        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_can_id FROM tabs_results
                                        Where 
                                        tabs_cat_id = :tabs_cat_id AND
                                        tabs_event_id = :tabs_event_id 
                                        Order By tabs_result_rank ASC");
        $statement->execute([
            'tabs_cat_id' => $catId,
            'tabs_event_id' => $eventId
        ]);

        return $statement;

    }

    function countCandidateResultByEventCategory($eventId, $catId){

        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_can_id FROM tabs_results
                                        Where 
                                        tabs_cat_id = :tabs_cat_id AND
                                        tabs_event_id = :tabs_event_id 
                                        Order By tabs_result_score DESC");
        $statement->execute([
            'tabs_cat_id' => $catId,
            'tabs_event_id' => $eventId
        ]);

        $count=$statement->rowCount();

        return $count;

    }

    function getCandidateResultByCategoryAndJudge($catId, $judgeId){

        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_can_id, tabs_user_id FROM tabs_results
                                        Where 
                                        tabs_cat_id = :tabs_cat_id AND 
                                        tabs_user_id = :tabs_user_id 
                                        Order By tabs_result_score DESC");
        $statement->execute([
            'tabs_cat_id' => $catId,
            'tabs_user_id' => $judgeId
        ]);

        return $statement;

    }

    function getCandidateRank($canId, $eventId, $catId, $judgeId){

        $statement=dbaselink()->prepare("SELECT tabs_result_rank FROM tabs_results
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_can_id = :tabs_can_id AND
                                        tabs_cat_id = :tabs_cat_id AND
                                        tabs_user_id = :tabs_user_id");
        $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_can_id' => $canId,
            'tabs_cat_id' => $catId,
            'tabs_user_id' => $judgeId
        ]);

        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_result_rank'];

    }

    function getCandidateCatRank($canId, $eventId, $catId){

        $statement=dbaselink()->prepare("SELECT tabs_result_catRank FROM tabs_results
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_can_id = :tabs_can_id AND
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_can_id' => $canId,
            'tabs_cat_id' => $catId
        ]);

        $res=$statement->fetch(PDO::FETCH_ASSOC);

        return $res['tabs_result_catRank'];

    }

    function updateRank($canId, $eventId, $catId, $judgeId, $rank){

        $statement=dbaselink()->prepare("UPDATE tabs_results SET
                                        tabs_result_rank = :tabs_result_rank
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_can_id = :tabs_can_id AND
                                        tabs_cat_id = :tabs_cat_id AND
                                        tabs_user_id = :tabs_user_id");
         $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_can_id' => $canId,
            'tabs_cat_id' => $catId,
            'tabs_user_id' => $judgeId,
            'tabs_result_rank' => $rank
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }
        
    }

    function updateCatRank($canId, $eventId, $catId, $catRank){

        $statement=dbaselink()->prepare("UPDATE tabs_results SET
                                        tabs_result_catRank = :tabs_result_catRank
                                        Where
                                        tabs_event_id = :tabs_event_id AND
                                        tabs_can_id = :tabs_can_id AND
                                        tabs_cat_id = :tabs_cat_id");
         $statement->execute([
            'tabs_event_id' => $eventId,
            'tabs_can_id' => $canId,
            'tabs_cat_id' => $catId,
            'tabs_result_catRank' => $catRank
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }
        
    }

    function getCandidateResultByCategory($catId){

        $statement=dbaselink()->prepare("SELECT * FROM tabs_results
                                        Where 
                                        tabs_cat_id = :tabs_cat_id 
                                        Order By tabs_result_score DESC");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);

        return $statement;

    }

    function selectCategoryActiveJudges($catId){

        $statement=dbaselink()->prepare("SELECT DISTINCT tabs_user_id From tabs_results
                                        Where
                                        tabs_cat_id = :tabs_cat_id
                                        Order By 
                                        tabs_user_id ASC");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);

        return $statement;

    }

    function countCategoryResults($catId){

        $statement=dbaselink()->prepare("SELECT tabs_result_id From tabs_results
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);

        $count=$statement->rowCount();

        return $count;

    }

    function resetCategoryResults($catId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_results 
                                        Where
                                        tabs_cat_id = :tabs_cat_id");
        $statement->execute([
            'tabs_cat_id' => $catId
        ]);

        if ($statement) {
            return true;
        } else {
            return false;
        }

    }

    function getAverageValueByCategoryPercentage($average, $percentage){

        if ($average == 0) {
            $res = 0;
        } else {
            $averagePercentageByCriteriaMax = ($average * $percentage);

            $res = $averagePercentageByCriteriaMax / 100;
        }
        
        return $res;
    }

    function getCriteriaPercentage($score, $percentage, $criteriaMax){

        $x = ($score / $criteriaMax) * $percentage;

        if (is_nan($x)) {
            $res = 0;
        } else {
            $res = $x;
        }

        return $res;

    }

    //methods_image

    function updateEventImage($newImage){

        $statement=dbaselink()->prepare("UPDATE tabs_my_project
                                        SET
                                        tabs_event_image = :tabs_event_image");
        $statement->execute([
            'tabs_event_image' => $newImage
        ]);
        
        if ($statement) {
            return true;
        } else {
            return false;
        }

    }

    //methods_delete

    function deleteCandidatesByEvent($eventId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_candidates 
                                        Where 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }
    
    function deleteJudgesByEvent($eventId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_users 
                                        Where 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function deleteScoresByEvent($eventId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_results 
                                        Where 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function deleteCriteriaByEvent($eventId){
        
        $getCategories=selectCategories($eventId);
        while ($category=$getCategories->fetch(PDO::FETCH_ASSOC)) {
            
            $statement=dbaselink()->prepare("DELETE FROM tabs_criterias
                                            Where
                                            tabs_cat_id = :tabs_cat_id");
            $statement->execute([
                'tabs_cat_id' => $category['tabs_cat_id']
            ]);

        }

        if ($statement) {
            return true;
        } else {
            return false;
        }

    }

    function deleteCategoryByEvent($eventId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_categories 
                                        Where 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function deleteEvent($eventId){

        $statement=dbaselink()->prepare("DELETE FROM tabs_events 
                                        Where 
                                        tabs_event_id = :tabs_event_id");
        $statement->execute([
            'tabs_event_id' => $eventId
        ]);

        if ($statement) {
            return true;
        }else{
            return false;
        }
    }

    function deleteEventRecords($eventId){

        $deleteCandidates = deleteCandidatesByEvent($eventId);
        $deleteJudges =  deleteJudgesByEvent($eventId);
        $deleteScores = deleteScoresByEvent($eventId);
        $deleteCriteria = deleteCriteriaByEvent($eventId);
        $deleteCategory = deleteCategoryByEvent($eventId);
        $deleteEvent =  deleteEvent($eventId);

        if ($deleteCandidates == true && 
            $deleteJudges == true && 
            $deleteScores == true && 
            $deleteCriteria == true && 
            $deleteCategory == true && 
            $deleteEvent == true) {
            
                return true;

        } else {
            return false;
        }
        
    }
?>