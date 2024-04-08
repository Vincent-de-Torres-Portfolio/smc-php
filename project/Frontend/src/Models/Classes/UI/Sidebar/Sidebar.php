<?php
namespace Classes\UI\Sidebar;


include_once "SidebarItem.php";

define( 'NAV_ITEMS_MAIN' , [
    'Home'=>['Home','home.svg','library.php?view=all'],
    'Recent' => ['Recent', 'recent.svg', 'library.php?view=recent'],
    'Pinned' => ['Pinned', 'pin.svg', 'library.php?view=Pinned'],
]);

define( 'NAV_ITEMS_MEDIA' , [
    'Images' => ['Images', 'photo.svg', 'library.php?view=photo'],
    'Videos' => ['Videos', 'video.svg', 'library.php?view=video'],
    'Audios' => ['Audios','music.svg','library.php?view=audio'],
]);

define( 'NAV_ITEMS_ACTION' , [
    'Upload' => ['Upload', 'upload.svg', 'upload.php'],
    'Logout' => ['Logout', 'logout.svg', 'logout.php'],
    'Trash' => ['Trash', 'Trash.svg', '#trash'],
//    'Categories' => ['Categories', 'sort-cat.svg', '#Categories'],
]);

define('NAV_ITEMS_CUSTOM',[

]);

function generateSidePanel($menuArray)
{
    $returnSidePanel = '';

    foreach ($menuArray as $label => $menuItemData) {
        list($menuItem, $iconPath, $hashLink) = $menuItemData;
        $returnSidePanel .= generateSidebarItem($label, $hashLink, $iconPath);
    }
    return $returnSidePanel;
}

$menuArrays = [
    'Main' => NAV_ITEMS_MAIN,
    'Media' => NAV_ITEMS_MEDIA,
//    'Custom' => NAV_ITEMS_CUSTOM,
    'Action' => NAV_ITEMS_ACTION
];

foreach ($menuArrays as $menuName => $menuArray) {
    echo '<div class="panel-group">' . generateSidePanel($menuArray) . '</div>';
}
