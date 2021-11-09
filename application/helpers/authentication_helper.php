<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('userCheckAuth')) {

    function userCheckAuth($userId) 
    {

        $CI =& get_instance();
       
        $headers = array();

        $req_dump = print_r(getallheaders(), TRUE);
        $fp = fopen('request.log', 'a');
        fwrite($fp, $req_dump);
        fclose($fp);
        
        foreach (getallheaders() as $name => $value) 
        {
            $headers[$name] = $value;
        }



        if (isset($headers['Authtoken']) && isset($userId)) 
        {
   
            $user = $CI->AM->authentication('tbl_user', array('userId' => $userId, 'authToken' => $headers['Authtoken']));
            if ($user) 
            {
                return $user;
            } 
            else 
            {
                return FALSE;
            }  
        } 
        else 
        {

            return FALSE;
        }
    }

    function keyAuth() 
    {

        $CI =& get_instance();
       
        $headers = array();

        $req_dump = print_r(getallheaders(), TRUE);
        $fp = fopen('request.log', 'a');
        fwrite($fp, $req_dump);
        fclose($fp);
        
        foreach (getallheaders() as $name => $value) 
        {
            $headers[$name] = $value;
        }
 
        if (isset($headers['X-Api-Key'])) 
        {   
            $response = $CI->AM->authentication('tbl_api_key', array('key' => $headers['X-Api-Key']));
            if ($response) 
            {   
                
                return TRUE;
            }
            else
            {                   
                return FALSE;
            }  
        } 
        else 
        {
            return FALSE;
        }
    }
}
