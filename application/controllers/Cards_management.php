<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Cards_management extends CI_Controller
{
    public $message = '';
    public $message_type = 'info';

    public function __construct()
    {
        parent::__construct();
        $this->load->library('tpl');
    }

    public function index()
    {
        redirect('cards_management/cards_list');
    }

    public function cards_list($start = 0)
    {
        $this->load->model('cards/cards');
        $data['list'] = $this->cards->get_list($start);
        $data['list_total'] = $this->cards->get_total();

        $this->load->library('pagination');
        $config['base_url'] = site_url('cards_management/cards_list');
        $config['total_rows'] = $data['list_total'];
        $config['per_page'] = $this->cards->limit;
        $config['uri_segment'] = 3;
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();

        $data['message'] = $this->message;
        $data['message_type'] = $this->message_type;


        if ($this->input->is_ajax_request())
        {
            $this->load->view('cards/list', $data);
        }
        else
        {
            $this->tpl->set('content', 'cards/list', $data);
            $this->tpl->render('tpl/index');
        }
    }

    public function create_form()
    {
        $this->load->view('cards/form');
    }

    public function create_action()
    {
        $this->load->model('cards/cards');
        list($this->message, $this->message_type) = $this->cards->generate();
        $this->cards_list();
    }

    public function card_details($id)
    {
        $this->load->model('cards/cards');
        $data['card'] = $this->cards->get_details($id);
        $data['transactions'] = $this->cards->get_transactions($id);
        $this->load->view('cards/details', $data);
    }

    public function card_remove($id)
    {
        $this->load->model('cards/cards');
        $this->cards->remove_card($id);
        $this->cards_list();
    }
    public function card_status($id, $status)
    {
        $this->db->where('id', (int)$id);
        $this->db->set('status', (int)(bool)$status);
        $this->db->update('cards');
        $this->cards_list();
    }


    /* Test methods */
    public function purchase_form()
    {
        // any card, just for test
        $this->db->where('status', 1);
        $this->db->limit(1);
        $data['card'] = $this->db->get('cards')->row();
        $this->load->view('cards/purchase_form', $data);
    }

    public function purchase_action()
    {
        $this->load->model('cards/cards');
        $this->load->model('cards/api');
        list($this->message, $this->message_type) = $this->api->add_purchase($this->input->post('p_series'), $this->input->post
            ('p_number'), $this->input->post('p_sum'), $this->input->post('p_description'));
        $this->cards_list();
    }


}
