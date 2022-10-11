<nav class="navbar navbar-expand-lg">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse text-center menu" id="navbarNavDropdown">
            <ul class="navbar-nav ">
                <li class="nav-item active">
                    <a class="nav-link
                    <?php if ($_SERVER['REQUEST_URI'] === '/company') { ?>
                        active
                    <?php }  ?>
                    " href="/company">
                        <i class="fa-solid fa-briefcase"></i> comanies</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link
                    <?php if ($_SERVER['REQUEST_URI'] === '/store') { ?>
                        active
                    <?php }  ?>
                    " href="/store">
                        <i class="fa-solid fa-store"></i> stores</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

