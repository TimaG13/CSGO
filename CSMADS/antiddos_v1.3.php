<?php
  $crlf=chr(13).chr(10);
  $itime=3; //Промежуток времени
  $imaxvisit=10; //Максимальное кол-во посещений за указанный промежуток времени.
  $ipenalty=($itime * $imaxvisit);
  $iplogdir="./logs/";
  $iplogfile="AttackersIPs.Log";
  
  $today = date("Y-m-j,G");
  $min = date("i");
  $r = substr(date("i"),0,1);
  $m =  substr(date("i"),1,1);
  $minute = 0;
  
    $to      = 'mr.kirillor@yandex.ru';   //Смените на вашу ПОЧТУ
  $headers = 'From: ANTIDODOS' . "\r\n" .   //  Измените по вашему желанию	   
    		 'ANTIDODOS';
  $subject = "ВНИМАНИЕ! Это похоже на DDOS атаку! @ $today:$min"; // Само сообщение
  
   $message1='<img src="/logs/ddos.png"><br>Данный сайт защищён от DDOS атак!<br>Повторите попытку позже!';
   
    
   // ТУТ НИЧЕГО НЕ ТРОГАТЬ!!!
   
  $ipfile=substr(md5($_SERVER["REMOTE_ADDR"]),-3);
  $oldtime=0;
  if (file_exists($iplogdir.$ipfile)) $oldtime=filemtime($iplogdir.$ipfile);

  $time=time();
  if ($oldtime<$time) $oldtime=$time;
  $newtime=$oldtime+$itime;

  if ($newtime>=$time+$itime*$imaxvisit)
  {
  
    touch($iplogdir.$ipfile,$time+$itime*($imaxvisit-1)+$ipenalty);
    header("HTTP/1.0 503 Service Temporarily Unavailable");
    header("Connection: close");
    header("Content-Type: text/html");
    echo '<html><head><title>BLOCKED!</title></head><body><p align="center"><strong>'
          .$message1.'</strong>'.$br;
    echo $message2.'</p></body></html>'.$crlf;
	
     {
	@mail($to, $subject, $message5, $headers);	
     }
	 
    $fp=@fopen($iplogdir.$iplogfile,"a");
    if ($fp!==FALSE)
    {
      $useragent='<unknown user agent>';
      if (isset($_SERVER["HTTP_USER_AGENT"])) $useragent=$_SERVER["HTTP_USER_AGENT"];
      @fputs($fp,$_SERVER["REMOTE_ADDR"].' on '.date("D, d M Y, H:i:s").' as '.$useragent.$crlf);
    }
    @fclose($fp);
    exit();

  }

  touch($iplogdir.$ipfile,$newtime);