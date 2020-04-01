<?php

  $ini = parse_ini_file('conf.ini', true);

  $opt =
    array
    (
      PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
    );

  $dsn = "{$ini['database']['dialect']}:host={$ini['database']['hostname']};dbname={$ini['database']['schema']";

  $pdo = new PDO($dsn, $ini['database']['username'], $ini['database']['password'], $opt);

  $sql = "SELECT user.id, user.username FROM users WHERE user.username = :username";
  $stmnt = $pdo->prepare($sql);

  $params =
    array
    (
      ':username' => 'mrmoon'
    );

  if($stmnt->execute($params))
  {
    $rows = $stmnt->fetchAll(PDO::FETCH_ASSOC);
  }
  else
  {
    $rows = $stmnt->errorInfo();
  }

  print_r($rows);

  $stmnt = null;
  $pdo = null;

