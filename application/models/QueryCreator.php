<?php 
class QueryCreator extends CI_Model {
    /*
        This method returns single or multiple records
    */
    public function selectQuery($table,$columnsToSelect,$comparisonColumnsAndValues,$recordType,$sortingColumnsAndValues,$groupingColumnsAndValues,$limit){
        $this->CI->db->select($columnsToSelect);
        $this->CI->db->from($table);
        foreach($comparisonColumnsAndValues as $key => $value){
            $whereType = $value[1];
            $this->CI->db->$whereType($key,$value[0]);
        }
        foreach($sortingColumnsAndValues as $key => $value){
            $this->CI->db->order_by($key,$value);
        }
        foreach($groupingColumnsAndValues as $value){
            $this->CI->db->group_by($value);
        }
        if(count($limit)>0){
            $this->CI->db->limit($limit[0],$limit[1]);   
        }
        $res = $this->CI->db->get();
        return ($recordType=='Single') ? $res->row_array() : $res->result_array();
    }

    /*
        This method returns no of rows
    */
    public function noOfRecords($table,$comparisonColumnsAndValues){
        $this->CI->db->select('');
        $this->CI->db->from($table);
        foreach($comparisonColumnsAndValues as $key => $value){
            $whereType = $value[1];
            $this->CI->db->$whereType($key,$value[0]);
        }
        $res = $this->CI->db->get();
        return $res->num_rows();
    }

    /*
        This method add single record
    */
    public function insertSingle($table,$data){
        $this->CI->db->insert($table,$data);
        return $this->CI->db->insert_id();
    }

    /*
        This method add multiple record
    */
    public function insertMultiple($table,$data){
        $this->CI->db->insert_batch($table,$data);
        return $this->CI->db->insert_id();
    }

    /*
        This method update single or multiple records
    */
    public function updateQuery($table,$comparisonColumnsAndValues,$targetColumnsAndValues){
        foreach($comparisonColumnsAndValues as $key => $value){
            $whereType = $value[1];
            $this->CI->db->$whereType($key,$value[0]);
        }
        $this->CI->db->update($table,$targetColumnsAndValues);
        return $this->CI->db->affected_rows();
    }

    /*
        This method delete single or multiple records
    */
    public function deleteQuery($table,$comparisonColumnsAndValues){
        foreach($comparisonColumnsAndValues as $key => $value){
            $whereType = $value[1];
            $this->CI->db->$whereType($key,$value[0]);
        }
        $this->CI->db->delete($table);
        return $this->CI->db->affected_rows();
    }

    /*
        This method joins 2 or more tables and returns single or multiple records
    */
    public function joinInnerQuery($tableComparisonColumns,$columnsToSelect,$comparisonColumnsAndValues,$recordType,$sortingColumnsAndValues,$groupingColumnsAndValues,$limit){
        $this->CI->db->select($columnsToSelect);
        foreach($tableComparisonColumns as $key => $value){
            if(empty($value)){
                $this->CI->db->from($key);
            }
            else {
                $this->CI->db->join($key,$value);        
            }
        }
        foreach($comparisonColumnsAndValues as $key => $value){
            $whereType = $value[1];
            $this->CI->db->$whereType($key,$value[0]);
        }
        foreach($sortingColumnsAndValues as $key => $value){
            $this->CI->db->order_by($key,$value);
        }
        foreach($groupingColumnsAndValues as $value){
            $this->CI->db->group_by($value);
        }
        if(count($limit)>0){
            $this->CI->db->limit($limit[0],$limit[1]);   
        }
        $res = $this->CI->db->get();
        return ($recordType=='Single') ? $res->row_array() : $res->result_array();
    }

    /*
        This method joins 2 or more tables and returns no of records
    */
    public function joinInnerNoOfRecords($tableComparisonColumns,$comparisonColumnsAndValues){
        $this->CI->db->select('');
        foreach($tableComparisonColumns as $key => $value){
            if(empty($value)){
                $this->CI->db->from($key);
            }
            else {
                $this->CI->db->join($key,$value);        
            }
        }
        foreach($comparisonColumnsAndValues as $key => $value){
            $whereType = $value[1];
            $this->CI->db->$whereType($key,$value[0]);
        }
        $res = $this->CI->db->get();
        return $res->num_rows();
    }

    /*
        This method return single or multiple records, It is only for getting data
    */
    public function customQuery($sql,$recordType){
        $query = $this->CI->db->query($sql);
        return ($recordType=='Single') ? $query->row_array() : $query->result_array();
    }
}