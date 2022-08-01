<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Enkripsi_m extends CI_Model

{
    public function __construct()
    {
        parent::__construct();
    }

    public function insertEncryptData($user, $final_file, $finalfile, $size2, $key, $deskripsi)
    {
        $hsl = $this->db->query("INSERT INTO file VALUES ('', '$user', '$final_file', '$finalfile.rda', 'file_encrypt/$finalfile.rda', '$size2', '$key', now(), '1', '$deskripsi')");
        return $hsl;
    }

    public function selectEncryptData($finalfile)
    {
        $this->db->select('*');
        $this->db->from('file');
        if ($finalfile != null) {
            $this->db->where('file_url', $finalfile);
        }
        $query = $this->db->get();
        return $query;
    }

    public function updateEncryptData($file_url)
    {
        $updatedata = $this->db->query("UPDATE file SET file_url ='$file_url' WHERE file_url=''");
        return $updatedata;
    }
}
