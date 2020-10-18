<?php

// if (!eregi("modules.php", $_SERVER['PHP_SELF'])) {
//     die ("You can't access this file directly...");
// }
//
// require_once("mainfile.php");
// $module_name = basename(dirname(__FILE__));
// get_lang($module_name);
function viewcity($dd_terrain3, $dd_terrain4, $dd_terrain5, $dd_terrain6, $dd_terrain7, $dd_xx3, $dd_xx4, $dd_xx5, $dd_xx6, $dd_xx7, $dd_yy3, $dd_yy4, $dd_yy5, $dd_yy6, $dd_yy7)
{
    global $db, $sitename, $admin, $multilingual, $module_name;
    include("header.php");
    title("Town");

    echo "Community Information will be here.";


    include("footer.php");
}

switch ($op) {
        case "viewcity":
            viewcity($dd_terrain3, $dd_terrain4, $dd_terrain5, $dd_terrain6, $dd_terrain7, $dd_xx3, $dd_xx4, $dd_xx5, $dd_xx6, $dd_xx7, $dd_yy3, $dd_yy4, $dd_yy5, $dd_yy6, $dd_yy7);
            break;

        default:
            viewcity($dd_terrain3, $dd_terrain4, $dd_terrain5, $dd_terrain6, $dd_terrain7, $dd_xx3, $dd_xx4, $dd_xx5, $dd_xx6, $dd_xx7, $dd_yy3, $dd_yy4, $dd_yy5, $dd_yy6, $dd_yy7);
            break;

}
