<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
/*
	* hydev
	* software dev
*/
class Ekspedisi extends CI_Controller
{
	public function __construct()
    {
        parent::__construct();
        // cek login
        if (is_null($this->session->userdata('login'))) {
            redirect(base_url('login'));
        }        
        $this->load->model('m_ekspedisi');
    }

    public function index()
    {
        $data['title'] = 'Ekspedisi';
    	$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('ekspedisi/index');
		$this->load->view('v_template_admin/admin_footer');
    }
    function get_data()
    {
        $where = array('ekspedisi_hapus' => 0);

        $data   = $this->m_ekspedisi->get_datatables($where);
        $total  = $this->m_ekspedisi->count_all($where);
        $filter = $this->m_ekspedisi->count_filtered($where);

        $output = array(
            "draw" => $_GET['draw'],
            "recordsTotal" => $total,
            "recordsFiltered" => $filter,
            "data" => $data,
        );
        echo json_encode($output);
    }
    function add()
    { 
        $data['title'] = 'Ekspedisi';
        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('ekspedisi/add');
        $this->load->view('v_template_admin/admin_footer');
    }
    function save()
    {
        $set = array(
            'ekspedisi_kode' => strip_tags($_POST['kode']),
            'ekspedisi_nama' => strip_tags($_POST['nama']),
        );
        $db = $this->query_builder->add('t_ekspedisi',$set);

        if ($db == 1) {
            $this->session->set_userdata('success','Data berhasil di tambah');
        } else {
            $this->session->set_userdata('gagal','Data gagal di tambah');
        }        
        redirect(base_url('ekspedisi'));
    }
    function edit($id){

        $data['data'] = $this->query_builder->view_row("SELECT * FROM t_ekspedisi WHERE ekspedisi_id = '$id'");

        $data['title'] = 'Ekspedisi';
        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('ekspedisi/add');
        $this->load->view('ekspedisi/edit');
        $this->load->view('v_template_admin/admin_footer');
    }
    function update($id){

        $set = array(
                        'ekspedisi_nama' => strip_tags(@$_POST['nama']),
                        'ekspedisi_keterangan' => strip_tags(@$_POST['keterangan']), 
                    );
        $db = $this->query_builder->update('t_ekspedisi', $set, ['ekspedisi_id' => $id]);

        if ($db == 1) {
            $this->session->set_userdata('success','Data berhasil di rubah');
        } else {
            $this->session->set_userdata('gagal','Data gagal di rubah');
        }       

        redirect(base_url('ekspedisi'));
    }
    function delete($id){

        $db = $this->query_builder->update('t_ekspedisi', ['ekspedisi_hapus' => 1], ['ekspedisi_id' => $id]);

        if ($db == 1) {
            $this->session->set_userdata('success','Data berhasil di hapus');
        } else {
            $this->session->set_userdata('gagal','Data gagal di hapus');
        }       

        redirect(base_url('ekspedisi'));
    }
}