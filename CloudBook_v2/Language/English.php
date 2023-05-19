<?php 
 function lang($word){
   static $lang = array(
     'Home' => 'Home',
     'My Account' => 'My Account',
     'Liberary' => 'Liberary',
     'Settings' => 'Settings',
     'Log out' => 'Log out ',
       'Sign In' => 'Sign In'
    );
    return $lang[$word];
 }