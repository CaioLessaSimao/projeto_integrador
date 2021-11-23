<?php
  $host = "ec2-35-171-171-27.compute-1.amazonaws.com";
  $user = "hvezuusbcngwia";
  $psswd = "8b3d451222a483b655813fc475c09efb981038b1fbc5c08279031e6587101eb3";
  $db_name = "d5sv9emdjldoo8";
  $connstring = "host=$host port=5432 dbname=$db_name user=$user password=$psswd";

  $conn = pg_connect($connstring) or die("Falha na conexão");
?>