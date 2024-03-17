<?php
defined('BASEPATH') or exit('No direct script access allowed');
$this->load->view('templates/header'); ?>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<body>
    <?php if ($this->session->flashdata('message')) : ?>
        <script>
            Swal.fire({
                title: 'Success!',
                text: '<?php echo $this->session->flashdata('message'); ?>',
                icon: 'success',
                confirmButtonText: 'Okay'
            });
        </script>
    <?php endif; ?>

    <?php if ($this->session->flashdata('errors')) : ?>
        <script>
            Swal.fire({
                title: 'Error!',
                text: '<?php echo $this->session->flashdata('errors'); ?>',
                icon: 'error',
                confirmButtonText: 'Okay'
            });
        </script>
    <?php endif; ?>
    <div class="container">
        <h3 class="text-center m-3">Enter Student Marks</h3>
        <form action="<?php echo site_url('save'); ?>" method="post" id="marksForm">
            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" class="form-control" name="student_name" id="student_name" required pattern="[A-Za-z ]{2,100}" title="Name should only contain letters and spaces, and must be 2 to 100 characters long">
            </div>
            <div class="form-group">
                <label for="month">Month:</label>
                <select name="month" id="month" class="form-control" required>
                    <option value="" default disabled>Select a Month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11">November</option>
                    <option value="12">December</option>
                </select>
            </div>
            <div class="form-group">
                <label for="marks">Marks:</label>
                <input type="number" class="form-control" name="marks" id="marks" min="0" max="100" required title="Marks should be between 0 and 100">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>