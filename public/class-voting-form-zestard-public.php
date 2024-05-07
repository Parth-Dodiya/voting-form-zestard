<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://the-gujarati.free.nf
 * @since      1.0.0
 *
 * @package    Voting_Form_Zestard
 * @subpackage Voting_Form_Zestard/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Voting_Form_Zestard
 * @subpackage Voting_Form_Zestard/public
 * @author     Parth Dodiya <parthdodiya.dodiya@gmail.com>
 */
class Voting_Form_Zestard_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Voting_Form_Zestard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Voting_Form_Zestard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/voting-form-zestard-public.css', array(), $this->version, 'all' );

		wp_enqueue_script( 'jquery');
		wp_register_script( 'validate-jquery', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js', null, null, true );
		wp_enqueue_script('validate-jquery');
		wp_register_script( 'additional-methods', 'https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js', null, null, true );
		wp_enqueue_script('additional-methods');
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Voting_Form_Zestard_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Voting_Form_Zestard_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/voting-form-zestard-public.js', array( 'jquery' ), $this->version, false );

	}

	public function voting_form_design() { 
		$output = '';
		$output = '<style>
	        /* Form Styles */
	        .form-container {
	            max-width: 400px;
	            padding: 30px;
	            border-radius: 8px;
	            background-color: #fff;
	            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
	        }
	        .form-container img {
	            width: 80px;
	            height: 80px;
	            border-radius: 50%;
	            margin-right: 10px;
	            cursor: pointer;
	            border: 2px solid transparent;
	            transition: border-color 0.3s ease;
	        }
	        .form-container img:hover {
	            border-color: #007bff;
	        }

	        .form-container input[type="text"],
	        .form-container input[type="email"],
	        .form-container input[type="tel"],
	        .form-container input[type="number"],
	        .form-container input[type="password"] {
	            width: 100%;
	            padding: 12px;
	            margin-bottom: 20px;
	            border: 1px solid #ddd;
	            border-radius: 4px;
	            box-sizing: border-box;
	            font-size: 16px;
	        }

	        .form-container button {
	            width: 100%;
	            padding: 12px;
	            background-color: #007bff;
	            color: #fff;
	            border: none;
	            border-radius: 4px;
	            cursor: pointer;
	            font-size: 16px;
	            transition: background-color 0.3s ease;
	        }

	        .form-container button:hover {
	            background-color: #0056b3;
	        }

	        #otp-field {
	            display: none;
	            margin-top: 20px;
	        }

	        #otp-display {
	           margin-top: 10px;
	        }

	        /* Yes/No Radio Buttons */
	        .yes-no-radio {
	            display: none;
	            margin-bottom: 15px;
	        }

	        .yes-no-radio label {
	            margin-right: 10px;
	        }

	        .image-radio-container {
	          display: flex;
	          gap: 10px; /* Add spacing between images */
	        }
	        
	        #person3, #person4 {
	          opacity: 0; /* Hide the actual radio button */
	          position: absolute;
	          pointer-events: none; /* Allow clicks on the label area */
	        }
	        
	        .person-select div.test {
	        	display: block;
	        }

	        .person-select div.test p {
    text-align: center;
    margin: 0 0 20px 0;
}

	        #personForm div.success {
			    color: green;
			    margin-top: 20px;
			    display: none;
			}
			#personForm div.error {
			    color: red;
			    margin-top: 20px;
			    display: none;
			}
	    </style>
	    <div class="form-container">
	        <div class="person-select image-radio-container">
	        	<div class="test">
		            <img src="'. plugin_dir_url( __FILE__ ) .'images/person1.webp" alt="Person 1" onclick="selectPerson(1)">
		            <p>P 1</p>
	            </div>
		        <div class="yes-no-radio" id="person1_yesNoRadio">
		            <label><input type="radio" name="person1" value="1"> Yes</label>
		            <label><input type="radio" name="person1" value="0"> No</label>
		        </div>
		        <div class="test">
		            <img src="'. plugin_dir_url( __FILE__ ) .'images/person2.webp" alt="Person 2" onclick="selectPerson(2)">
		            <p>P 2</p>
		        </div>
		        <div class="yes-no-radio" id="person2_yesNoRadio">
		            <label><input type="radio" name="person2" value="1"> Yes</label>
		            <label><input type="radio" name="person2" value="0"> No</label>
		        </div>
		        <div class="test">
		        	<label for="person3">
		        		<img src="'. plugin_dir_url( __FILE__ ) .'images/person3.webp" alt="Person 3" onclick="selectPerson(3)" for="person3">
		        		<input type="radio" id="person3" name="person3-vote" value="person3">
		        		<p>P 3</p>
		        	</label>
	        	</div> 
	        	<div class="test">
		        	<label for="person4">
		                <img src="'. plugin_dir_url( __FILE__ ) .'images/person4.webp" alt="Person 4" onclick="selectPerson(4)" for="person4">
		                <input type="radio" id="person4" name="person3-vote" value="person4" >
		                <p>P 4</p>
		          	</label>
	          	</div>
	        </div>
	        <form id="personForm">
			    <input type="text" name="fullName" placeholder="Full Name" required>
			    <input type="email" name="email" placeholder="Email" required>
			    <input type="tel" name="phoneNumber" placeholder="Phone Number" required>
			    <input type="text" name="memberId" placeholder="Member ID" required>
			    <button type="button" onclick="generateOTP()">Get OTP</button>
			    <div id="otp-display"></div>
			    <div id="otp-field">
			        <input id="otpInput" type="text" name="otpInput" placeholder="Enter OTP" required>
			    	<button type="button" onclick="submitForm()">Submit</button>
			    </div>
			    <div class="success"> <p> Your vote is registered successfully.</p> </div>
			    <div class="error"> <p> Your vote is already registered.</p> </div>
			</form>
	    </div>

	    <script>
	        let selectedPerson = 0;

	        function selectPerson(personNumber) {
	        	// console.log(personNumber);
	        	selectedPerson = personNumber;
	    		selector = `.person-select img:nth-child(${selectedPerson})`;
	            if (personNumber === 2 ) {
	        		selectedPerson = 3;
	    			selector = `.person-select .test:nth-child(3) img`;
	            } else if ( personNumber === 3) {
	        		selectedPerson = 5;
	    			selector = `.person-select .test:nth-child(5) img`;
	            } else if ( personNumber === 4)  {
	        		selectedPerson = 7;
	    			selector = `.person-select .test:nth-child(6) img`;
	            }
	            // Reset selection for all images
	            document.querySelectorAll(`.person-select img`).forEach(img => {
	                img.style.border = "none";
	            });
	            // console.log(selector);
	            // Apply selection style to the clicked image
	            document.querySelector(selector).style.border = "2px solid #007bff";

	            // Show yes/no radio buttons if first person is selected
	            if (selectedPerson === 1 ) {
	                document.getElementById(`person1_yesNoRadio`).style.display = "block";
	                document.getElementById(`person2_yesNoRadio`).style.display = "none";
	            } else if ( selectedPerson === 3) {
	                document.getElementById(`person2_yesNoRadio`).style.display = "block";
	                document.getElementById(`person1_yesNoRadio`).style.display = "none";
	            } else {
	                document.getElementById(`person2_yesNoRadio`).style.display = "none";
	                document.getElementById(`person1_yesNoRadio`).style.display = "none";
	            }
	        }

	        function generateOTP() {
	            let min = 100000; // Minimum 6-digit number
	            let max = 999999; // Maximum 6-digit number
	            generatedOTP = Math.floor(Math.random() * (max - min + 1)) + min;

	            document.getElementById(`otp-display`).textContent = `Generated OTP: ${generatedOTP}`;
	            document.getElementById(`otp-field`).style.display = "block";
	        }

	        function requestOTP() {
	            if (selectedPerson === 0) {
	                alert(`Please select a person first.`);
	            } else {
	                // Here you can implement OTP generation/sending logic
	                document.getElementById(`otp-field`).style.display = "block";
	            }
	        }

	        function submitForm() {
	            let enteredOTP = document.getElementById(`otpInput`).value.trim();
	            let selectedP1 = document.querySelector(`input[name="person1"]:checked`).value;
	            let selectedP2 = document.querySelector(`input[name="person2"]:checked`).value;
	            let selectedP3 = document.querySelector(`input[name="person3-vote"]:checked`).value;
	            let formData = jQuery(`form#personForm`).serializeArray();
	            // console.log(enteredOTP, selectedP1, selectedP2, formData);            

	            if (enteredOTP === "") {
	                alert(`Please enter the OTP.`);
	                return;
	            } else if (enteredOTP !== generatedOTP.toString()) {
	                alert(`Incorrect OTP. Please try again.`);
	                return;
	            } else {
	            	jQuery.ajax({
					    type: "POST",
					    url: "'. admin_url("admin-ajax.php") .'",
					    data: {
		                    action: "submit_voting_form",
		                    votedP1: selectedP1,
		                    votedP2: selectedP2,
		                    votedP3: selectedP3,
		                    formData: formData,
		                    votingFormSubmitAjaxNonce: "'. wp_create_nonce("voting_form_submit_nounce") .'"
		                },
		                dataType:"json",
					    success: function(data){
					    	console.log(typeof(data.status));
					    	console.log(data.status);
					    	if (data.status == "1") {
					    		document.querySelector("#personForm div.success").style.display = "block";
					    		console.log(document.querySelector("#personForm div.success").style.display = "visible");
					    	} else if (data.status == "0")  {
					    		document.querySelector("#personForm div.error").style.display = "block";
					    	}
						},
					    error: function (jqXHR, textStatus, errorThrown) {
					      // $loader.html(jqXHR + " :: " + textStatus + " :: " + errorThrown);
					    },
					});
	            }
	        }

	        jQuery(function($) {
		        // Add validation rules to the form fields
		        $("#personForm").validate({
		            rules: {
		                fullName: {
		                    required: true
		                },
		                email: {
		                    required: true,
		                    email: true
		                },
		                phoneNumber: {
		                    required: true,
		                    digits: true,
		                    minlength: 10
		                },
		                memberId: {
		                    required: true
		                },
		                otpInput: {
		                    required: true,
		                    digits: true,
		                    minlength: 6,
		                    maxlength: 6
		                }
		            },
		            messages: {
		                fullName: {
		                    required: "Please enter your full name."
		                },
		                email: {
		                    required: "Please enter your email address.",
		                    email: "Please enter a valid email address."
		                },
		                phoneNumber: {
		                    required: "Please enter your phone number.",
		                    digits: "Please enter only digits.",
		                    minlength: "Phone number must be at least 10 digits."
		                },
		                memberId: {
		                    required: "Please enter your member ID."
		                },
		                otpInput: {
		                    required: "Please enter the OTP.",
		                    digits: "Please enter only digits.",
		                    minlength: "OTP must have at least 6 digits.",
		                    maxlength: "OTP must have at least 6 digits."
		                }
		            },
		            // Specify where to display error messages
		            errorPlacement: function(error, element) {
		                error.insertAfter(element); // Display error message after the input element
		            }
		        });
		    });	        
	    </script>';
	    return $output;
	}

	public function submit_voting_form_ajax_callback() {
	    check_ajax_referer('voting_form_submit_nounce', 'votingFormSubmitAjaxNonce');
		
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";

		$user_name = $user_email = $_POST['formData'][1]['value'];
		$phn_no = $_POST['formData'][2]['value'];
		$member_id = $_POST['formData'][3]['value'];
		$user_voted = array( 'P1' => $_POST['votedP1'], 'P2' => $_POST['votedP2'] );
		$user_voted['P3'] = ($_POST['votedP3'] == 'person3') ? '1' : '0';
		$user_voted['P4'] = ($_POST['votedP3'] == 'person4') ? '1' : '0';

		$user_id = username_exists( $user_name );

		if ( ! $user_id && false == email_exists( $user_email ) ) {
			$random_password = wp_generate_password( $length = 12, $include_standard_special_chars = false );
			$userdata = array(
				'user_pass'				=> $random_password, 	//(string) The plain-text user password.
				'user_login' 			=> $user_name, 			//(string) The user's login username.
				'user_email' 			=> $user_email, 		//(string) The user email address.
				'display_name' 			=> $user_name, 			//(string) The user's display name. Default is the user's username.
				'nickname' 				=> $user_name, 			//(string) The user's nickname. Default is the user's username.
				'role' 					=> 'voter', 			//(string) User's role.
				'show_admin_bar_front'	=> 'false', 			//(string) Whether to display the Admin Bar for the user
			);
			$user_id = wp_insert_user( $userdata );
			add_user_meta( $user_id, 'phone_number', $phn_no);
			add_user_meta( $user_id, 'member_id', $member_id);
			add_user_meta( $user_id, 'user_voted', json_encode($user_voted));
			$user = __( 'User created.', 'textdomain' );
			$status = '1';
		} else {
			$user = __( 'User already exists.', 'textdomain' );
			$status = '0';
		}
		$response = array(
		   'user'=> $user,
		   'user_detail'=> $user_id,
		   'status'=> $status
		);
		$response = json_encode($response);
		echo $response;
	    die();
	}
}