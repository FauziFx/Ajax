<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Belajar Ajax</title>
</head>
<body>

<p>ini Bagian Atas</p>
<div id="box"></div>
<p>ini Bagian Bawah</p>

<button id="btn">Ambil Data</button>

<script src="jquery-3.1.0.min.js"></script>

<script>
	
	$(document).ready(function(){

		// Method -> load, Post, Get, Ajax
		$('#btn').click(function(){
			// 4. Ajax
			$.ajax({
				url		: 'file.php',
				method	: 'POST',
				data 	: { nama : 'Fauzi'}
			}).done(function(hasil){
				$('#box').html(hasil);
			});
		});

		// 2. Get && 3. Post
		// $.get('file.php', { nama : 'Fauzi' })
		// 	.done(function(data){
		// 		$('#box').html(data);
		// });

		// 1. Load
		// $("#box").load("file.php", function(response, status, xhr){
		// 	if (status === 'success'){
		// 		console.log('Berhasil!');
		// 	}else{
		// 		console.log('Gagal!');
		// 	}
		// });

	});

</script>

<!-- <div id="box"></div>
<input type="text" id="inputText" name="name">
<button id="button">Ambil Data</button>
<button id="button2">Tutup</button>

	<script>
		
		function load_ajax(url, callback){

			var xhr = new XMLHttpRequest();
			xhr.onreadystatechange = cekStatus;

			function cekStatus(){
				if( xhr.readyState === 4 && xhr.status === 200 ){
					callback( xhr.responseText );
				}
			}

			xhr.open('GET', url, true);
			xhr.send();
		}

		document.getElementById('button').onclick = function(){
			text = document.getElementById('inputText').value
			load_ajax('data.php?q=' + text, function(data){
				// console.clear();
				// console.log(data);
				// data = JSON.parse(data);
				document.getElementById('box').innerHTML = data;
				document.getElementById('box').style = "display : block;";
			});
		};

		document.getElementById('button2').onclick = function(){
			// console.clear();
			document.getElementById('box').style = "display : none;";
		};

	</script> -->
	
</body>
</html>