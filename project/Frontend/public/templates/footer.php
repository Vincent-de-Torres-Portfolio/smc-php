<?php
/**
 * This is the footer section of the project's webpage. It contains:
 *
 * - A copyright notice that dynamically displays the current year and the company name (nexus).
 * - A navigation bar with links to the MIT License, the project's GitHub page, a sponsorship page, and a page to report issues.
 *
 * All links are designed to open in a new tab or window.
 */
?>

<footer class="footer-section">
    <div class="container">
        <div class="opensource-footer-item">
            <p class="caption-text">&copy; <?php echo date("Y"); ?> nexus | &trade;</p>
        </div>
        <div class="opensource-footer-item">
            <nav>
                <a href="https://opensource.org/licenses/MIT" class="caption-text" target="_blank">MIT License</a>
                <a href="https://github.com/devinci-it/#" class="caption-text" target="_blank"> GitHub</a>
                <a href="https://github.com/sponsors/devinci-it" class="caption-text" target="_blank">Sponsor</a>
                <a href="https://github.com/devinci-it/#/issues" class="caption-text" target="_blank">Report Issue</a>
            </nav>
        </div>
    </div>
</footer>