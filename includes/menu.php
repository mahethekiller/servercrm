<?php
function display_menu($role)
{
    global $db;

    $items = $db->get_results("SELECT menu_item FROM permissions WHERE role = '$role'");

    echo "<ul class='menu'>";
    foreach ($items as $item) {
        echo "<li>" . htmlspecialchars($item['menu_item']) . "</li>";
    }
    echo "</ul>";
}
