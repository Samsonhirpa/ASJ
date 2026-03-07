<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Get role name by role ID
 */
function get_role_name($roleId) {
    $roles = array(
        1 => 'System Administrator',
        2 => 'Manager',
        3 => 'Employee',
        4 => 'Office Boy',
        5 => 'Receptionist',
        6 => 'Project Manager',
        7 => 'Project Manager L2',
        8 => 'Project Manager L3',
        9 => 'Project Manager L4',
        10 => 'Project Manager L5',
        11 => 'Project Manager L6',
        12 => 'Data Entry Operator',
        13 => 'Editor-in-Chief',
        14 => 'Associate Editor-in-Chief',
        15 => 'Managing Editor',
        16 => 'Associate Editor',
        17 => 'Specialty Chief Editor',
        18 => 'Editorial Advisory Board',
        19 => 'Reviewer',
        20 => 'Guest Editor',
        21 => 'Author'
    );
    
    return isset($roles[$roleId]) ? $roles[$roleId] : 'Unknown';
}

/**
 * Get article type name
 */
function get_article_type_name($type) {
    $types = array(
        'research' => 'Research Article',
        'review' => 'Review Article',
        'short_communication' => 'Short Communication',
        'case_study' => 'Case Study',
        'technical_note' => 'Technical Note'
    );
    
    return isset($types[$type]) ? $types[$type] : $type;
}

/**
 * Get manuscript status badge
 */
function get_status_badge($status) {
    $badges = array(
        'draft' => 'secondary',
        'submitted' => 'info',
        'under_review' => 'warning',
        'revision_required' => 'primary',
        'accepted' => 'success',
        'rejected' => 'danger',
        'published' => 'success'
    );
    
    $color = isset($badges[$status]) ? $badges[$status] : 'secondary';
    return '<span class="badge badge-' . $color . '">' . ucfirst(str_replace('_', ' ', $status)) . '</span>';
}

/**
 * Format file size
 */
function format_file_size($bytes) {
    if ($bytes >= 1073741824) {
        return number_format($bytes / 1073741824, 2) . ' GB';
    } elseif ($bytes >= 1048576) {
        return number_format($bytes / 1048576, 2) . ' MB';
    } elseif ($bytes >= 1024) {
        return number_format($bytes / 1024, 2) . ' KB';
    } elseif ($bytes > 1) {
        return $bytes . ' bytes';
    } elseif ($bytes == 1) {
        return '1 byte';
    } else {
        return '0 bytes';
    }
}

/**
 * Generate DOI
 */
function generate_doi($manuscriptId, $issueId) {
    return '10.1234/ojas.' . date('Y') . '.' . $issueId . '.' . $manuscriptId;
}