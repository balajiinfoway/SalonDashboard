<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CommonModel extends CI_Model {
    function __construct() {
        parent::__construct();
    }
    public function insert($table, $data) {
        $response = $this->db->insert($table, $data);
        return $this->db->insert_id();
    }
    public function updateTable($table, $condition, $data) {
        $this->db->where($condition);
        $response = $this->db->update($table, $data);
        return $response;
    }
    public function selectData($table, $condition = array()) {
        if (isset($condition['fields'])) {
            $fields = $condition['fields'];
        } else {
            $fields = "*";
        }
        $this->db->select($fields);
        $this->db->from($table);
        if (isset($condition['conditions'])) {
            $this->db->where($condition['conditions']);
        }
        if (isset($condition['or_where'])) {
            $this->db->or_where($condition['or_where']);
        }
        if (isset($condition['like'])) {
            $this->db->like($condition['like']);
        }
        if (isset($condition['or_like'])) {
            $this->db->or_like($condition['or_like']);
        }
        if (isset($condition['group_by'])) {
            $this->db->group_by($condition['group_by']);
        }
        if (isset($condition['order_by'])) {
            $this->db->order_by($condition['order_by']['field'], $condition['order_by']['order']);
        }
        if (isset($condition['where_in'])) {
            $where_in = $condition['where_in'];
            foreach ($where_in as $key => $value) {
                $this->db->where_in($key, $value);
            }
        }
        if (isset($condition['joins'])) {
            $joins = $condition['joins'];
            foreach ($joins as $join) {
                $this->db->join($join['table'], $join['joinWith'], $join['type']);
            }
        }
        if (isset($condition['limits'])) {
            $this->db->limit($condition['limits']['limit'], $condition['limits']['start']);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function selectSingleData($table, $condition = NULL) {
        $this->db->select('*');
        $this->db->from($table);
        if ($condition != NULL) {
            $this->db->where($condition);
        }
        $query = $this->db->get();
        return $query->row_array();
    }
    public function delete($table, $condition) {
        $this->db->where($condition);
        $this->db->delete($table);
        return true;
    }
    public function selectWithJoin($table, $joins = array(), $fields = "*", $condition = NULL) {
        $this->db->select($fields);
        $this->db->from($table);
        foreach ($joins as $join) {
            $this->db->join($join['table'], $join['joinWith'], $join['type']);
        }
        if ($condition != NULL) {
            $this->db->where($condition);
        }
        $query = $this->db->get();
        return $query->result_array();
    }
    public function selectSingleRow($table, $condition = array()) {
        if (isset($condition['fields'])) {
            $fields = $condition['fields'];
        } else {
            $fields = "*";
        }
        $this->db->select($fields);
        $this->db->from($table);
        if (isset($condition['conditions'])) {
            $this->db->where($condition['conditions']);
        }
        if (isset($condition['or_where'])) {
            $this->db->or_where($condition['or_where']);
        }
        if (isset($condition['group_by'])) {
            $this->db->group_by($condition['group_by']);
        }
        if (isset($condition['order_by'])) {
            $this->db->group_by($condition['order_by']['field'], $condition['order_by']['order']);
        }
        if (isset($condition['joins'])) {
            $joins = $condition['joins'];
            foreach ($joins as $join) {
                $this->db->join($join['table'], $join['joinWith'], $join['type']);
            }
        }
        $query = $this->db->get();
        return $query->row_array();
    }
    function num_rows($table, $condition = array()) {
        $this->db->select('*');
        $this->db->from($table);
        if (isset($condition['conditions'])) {
            $this->db->where($condition['conditions']);
        }
        $query = $this->db->get();
        return $query->num_rows();
    }

    function countAllResult($table, $condition = array()){
        $this->db->select('*');
        $this->db->from($table);
        if(isset($condition['conditions'])){
            $this->db->where($condition['conditions']);
        }
        return $this->db->count_all_results();
    }


}
?>