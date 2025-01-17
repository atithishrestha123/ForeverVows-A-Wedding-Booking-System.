<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!--========== BOX ICONS ==========-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!--========== CSS ==========-->
    <link rel="stylesheet" href="styles.css">

    <title>Responsive sidebar submenu</title>
</head>

<body>
    <!--========== HEADER ==========-->
    <header class="header">
        <div class="header__container">
            <img src="../Assets/Logo.png" alt="" class="header__img">

            <a href="../webpage/dashboard.php" class="header__logo">ForeverVows</a>

            <div class="header__search">
                <input type="search" placeholder="Search" class="header__input">
                <i class='bx bx-search header__icon'></i>
            </div>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header>

    <!--========== NAV ==========-->
    <div class="nav" id="navbar">
        <nav class="nav__container">
            <div>
                <a href="../webpage/dashboard.php" class="nav__link nav__logo">
                    <img src="../Assets/logo.png" alt="Forever" class="header__img">
                    <span class="nav__logo-name">ForeverVows</span>
                </a>

                <div class="nav__list">
                    <div class="nav__items">
                        <h3 class="nav__subtitle">Profile</h3>

                        <a href="../webpage/dashboard.php" class="nav__link active">
                            <i class='bx bx-home nav__icon'></i>
                            <span class="nav__name">Home</span>
                        </a>

                        <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class='bx bx-user nav__icon'></i>
                                <span class="nav__name">Customer Details</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>

                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="../User/update_customer.php" class="nav__dropdown-item">Update</a>
                                </div>
                            </div>
                        </div>
                        <a href="../Booking/create_booking.php" class="nav__link">
                            <i class="bx bx-calendar nav__icon"></i>
                            <span class="nav__name">Booking</span>
                        </a>
                        <!-- For Service Details -->
                        <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class="fas fa-concierge-bell nav__icon"></i>
                                <span class="nav__name">Service Details</span>
                                <i class="bx bx-chevron-down nav__icon nav__dropdown-icon"></i>
                            </a>
                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="../Service/add_service.php" class="nav__dropdown-item">Add</a>
                                    <a href="../Service/update_service.php" class="nav__dropdown-item">Update</a>
                                </div>
                            </div>
                        </div>


                        <div class="nav__dropdown">
                            <a href="#" class="nav__link">
                                <i class='bx bxs-paint nav__icon'></i>
                                <span class="nav__name">Decoration Details</span>
                                <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                            </a>
                            <div class="nav__dropdown-collapse">
                                <div class="nav__dropdown-content">
                                    <a href="../Decoration/add_decoration.php" class="nav__dropdown-item">Add</a>
                                    <a href="../Decoration/update_decoration.php" class="nav__dropdown-item">Update</a>
                                </div>
                            </div>
                        </div>
                        <a href="../About_Us/about_us.php" class="nav__link">
                            <i class='bx bx-info-circle nav__icon'></i>
                            <span class="nav__name">About Us</span>
                        </a>

                        <div class="nav__items">
                            <h3 class="nav__subtitle">Menu</h3>

                            <div class="nav__dropdown">
                                <a href="#" class="nav__link">
                                    <i class='bx bx-bell nav__icon'></i>
                                    <span class="nav__name">Notifications</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>

                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="#" class="nav__dropdown-item">Blocked</a>
                                        <a href="#" class="nav__dropdown-item">Silenced</a>
                                        <a href="#" class="nav__dropdown-item">Publish</a>
                                        <a href="#" class="nav__dropdown-item">Program</a>
                                    </div>
                                </div>

                            </div>

                            <a href="#" class="nav__link">
                                <i class='bx bx-compass nav__icon'></i>
                                <span class="nav__name">Explore</span>
                            </a>
                            <a href="#" class="nav__link">
                                <i class='bx bx-bookmark nav__icon'></i>
                                <span class="nav__name">Saved</span>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="../User/logout.php" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon'></i>
                    <span class="nav__name">Log Out</span>
                </a>
        </nav>
    </div>
    <script src="main.js"></script>
</body>

</html>