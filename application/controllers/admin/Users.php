<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	public function index(){
		$data['users'] = $this->User_model->get_list();
		// Load template
		$this->template->load('admin', 'default', 'users/index', $data);
	}

	public function add(){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[4]|matches[password2]');
		$this->form_validation->set_rules('password2', 'Confirm Password', 'trim|required|min_length[6]|matches[password2]');

		if ($this->form_validation->run() == FALSE){
			// Load View Into template
			$this->template->load('admin', 'default', 'users/add');
		} else {
			// Create Page Data Array
			$data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
				'email'			=> $this->input->post('email'),
				'username'		=> $this->input->post('username'),
				'password'		=> md5($this->input->post('password'))
			);

			// Add User
			$this->User_model->add($data);

			// Activity Array
			$data = array(
				'resource_id'	=> $this->db->insert_id(),
				'type'			=> 'user',
				'action'		=> 'added',
				'user_id'		=> 1,
				'message'		=> 'A new user was added ('.$data["username"].')'
			);

			// Add Activity
			$this->Activity_model->add($data);

			// Create Message
			$this->session->set_flashdata('success', 'User has been added.');

			// Redirect to pages
			redirect('admin/users');
		}
	}

	public function edit($id){
		$this->form_validation->set_rules('first_name', 'First Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('last_name', 'Last Name', 'trim|required|min_length[2]');
		$this->form_validation->set_rules('username', 'Username', 'trim|required|min_length[4]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|min_length[7]|valid_email');

		if($this->form_validation->run() == FALSE){
			// Get Current Subject
			$data['item'] = $this->User_model->get($id);
			// Load View Into Template
			$this->template->load('admin', 'default', 'users/edit', $data);
		} else {
			// Create User Data Array
			$data = array(
				'first_name'	=> $this->input->post('first_name'),
				'last_name'		=> $this->input->post('last_name'),
				'email'			=> $this->input->post('email'),
				'username'		=> $this->input->post('username')
			);

			// Update User
			$this->User_model->update($id, $data);

			// Activity Array
			$data = array(
				'resource_id'	=> $this->db->insert_id(),
				'type'			=> 'user',
				'action'		=> 'updated',
				'user_id'		=> 1,
				'message'		=> 'A new user was updated ('.$data["username"].')'
			);

			// Add Activity
			$this->Activity_model->add($data);

			// Create message
			$this->session->set_flashdata('success', 'User has been updated');

			// Redirect to Users
			redirect('admin/users');
		}
	}

	public function delete($id){
		// Get Username
		$username = $this->User_model->get($id)->username;

		// Delete User
		$this->User_model->delete($id);

		// Activity Array
		$data = array(
			'resource_id'	=> $this->db->insert_id(),
			'type'			=> 'user',
			'action'		=> 'deleted',
			'user_id'		=> 1,
			'message'		=> 'User was deleted ('.$data["username"].')'
		);

		// Add Activity
		$this->Activity_model->add($data);

		// Create Message
		$this->session->set_flashdata('success', 'User was Deleted.');

		// Redirect to Subjects
		redirect('admin/users');

	}

	public function login(){

	}

	public function logout(){

	}
}
