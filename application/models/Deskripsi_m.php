<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Deskripsi_m extends CI_Model
{
    public function get($id = null)
    {
        $this->db->select('*');
        $this->db->from('file');
        // order by file_id
        $this->db->order_by('file_id', 'DESC');

        if ($id != null) {
            $this->db->where('file_id', $id);
        }
        $query = $this->db->get();
        return $query;
    }

    public function get2($id = null)
    {
        $this->db->select('*');
        $this->db->from('file');
        if ($id != null) {
            $this->db->where('file_id', $id);
        }
        $query = $this->db->get();
        return $query->result();
    }

    public function getDataFileByPassword($id_file, $pwdfile)
    {
        $this->db->select('password');
        $this->db->from('file');
        if ($id_file != null) {
            $this->db->where('file_id', $id_file);
            $this->db->where('password', $pwdfile);
        }
        $query = $this->db->get();
        return $query->result();
    }
    public function updateStatusFile($id_file)
    {
        $hsl = $this->db->query("UPDATE file SET status='2' WHERE file_id='$id_file'");
        return $hsl;
    }
}
