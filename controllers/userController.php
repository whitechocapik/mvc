<?php


class userController {
    function loginAction(){
        $login= filter_input(INPUT_POST , 'login',FILTER_SANITIZE_EMAIL);
        $password = filter_input(INPUT_POST, 'password' , FILTER_SANITIZE_SPECIAL_CHARS);
       //         var_dump($password);
        $objUser = new user();
        $objUser->setLogin($login);
        $objUser->setPassword($password);
       
        $resultCheck = $this->checkAction($objUser);
     //   die(var_dump($resultCheck));
                
        if($resultCheck){
            $_SESSION['msgStyle'] = 'success';
            $_SESSION['msgTxt'] = 'Vous êtes connecté';
            $_SESSION['connected']= true;
            return 'willkommen';
        }
        $_SESSION['msgStyle'] = 'Danger';
        $_SESSION['msgTxt'] = 'Erreur de login/mot de passe';
                    $_SESSION['connected']= false;
        return $resultCheck;
    }
    function checkAction(user $user){
    return($user->getPassword() == 'toto')?TRUE:FALSE;
    }
    function logoutAction(){
        $_SESSION['connected']=false;
        session_destroy();
        return null;
    }
}
