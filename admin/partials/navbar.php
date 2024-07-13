<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm dont-print" style=" z-index: 1 !important;">
    <div class="container">

        <button class="navbar-toggler d-lg-none d-lg-block" id="sidebar-toggler"><i class="navbar-toggler-icon"></i></button>

        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
                <a href="" class="dropdown-toggle nav-link" data-bs-toggle="dropdown"> <img src="<?= $_SESSION['AUTH_IMG'] ?>" alt="image" style="width: 40px;" class="border rounded-circle py-1"> <?= $_SESSION['AUTH_KEY'] ?></a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li class="dropdown-item">
                        <a href="#" onclick="return showLogout()" class="text-decoration-none text-dark">
                            <i class="bx bx-log-out"></i> Logout</a>
                    </li>
                </ul>
            </li>
        </ul>

    </div>
</nav>

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