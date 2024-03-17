<?php
defined('BASEPATH') or exit('No direct script access allowed');
// Prepare data in PHP before outputting the HTML
$months = [];
$marks = [];
// Now, independently from the check above, process $chart_data
foreach ($chart_data as $data) {
    // Converting numerical month to textual representation, e.g., '1' to 'January'
    $months[] = date('F', mktime(0, 0, 0, $data['month'], 10)); // Using '10' is arbitrary, any day in the month works
    $marks[] = $data['average_marks'];
}

// Convert PHP arrays to JSON
$jsonMonths = json_encode($months);
$jsonMarks = json_encode($marks);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Marks Chart</title>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <style>
        .apexcharts-canvas {
            width: -webkit-fill-available !important;
        }

        text#SvgjsText1138 {
            font-size: medium;
        }
    </style>
</head>

<body>
    <h3 class="text-center m-3">Student Marks by Month</h3>

    <div id="marksChart"></div>
    <script>
        // Convert JSON back into arrays in JavaScript
        var months = <?= $jsonMonths; ?>;
        var marks = <?= $jsonMarks; ?>;

        // Define chart options
        var options = {
            chart: {
                type: 'bar', // Define chart type
                height: '550px' // Optional: define height
            },
            series: [{
                name: 'Marks', // Name of the data series
                data: marks // Data for the series
            }],
            xaxis: {
                categories: months // Assign months to the categories on the x-axis
            },
            yaxis: {
                title: {
                    text: 'Marks' // Y-axis title
                },
                labels: { 
                formatter: function(value) {
                    return value.toFixed(2); // Formats the value to two decimal places
                }
                },
                min: 0, // Optional: Define min value for Y-axis
                max: 100 // Optional: Define max value for Y-axis (if marks are out of 100)
            },
        };

        // Initialize the chart and render it in the page
        var chart = new ApexCharts(document.querySelector("#marksChart"), options);
        chart.render();
    </script>
</body>

</html>