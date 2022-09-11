<?php
//any space between thes makes error 
 $dsn = 'mysql:host=localhost;dbname=CloudBook';
 $user = 'MOHAMMED';
 $pass = 'ALC0MNDA&C0M';
 try {
   $db = new PDO($dsn, $user, $pass );
  } catch (PDOException $e ) {
   echo 'faild to Connect to the server';
 }