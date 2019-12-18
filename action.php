<?php
	session_start();
	$conn = mysqli_connect("localhost","root","","yinyinpedia");
	function disc($id)
	{
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		echo "<h4>Product Discussion</h4>";
			$sql = "select * from diskusi";
			$query = mysqli_query($conn, $sql);
			foreach ($query as $row) {
				if ($row["id_produk"] == $id && $row["id_parent"] == 0){
					echo "<div style='border : 1px solid black'>";
						if ($row["tipe"] == 1){
							$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
							foreach ($query2 as $row2){
								if ($row2["id_user"] == $row["id_user"]){
									echo "<div> <b>".$row2["nama_user"]."</b> </div>";
								}
							}
						}
						if ($row["tipe"] == 2){
							$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
							foreach ($query2 as $row2) {
								if ($row2["id_penjual"] == $row["id_user"]){
									echo "<div> <b>".$row2["nama_toko"]."</b> </div>";
								}
							}
						}
						echo "<div>".$row["isi"]."</div>";
						echo "<input type='text' class='form-control'  style='width:50%' name='diskusi' id='diskusi".$row['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
						echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah(".$row['id_diskusi'].")'> Send </button>";
						$sql3 = "select * from diskusi"; $query3 = mysqli_query($conn, $sql3);
						foreach ($query3 as $row3) {
							if ($row3["id_produk"] == $id && $row3["id_parent"] == $row["id_diskusi"]) {
								echo "<div style='background-color:#D9DEDC; text-align:right'>";
								echo "<br>";
								if ($row3["tipe"] == 1){
									$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
									foreach ($query2 as $row2){
										if ($row2["id_user"] == $row3["id_user"]){
											echo "<div> <b>".$row2["nama_user"]."</b> </div>";
										}
									}
								}
								if ($row3["tipe"] == 2){
									$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
									foreach ($query2 as $row2) {
										if ($row2["id_penjual"] == $row3["id_user"]){
											echo "<div style='color:#1E2971'> <b>".$row2["nama_toko"]."</b> </div>";
										}
									}
								}
								echo "<div>".$row3["isi"]."</div>";
								echo "<input type='text' class='form-control' style='width:50%; margin-left:50%;' name='diskusi' id='diskusiW".$row3['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
								echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah3(".$row3['id_diskusi'].", ".$row['id_diskusi'].")'> Send </button>";
							echo "</div>";
							}
						}
					echo "</div>"."<br>";
				}
			}
			echo "<h5>New Question</h5>";
			echo "<input type='text' class='form-control' name='diskusi2' id='diskusiZ' placeholder='Post Your Question Here'> <br>";
			echo "<button class='btn btn-main text-center' name='send2' onclick='tambah2(".$id.")'> Send </button>";
			echo "<script>
		    	function tambah(id) {
		    		nama = '#diskusi' + id;
		    		isi = $(nama).val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		id3 = ".$id.";
		    		$.get(
		    			'action.php',
		    			{
		    				action:3,
		    				id:iduser,
		    				id2:id,
		    				id3:id3,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
		    	</script>";
		    echo "<script>
		    	function tambah2(id) {
		    		isi = $('#diskusiZ').val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		$.get(
		    			'action.php',
		    			{
		    				action:2,
		    				id:iduser,
		    				id2:id,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
		    	</script>";
		    echo "<script>
		    	function tambah3(id, id4) {
		    		nama = '#diskusiW' + id;
		    		isi = $(nama).val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		id3 = ".$id.";
		    		$.get(
		    			'action.php',
		    			{
		    				action:3,
		    				id:iduser,
		    				id2:id4,
		    				id3:id3,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
    		</script>";
	}
	function disc2($id)
	{
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		echo "<h4>Product Discussion</h4>";
		$sql = "select * from diskusi";
		$query = mysqli_query($conn, $sql);
		foreach ($query as $row) {
			if ($row["id_produk"] == $id && $row["id_parent"] == 0){
				echo "<div style='border : 1px solid black'>";
					if ($row["tipe"] == 1){
						$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
						foreach ($query2 as $row2){
							if ($row2["id_user"] == $row["id_user"]){
								echo "<div> <b>".$row2["nama_user"]."</b> </div>";
							}
						}
					}
					if ($row["tipe"] == 2){
						$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
						foreach ($query2 as $row2) {
							if ($row2["id_penjual"] == $row["id_user"]){
								echo "<div> <b>".$row2["nama_toko"]."</b> </div>";
							}
						}
					}
					echo "<div>".$row["isi"]."</div>";
					echo "<input type='text' class='form-control'  style='width:50%' name='diskusi' id='diskusi".$row['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
					echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah(".$row["id_diskusi"].")'> Send </button>";
					$sql3 = "select * from diskusi"; $query3 = mysqli_query($conn, $sql3);
					foreach ($query3 as $row3) {
						if ($row3["id_produk"] == $id && $row3["id_parent"] == $row["id_diskusi"]) {
							echo "<div style='background-color:#D9DEDC; text-align:right'>";
							echo "<br>";
							if ($row3["tipe"] == 1){
								$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
								foreach ($query2 as $row2){
									if ($row2["id_user"] == $row3["id_user"]){
										echo "<div> <b>".$row2["nama_user"]."</b> </div>";
									}
								}
							}
							if ($row3["tipe"] == 2){
								$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
								foreach ($query2 as $row2) {
									if ($row2["id_penjual"] == $row3["id_user"]){
										echo "<div style='color:#1E2971'> <b>".$row2["nama_toko"]."</b> </div>";
									}
								}
							}
							echo "<div>".$row3["isi"]."</div>";
							echo "<input type='text' class='form-control' style='width:50%; margin-left:50%;' name='diskusi' id='diskusiW".$row3['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
							echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah3(".$row3["id_diskusi"].", ".$row["id_diskusi"].")'> Send </button>";
						echo "</div>";
						}
					}
				echo "</div>"."<br>";
			}
		}
		echo "<script>
	    	function tambah(id) {
	    		nama = '#diskusi' + id;
	    		isi = $(nama).val();
	    		iduser = ".$_SESSION['id'].";
	    		isi2 = isi.replace(/ /g, '-');
	    		id3 = ".$id.";
	    		$.get(
	    			'action.php',
	    			{
	    				action:5,
	    				id:iduser,
	    				id2:id,
	    				id3:id3,
	    				isi:isi2
	    			},
	    			function(data){
						$('#details').html(data);
	    			}
	    		);
	    		alert('Message Sent');
	    	}
	    	</script>";
	    echo "<script>
	    	function tambah3(id, id4) {
	    		nama = '#diskusiW' + id;
	    		isi = $(nama).val();
	    		iduser = ".$_SESSION['id'].";
	    		isi2 = isi.replace(/ /g, '-');
	    		id3 = ".$id.";
	    		$.get(
	    			'action.php',
	    			{
	    				action:5,
	    				id:iduser,
	    				id2:id4,
	    				id3:id3,
	    				isi:isi2
	    			},
	    			function(data){
						$('#details').html(data);
	    			}
	    		);
	    		alert('Message Sent');
	    	}
		</script>";
	}
	if (isset($_GET["action"])) {
		$action  = $_GET["action"]; 
		$id  = $_GET["id"];
		if ($action == 1) {
			$sql = "update produk_detail set status = 1  where id_produk = $id"; 
			$query = mysqli_query($conn, $sql);
		}
		else if ($action == 2) {
			$id2  = $_GET["id2"];
			$isi  = $_GET["isi"];
			if ($isi != "") {
				$isi = str_replace('-', ' ', $isi);
				$date = date("y-m-d h:i:sa");
				$sql = "insert into diskusi values('',0,1,$id,$id2,'$date','$isi')";
				$query = mysqli_query($conn, $sql);
			}
			disc($id2);
		}
		else if ($action == 3) {
			$id2  = $_GET["id2"];
			$id3  = $_GET["id3"];
			$isi  = $_GET["isi"];
			if ($isi != "") {
				$isi = str_replace('-', ' ', $isi);
				$date = date("y-m-d h:i:sa");
				$sql = "insert into diskusi values('',$id2,1,$id,$id3,'$date','$isi')";
				$query = mysqli_query($conn, $sql);
			}
			disc($id3);
		}
		else if ($action == 4) {
			echo "<h4>Product Discussion</h4>";
			$sql = "select * from diskusi";
			$query = mysqli_query($conn, $sql);
			foreach ($query as $row) {
				if ($row["id_produk"] == $id && $row["id_parent"] == 0){
					echo "<div style='border : 1px solid black'>";
						if ($row["tipe"] == 1){
							$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
							foreach ($query2 as $row2){
								if ($row2["id_user"] == $row["id_user"]){
									echo "<div> <b>".$row2["nama_user"]."</b> </div>";
								}
							}
						}
						if ($row["tipe"] == 2){
							$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
							foreach ($query2 as $row2) {
								if ($row2["id_penjual"] == $row["id_user"]){
									echo "<div> <b>".$row2["nama_toko"]."</b> </div>";
								}
							}
						}
						echo "<div>".$row["isi"]."</div>";
						echo "<input type='text' class='form-control' style='width:50%' name='diskusi' id='diskusi".$row['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
						echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah(".$row['id_diskusi'].")'> Send </button>";
						$sql3 = "select * from diskusi"; $query3 = mysqli_query($conn, $sql3);
						foreach ($query3 as $row3) {
							if ($row3["id_produk"] == $id && $row3["id_parent"] == $row["id_diskusi"]) {
								echo "<div style='background-color:#D9DEDC; text-align:right'>";
								echo"<br>";
								if ($row3["tipe"] == 1){
									$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
									foreach ($query2 as $row2){
										if ($row2["id_user"] == $row3["id_user"]){
											echo "<div> <b>".$row2["nama_user"]."</b> </div>";
										}
									}
								}
								if ($row3["tipe"] == 2){
									$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
									foreach ($query2 as $row2) {
										if ($row2["id_penjual"] == $row3["id_user"]){
											echo "<div style='color:#1E2971'> <b>".$row2["nama_toko"]."</b> </div>";
										}
									}
								}
								echo "<div>".$row3["isi"]."</div>";
								echo "<input type='text' class='form-control' style='width:50%; margin-left:50%;' name='diskusi' id='diskusiW".$row3['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
								echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah3(".$row3['id_diskusi'].", ".$row['id_diskusi'].")'> Send </button>";
							echo "</div>";
							}
						}
					echo "</div>"."<br>";
				}
			}
			echo "<h5>New Question</h5>";
			echo "<input type='text' class='form-control' name='diskusi2' id='diskusiZ' placeholder='Post Your Question Here'> <br>";
			echo "<button class='btn btn-main text-center' name='send2' onclick='tambah2(".$id.")'> Send </button>";
			echo "<script>
		    	function tambah(id) {
		    		nama = '#diskusi' + id;
		    		isi = $(nama).val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		id3 = ".$id.";
		    		$.get(
		    			'action.php',
		    			{
		    				action:3,
		    				id:iduser,
		    				id2:id,
		    				id3:id3,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
		    	</script>";
		    echo "<script>
		    	function tambah2(id) {
		    		isi = $('#diskusiZ').val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		$.get(
		    			'action.php',
		    			{
		    				action:2,
		    				id:iduser,
		    				id2:id,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
		    	</script>";
		    echo "<script>
		    	function tambah3(id, id4) {
		    		nama = '#diskusiW' + id;
		    		isi = $(nama).val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		id3 = ".$id.";
		    		$.get(
		    			'action.php',
		    			{
		    				action:3,
		    				id:iduser,
		    				id2:id4,
		    				id3:id3,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
    		</script>";

		}
		else if ($action == 5) {
			$id2  = $_GET["id2"];
			$id3  = $_GET["id3"];
			$isi  = $_GET["isi"];
			if ($isi != "") {
				$isi = str_replace('-', ' ', $isi);
				$date = date("y-m-d h:i:sa");
				$sql = "insert into diskusi values('',$id2,2,$id,$id3,'$date','$isi')";
				$query = mysqli_query($conn, $sql);
			}
			disc2($id3);
		}
		else if ($action == 7) {
			echo "<h4>Product Discussion</h4>";
			$sql = "select * from diskusi";
			$query = mysqli_query($conn, $sql);
			foreach ($query as $row) {
				if ($row["id_produk"] == $id && $row["id_parent"] == 0){
					echo "<div style='border : 1px solid black'>";
						if ($row["tipe"] == 1){
							$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
							foreach ($query2 as $row2){
								if ($row2["id_user"] == $row["id_user"]){
									echo "<div> <b>".$row2["nama_user"]."</b> </div>";
								}
							}
						}
						if ($row["tipe"] == 2){
							$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
							foreach ($query2 as $row2) {
								if ($row2["id_penjual"] == $row["id_user"]){
									echo "<div> <b>".$row2["nama_toko"]."</b> </div>";
								}
							}
						}
						echo "<div>".$row["isi"]."</div>";
						echo "<input type='text' class='form-control'  style='width:50%' name='diskusi' id='diskusi".$row['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
						echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah(".$row["id_diskusi"].")'> Send </button>";
						$sql3 = "select * from diskusi"; $query3 = mysqli_query($conn, $sql3);
						foreach ($query3 as $row3) {
							if ($row3["id_produk"] == $id && $row3["id_parent"] == $row["id_diskusi"]) {
								echo "<div style='background-color:#D9DEDC; text-align:right'>";
								echo "<br>";
								if ($row3["tipe"] == 1){
									$sql2 = "select * from pembeli"; $query2 = mysqli_query($conn, $sql2);
									foreach ($query2 as $row2){
										if ($row2["id_user"] == $row3["id_user"]){
											echo "<div> <b>".$row2["nama_user"]."</b></div>";
										}
									}
								}
								if ($row3["tipe"] == 2){
									$sql2 = "select * from penjual"; $query2 = mysqli_query($conn, $sql2);
									foreach ($query2 as $row2) {
										if ($row2["id_penjual"] == $row3["id_user"]){
											echo "<div style='color:#1E2971'> <b>".$row2["nama_toko"]."</b> </div>";
										}
									}
								}
								echo "<div>".$row3["isi"]."</div>";
								echo "<input type='text' class='form-control' style='width:50%; margin-left:50%;' name='diskusi' id='diskusiW".$row3['id_diskusi']."' placeholder='Post Your Question Here'>"."<br>";
								echo "<button type='submit' class='btn btn-main text-center' name='send' onclick='tambah3(".$row3["id_diskusi"].", ".$row["id_diskusi"].")'> Send </button>";
							echo "</div>";
							}
						}
					echo "</div>"."<br>";
				}
			}
			echo "<script>
		    	function tambah(id) {
		    		nama = '#diskusi' + id;
		    		isi = $(nama).val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		id3 = ".$id.";
		    		$.get(
		    			'action.php',
		    			{
		    				action:5,
		    				id:iduser,
		    				id2:id,
		    				id3:id3,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
		    	</script>";
		    echo "<script>
		    	function tambah3(id, id4) {
		    		nama = '#diskusiW' + id;
		    		isi = $(nama).val();
		    		iduser = ".$_SESSION['id'].";
		    		isi2 = isi.replace(/ /g, '-');
		    		id3 = ".$id.";
		    		$.get(
		    			'action.php',
		    			{
		    				action:5,
		    				id:iduser,
		    				id2:id4,
		    				id3:id3,
		    				isi:isi2
		    			},
		    			function(data){
							$('#details').html(data);
		    			}
		    		);
		    		alert('Message Sent');
		    	}
    		</script>";
		}
	}
?>