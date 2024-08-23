 <?php
class Query_builder{ 
  protected $sql;
  function __construct(){
        $this->sql = &get_instance();
  }
  function view($query){  
  	return
  	$this->sql->db->query($query)->result_array();
  }
  function view_row($query){ 
    return 
    $this->sql->db->query($query)->row_array();
  }
  function count($query){ 
    return
    $this->sql->db->query($query)->num_rows();
  }
  function add($table,$set){
    $this->sql->db->set($set);
    $this->sql->db->insert($table);

    return $this->sql->db->affected_rows();
  }
  function update($table,$set,$where){
    $this->sql->db->set($set);
    $this->sql->db->where($where);
    $this->sql->db->update($table);

    return $this->sql->db->affected_rows();

  }
  function delete($table,$where){
    $this->sql->db->where($where);
    $this->sql->db->delete($table);

    return $this->sql->db->affected_rows();
  }
}