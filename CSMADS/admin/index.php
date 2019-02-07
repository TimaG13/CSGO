
   <?php

session_start();
include('../steamauth/userInfo.php');
if($steamprofile['steamid'] == '76561198150228791'){
	$_SESSION['adm_login'] = 1;
}
?>
<?php

		if(!isset($_SESSION['adm_login'])){
			
			header("Location: /");
			
			
			?>
			
			
			
	<?php
		}else{

?>

<?php include('head.php'); ?>


<div class="content">
<!-- <middle> -->

	
<?php include('left.php'); ?>

<div class="rightbar" id="rightbar">
<div class="game-number">Статистика</div>
<div class="top-statistics hidden">
			<div class="block"><div id="count-top"><?=$counter?></div>игроков в рейтинге</div>
			<div class="block"><div id="inf10">0</div>макс.выигрыш сегодня</div>
			<div class="block"><div id="inf3">0</div>сегодня уник.игроков</div>
			<div class="block"><div id="inf14">0</div>сегодня игр</div>
		</div>

<div class="copyright">Powered by Steam, a registered trademark of Valve Corporation</div>
</div>
<!-- </middle> -->
<div class="clear"></div>
</div>
</body>
</html>
			<?php
		}
	?>