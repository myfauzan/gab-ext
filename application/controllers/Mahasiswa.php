<?php
defined('BASEPATH') OR exit('No direct script access allowed');


require APPPATH."libraries/Server.php";
class Mahasiswa extends Server {

	// buat construct
	public function __construct()
        {
			parent::__construct();
                // panggil model "Mmahasiswa"
				$this->load->model("Mmahasiswa","mdl",TRUE);
        }

	// buat fungsi "GET"
	function service_get()
	{
		// panggil fungsi "get_data"
		$hasil = $this->mdl->get_data();

		// memberikan response
		$this->response(array("mahasiswa" => $hasil),200);

	}

	function service_post()
	{
		
		// ambil parameter data
		$data = array (
			"npm" => $this->post("npm"),
			"nama" => $this->post("nama"),
			"telepon" => $this->post("telepon"),
			"jurusan" => $this->post("jurusan"),
			"token" => $this->post("npm"),
		);

		// $data["npm"] = $this->post("npm");
		// $data["nama"] = $this->post("nama");

		// $npm = $this->post("npm");
		// $nama = $this->post("nama");

		// panggil fungsi "save_data"
		$hasil = $this->mdl->save_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], base64_encode($data["token"]));

		// jika proses post berhasil
		if ($hasil == 0)
		{
			$this->response(array("status" => "Data Mahasiswa Berhasil Disimpan . . ."),200);
		}
		
		// jika proses post gagal
		else
		{
			$this->response(array("status" => "Data Mahasiswa Gagal Disimpan !"),200);
		}
	}

	function service_put()
	{
		
		// ambil parameter data
		$data = array (
			"npm" => $this->put("npm"),
			"nama" => $this->put("nama"),
			"telepon" => $this->put("telepon"),
			"jurusan" => $this->put("jurusan"),
			"token" => base64_encode($this->put("token")),
		);

		// panggil fungsi "update_data"
		$hasil = $this->mdl->update_data($data["npm"], $data["nama"], $data["telepon"], $data["jurusan"], $data["token"]);

		// jika proses update berhasil
		if ($hasil == 0)
		{
			$this->response(array("status" => "Data Mahasiswa Berhasil Diupdate . . ."),200);
		}
		
		// jika proses update gagal
		else
		{
			$this->response(array("status" => "Data Mahasiswa Gagal Diupdate !"),200);
		}
	}

	function service_delete()
	{
		
		// ambil parameter token "(npm)"
		$token = $this->delete("npm");

		// panggil fungsi "delete_data"
		$hasil = $this->mdl->delete_data(base64_encode($token));

		// jika proses delete berhasil
		if ($hasil == 1)
		{
			$this->response(array("status" => "Data Mahasiswa Berhasil Dihapus"),200);
		}
		
		// jika proses delete gagal
		else
		{
			$this->response(array("status" => "Data Mahasiswa Gagal Dihapus !"),200);
		}
	}
	
}
