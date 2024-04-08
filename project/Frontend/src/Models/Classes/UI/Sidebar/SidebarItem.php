<?php
namespace Classes\UI\Sidebar;


function generateSidebarItem($label,$href,$icon)
{
    $iconPath = "public/assets/icons/nav/" . $icon;

    return '<li class="side-menu-item">
<a href="' . $href . '">
<img src="' . $iconPath . '" alt="' . $label . ' Icon">' . $label . '</a></li>';

}

// Example usage:
//echo generateSideNav('Main', 'Recent', 'icons/nav/recent.svg');
