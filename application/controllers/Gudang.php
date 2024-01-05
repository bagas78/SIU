<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Gudang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        // cek login
        if (is_null($this->session->userdata('login'))) {
            redirect(base_url('login'));
        }        
        $this->load->model('m_gudang');
    }
    public function index()
    {
        $data['title'] = 'Gudang';
    	$this->load->view('v_template_admin/admin_header',$data);
		$this->load->view('gudang/index');
		$this->load->view('v_template_admin/admin_footer');
    }
    function get_data()
    {
        $where = array('gudang_hapus' => 0);

        $data   = $this->m_gudang->get_datatables($where);
        $total  = $this->m_gudang->count_all($where);
        $filter = $this->m_gudang->count_filtered($where);

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
        $data['title'] = 'Gudang';
        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('gudang/add');
        $this->load->view('v_template_admin/admin_footer');
    }
    function save()
    {
        $set = array(
            'gudang_kode' => strip_tags($_POST['kode']),
            'gudang_nama' => strip_tags($_POST['nama']),
        );
        $db = $this->query_builder->add('t_gudang',$set);

        if ($db == 1) {
            $this->session->set_flashdata('success','Data berhasil di tambah');
        } else {
            $this->session->set_flashdata('gagal','Data gagal di tambah');
        }        
        redirect(base_url('gudang'));
    }

    function edit($id)
    {
        $data['title'] = 'Gudang';
        $data['data'] = $this->query_builder->view_row("SELECT * FROM t_gudang WHERE gudang_id = '$id'");

        $this->load->view('v_template_admin/admin_header',$data);
        $this->load->view('gudang/edit');
        $this->load->view('v_template_admin/admin_footer');
    }
    function update($id)
    {
        $set = array(
            'gudang_kode' => strip_tags($_POST['kode']),
            'gudang_nama' => strip_tags($_POST['nama']),
        );
        $where = ['gudang_id' => $id];
        $db = $this->query_builder->update('t_gudang',$set,$where);
        
        if ($db == 1) {
            $this->session->set_flashdata('success','Data berhasil di rubah');
        } else {
            $this->session->set_flashdata('gagal','Data gagal di rubah');
        }        
        redirect(base_url('gudang'));
    }

    function delete($id)
    {
        $set    = ['gudang_hapus' => 1];    // hydev soft delete
        $where  = ['gudang_id' => $id];
        $db     = $this->query_builder->update('t_gudang',$set,$where);
        
        if ($db == 1) {
            $this->session->set_flashdata('success','Data berhasil di hapus');
        } else {
            $this->session->set_flashdata('gagal','Data gagal di hapus');
        }        
        redirect(base_url('gudang'));
    }
}