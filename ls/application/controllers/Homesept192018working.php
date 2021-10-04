<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller 
{

	public function __construct() 
	{
		parent::__construct();
		if (defined('REQUEST') && REQUEST == "external") {
	        return;
	    }
		$this->template->loadData("activeLink", 
			array("home" => array("general" => 1)));
		$this->load->model("user_model");
		$this->load->model("home_model");
		if(!$this->user->loggedin) {
			redirect(site_url("login"));
		}
	}

	public function index()
	{
		if (defined('REQUEST') && REQUEST == "external") {
	        return;
	    }
		//redirect to premium plans
		
		if(!$this->user->info->admin  && !isset($_GET['home']))
		{
			redirect('?home=yes');
		}
		$new_members = $this->user_model->get_new_members(5);
		$all_purchases =  $this->user_model->get_all_time_purchases($this->user->info->phone_no);
		$leads_purchased_today = $this->user_model->get_leads_purchased_today($this->user->info->phone_no);
		$amount_spent_all_time = $this->user_model->get_amount_spent_all_time($this->user->info->phone_no);
		$amount_spent_today = $this->user_model->get_amount_spent_today($this->user->info->phone_no);
		
		if($this->user->info->admin)			
			$leads = $this->user_model->get_leads_purchased_all_users();
		else
			$leads = $this->user_model->get_leads_purchased($this->user->info->phone_no);
		
		//Admin stuff
		$leads_generated_today = $this->user_model->get_leads_generated_today(); 
		$leads_generated_all = $this->user_model->get_leads_generated_all(); 
		$leads_spent_all_time = $this->user_model->get_leads_spent_all_time();
		$leads_spent_today = $this->user_model->get_leads_spent_today();
		
		$months = array();

		// Graph Data
		$current_month = date("n");
		$current_year = date("Y");

		// First month
		for($i=6;$i>=0;$i--) {
			// Get month in the past
			$new_month = $current_month - $i;
			// If month less than 1 we need to get last years months
			if($new_month < 1) {
				$new_month = 12 + $new_month;
				$new_year = $current_year - 1;
			} else {
				$new_year = $current_year;
			}
			// Get month name using mktime
			$timestamp = mktime(0,0,0,$new_month,1,$new_year);
			if($this->user->info->admin)
				$count =  $this->user_model->get_all_leads_each_month($new_month, $new_year);
			else
				$count = $this->user_model
					->get_user_leads_each_month($this->user->info->phone_no,$new_month, $new_year);
			$months[] = array(
				"date" => date("F", $timestamp),
				"count" => $count
				);
		}


		$javascript = 'var data_graph = {
					    labels: [';
						foreach($months as $d) {
							$javascript .= '"'.$d['date'].'",';
						}
						$javascript.='],
						datasets: [
							{
								label: "Historical Purchases",
								fillColor: "rgba(220,220,220,0.2)",
								strokeColor: "rgba(220,220,220,1)",
								pointColor: "rgba(220,220,220,1)",
								pointStrokeColor: "#fff",
								pointHighlightFill: "#fff",
								pointHighlightStroke: "rgba(220,220,220,1)",
								data: [';
								foreach($months as $d) {
									$javascript .= $d['count'].',';
								}
								$javascript.=']
								
							}
						]
						,
						options: {
								legend: {
									display: true,
									labels: {
										fontColor: "rgb(255, 99, 132)"
									}
								},
								scales: {
									xAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: "Monthddd"
										}
									}],
									yAxes: [{
										display: true,
										scaleLabel: {
											display: true,
											labelString: "Dollardds"
										},
									}]
								}
						}
		};';


		$stats = $this->home_model->get_home_stats();
		if($stats->num_rows() == 0) {
			$this->template->error(lang("error_24"));
		} else {
			$stats = $stats->row();
			if($stats->timestamp < time() - 3600 * 5) {
				$stats = $this->get_fresh_results($stats);
				// Update Row
				$this->home_model->update_home_stats($stats);
			}
		}


		$javascript .= ' var social_data = [
		    {
		        value: '.$stats->google_members.',
		        color:"#F7464A",
		        highlight: "#FF5A5E",
		        label: "Google"
		    },
		    {
		        value: '.($stats->total_members - ($stats->google_members +
		         $stats->facebook_members + $stats->twitter_members)).',
		        color: "#39bc2c",
		        highlight: "#5AD3D1",
		        label: "'.lang("ctn_242").'"
		    },
		    {
		        value: '.$stats->facebook_members.',
		        color: "#2956BF",
		        highlight: "#FFC870",
		        label: "Facebook"
		    },
		    {
		        value: '.$stats->twitter_members.',
		        color: "#5BACD4",
		        highlight: "#7db864",
		        label: "Twitter"
		    }
		];';


		$this->template->loadExternal(
			'<script type="text/javascript" src="'
			.base_url().'scripts/libraries/Chart.min.js" /></script>
			<script type="text/javascript">'.$javascript.'</script>
			<script type="text/javascript" src="'
			.base_url().'scripts/custom/home.js" /></script>'
		);

		$online_count = $this->user_model->get_online_count();

		$this->template->loadContent("home/index.php", array(
			"new_members" => $new_members,
			"stats" => $stats,
			"online_count" => $online_count,
			"all_purchases" => $all_purchases,
			"leads_purchased_today"=>$leads_purchased_today,
			"amount_spent_all_time"=>$amount_spent_all_time,
			"amount_spent_today"=>$amount_spent_today,
			"leads"=>$leads,
			"leads_generated_today" =>$leads_generated_today,
			"leads_generated_all"=>$leads_generated_all,
			"leads_spent_all_time"=>$leads_spent_all_time,
			"leads_spent_today"=>$leads_spent_today
			)
		);
	}
		
	private function get_fresh_results($stats) 
	{
		$data = new STDclass;

		$data->google_members = $this->user_model->get_oauth_count("google");
		$data->facebook_members = $this->user_model->get_oauth_count("facebook");
		$data->twitter_members = $this->user_model->get_oauth_count("twitter");
		$data->total_members = $this->user_model->get_total_members_count();
		$data->new_members = $this->user_model->get_new_today_count();
		$data->active_today = $this->user_model->get_active_today_count();

		return $data;
	}

	public function change_language() 
	{	
		$languages = $this->config->item("available_languages");
		if(!isset($_COOKIE['language'])) {
			$lang = "";
		} else {
			$lang = $_COOKIE["language"];
		}
		$this->template->loadContent("home/change_language.php", array(
			"languages" => $languages,
			"user_lang" => $lang
			)
		);
	}

	public function change_language_pro() 
	{
		$lang = $this->common->nohtml($this->input->post("language"));
		$languages = $this->config->item("available_languages");
		if(!in_array($lang, $languages, TRUE)) {
			$this->template->error(lang("error_25"));
		}

		setcookie("language", $lang, time()+3600*7, "/");
		$this->session->set_flashdata("globalmsg", lang("success_14"));
		redirect(site_url());
	}

}

?>