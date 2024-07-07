<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm dont-print" style=" z-index: 1 !important;">
                <div class="container">
                    
                    <button class="navbar-toggler" id="sidebar-toggler"><i class="navbar-toggler-icon"></i></button>

                    <ul class="navbar-nav ms-auto">
                            <li class="nav-item">
                                <a href="?logout" onclick="return confirm('Are you sure you want to logout?')"  class="nav-link text-dark"> <i class="bx bx-log-out"></i> Logout</a>
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

            </script>