<?php
//==============COMMON START===================

function alert($data,$color="danger"){
    return "<div class='alert alert-$color alert-dismissible fade show' role='alert'>
           $data
              <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
              </button>
           </div>";
}

function runQuery($sql){
    $con = con();
    if (mysqli_query($con,$sql)){
        return true;
    }else{
        die("DB Error :".mysqli_error($con));
    }
}

function redirect($l){
    header("location:$l");
}

function linkTo($l){
    echo "<script>location.href = '$l'</script>";
}

function fetch($sql){
    $query = mysqli_query(con(),$sql);
    $row = mysqli_fetch_assoc($query);
    return $row;

}

function fetchAll($sql){
    $query = mysqli_query(con(),$sql);
    $rows = [];
    while ($row = mysqli_fetch_assoc($query)){
        array_push($rows,$row);
    }
    return $rows;
}

function showTime($timestamp,$format = "d-m-y"){
    return date($format,strtotime($timestamp));
}

function countTotal($table,$condition = 1){
    $sql = "SELECT COUNT(id) FROM $table WHERE $condition";
    $total = fetch($sql);

    return $total["COUNT(id)"];
}

function short($str,$length = 100){
    return substr($str,0,$length)."...";
}

function textFilter($text){
    $text = trim($text);
    $text = htmlentities($text,ENT_QUOTES);
    $text = stripslashes($text);

    return $text;
}

//==============COMMON END===================


//==============AUTH START===================

function register(){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cpassword = $_POST['cpassword'];

    if ($password == $cpassword){
        $sPass = password_hash($password,PASSWORD_DEFAULT);
        $sql = "INSERT INTO users (name,email,password) VALUES ('$name','$email','$sPass')";
        if (runQuery($sql)){
            redirect("login.php");
        }
    }else{
        alert("Password don't match");
    }
}

function login(){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $query = mysqli_query(con(),$sql);
    $row = mysqli_fetch_assoc($query);
    if (!$row){
        return alert("Invalid Email or Password");
    }else{
        if (!password_verify($password,$row['password'])){
            return alert("Invalid Email or Password");
        }else{
            session_start();
            $_SESSION['user'] =$row;
            redirect("dashboard.php");
        }

    }
}

//==============AUTH END==========================
//==============USER START========================

function user($id){
    $sql = "SELECT * FROM users WHERE id=$id";
    return fetch($sql);
}

function users(){
    $sql = "SELECT * FROM users";
    return fetchAll($sql);
}

//==============USER END==========================


//==============CATEGORY START=====================

function categoryAdd(){
    $title = textFilter(strip_tags($_POST['title']));
    $user_id = $_SESSION['user']['id'];
    $sql = "INSERT INTO categories (title,user_id) VALUES ('$title','$user_id')";
    return runQuery($sql);
}

function category($id){
    $sql = "SELECT * FROM categories WHERE id='$id'";
    return fetch($sql);
}

function categories(){
    $sql = "SELECT * FROM categories ORDER BY ordering DESC";
    return fetchAll($sql);
}

function categoryDelete($id){
    $sql = "DELETE FROM categories WHERE id=$id";
    return runQuery($sql);
}

function categoryUpdate(){
    $title = $_POST['title'];
    $id = $_POST['id'];
    $sql = "UPDATE categories SET title='$title' WHERE id=$id";
    return runQuery($sql);
}

function categoryPinToTop($id){
    $sql = "UPDATE categories SET ordering ='0'";
    mysqli_query(con(),$sql);
    $sql = "UPDATE categories SET ordering ='1' WHERE id=$id";
    return runQuery($sql);
}

function categoryRemovePin(){
    $sql = "UPDATE categories SET ordering ='0'";
    return runQuery($sql);
}

function isCategory($id){
    if (category($id)){
        return $id;
    }else{
        die( "category is invalid");
    }
}

//==============CATEGORY END=======================

//==============POST START=========================

function postAdd(){
    $title = textFilter($_POST['title']);
    $description = textFilter($_POST['description']);
    $category_id = isCategory($_POST['category_id']);
    $user_id = $_SESSION['user']['id'];

    $sql = "INSERT INTO posts (title,description,category_id,user_id) VALUES ('$title','$description','$category_id','$user_id')";
    return runQuery($sql);
}

function post($id){
    $sql = "SELECT * FROM posts WHERE id=$id";
    return fetch($sql);
}

function posts(){
    if ($_SESSION['user']['role'] == 2){
        $current_user_id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM posts WHERE user_id=$current_user_id"; // for user
    }else{
        $sql = "SELECT * FROM posts";
    }
    return fetchAll($sql);
}

