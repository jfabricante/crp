<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class NSERIES extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->_redirectUnauthorized();

		date_default_timezone_set('Asia/Manila');
		
	}

	public function myUrlEncode($string) {
		    $entities = array('%21', '%2A', '%27', '%28', '%29', '%3B', '%3A', '%40', '%26', '%3D', '%2B', '%24', '%2C', '%2F', '%3F', '%25', '%23', '%5B', '%5D');
		    $replacements = array('!', '*', "'", "(", ")", ";", ":", "@", "&", "=", "+", "$", ",", "/", "?", "%", "#", "[", "]");
		    return str_replace($entities, $replacements, urlencode($string));
	}



	public function N_series(){
		// echo base_url();
		// //echo 'docs/VESI/CESeries/HGHTML-WEN-1331E5_20180122/index.html';
		// exit();
		$this->load->view('docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/index.html');
	}

	public function N_series_menu(){
		$this->load->view('docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/menu.html');

	}

	public function frame_html(){

		//$this->load->view('docs/VESI/CESeries/HGHTML-WEN-1331E5_20180122/si/si_82557.html');
		// echo base_url();
		// exit();
		
		// $data['link']= base_url().'index.php/VESI/si_82557';
		$this->load->view('docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/frame.html');
	}

	public function manual_docs(){
		
		$urlname =$this->uri->segment('3');
		// echo $urlname;
		// die();

		$svg = strpos($urlname, 'svgViewer');
		$pos = strpos($urlname, 'html');

		if ($svg===false){
			if ($pos===false){
				$this->load->view('docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/si/'.$urlname.'.html');
			}else{
				$this->load->view('docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/si/'.$urlname);
			}
		}else
		{
			$this->svgViewer();
		}

		
	
	}

	public function svgViewer(){
		 
		 $param = $this->input->get();

		// print_r($param );
		// var_dump($param);
		
		 $params = (explode('|', $param['param']));
		// $par = '&param=RHD%20Smoother&param=TCM&param=Transmission%20M%2FV';
		 $par='&param=LHD DLC (4HK1%2C 4JJ1)&param=DLC';
		 $concat = '';
		 foreach ($params as $param) {
		 	$concat .= '&param=' . $param;
		 }
		 //var_dump(implode('&param=', $params));
		 // echo urldecode($concat);
		  // $concat = str_replace(' ', '%20', $concat);
		  //  $concat = str_replace(',', '%2C', $concat);
		  //  $concat = str_replace('/', '%2F', $concat);
		 // $concat = $this->myUrlEncode($concat);
		 // //$concat = urlencode($concat);
		 // echo $concat;
		 // var_dump($concat);
		 //  echo $par;
		 //     die();
		 // die();



		
		// $this->load->view('docs/VESI/CESeries/HGHTML-WEN-1331E5_20180122/si/svg_viewer/svg_viewer.html?type=open&param=RHD%20Smoother&param=TCM&param=Transmission%20M%2FV');
		//$this->load->view('docs/VESI/CESeries/HGHTML-WEN-1331E5_20180122/si/svg_viewer/svg_viewer.html');
		// redirect(echo base_url().)
		//
		redirect(base_url().'docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/si/svg_viewer/svg_viewer.html?type=open'.$concat); 

	}

	
	public function notfound(){
		$this->load->view('docs/VESI/NSeries/LGHTML-WEN-1771IG_20171204/notfound.html');
	}


	protected function _redirectUnauthorized()
	{
		if (count($this->session->userdata()) < 3)
		{
			$this->session->set_flashdata('message', '<div class="alert alert-warning">Login first!</div>');

			redirect(base_url());
		}
	}




}