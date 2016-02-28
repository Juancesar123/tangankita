<?php
class Tangankita extends CI_Model{
	public function lihat_editor(){
		$sql = "SELECT edit.id,editor.id_edit,edit.fitur,editor.editor FROM editor LEFT JOIN edit ON edit.id = editor.id_edit";
		return $this->db->query($sql)->result();
	}
}
?>