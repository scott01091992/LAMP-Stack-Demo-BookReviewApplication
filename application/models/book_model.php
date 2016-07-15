<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Book_model extends CI_Model {

	public function register_user(){
		$result = $this->db->get_where('users', array('email' => $this->input->post('email')))->row_array();
		if($result == null){
			$salt = bin2hex(openssl_random_pseudo_bytes(22));
			$encrypted_password = md5($this->input->post('password')."".$salt);
			$this->db->insert('users', array('name' => $this->input->post('name'), 'alias' => $this->input->post('alias'), 'email' => $this->input->post('email'), 'password' => $encrypted_password, 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'salt' => $salt));
			return true;
		}else{return false;}
	}

	public function delete_review($id){
		$this->db->delete('reviews', array("reviews.id" => $id));
	}

	public function login_user(){
		$result = $this->db->get_where('users', array('email' => $this->input->post('login_email')))->row_array();
		if($result == null){return false;}
		else{
			$encrypted_password = md5($this->input->post('login_password')."".$result['salt']);
			if($result['password'] == $encrypted_password){
				$this->session->set_userdata('current_user', $result['id']);
				$this->session->set_userdata('user_name', $result['name']);
				return true;
			}else{return false;}
		}
	}

	public function post_review($id){
		$this->db->insert('reviews', array('review' => $this->input->post('review'), 'rating' => $this->input->post('rating'), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'users_id' => $this->session->userdata('current_user'), 'books_id' => $id));
	}

	public function get_book_review($id){
		return $this->db->query("SELECT reviews.users_id, books.id as book_id, reviews.review, books.title, books.author, reviews.rating, users.name, reviews.created_at, reviews.id FROM reviews LEFT JOIN users ON reviews.users_id = users.id LEFT JOIN books ON books.id = reviews.books_id WHERE books.id = {$id}")->result_array();
	}

	public function get_user_view($id){
		return $this->db->query("SELECT books.id AS bookid, users.alias, users.name, users.email, reviews.id, books.title FROM books LEFT JOIN reviews ON books.id = reviews.books_id LEFT JOIN users ON reviews.users_id = users.id WHERE users.id = {$id}")->result_array();
	}

	public function load_books_page(){
		return $this->db->query("SELECT books.id AS bookid, users.id AS userid, books.title, reviews.rating, reviews.review, reviews.created_at, users.name
								 FROM books
								 LEFT JOIN reviews
								 ON reviews.books_id = books.id
								 LEFT JOIN users
								 ON reviews.users_id = users.id
								 WHERE books.id = reviews.books_id;")->result_array();

	}

	public function get_authors(){
		return $this->db->query("SELECT author FROM books")->result_array();
	}

	public function add_book(){
		if($this->input->post('list_author') == null && $this->input->post('text_author')){
			return false;
		}
		elseif($this->input->post('text_author') != null){
			$this->db->insert('books', array('title' => $this->input->post('book_title'), 'author' => $this->input->post('text_author'), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'users_id' => $this->session->userdata('current_user')));
			$book = $this->db->get_where('books', array('title' => $this->input->post('book_title')))->row_array();
			$this->db->insert('reviews', array('review' => $this->input->post('review'), 'rating' => $this->input->post('rating'), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'users_id' => $this->session->userdata('current_user'), 'books_id' => $book['id']));
			return true;
		}
		else{
			$this->db->insert('books', array('title' => $this->input->post('book_title'), 'author' => $this->input->post('list_author'), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'users_id' => $this->session->userdata('current_user')));
			$book = $this->db->get_where('books', array('title' => $this->input->post('book_title')))->row_array();
			$this->db->insert('reviews', array('review' => $this->input->post('review'), 'rating' => $this->input->post('rating'), 'created_at' => date("Y-m-d H:i:s"), 'updated_at' => date("Y-m-d H:i:s"), 'users_id' => $this->session->userdata('current_user'), 'books_id' => $book['id']));
			return true;
		}
	}
}
