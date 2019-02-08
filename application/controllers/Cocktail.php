<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cocktail extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->database();
		$this->load->helper('url');

		$this->load->library('grocery_CRUD');
	}

	public function _example_output($output = null)
	{
		$this->load->view('cocktail.php',(array)$output);
	}

	public function offices()
	{
		$output = $this->grocery_crud->render();

		$this->_example_output($output);
	}

	public function index()
	{
		$this->_example_output((object)array('output' => '' , 'js_files' => array() , 'css_files' => array()));
	}


	public function cocktail_managment()
	{
		try{
			$crud = new grocery_CRUD();

			// $crud->set_theme('twitter-bootstrap');
			$crud->set_table('cocktail');
			$crud->set_subject('Cocktail');
			$crud->required_fields('name', "recipe_description", "prepare_time", "image_url", "video_url", "class_url", "training_url", "recommended");
			$crud->columns('name', "recipe_description", "category", "prepare_time", "image_url", "video_url", "class_url", "training_url", "recommended");

			// $crud->set_field_upload('image_url','assets/uploads/files');

			// $crud->change_field_type('recommended', 'active');

			$crud->unset_texteditor('recipe_description','full_text');

			$crud->change_field_type('created_date','invisible');
			$crud->change_field_type('category','invisible');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}


	public function bar_managment()
	{
		try{
			$crud = new grocery_CRUD();

			// $crud->set_theme('twitter-bootstrap');
			$crud->set_table('bar');
			$crud->set_subject('Bar');
			$crud->required_fields('name', "description", "image_url", "latitude", "longitude", "location_name", "opening_hours", "closing_hours");
			$crud->columns('name', "description", "image_url", "latitude", "longitude", "location_name", "opening_hours", "closing_hours");
			
			$crud->change_field_type('history','invisible');	
			$crud->change_field_type('created_date','invisible');

			$crud->unset_columns('history');			

			$crud->unset_texteditor('description','full_text');

			$output = $crud->render();

			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}

	public function last_call_reminder_managment()
	{
			$crud = new grocery_CRUD();
			
			$crud->set_table('last_call_reminder');
			$crud->set_relation('bar_id','bar','name');			
			$crud->set_subject('Last Call Reminder');

			$crud->columns('bar_id', "last_round_at");
			$crud->required_fields('bar_id', "last_round_at");

			$crud->display_as('bar_id','Bar Name');	

			$crud->change_field_type('created_date','invisible');		


			$output = $crud->render();

			$this->_example_output($output);
	}

	public function happy_hour_managment()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('happy_hour');
			
			$crud->columns('bar_id', "opening_time", "closing_time", "happy_date");	
			$crud->required_fields('bar_id', "opening_time", "closing_time", "happy_date");		
			
			$crud->set_subject('Happy Hour');
			$crud->set_relation('bar_id','bar','name');
			$crud->display_as('bar_id','Bar Name');	

			$crud->change_field_type('created_date','invisible');	

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function events_managment()
	{
			$crud = new grocery_CRUD();

			$crud->set_table('event');
			$crud->set_subject('Event');

			$crud->columns('name', "detail", "event_date", "image_url", "latitude", "longitude", "location_name", "ticket_price");
			$crud->required_fields('name', "detail", "event_date", "image_url", "latitude", "longitude", "location_name", "ticket_price");													

			$crud->change_field_type('created_date','invisible');

			$crud->unset_texteditor('detail','full_text');

			$output = $crud->render();

			$this->_example_output($output);
	}

	public function special_offer_managment()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('special_offer');
		$crud->set_subject('Special Offer');



		$crud->columns('name', "detail", "event_date", "image_url", "bar_image_url", "latitude", "longitude", "location_name", "ticket_price");
		$crud->required_fields('name', "detail", "event_date", "image_url", "bar_image_url", "latitude", "longitude", "location_name", "ticket_price", "bar_history");													

		$crud->change_field_type('created_date','invisible');


		$crud->unset_texteditor('detail','full_text');
		$crud->unset_texteditor('bar_history','full_text');			


		$output = $crud->render();

		$this->_example_output($output);
	}

	public function groupon_managment()
	{
		$crud = new grocery_CRUD();

		$crud->set_table('groupon');
		$crud->set_subject('Groupon');


		$crud->columns('name', "description", "image_url", "cocktail_id", "valid_details", "code");
		$crud->required_fields('name', "description", "image_url", "cocktail_id", "valid_details", "code");													

		$crud->set_relation('cocktail_id','cocktail','name');
		$crud->display_as('cocktail_id','Cocktail Name');	

		$crud->change_field_type('created_date','invisible');

		$crud->unset_texteditor('description','full_text');		

		$output = $crud->render();

		$this->_example_output($output);
	}


	public function valueToEuro($value, $row)
	{
		return $value.' &euro;';
	}


	function multigrids()
	{
		$this->config->load('grocery_crud');
		$this->config->set_item('grocery_crud_dialog_forms',true);
		$this->config->set_item('grocery_crud_default_per_page',10);

		$output1 = $this->offices_management2();

		$output2 = $this->employees_management2();

		$output3 = $this->customers_management2();

		$js_files = $output1->js_files + $output2->js_files + $output3->js_files;
		$css_files = $output1->css_files + $output2->css_files + $output3->css_files;
		$output = "<h1>List 1</h1>".$output1->output."<h1>List 2</h1>".$output2->output."<h1>List 3</h1>".$output3->output;

		$this->_example_output((object)array(
				'js_files' => $js_files,
				'css_files' => $css_files,
				'output'	=> $output
		));
	}



}
