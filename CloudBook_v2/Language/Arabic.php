<?php 
 function lang($word){
   static $lang = array(
     'Home' => 'الصفحة الرئيسية',
     'My Account' => 'صفحتي',
     'Liberary' => 'المكتبة',
     'Settings' => 'الإعدادات',
     'Log out' => 'تسجيل خروج ',
     'Sign In' => 'تسجيل الدخول'
    );
    return $lang[$word];
 }