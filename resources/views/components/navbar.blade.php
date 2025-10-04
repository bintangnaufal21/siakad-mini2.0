<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Logout -->
        <li class="nav-item">
            <form action="" method="POST">
                @csrf
                <button type="submit" class="btn"><i class="fas fa-sign-in-alt"></i></button>
            </form>
        </li>
    </ul>
</nav>
