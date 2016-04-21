<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Note extends CI_Model {
  public function all()
  {
    return $this->db->query("SELECT * FROM notes")->result_array();
  }
  public function create_note($title)
  {
    return $this->db->insert("notes", array('title' => $title, 'description' => '', 'created_at' => date("Y-m-d H-i-s"), 'updated_at' => date("Y-m-d H:i:s")));
  }
  public function delete_note($id){
  		$this->db->delete('notes', array('id' => $id));
  }

  public function update_description($id, $description){
  		$this->db->update('notes', array('description' => $description, 'updated_at' => date("Y-m-d H:i:s")), array("id" => $id));
  		return date("Y-m-d H:i:s");
  }
}