<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Crud
{

    protected $CI;

    public function __construct()
    {
        $this->CI = &get_instance();
        $this->CI->load->database();
    }

    public function insert($table, $data)
    {
        $this->CI->db->insert($table, $data);
        return $this->CI->db->insert_id();
    }
    public function batch_insert($table, $data)
    {
        $result = $this->CI->db->insert_batch($table, $data);
        // Check the result of the batch insertion
        if ($result) {
            return true; // Entire batch inserted successfully
        } else {
            return false; // Some rows in the batch may have failed
        }
    }

    public function update($table, $data, $where)
    {
        $this->CI->db->where($where);
        $this->CI->db->update($table, $data);
        return $this->CI->db->affected_rows();
    }

    public function delete($table, $where)
    {
        $this->CI->db->where($where);
        $this->CI->db->delete($table);
        return $this->CI->db->affected_rows();
    }

    public function fetch_all($table)
    {
        $this->CI->db->where('deleted', 0);
        return $this->CI->db->get($table);
    }

    public function fetch_data_asc($table, $where, $order)
    {
        return  $this->CI->db->order_by($order, "asc")->where($where)->get($table);
    }

    public function fetch_data_without_order($table, $where)
    {
        return  $this->CI->db->where($where)->get($table);
    }

    public function fetch_data_desc($table, $where, $order)
    {
        return  $this->CI->db->order_by($order, "desc")->where($where)->get($table);
    }

    public function fetch_all_with_limit($table, $limit)
    {
        return $this->CI->db->limit($limit)->get($table);
    }
    public function fetch_single_row($table, $where)
    {
        return  $this->CI->db->where($where)->get($table)->row();
    }
    public function fetch_stock($stock_id){

    }
}
