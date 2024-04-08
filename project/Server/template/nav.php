<section class="header-section">
    <div class="container">
        <div class="nexus-header-item">
            <a href="#" class="nexus-header-link">
                <h3 class="title-medium-text">
                    nexus
                </h3>
            </a>
        </div>
        <?php if(isset($_SESSION['username'])): ?>
            <div class="nexus-header-item nexus-header-item-mr-0">
                <a href="?page=dashboard" class="nexus-header-link">
                    <img class="nexus-avatar" src="<?php echo ICONS_PATH; ?>default_user_icon.svg" alt="User Avatar" height="20" width="20" />
                    <p class="caption-text"><?php echo $_SESSION['username']; ?></p>
                </a>
            </div>
            <div class="nexus-header-item nexus-header-item-mr-0">
                <a href="upload.php" class="nexus-header-link">
                    <p class="caption-text">Libraries</p>
                </a>
            </div>
        <?php else: ?>
        <div class="nav-wrapper">

            <div class="nexus-header-item nexus-header-item-mr-0">
                <a href="?page=login" class="nexus-header-link">
                    <p class="caption-text">Login</p>
                </a>
            </div>
            <div class="nexus-header-item nexus-header-item-mr-0">
                <a href="?page=signup" class="nexus-header-link">
                    <p class="caption-text">Signup</p>
                </a>
            </div>
        </div>

        <?php endif; ?>
    </div>
</section>
