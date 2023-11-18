<style>
#content{
	background-color: none;
}

#window{
	background-color: gray;
	margin: 0 auto;
	width: 200px;
	padding: 5px;
	border-radius: 5px;
	margin-top: 5px;
}

#window-description{
	margin: 0 auto;
	width: 400px;
	color: whitesmoke;
	font-family: "Lucida Console", "Courier New", monospace;
	font-size: 12px;
}

body{
	background-color: #212121;
	font-family: "Lucida Console", "Courier New", monospace;
}

img{
	border-radius: 50%;
}

a{
	text-decoration: none;
	color: whitesmoke;
}

a:hover{
	text-decoration: underline;
	color: white;
}

body {
  background: linear-gradient(#000, #151515);
}

canvas {
  display: block;
  z-index: -1;
  position: fixed;  
}
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<canvas id="canvas"></canvas>
<script src='thunder.js'></script>

<div id='content'>
	<div>
		<center><img src='Healer.gif' width ='100' height="100"/></center>
	</div>
	<div id='window'>
		<p>
			<center style='color: whitesmoke; text-shadow: 1px 1px black; font-weight: bold;'>Wp Wizard</center>
		</p>
		<ul>
			<li><a href="viewer.php">viewer</a></li>
			<li><a href="scanerVT.php">scanVt</a></li>
			<li><a href="scanVtPlugins.php">scanVtPlugins</a></li>
			<li><a href="scanVtPluginsNoZip.php">scanVtPluginsNoZip</a></li>
			<li><a href="scanVtThemes.php">scanVtThemes</a></li>
			<li><a href="scanUploads.php">scanUploads</a></li>
			<li><a href="scanUploads2.php">scanUploads2</a></li>
			<li><a href="scanVtNotIdentifed.php">scanVtNotIdentifed</a></li>
			</br>
			<li><a href="listPlugins.php">listPlugins</a></li>
			<li><a href="scanPossible.php">scanPossible</a></li>
			<li><a href="scanPrivelages.php">scanPrivelages</a></li>
			<li><a href="manipulatePath.php">manipulatePath</a></li>
			<li><a href="scanDangFunc.php">scanDange</a></li>
			<li><a href="scanChange.php">scanChange</a></li>
			<li><a href="showLoggs.php">showLoggs</a></li>
		</ul>
	</div>
	<div id='window-description'>
		<p><center>Wp Wizard</center></p>
		<p><center>Pomoże ci oczyścić twój wordpress.</center></p>
		<ul>
			<li> 1. Zrób backup bazy danych.</li>
			<li> 2. Zrób backup strony.</li>
			<li> 3. Pobierz nowy wordpress.</li>
			<li> 4. Pobierz świeże wtyczki.</li>
			<li> 5. Pobierz świeże tematy.</li>
			<li> 6. Oczyść uploads z plików wykonywalnych i podejrzanych.</li>
			<li> 7. Oczyść pliki, foldery które skopiowałeś z za infekowanej wersji.</li>
			<li> 8. Zapakuj wszystko do nowo utworzonego czystego projektu.</li>
			<li> 8. Przywróć właściwe uprawnienia.</li>
			<li> 9. Zainstaluj WAF i scanner.</li>
			<li>10. Przejrzyj foldery nadrzędne przy pomocy ssh i ftp je też oczyść.</li>
			<li>11. Oczyczaj, aż skaner remonowanego producenta nie uzna strony za czystą.</li>
			<li>12. Wyszlifuj plik .htaccess manipulując ścieżkami "manipulatePath".</li>
			<li>13. Zrób "scanChange" kilka razy po wgraniu projektu i przy kolejnym ataku też, a następnie przejrzyj logi.</li>
			<li>14. Zabezpiecz strone dodatkowo badając źródła poprzedniego ataku.</li>
		</ul>
	</div>
</div>