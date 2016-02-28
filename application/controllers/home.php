<?php 
class Home extends CI_Controller{
	function __construct(){
		parent::__construct();
		$this->load->model('tangankita');
	}
public function index(){
	$this->load->view("home");
}
public function artikel(){
$this->load->view("artikel");
}
public function viewartikel(){
$q = $this->db->get('artikel');
echo json_encode($q->result_array());
}
public function insertartikel(){
$data = (array)json_decode(file_get_contents('php://input'));
$val=array(
"judul"=>$data["judul"],
"artikel"=>$data["artikel"]
);
$this->db->insert("artikel",$val);
}
public function hapusartikel(){
$data = (array)json_decode(file_get_contents('php://input'));
for($i=0;$i<count($data["id"]->artikelku);$i++){
$this->db->where("id",$data["id"]->artikelku[$i]);
$this->db->delete("artikel");
}
}
public function editartikel(){
$data = (array)json_decode(file_get_contents('php://input'));
$val=array(
"judul"=>$data["judul"],
"artikel"=>$data["artikel"]
);
$this->db->where("id",$data["id"]);
$this->db->update("artikel",$val);

}
public function event(){
$this->load->view("event");
}
public function lihatevent(){
$q = $this->db->get('event');
echo json_encode($q->result_array());
}
public function insertevent(){
	$this->load->helper('date');
		$date = date('Y-m-d H:i:s');
		$time = date('YmdHis');
		$config['upload_path']          = 'gambarevent/';
        $config['allowed_types']        = 'jpg|png|jpeg|gif';
		$config['file_name'] 			= "F".$time;
		
		$this->load->library('upload', $config);
		 $this->upload->do_upload('foto');
		
			$extendtion = explode(".", $_FILES['foto']['name']);
			$foto_path = "gambarevent/F".$time.".".$extendtion[count($extendtion)-1];
                				//Simpan data ke mysql
   $name = $_FILES['foto']['name'];
   $val=array(
   "judul" => $this->input->post("judul"),
   "event" => $this->input->post("event"),
   "gambar" => $foto_path
   );
   $this->db->insert("event",$val);
}
public function editevent(){
	$this->load->helper('date');
		$date = date('Y-m-d H:i:s');
		$time = date('YmdHis');
		$config['upload_path']          = 'gambarevent/';
        $config['allowed_types']        = 'jpg|png|jpeg|gif';
		$config['file_name'] 			= "F".$time;
		
		$this->load->library('upload', $config);
		 $this->upload->do_upload('foto');
		
			$extendtion = explode(".", $_FILES['foto']['name']);
			$foto_path = "gambarevent/F".$time.".".$extendtion[count($extendtion)-1];
                				//Simpan data ke mysql
   $name = $_FILES['foto']['name'];
   $val=array(
   "judul" => $this->input->post("judul"),
   "event" => $this->input->post("event"),
   "gambar" => $foto_path
   );
   $this->db->where("id",$this->input->post("id"));
   $this->db->update("event",$val);
}
public function hapusevent(){
	$data = (array)json_decode(file_get_contents('php://input'));
for($i=0;$i<count($data["id"]->eventku);$i++){
$this->db->where("id",$data["id"]->eventku[$i]);
$this->db->delete("event");
}
}
public function aboutus(){
	$this->load->view("editor");
	
}
public function ambiledit(){
$q = $this->db->get('edit');
echo json_encode($q->result_array());
}
public function ambileditor(){
$q = $this->tangankita->lihat_editor();
echo json_encode($q);	
}
public function inserteditor(){
	$data = (array)json_decode(file_get_contents('php://input'));
	$val = array(
	"id_edit"=>$data["type"],
	"editor"=>$data["editor"]
	);
	$this->db->insert("editor",$val);
}
};

?>