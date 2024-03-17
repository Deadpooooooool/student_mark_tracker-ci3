<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Marks_model extends CI_Model
{
    public function insert_mark($studentId, $month, $marks)
    {
        $data = [
            'student_id' => $studentId,
            'month' => $month,
            'marks' => $marks
        ];
        $this->db->insert('marks', $data);
    }

    public function get_marks_chart_data()
    {
        $this->db->select('CAST(month AS UNSIGNED) AS month, AVG(marks) as average_marks');
        $this->db->from('marks');
        $this->db->join('students', 'marks.student_id = students.id');
        $this->db->group_by('month');
        $this->db->order_by('month', 'ASC');
        $query = $this->db->get();
        return $query->result_array();
    }

    public function mark_exists($studentId, $month) {
        $this->db->where('student_id', $studentId);
        $this->db->where('month', $month);
        $query = $this->db->get('marks');
        return $query->num_rows() > 0;
    }
    
}
