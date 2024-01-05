<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Reminder extends CI_Controller
{
    public function __construct()
    {
        parent::__construct(); 
        // cek login
        if (is_null($this->session->userdata('login'))) {
            redirect(base_url('login'));
        }   

        $this->load->model('m_bahan');
        $this->load->model('m_produk');   
        
    }
    function serverside($where,$model){
        $data = $this->$model->get_datatables($where);
        $total = $this->$model->count_all($where);
        $filter = $this->$model->count_filtered($where);
 
        $output = array(
            "draw" => $_GET["draw"],
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $data,
        );

        return $output;
    } 


    /////////////////////////// bahan /////////////////////////

    public function bahan()
    {
        $data['title'] = 'Reminder Bahan';

        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('reminder/bahan');
        $this->load->view('v_template_admin/admin_footer');
    }
    public function bahan_notif()
    {

        $data = $this->query_builder->count('SELECT * FROM t_bahan as a JOIN t_bahan_gudang as b ON a.bahan_id = b.bahan_gudang_bahan WHERE b.bahan_gudang_panjang = 0 AND a.bahan_hapus = 0');
        echo json_encode($data);

    }
    public function get_bahan()
    {
        $model = 'm_bahan';
        $where = array('bahan_hapus' => 0,'bahan_gudang_panjang' => 0);
        $output = $this->serverside($where, $model);
        echo json_encode($output);
    }
    
    //////////////////////// produk //////////////

    public function produk()
    {
        $data['title'] = 'Reminder Produk';

        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('reminder/produk');
        $this->load->view('v_template_admin/admin_footer');
    }
    public function produk_notif()
    {
        
        $data = $this->query_builder->count('SELECT * FROM t_produk AS a JOIN t_produk_gudang AS b ON a.produk_id = b.produk_gudang_produk WHERE b.produk_gudang_panjang = 0 AND a.produk_hapus = 0');
        echo json_encode($data);

    }
    public function get_produk()
    {
        $model = 'm_produk';
        $where = array('produk_hapus' => 0,'produk_gudang_panjang' => 0);
        $output = $this->serverside($where, $model);
        echo json_encode($output);
    }
        
}