<?php

// Database connection
$conn = new mysqli("localhost", "root", "", "mcc_bsit_quiz_and_exam");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch data from ms_365_users table
$sql = "SELECT id, first_name, last_name, Username FROM ms_365_users";
$result = $conn->query($sql);

?>

<?php require __DIR__ . '/./partials/header.php' ?>
<div class="container-fluid">
    <div class="row">

        <?php require __DIR__ . '/./partials/sidebar.php'; ?>

        <div class="col-lg-10 p-0 overflow-y-auto" style="max-height: 100vh;">
            <?php require __DIR__ . '/./partials/navbar.php'; ?>

            <div class="w-100 p-3">
                <div class="row g-3">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h5><i class="bx bx-user"></i> MS 365 Account</h5>
                            </div>
                            <div data-aos="fade-down" class="col-12">
                                <div class="card recent-sales overflow-auto border-3 border-top border-info">
                                    <div class="card-body">
                                        <div class="row d-flex justify-content-end align-items-center mt-4">
                                            <div class="text-start">
                                                <form action="import.php" method="post" enctype="multipart/form-data">
                                                    <input type="file" name="file" required accept=".csv">
                                                    <button type="submit" name="save_csv_data" class="btn btn-danger">
                                                        <b>Import</b>
                                                    </button>
                                                    <a href="export.php" class="btn btn-info" role="button" style="color: white;">
                                                   <b>Export</b>
                                                  </a>
                                              <button type="button" class="btn btn-secondary" onclick="printPDF()">
                                              <b>Print </b>
                                               </button>
                                                </form>
                                              
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <div class="container">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            <div class="data_table">
                                                                <table id="myDataTable" class="table table-striped table-bordered">
                                                                    <br>
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                            <th>Firstname</th>
                                                                            <th>Lastname</th>
                                                                            <th>Email</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <?php
                                                                        if ($result->num_rows > 0) {
                                                                            while ($row = $result->fetch_assoc()) {
                                                                                echo "<tr>
                                                                                <td>" . $row['id'] . "</td>
                                                                                <td>" . $row['first_name'] . "</td>
                                                                                <td>" . $row['last_name'] . "</td>
                                                                                <td>" . $row['Username'] . "</td>
                                                                            </tr>";
                                                                            }
                                                                        } else {
                                                                            echo "<tr><td colspan='4' style='text-align: center;'>No records found</td></tr>";
                                                                        }
                                                                        ?>
                                                                    </tbody>
                                                                </table>
                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<!-- Include DataTables and Buttons extension -->
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.3.6/css/buttons.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script>
    async function printPDF() {
        const { jsPDF } = window.jspdf;
        const doc = new jsPDF({
            orientation: "landscape", // Set orientation to landscape or portrait
            unit: "mm", // Use mm for units
            format: "a4", // Set page format to A4
            putOnlyUsedFonts: true,
            floatPrecision: 16 // Avoid floating point issues
        });

        const table = document.getElementById('myDataTable');
        let pdfContent = [];

        // Collect table headers
        let headerData = [];
        for (let header of table.tHead.rows[0].cells) {
            headerData.push(header.innerText);
        }
        pdfContent.push(headerData); // Add headers to content

        // Collect table data
        for (let row of table.rows) {
            let rowData = [];
            for (let cell of row.cells) {
                rowData.push(cell.innerText);
            }
            pdfContent.push(rowData);
        }

        // Add content to PDF with better positioning
        const startY = 20; // Start Y position
        const rowHeight = 10; // Row height

        pdfContent.forEach((rowData, index) => {
            doc.text(rowData.join(' | '), 10, startY + (index * rowHeight));
        });

        // Save the PDF
        doc.save("users_data.pdf");
    }
</script>
<script>
    // Initialize AOS (Animate On Scroll)
    AOS.init();

    // Initialize DataTables with Export Buttons
    $(document).ready(function() {
        $('#myDataTable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'copy', 'csv', 'excel', 'pdf', 'print'
            ]
        });

        // Sidebar toggle
        $('.toggle-sidebar-btn').click(function() {
            $('body').toggleClass('toggle-sidebar');
        });

        // Auto-numbering rows (if necessary)
        let table = document.querySelector('#myDataTable');
        let rows = table.querySelectorAll('tbody tr');
        rows.forEach((row, index) => {
            row.querySelector('.auto-id').textContent = index + 1;
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php require __DIR__ . '/./partials/footer.php' ?>
