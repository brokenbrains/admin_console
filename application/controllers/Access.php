<?php
defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' );
class Access extends MY_Controller {
	public function __construct() {
		parent::__construct ();
		
		// Force SSL
		// $this->force_ssl();
		
		// Form and URL helpers always loaded (just for convenience)
		$this->load->helper ( 'url' );
		$this->load->helper ( 'form' );
	}
	public function index() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			
			// echo '<div class="span10" id="content"><p>You are logged in!</p></div>';
			echo $this->load->view ( 'manager/user_management', '', TRUE );
			
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function home() {
		$this->is_logged_in ();
		
		echo $this->load->view ( 'examples/page_header', '', TRUE );
		
		echo '<p>Welcome Home</p>';
		
		echo $this->load->view ( 'examples/page_footer', '', TRUE );
	}
	public function create_user() {
		// Customize this array for your user
		$user_data = [ 
				'username' => 'brokenbrains',
				'passwd' => 'GEN2brains',
				'email' => 'broken@brokenbrains.com',
				'auth_level' => '9' 
		] // 9 if you want to login @ examples/index.
;
		
		$this->is_logged_in ();
		
		echo $this->load->view ( 'examples/page_header', '', TRUE );
		
		// Load resources
		$this->load->model ( 'examples_model' );
		$this->load->model ( 'validation_callables' );
		$this->load->library ( 'form_validation' );
		
		$this->form_validation->set_data ( $user_data );
		
		$validation_rules = [ 
				[ 
						'field' => 'username',
						'label' => 'username',
						'rules' => 'max_length[12]|is_unique[' . config_item ( 'user_table' ) . '.username]',
						'errors' => [ 
								'is_unique' => 'Username already in use.' 
						] 
				],
				[ 
						'field' => 'passwd',
						'label' => 'passwd',
						'rules' => [ 
								'trim',
								'required',
								[ 
										'_check_password_strength',
										[ 
												$this->validation_callables,
												'_check_password_strength' 
										] 
								] 
						],
						'errors' => [ 
								'required' => 'The password field is required.' 
						] 
				],
				[ 
						'field' => 'email',
						'label' => 'email',
						'rules' => 'trim|required|valid_email|is_unique[' . config_item ( 'user_table' ) . '.email]',
						'errors' => [ 
								'is_unique' => 'Email address already in use.' 
						] 
				],
				[ 
						'field' => 'auth_level',
						'label' => 'auth_level',
						'rules' => 'required|integer|in_list[1,6,9]' 
				] 
		];
		
		$this->form_validation->set_rules ( $validation_rules );
		
		if ($this->form_validation->run ()) {
			$user_data ['passwd'] = $this->authentication->hash_passwd ( $user_data ['passwd'] );
			$user_data ['user_id'] = $this->examples_model->get_unused_id ();
			$user_data ['created_at'] = date ( 'Y-m-d H:i:s' );
			
			// If username is not used, it must be entered into the record as NULL
			if (empty ( $user_data ['username'] )) {
				$user_data ['username'] = NULL;
			}
			
			$this->db->set ( $user_data )->insert ( config_item ( 'user_table' ) );
			
			if ($this->db->affected_rows () == 1)
				echo '<h1>Congratulations</h1>' . '<p>User ' . $user_data ['username'] . ' was created.</p>';
		} else {
			echo '<h1>User Creation Error(s)</h1>' . validation_errors ();
		}
		
		echo $this->load->view ( 'examples/page_footer', '', TRUE );
	}
	public function login() {
		// Method should not be directly accessible
		if ($this->uri->uri_string () == 'Access/login')
			show_404 ();
		
		if (strtolower ( $_SERVER ['REQUEST_METHOD'] ) == 'post')
			$this->require_min_level ( 1 );
		
		$this->setup_login_form ();
		
		$html = $this->load->view ( 'templates/template_login_header', '', TRUE );
		$html .= $this->load->view ( 'access/login_page', '', TRUE );
		$html .= $this->load->view ( 'templates/template_login_footer', '', TRUE );
		
		echo $html;
	}
	public function logout() {
		$this->authentication->logout ();
		
		// Set redirect protocol
		$redirect_protocol = USE_SSL ? 'https' : NULL;
		
		redirect ( site_url ( LOGIN_PAGE . '?logout=1&redirect=access', $redirect_protocol ) );
	}
	public function recover() {
		// Load resources
		$this->load->model ( 'examples_model' );
		
		// / If IP or posted email is on hold, display message
		if ($on_hold = $this->authentication->current_hold_status ( TRUE )) {
			$view_data ['disabled'] = 1;
		} else {
			// If the form post looks good
			if ($this->tokens->match && $this->input->post ( 'email' )) {
				if ($user_data = $this->examples_model->get_recovery_data ( $this->input->post ( 'email' ) )) {
					// Check if user is banned
					if ($user_data->banned == '1') {
						// Log an error if banned
						$this->authentication->log_error ( $this->input->post ( 'email', TRUE ) );
						
						// Show special message for banned user
						$view_data ['banned'] = 1;
					} else {
						/**
						 * Use the authentication libraries salt generator for a random string
						 * that will be hashed and stored as the password recovery key.
						 * Method is called 4 times for a 88 character string, and then
						 * trimmed to 72 characters
						 */
						$recovery_code = substr ( $this->authentication->random_salt () . $this->authentication->random_salt () . $this->authentication->random_salt () . $this->authentication->random_salt (), 0, 72 );
						
						// Update user record with recovery code and time
						$this->examples_model->update_user_raw_data ( $user_data->user_id, [ 
								'passwd_recovery_code' => $this->authentication->hash_passwd ( $recovery_code ),
								'passwd_recovery_date' => date ( 'Y-m-d H:i:s' ) 
						] );
						
						// Set the link protocol
						$link_protocol = USE_SSL ? 'https' : NULL;
						
						// Set URI of link
						$link_uri = 'examples/recovery_verification/' . $user_data->user_id . '/' . $recovery_code;
						
						$view_data ['special_link'] = anchor ( site_url ( $link_uri, $link_protocol ), site_url ( $link_uri, $link_protocol ), 'target ="_blank"' );
						
						$view_data ['confirmation'] = 1;
					}
				} 				

				// There was no match, log an error, and display a message
				else {
					// Log the error
					$this->authentication->log_error ( $this->input->post ( 'email', TRUE ) );
					
					$view_data ['no_match'] = 1;
				}
			}
		}
		
		echo $this->load->view ( 'examples/page_header', '', TRUE );
		
		echo $this->load->view ( 'examples/recover_form', (isset ( $view_data )) ? $view_data : '', TRUE );
		
		echo $this->load->view ( 'examples/page_footer', '', TRUE );
	}
	public function recovery_verification($user_id = '', $recovery_code = '') {
		// / If IP is on hold, display message
		if ($on_hold = $this->authentication->current_hold_status ( TRUE )) {
			$view_data ['disabled'] = 1;
		} else {
			// Load resources
			$this->load->model ( 'examples_model' );
			
			if (/**
			 * Make sure that $user_id is a number and less
			 * than or equal to 10 characters long
			 */
			is_numeric ( $user_id ) && strlen ( $user_id ) <= 10 && 

			/**
			 * Make sure that $recovery code is exactly 72 characters long
			 */
			strlen ( $recovery_code ) == 72 && 

			/**
			 * Try to get a hashed password recovery
			 * code and user salt for the user.
			 */
			$recovery_data = $this->examples_model->get_recovery_verification_data ( $user_id )) {
				/**
				 * Check that the recovery code from the
				 * email matches the hashed recovery code.
				 */
				if ($recovery_data->passwd_recovery_code == $this->authentication->check_passwd ( $recovery_data->passwd_recovery_code, $recovery_code )) {
					$view_data ['user_id'] = $user_id;
					$view_data ['username'] = $recovery_data->username;
					$view_data ['recovery_code'] = $recovery_data->passwd_recovery_code;
				} 				

				// Link is bad so show message
				else {
					$view_data ['recovery_error'] = 1;
					
					// Log an error
					$this->authentication->log_error ( '' );
				}
			} 			

			// Link is bad so show message
			else {
				$view_data ['recovery_error'] = 1;
				
				// Log an error
				$this->authentication->log_error ( '' );
			}
			
			/**
			 * If form submission is attempting to change password
			 */
			if ($this->tokens->match) {
				$this->examples_model->recovery_password_change ();
			}
		}
		
		echo $this->load->view ( 'examples/page_header', '', TRUE );
		
		echo $this->load->view ( 'examples/choose_password_form', $view_data, TRUE );
		
		echo $this->load->view ( 'examples/page_footer', '', TRUE );
	}
	public function user_management() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'manager/user_management', '', TRUE );
			
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function user_register() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'manager/user_register', '', TRUE );
			
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function user_register_post() {
		$user_data = [ 
				'username' => $this->input->post ( 'username' ),
				'passwd' => $this->input->post ( 'password' ),
				'email' => $this->input->post ( 'email' ),
				'auth_level' => $this->input->post ( 'level' ),
				'first_name' => $this->input->post ( 'firstname' ),
				'last_name' => $this->input->post ( 'lastname' )
		] ;

		
		$this->is_logged_in ();
		
		echo $this->load->view ( 'templates/template_header', '', TRUE );
		
		// Load resources
		$this->load->model ( 'examples_model' );
		$this->load->model ( 'validation_callables' );
		$this->load->library ( 'form_validation' );
		
		$this->form_validation->set_data ( $user_data );
		
		$validation_rules = [ 
				[ 
						'field' => 'username',
						'label' => 'username',
						'rules' => 'required|max_length[12]|is_unique[' . config_item ( 'user_table' ) . '.username]',
						'errors' => [ 
								'is_unique' => 'Username already in use.' 
						] 
				],
				[ 
						'field' => 'passwd',
						'label' => 'passwd',
						'rules' => [ 
								'trim',
								'required',
								[ 
										'_check_password_strength',
										[ 
												$this->validation_callables,
												'_check_password_strength' 
										] 
								] 
						],
						'errors' => [ 
								'required' => 'The password field is required.' 
						] 
				],
				[ 
						'field' => 'email',
						'label' => 'email',
						'rules' => 'trim|required|valid_email|is_unique[' . config_item ( 'user_table' ) . '.email]',
						'errors' => [ 
								'is_unique' => 'Email address already in use.' 
						] 
				],
				[ 
						'field' => 'auth_level',
						'label' => 'auth_level',
						'rules' => 'required|integer|in_list[1,6,9]' 
				] 
		];
		
		$this->form_validation->set_rules ( $validation_rules );
		
		if ($this->form_validation->run ()) {
			$user_data ['passwd'] = $this->authentication->hash_passwd ( $user_data ['passwd'] );
			$user_data ['user_id'] = $this->examples_model->get_unused_id ();
			$user_data ['created_at'] = date ( 'Y-m-d H:i:s' );
			
			// If username is not used, it must be entered into the record as NULL
			if (empty ( $user_data ['username'] )) {
				$user_data ['username'] = NULL;
			}
			
			$this->db->set ( $user_data )->insert ( config_item ( 'user_table' ) );
			
			if ($this->db->affected_rows () == 1)
// 				echo '<div class="span10" id="content"><h1>Congratulations</h1>' . '<p>User ' . $user_data ['username'] . ' was created.</p>';
// 				echo '</div>';
				$data = array(
						'message' => '<div><h1>Congratulations</h1>' . '<p>User ' . $user_data ['username'] . ' was created.</p>',
				);
				
				echo $this->load->view ( 'manager/user_register', $data, TRUE );
	} else {
			$data = array(
					'message' => '<div><h1>User Creation Contain error</h1><div></p>',
			);
			
			$this->load->view('manager/user_register',$data);
			echo $this->load->view ( 'manager/user_register', '', TRUE );
		}
		
		echo $this->load->view ( 'templates/template_footer', '', TRUE );
	}
	public function costumer_management() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'manager/costumer_management', '', TRUE );
			
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function costumer_register() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'manager/costumer_register', '', TRUE );
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function withdrawal() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'transaction/withdrawal', '', TRUE );
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function deposit() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'transaction/deposit', '', TRUE );
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
	public function transfer() {
		if ($this->require_role ( 'admin' )) {
			echo $this->load->view ( 'templates/template_header', '', TRUE );
			echo $this->load->view ( 'transaction/transfer', '', TRUE );
			echo $this->load->view ( 'templates/template_footer', '', TRUE );
		}
	}
}