<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Deactivate extends Admin_Controller
{

        function __construct()
        {
                parent::__construct();
        }

        public function index()
        {
                if (!($id = (int) $this->input->get('user-id')))
                {

                        show_error('Invalid request.');
                }

                if ($id == $this->ion_auth->user()->row()->id)
                {
                        //  show_error('You cannot deactivate your self.');
                        $this->session->set_flashdata(
                                'message', $this->config->item('error_start_delimiter', 'ion_auth') .
                                'You cannot deactivate your self.' .
                                $this->config->item('error_end_delimiter', 'ion_auth')
                        );
                        redirect('admin/users', 'refresh');
                }
                $this->load->library('form_validation');
                $this->form_validation->set_rules('confirm', $this->lang->line('deactivate_validation_confirm_label'), 'required');
                $this->form_validation->set_rules('id', $this->lang->line('deactivate_validation_user_id_label'), 'required|alpha_numeric');

                if ($this->form_validation->run() == FALSE)
                {
                        $this->data['user'] = $this->ion_auth->user($id)->row();
                        if (!$this->data['user'])
                        {
                                show_error('Invalid request.');
                        }
                        $this->session->set_flashdata('message', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->ion_auth->messages())));
                        $this->_render_admin_page('admin/deactivate_user', $this->data);
                }
                else
                {

                        // do we really want to deactivate?
                        if ($this->input->post('confirm', TRUE) == 'yes')
                        {

                                // do we have the right userlevel?
                                if ($this->ion_auth->logged_in() && $this->ion_auth->is_admin())
                                {
                                        $this->ion_auth->deactivate($id);
                                }
                        }
                        $this->session->set_flashdata('message', (validation_errors() ? validation_errors() : ($this->ion_auth->errors() ? $this->ion_auth->errors() : $this->ion_auth->messages())));
                        // redirect them back to the auth page
                        redirect('admin/users', 'refresh');
                }
        }

}
