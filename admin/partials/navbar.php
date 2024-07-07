<nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top shadow-sm dont-print">
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
                let toggle =document.getElementById('sidebar-toggler')
                let sidebar =document.getElementById('menu')

                toggle.onclick = () => {
                    sidebar.classList.add('d-fixed', 'start-0')
                    sidebar.classList.remove('d-none')
                }

            </script>