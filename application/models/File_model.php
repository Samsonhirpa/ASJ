<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class File_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
        $this->load->database();
    }
    
    /**
     * Upload manuscript file
     */


/**
 * Upload manuscript file
 */
public function uploadFile($manuscriptId, $fieldName, $fileType = null)
{
    // Configure upload
    $config['upload_path'] = './uploads/manuscripts/';
    $config['allowed_types'] = 'pdf|doc|docx|tex|txt|jpg|jpeg|png|gif|tiff|csv|xlsx|zip';
    $config['max_size'] = 102400; // 100MB (100 * 1024)
    $config['encrypt_name'] = true;
    
    // Create directory if not exists
    if (!is_dir($config['upload_path'])) {
        mkdir($config['upload_path'], 0777, true);
    }
    
    $this->load->library('upload', $config);
    
    if (!empty($_FILES[$fieldName]['name'])) {
        if ($this->upload->do_upload($fieldName)) {
            $uploadData = $this->upload->data();
            
            // Determine file type if not provided
            if($fileType === null) {
                $ext = strtolower($uploadData['file_ext']);
                if(in_array($ext, ['.jpg', '.jpeg', '.png', '.gif', '.tiff'])) {
                    $fileType = 'figure';
                } elseif(in_array($ext, ['.csv', '.xlsx', '.zip'])) {
                    $fileType = 'supplementary';
                } else {
                    $fileType = 'main';
                }
            }
            
            // Save to database
            $fileData = array(
                'manuscriptId' => $manuscriptId,
                'fileType' => $fileType,
                'fileName' => $uploadData['orig_name'],
                'filePath' => 'uploads/manuscripts/' . $uploadData['file_name'],
                'fileSize' => $uploadData['file_size'] * 1024,
                'mimeType' => $uploadData['file_type'],
                'uploadedBy' => $this->session->userdata('userId'),
                'createdDtm' => date('Y-m-d H:i:s')
            );
            
            $this->db->insert('tbl_manuscript_files', $fileData);
            return true;
        } else {
            return $this->upload->display_errors();
        }
    }
    
    return null;
}

   
    
    /**
     * Delete file
     */
    public function deleteFile($fileId)
    {
        // Get file info to delete physical file
        $file = $this->db->get_where('tbl_manuscript_files', ['fileId' => $fileId])->row();
        
        if ($file && file_exists('./' . $file->filePath)) {
            unlink('./' . $file->filePath);
        }
        
        // Soft delete
        $this->db->where('fileId', $fileId);
        return $this->db->update('tbl_manuscript_files', ['isDeleted' => 1]);
    }
}