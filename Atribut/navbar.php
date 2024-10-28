<style>
    .navbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background-color: #654520;
        padding: 10px 20px;
        position: relative;
       
    }

    .navbar .logo img {
        height: 50px;
    }

    .nav-links {
        list-style: none;
        display: flex;
        position: absolute;
        left: 50%;
        /* Menempatkan kiri ke tengah layar */
        transform: translateX(-50%);
        /* Menggeser separuh lebar elemen ke kiri untuk benar-benar berada di tengah */
    }

    .nav-links li {
        margin-left: 20px;
    }

    .nav-links li a {
        text-decoration: none;
        color: #fff;
        font-size: 16px;
        transition: color 0.3s ease;
    }

    .nav-links li a:hover {
        color: #d19b68;
    }
</style>

<nav class="navbar">
    <div class="logo">
        <img src="assets/logo.svg" alt="Logo" style="height: 50px" />
    </div>
    <ul class="nav-links">
        <li><a href="home.php">Home</a></li>
        <li><a href="#byMood">By Mood</a></li>
        <li><a href="#byActivity">By Activity</a></li>
        <li><a href="logout.php">Logout</a></li>
    </ul>
</nav>