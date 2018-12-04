<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Email_controller extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
	    $this->load->helper(array('url', 'form'));
		$this->load->view('form_send_email');
	}
	public function send_email(){
	    $config = [
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.mailtrap.io',
            'smtp_port' => 2525,
            'smtp_user' => 'c7c9ee20513111',
            'smtp_pass' => '66810a97ea201a',
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ];

        $this->load->library('email');
        $post = $this->input->post();
        $name = mb_convert_encoding($post['name'], "utf-8", "auto");
        $email_sender = mb_convert_encoding($post['email'], "utf-8", "auto");
        $message = mb_convert_encoding($post['message'], "utf-8", "auto");

        $this->email->initialize($config);
        $this->email->from($email_sender, $name);
        $this->email->to('juliano.berselli@equipe.ezoom.com.br');
        $this->email->subject('Duvida');
        $this->email->message($message);

        $this->email->send();
    }
}
