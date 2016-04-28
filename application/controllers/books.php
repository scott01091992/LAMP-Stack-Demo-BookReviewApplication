<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Books extends CI_Controller {

	public function view_index(){

		$this->load->view('index');
	}

	public function view_books(){
		if($this->session->userdata('current_user')){
			$this->load->model("Book_model");
			$data = $this->Book_model->load_books_page();
			$this->load->view('books', array("data" => $data));
		}else{
			redirect('/');
		}
	}

	public function view_add_book(){
		if($this->session->userdata('current_user')){
			$this->load->model("Book_model");
			$authors = $this->Book_model->get_authors();
			$this->load->view('add', array("authors" => $authors));
		}else{
			redirect('/');
		}
	}

	public function view_book($id){
		if($this->session->userdata('current_user')){
			$this->load->model("Book_model");
			$data = $this->Book_model->get_book_review($id);
			$this->load->view("book_review", array('data' => $data));
		}else{
			redirect('/');
		}
	}

	public function view_user($id){
		if($this->session->userdata('current_user')){
			$this->load->model("Book_model");
			$data = $this->Book_model->get_user_view($id);
			$this->load->view('user', array('data' => $data));
		}else{
			redirect('/');
		}
	}

	//back end methods

	public function delete($id){
		$this->load->model("Book_model");
		$this->Book_model->delete_review($id);
		redirect("/books");
	}

	public function post_review($id){
		$this->form_validation->set_rules("review", "review", "required|min_length[5]");
		$this->form_validation->set_rules("rating", "rating", "required");
		if($this->form_validation->run() == false){
			redirect("/book/".$id);
		}else{
			$this->load->model("Book_model");
			$this->Book_model->post_review($id);
			redirect("/book/".$id);
		}
	}

	public function logout(){
		$this->session->sess_destroy();
		redirect('/');
	}

	public function add_book(){
		$this->form_validation->set_rules("book_title", "book_title", "required");
		$this->form_validation->set_rules("review", "review", "required|min_length[12]");
		if($this->form_validation->run() == false){
			$this->load->view('add');
		}else{
			$this->load->model('Book_model');
			$result = $this->Book_model->add_book();
			if($result == false){
				$this->load->view('add');
			}else{
				redirect('books');
			}
		}
	}

	public function register(){
		$this->form_validation->set_rules("name", "name", "required|min_length[2]|max_length[45]");
		$this->form_validation->set_rules("alias", "alias", "required|min_length[2]|max_length[45]");
		$this->form_validation->set_rules("email", "email", "required|valid_email");
		$this->form_validation->set_rules("password", "password", "required|min_length[8]");
		$this->form_validation->set_rules("confirm", "confirm", "required|matches[password]");
		if($this->form_validation->run() == false){
			$this->load->view('index');
		}else{
			$this->load->model('Book_model');
			$result = $this->Book_model->register_user();
			if($result == false){
				$this->session->set_flashdata('fail', "Email already in use");
			}else{
				$this->session->set_flashdata('success', "Successfully registered");
			}
			redirect("/");
		}
	}

	public function login(){
		$this->form_validation->set_rules("login_email", "login_email", "required|valid_email");
		$this->form_validation->set_rules("login_password", "login_password", "required|min_length[8]");
		if($this->form_validation->run() == false){
			$this->load->view('index');
		}else{
			$this->load->model('Book_model');
			$result = $this->Book_model->login_user();
			if($result == false){
				$this->session->set_flashdata('login_fail', "Incorrect Email or Password");
				redirect('/');
			}else{
				redirect('books');
			}
		}
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */