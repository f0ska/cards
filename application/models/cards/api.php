<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Api extends Cards
{
    public function __construct()
    {
        parent::__construct();
    }

    public function add_purchase($series, $number, $sum, $description)
    {
        $sum = round($sum * 1, 2);

        $this->db->select('id');
        $this->db->where('series', $series);
        $this->db->where('number', $number);
        $this->db->where('status', 1);
        $row = $this->db->get('cards')->row();

        if (!$row)
        {
            return array('Card is invalid', 'danger');
        }
        else
        {
            $this->db->where('series', $series);
            $this->db->where('number', $number);
            $this->db->set('sum', 'sum + ' . $this->db->escape($sum), false);
            $this->db->set('used', 'NOW()', false);
            $this->db->update('cards');

            $this->db->set('card_id', $row->id);
            $this->db->set('series', $series);
            $this->db->set('number', $number);
            $this->db->set('sum', $sum);
            $this->db->set('created', 'NOW()', false);
            $this->db->set('description', strip_tags($description));
            $this->db->insert('card_history');
            return array('Transaction added successfuly', 'success');
        }
    }

}
