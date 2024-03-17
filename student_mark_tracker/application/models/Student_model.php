<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Student_model extends CI_Model
{
    public function insert_student($studentName)
    {
        $data = ['student_name' => $studentName];
        $this->db->insert('students', $data);
        return $this->db->insert_id(); // Return the ID of the inserted student
    }

    public function get_student_by_name($studentName)
{
    // Query the database to retrieve the student details based on the name
    $this->db->select('*');
    $this->db->from('students');
    $this->db->where('student_name', $studentName);
    $query = $this->db->get();

    // Check if the query returned any results
    if ($query->num_rows() > 0) {
        // Return the first row as an associative array
        return $query->row_array();
    } else {
        // Student does not exist, create a new record
        $newStudentData = array(
            'student_name' => $studentName
            // Add any other fields you want to initialize for the new student
        );
        $this->db->insert('students', $newStudentData);

        // Get the ID of the newly inserted student
        $newStudentId = $this->db->insert_id();

        // Query the database again to retrieve the newly created student
        $this->db->where('id', $newStudentId);
        $query = $this->db->get('students');

        // Return the newly created student as an associative array
        return $query->row_array();
    }
}

}