function postDelete($id){
    $sql = "DELETE FROM posts WHERE id=$id";
    return runQuery($sql);
}

function postUpdate(){
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category_id = $_POST['category_id'];
    $id = $_POST['id'];

    $sql = "UPDATE posts SET title='$title',category_id='$category_id',description='$description'  WHERE id=$id";
    return runQuery($sql);
}

//==============POST END===========================

//==============FRONT PANEL START===========================

function fPosts($orderCol="id",$orderType="DESC"){
    $sql = "SELECT * FROM posts ORDER BY $orderCol $orderType";
    return fetchAll($sql);
}

function fCategories(){
    $sql = "SELECT * FROM categories ORDER BY ordering DESC";
    return fetchAll($sql);
}

function fPostByCat($category_id,$limit="999999",$post_id = 0){
    $sql = "SELECT * FROM posts WHERE category_id = $category_id AND id!=$post_id ORDER BY id DESC LIMIT $limit";
    return fetchAll($sql);
}

function fSearch($searchKey){
    $sql = "SELECT * FROM posts WHERE title LIKE '%$searchKey%' OR description LIKE '%$searchKey%' ORDER BY id DESC";
    return fetchAll($sql);
}

function fSearchByDate($start,$end){
    $sql = "SELECT * FROM posts WHERE created_at BETWEEN '$start' AND '$end' ORDER BY id DESC";
    return fetchAll($sql);
}


//==============FRONT END===========================

//==============VIEWER COUNT START==========================

function viewerRecord($userId,$postId,$device){
    $sql = "INSERT INTO viewers (user_id,post_id,device) VALUES ('$userId','$postId','$device')";
    return runQuery($sql);
}

function viewerCountByPost($postId){
    $sql = "SELECT * FROM viewers WHERE post_id=$postId";
    return fetchAll($sql);
}

function viewerCountByUser($userId){
    $sql = "SELECT * FROM viewers WHERE user_id=$userId";
    return fetchAll($sql);
}

//==============VIEWER COUNT END===========================


//============== ADVERTISEMENT START ========================

function adAdd(){
    $ownerName = $_POST['owner-name'];
    $adPhoto = $_POST['adPhoto'];
    $adLink = $_POST['adLink'];
    $adStart = $_POST['adStart'];
    $adEnd = $_POST['adEnd'];

    $sql = "INSERT INTO ads (owner_name,photo,link,start,end) VALUES ('$ownerName','$adPhoto','$adLink','$adStart','$adEnd')";
    return runQuery($sql);

}

function adShow(){
    $today = date("Y-m-d");
    $sql = "SELECT * FROM ads WHERE start <= '$today' AND end >= '$today'";
//    die($sql);
    return fetchAll($sql);
}

//============== ADVERTISEMENT END===========================
//============== PAYMENT START============================

function payNow(){
    $from = $_SESSION['user']['id'];
    $to = $_POST['to_user'];
    $amount = $_POST['amount'];
    $description = $_POST['description'];

    // from user money update
    $fromUserDetail = user($from);
    $leftMoney = $fromUserDetail['money'] - $amount;
    if ($fromUserDetail['money'] >= $amount){
        $sql = "UPDATE users SET money = '$leftMoney' WHERE id=$from";
        mysqli_query(con(),$sql);

        // to user money update
        $toUserDetail = user($to);
        $newAmount = $toUserDetail['money'] + $amount;
        $sql = "UPDATE users SET money = '$newAmount' WHERE id=$to";
        mysqli_query(con(),$sql);

        // transition record
        $sql = "INSERT INTO transition (from_user,to_user,amount,description) VALUES ('$from','$to','$amount','$description')";
        return runQuery($sql);
    }

}

function transition($id){
    $sql = "SELECT * FROM transition WHERE id='$id'";
    return fetch($sql);
}

function transitions(){
    $userId = $_SESSION['user']['id'];
    if ($_SESSION['user']['role'] == 0){
        $sql = "SELECT * FROM transition";
    }else{
        $sql = "SELECT * FROM transition WHERE from_user='$userId' OR to_user='$userId'";
    }
    return fetchAll($sql);
}

//============== PAYMENT END==============================
//============== DASHBOARD START============================

function dashboardPosts($limit=99999999){
    if ($_SESSION['user']['role'] == 2){
        $current_user_id = $_SESSION['user']['id'];
        $sql = "SELECT * FROM posts WHERE user_id=$current_user_id ORDER BY id DESC LIMIT $limit"; // for user
    }else{
        $sql = "SELECT * FROM posts ORDER BY id DESC LIMIT $limit";
    }
    return fetchAll($sql);
}

//============== DASHBOARD END==============================

