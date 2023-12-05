<?php

use Symfony\Component\Mime\Message;

defined("ROOT_PATH") or die("<div style = '  margin: -5px; padding: 40px 30px; color: red; font-size: 50px;'> access denide!!</div>");

function logOut(){
    unset($_SESSION['login']);
}
function getLoggedInUser(){

    return $_SESSION['login'] ?? null;
}

function isLoggedIn(){
    return isset($_SESSION['login'])? true : false;
}


function register($userData){
    global $pdo;
    if((validation($userData)) == null){
        $passHash = password_hash($userData['password'],PASSWORD_BCRYPT); // Password hashing
        $sql = "INSERT INTO users (name,email,password) VALUES(:uName,:email,:password);";
        $stmt = $pdo->prepare($sql);
        $stmt ->execute([':uName'=>$userData['username'],'email'=>$userData['email'],'password' =>$passHash]);
       return 1 ;
    
    }else{
        return (validation($userData));
    }
    
}

function getUserByEmail($email){
    global $pdo;
    $sql = "SELECT * FROM users WHERE email = :email ";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email'=>$email]);
    $records = $stmt->fetchAll(PDO::FETCH_OBJ);
    $records[0]->image = "https://www.gravatar.com/avatar/" . md5( strtolower( trim($records[0]->email))); // use gravatar for email
    return $records[0];

    // because of email  that  defined unique in db, this line just return one object
    
}

function login($email,$password){
   $user = getUserByEmail($email);
   //dd($user);
    if(empty($user)){
        return false;
    }
        # CHECK PASSWORD IS CORRECT
    if(password_verify($password,$user->password)){
    //$user->image =  "https://www.gravatar.com/avatar/" . md5( strtolower( trim($user->email)));
    $_SESSION['login'] = $user;
    return true;
    }

}

# validation for user name , email, password

function testInput($data){
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
function validation($formData){ // validate for form data 
     $usernameErr = $passwordErr = $emailErr = '';
     $userName = $password = $email = '';
        //validate userName
        // if(empty($userName)){
        //     $usernameErr = 'YOU FOROGT TO ENTER YOUR USERNAME :)';
        //     return $usernameErr;
        // }else{
        //     $userName = testInput($userName);
        // }
        //validate password
        if(!empty($formData['password'])){
            $password = testInput($formData['password']);
            if(strlen($password) <= '8'){
                $passwordErr = "YOUR PASSWORD SHOULD BE BIGGER THAN 8 CHARCACTERS!!";   
            }elseif(!preg_match("#[0-9]+#",$password)){ // The preg_match() function searches a string for pattern, returning true if the pattern exists, and false otherwise.
                $passwordErr = 'YOUR PASSWORD MUST CONTAIN AT LEAST 1 NUMBER!';
            } elseif(!preg_match("#[A_Z]+#",$password)){
                $passwordErr = "YOUR PASSWORD MUST CONTAIN AT LEAST 1 CAPITAL LETTER!";
            }elseif(!preg_match("#[a-z]+#",$password)){
                $passwordErr = "YOUR PASSWORD MUST CONTAIN  AT LEAST 1 lowercase LETTER!";
            }
            return $passwordErr;
        }

        // //validatate email
        // if(is_null($email)){
        //     $emailErr = "YOUR FORGOT TO ENTER YOUR EMAIL!";
        //     }else{
        //         $email = testInput($email);
        //         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        //             $emailErr = "You Entered An Invalid Email Format";   
        //         }
        //     }
        //     return $emailErr;

     

}