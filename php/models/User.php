<?php

use Base\User as BaseUser;

/**
 * Skeleton subclass for representing a row from the 'user' table.
 *
 * 
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 */
class User extends BaseUser
{
    function register($username,$company,$email,$password,$repeated_password) {
        
        /*Verifica che i campi non siano vuoti, altrimenti ritorna un codice d'errore*/
        foreach(func_get_args() as $arg)
            if(empty($arg))
                return 0;
        
        /*Verifica che l'username non sia già stato utilizzato, altrimenti ritorna un codice d'errore*/
        $u = UserQuery::create()->findOneByUsername($username);
        if ($u != null)
            return -3;
        
        /*Verifica che le passwords combacino, altrimenti ritorna un codice d'errore*/
        if (strcmp($password,$repeated_password) != 0 )
            return -1;
        
        /*Verifica l'inserimento di una mail valida, altrimenti ritorna un codice d'errore*/
        if(!checkValidEmail($email))
            return -2;

        $this->setUsername($username);
        $this->setCompany($company);
        $this->setEmail($email);
        $this->setPassword(password_hash($password,PASSWORD_BCRYPT));
        $this->setCompany($company);
        try {
            $this->save();
        } catch(Exception $e){
            return -4;
        }
        return 1;
    }
    
    static function login($username, $password) {
        //find user with specified username from databse
        $u = UserQuery::create()->findOneByUsername($username);
        if ($u == false) {
            return false;
        }
        else {
            return password_verify($password,$u->getPassword());            
        }
    }
}
