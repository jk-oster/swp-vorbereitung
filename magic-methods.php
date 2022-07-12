<?php

$user = new MagicModel();
echo $user;
echo $user->toString();
$user->id = 1;
$user->email = 'admin@example.com';
$user->password = 'password';
$user->username = "Sepp";
$user->setEmail("user@example.com");
$user->getEmail();
isset($user->email);
MagicModel::getEmail();
echo $user;



