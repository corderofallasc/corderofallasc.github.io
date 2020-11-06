<?php

session_start();
// Comprobar si ya se enviaron los datos.
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $usuario = $_POST['username'];
  $password = $_POST['password'];
  $server =$_POST['server'];
  $connection = ssh2_connect($server, 22);
  ssh2_auth_password($connection, $usuario, $password);

  $stream = ssh2_exec($connection, 'systemctl status apache2');
  stream_set_blocking($stream, true);
  $stream_out = ssh2_fetch_stream($stream, SSH2_STREAM_STDIO);
  echo stream_get_contents($stream_out);
}

require 'views/index.view.php';
