<?php 

require_once 'database.php';

if(!isset($_SESSION['user'])){
	die('0');
}

if($_POST['type'] == 'insert'){
	$komen = mysqli_real_escape_string($link, $_POST['isi_komen']);
	$query = "INSERT INTO komentar (isi_komentar, id_user) VALUES ('$komen', 1)";

	if(mysqli_query($link, $query)){
		$last_id = mysqli_insert_id($link);
		echo "<div id='komens_". $last_id ."'>
				<p class='komen_text' id='komen_". $last_id ."'>". $komen ."</p>
				<button type='button' class='hapus' data-id='". $last_id ."'> Hapus </button>
				<button type='button' class='edit' data-id='". $last_id ."'> edit </button>
				</div>";
	}else{
		echo "error!";
	}
}

if($_POST['type'] == 'delete'){
	$query = "DELETE FROM komentar WHERE id=".$_POST['id_komen'];
	if(mysqli_query($link, $query)){
		echo "1";
	}else{
		echo "-1";
	}
}

if($_POST['type'] == 'update'){

	$query = "UPDATE komentar SET id_user=1, isi_komentar='".$_POST['isi_komen']."' WHERE id=".$_POST['id_komen'];
	if(mysqli_query($link, $query)){
		echo "1";
	}else{
		echo "-1";
	}

}

?>