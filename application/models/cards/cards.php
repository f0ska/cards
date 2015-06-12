<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Cards extends CI_Model
{
    private $search = array();
    public $limit = 10;


    private $max_count = 10000;
    private $max_failed_iterations = 100;

    private $search_fields = array(
        'series',
        'number',
        'created',
        'expiration',
        'status');

    public function __construct()
    {
        parent::__construct();
        foreach ($this->search_fields as $field)
        {
            if ($this->input->post($field) !== null)
            {
                $value = trim(strip_tags($this->input->post($field)));
                if (mb_strlen($value, 'utf-8'))
                {
                    $this->search[$field] = $value;
                }
            }
        }
    }


    public function get_list($start = 0)
    {
        if (!$this->input->is_ajax_request())
        {
            $this->db->set('status', -1);
            $this->db->where('expiration < NOW()');
            $this->db->where('status >', -1);
            $this->db->update('cards');
        }


        if ($this->search)
        {
            foreach ($this->search as $search_field => $search_value)
            {
                call_user_func(array($this, $search_field . '_condition'));
            }
        }
        $this->db->order_by('created');
        $this->db->limit($this->limit, (int)$start);
        return $this->db->get('cards')->result();
    }

    public function get_total()
    {
        if ($this->search)
        {
            foreach ($this->search as $search_field => $search_value)
            {
                call_user_func(array($this, $search_field . '_condition'));
            }
        }
        return $this->db->count_all_results('cards');
    }
    
    /** The random unique card generator
     * Yes, it's slow :)
     */
    public function generate()
    {
        $series = trim(mb_strtoupper($this->input->post('g_series')));
        $status = (int)(bool)$this->input->post('g_status');
        $expiration = (int)$this->input->post('g_expiration');
        $count = (int)$this->input->post('g_count');
        if (!$series)
        {
            return array('Series is not defined', 'danger');
        }
        if ($count < 1)
        {
            return array('Wrong cards number', 'danger');
        }


        if ($count > $this->max_count)
        {
            $count = $this->max_count;
        }

        $commit_counter = 0;
        $total_counter = 0;
        $failed_counter = 0;

        $this->db->trans_begin();

        while ($total_counter < $count)
        {
            $test_number = mt_rand(10000000, 99999999) . str_pad(mt_rand(0, 99999999), 8, '0', STR_PAD_LEFT);
            $this->db->where('series', $series);
            $this->db->where('number', $test_number);
            if ($this->db->count_all_results('cards'))
            {
                ++$failed_counter;
            }
            else
            {
                ++$commit_counter;
                ++$total_counter;
                $this->db->set('series', $series);
                $this->db->set('number', $test_number);
                $this->db->set('status', $status);
                $this->db->set('created', 'NOW()', false);
                switch ($expiration)
                {
                    case 1:
                        $this->db->set('expiration', 'NOW() + INTERVAL 1 MONTH', false);
                        break;
                    case 6:
                        $this->db->set('expiration', 'NOW() + INTERVAL 6 MONTH', false);
                        break;
                    default:
                        $this->db->set('expiration', 'NOW() + INTERVAL 12 MONTH', false);
                        break;
                }

                $this->db->insert('cards');
            }

            if ($failed_counter == $this->max_failed_iterations)
            {
                break;
            }

            if ($commit_counter == 100)
            {
                $commit_counter = 0;
                $this->db->trans_commit();
                set_time_limit(30);
            }
        }
        $this->db->trans_commit();
        $this->db->trans_off();

        set_time_limit(30);

        return array($total_counter . ' entries successfuly created', 'success');
    }

    public function remove_card($id)
    {
        $this->db->where('id', (int)$id);
        $this->db->delete('cards');
        $this->db->where('card_id', (int)$id);
        $this->db->delete('card_history');
    }

    public function get_details($id)
    {
        $this->db->where('id', (int)$id);
        return $this->db->get('cards')->row();
    }

    public function get_transactions($id)
    {
        $this->db->where('card_id', (int)$id);
        $this->db->order_by('created', 'desc');
        return $this->db->get('card_history')->result();
    }


    private function series_condition()
    {
        $this->db->like('series', $this->search['series']);
    }
    private function number_condition()
    {
        $this->db->like('number', str_replace(' ', '', $this->search['number']));
    }
    private function created_condition()
    {
        $this->db->where('DATE(`created`) = \'' . $this->db->escape_str($this->search['created']) . '\'');
    }
    private function expiration_condition()
    {
        $this->db->where('DATE(`expiration`) = \'' . $this->db->escape_str($this->search['expiration']) . '\'');
    }
    private function status_condition()
    {
        $this->db->where('status', (int)$this->search['status']);
    }
}
