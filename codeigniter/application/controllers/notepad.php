<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Notepad extends CI_Controller {

	public function index(){
		$this->load->view('index');
	}

	public function notes_html(){
		$this->load->model("Note");
		$data['notes'] = $this->Note->all();
		$this->load->view('partial_notes', $data);
	}

	public function create(){
		$this->load->model("Note");
		$this->Note->create_note($this->input->post('title'));
		$data['notes'] = $this->Note->all();
		$this->load->view('partial_notes', $data);
	}

	public function delete(){
		$this->load->model("Note");
		$this->Note->delete_note($this->input->post("id"));
		$data['notes'] = $this->Note->all();
		$this->load->view('partial_notes', $data);
	}

	public function update_description(){
		$this->load->model("Note");
		$updated =  $this->Note->update_description($this->input->post("id"), $this->input->post('description'));
		$this->load->view("updated", array('updated' => $updated));
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */