<?php 
	function insert_pembeli($username,$name,$password,$email,$alamat,$city,$telp,$profile)
	{
		echo "string";
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "insert into pembeli values ('','$username','$name', '$password','$email','$alamat','$city','$telp','{$profile}')";
		$query = mysqli_query($conn,$q);
	}
	function insert_penjual($username,$name,$namatoko,$password,$email,$alamat,$city,$telp,$profile)
	{
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "insert into penjual values ('','$username','$namatoko','$name', '$password','$email','$alamat','$city','$telp',0,'{$profile}')";
		$query = mysqli_query($conn,$q);
	}

	function get_all_pembeli()
	{
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "select * from pembeli";
		$query = mysqli_query($conn,$q);
		$data=[];
		while ($row=mysqli_fetch_array($query)) {
			$data[] = $row;
		}
		return $data;
	}
	function get_all_penjual()
	{
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "select * from penjual";
		$query = mysqli_query($conn,$q);
		$data=[];
		while ($row=mysqli_fetch_array($query)) {
			$data[] = $row;
		}
		return $data;
	}
	function get_a_pembeli($username){
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "select * from pembeli where username_user = '$username'";
		$query = mysqli_query($conn,$q);
		$data = [];
		while($row = mysqli_fetch_array($query))
		{
			$data[] = $row;
		}
		return $data;
	}
	function get_a_penjual($username){
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "select * from penjual where username_penjual = '$username'";
		$query = mysqli_query($conn,$q);
		$data = [];
		while($row = mysqli_fetch_array($query))
		{
			$data[] = $row;
		}
		return $data;
	}

	function insert_produk_detail($idpenjual,$idkategori,$nama,$desc,$stock,$harga,$gambar,$berat,$kondisi,$tag)
	{
		$conn = mysqli_connect("localhost","root","","yinyinpedia");
		$q = "insert into produk_detail values ('',$idpenjual,$idkategori,'$nama','$desc',$stock,$harga,'{$gambar}',$berat,'$kondisi','$tag',0,0,0,0,0)";
		$query = mysqli_query($conn,$q);
		
	}
?>