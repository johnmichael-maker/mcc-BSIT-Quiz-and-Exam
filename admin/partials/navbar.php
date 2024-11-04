<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm dont-print" style="z-index: 1 !important;">
 <div class="container">

        <button class="navbar-toggler d-lg-none d-lg-block" id="sidebar-toggler">
            <i class="navbar-toggler-icon"></i>
        </button>
 <h4 style="color: #666666; font-family: Arial, sans-serif; font-weight: 400; font-size: 20px;">
    Madridejos Community College
</h4>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                    <img src="<?= $_SESSION['AUTH_IMG'] ?>" alt="image" style="width: 40px;" class="border rounded-circle py-1">
                    <?= $_SESSION['AUTH_KEY'] ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-item">
                        <a href="#" class="text-decoration-none text-dark" onclick="showDetails('John Michaelle Robles', 'North', 'johnmichaellerobles@gmail.com', '2024', 'Full Stack Developer');" data-bs-toggle="modal" data-bs-target="#developerModal">
                            <i class="bx bx-info-circle"></i> Developer Info
                        </a>
                    </li>
                    <li class="dropdown-item">
                        <a href="#" onclick="return showLogout()" class="text-decoration-none text-dark">
                            <i class="bx bx-log-out"></i> Logout
                        </a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>
<div class="modal fade" id="developerModal" tabindex="-1" aria-labelledby="developerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="developerModalLabel">Developer Details:</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                  <h5>Capstone project</h5>
                <p><strong>Name:</strong> John Michaelle Robles <span id="devName"></span></p>
                <p><strong>Email:</strong> Johnmichaellerobles@gmail.com<span id="devEmail"></span></p>
                <p><strong>Contact no:</strong> 09309333290<span id="devContact"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>


<script>
    let toggle = document.getElementById('sidebar-toggler')
    let sidebar = document.getElementById('menu')
    let close = document.getElementById('close-sidebar')

    toggle.onclick = () => {
        sidebar.classList.remove('d-none', 'd-lg-block')
        sidebar.classList.add('position-fixed', 'start-0', 'top-0')
    }

    close.onclick = () => {
        sidebar.classList.add('d-none', 'd-lg-block')
        sidebar.classList.remove('position-fixed', 'start-0', 'top-0')
    }

    function showLogout() {
        Swal.fire({
            title: "<strong>Are you sure you want to logout?</strong>",
            icon: "info",
            showCloseButton: true,
            showCancelButton: true,
            focusConfirm: false,
            confirmButtonText: `Yes`,
            confirmButtonColor: "#d93645",
            cancelButtonText: `No`,
        }).then((result) => {
            if (result.isConfirmed) {
                window.location = "?logout"
            }
        });
    }
</script>
