<?php
defined('BASEPATH') or exit('No direct script access allowed');
class StudentController extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Marks_model');
        $this->load->model('Student_model');
        $this->load->helper('url');
    }

    public function index()
    {
        $data['chart_data'] = $this->Marks_model->get_marks_chart_data();
        $this->load->view('templates/header');
        $this->load->view('chart', $data);
    }

    public function save()
    {
        // Set validation rules
        $this->form_validation->set_rules('student_name', 'Student Name', 'required|alpha_numeric_spaces|min_length[2]|max_length[100]');
        $this->form_validation->set_rules('month', 'Month', 'required|integer|less_than_equal_to[12]|greater_than_equal_to[1]');
        $this->form_validation->set_rules('marks', 'Marks', 'required|integer|less_than_equal_to[100]|greater_than_equal_to[0]');

        if ($this->form_validation->run() == FALSE) {
            // Load the form view with errors
            $data['errors'] = validation_errors();
            $this->load->view('save_mark', $data);
        } else {
            $studentName = $this->input->post('student_name', TRUE);
            $month = $this->input->post('month', TRUE);
            $marks = $this->input->post('marks', TRUE);

            // Fetch the student, automatically adding them if they don't exist
            $student = $this->Student_model->get_student_by_name($studentName);

            // No need to check if student exists since it's handled in the model
            if ($this->Marks_model->mark_exists($student['id'], $month)) {
                // Load the form view with an error message
                $this->session->set_flashdata('errors', 'This student has already been entered for the selected month.');
                redirect('/save'); // Adjust the redirect accordingly
            } else {
                // Insert the mark
                $this->Marks_model->insert_mark($student['id'], $month, $marks);
                // Load the view with a success message
                $this->session->set_flashdata('message', 'Mark saved successfully.');
                redirect('/save'); // Adjust the redirect to the appropriate URL
            }
        }
    }



    public function chart()
    {
        $data['chart_data'] = $this->Marks_model->get_marks_chart_data();
        $this->load->view('chart', $data);
    }
}
