<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Crud Ajax</title>
	<script src="../jquery-3.1.0.min.js"></script>
	<style>
		
		*{
			font-family: sans-serif;
		}

		body{
			width: 80%; margin: 10% auto;
		}
		
		.hapus{
			background: red; color: white;
		}

		.edit{
			background: green; color: white;
		}

		.simpan{
			background: blue; color: white;
		}

	</style>
</head>
<body>
	
	<h1> Ini Judul Artikel </h1>
	<p>
		Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ratione, culpa fugit doloribus deserunt. Deserunt in consectetur dicta officia accusamus neque pariatur iusto ratione dolorum repudiandae autem laboriosam, fugiat tenetur possimus!
	</p>

	<textarea name="textarea_komen" id="textarea_komen" cols="40" rows="8"></textarea><br>
	<input type="submit" name="submit_komen" id="submit_komen">

	<div id="komentar_wrapper">
		
		<?php  

			require_once 'database.php';
			$query = "SELECT * FROM komentar";
			$comments = mysqli_query($link, $query);

			foreach ($comments as $comment) { ?>
				<div id="komens_<?=$comment['id'] ?>">
					<p class="komen_text" id="komen_<?=$comment['id'] ?>" data-id="<?=$comment['id'] ?>">
						<?=$comment['isi_komentar'] ?>
					</p>
						<button type="button" class="hapus" data-id="<?=$comment['id'] ?>"> Hapus </button>
						<button type="button" class="edit" data-id="<?=$comment['id'] ?>"> Edit </button>
				</div>

		<?php } ?>

	</div>
	
	
	<script>
		
		$('#submit_komen').on('click', function(){
			var isi = $('#textarea_komen').val();
			$.ajax({
				method : 'POST',
				url    : 'komen_ajax.php',
				data   : { isi_komen : isi, type: 'insert'},
				success: function(data){
					if(data == '0'){
						alert('Login dulu Gan!!');
					}else{
						$('#textarea_komen').val('');
						$('#komentar_wrapper').append(data);
					}
				}
			});
		});

		$(document).on('click', '.hapus', function(){
			var id = $(this).attr('data-id');
			$.ajax({
				method : 'POST',
				url    : 'komen_ajax.php',
				data   : { id_komen : id, type: 'delete'},
				success: function(data){
					if(data == '0'){
						alert('Login dulu Gan!!');
					}else if(data == '1'){
						$('#komens_'+id).fadeOut();
					}else if(data == '-1'){
						alert('Error!!');
					}
				}
			});
		});

		$(document).on('click', '.edit', function(){
			var id = $(this).attr('data-id');
			var textbox = $(document.createElement('textarea')).attr({
									'id': 'komen_'+id, 
									'autofocus' : '',
									'style': 'display:block; margin:10px 0;'
								});
			var btn = $(document.createElement('button')).attr({
								'class' : 'simpan',
								'data-id' : id
							})
			btn.text('Simpan');
			$('#komen_'+id).replaceWith(textbox);
			$(this).replaceWith(btn);


		});

		$(document).on('click', '.simpan', function(){
			var id = $(this).attr('data-id');
			var isi = $('#komen_'+id).val();
			var text = $(document.createElement('p')).attr({
									'id': 'komen_'+id,
									'class': 'komen_text',
									'data-id': id
								}).text(isi);
			var btn = $(document.createElement('button')).attr({
								'class' : 'edit',
								'data-id' : id
							})
			btn.text('Edit');

			$.ajax({
				method : 'POST',
				url    : 'komen_ajax.php',
				data   : { isi_komen : isi, id_komen: id, type: 'update'},
				success: function(data){
					console.log(data);
					if(data == '0'){
						alert('Login dulu Gan!!');
					}else if(data == '1'){
						$('#komen_'+id).replaceWith(text);
					}
				}
			});
			$(this).replaceWith(btn);

		});

	</script>


</body>
</html>