<?php


function view($dd_level, $dd_x, $dd_y, $dd_terrain, $dd_terrain3, $dd_terrain4, $dd_terrain5, $dd_terrain6, $dd_terrain7, $dd_xx3, $dd_xx4, $dd_xx5, $dd_xx6, $dd_xx7, $dd_yy3, $dd_yy4, $dd_yy5, $dd_yy6, $dd_yy7, $dd_gridpixels, $dd_ynfill, $dd_linesize)
{
    global $db, $sitename, $admin, $multilingual, $module_name;


    // Load Pattern Data

    $dd_region_name[0] = "The World of Infinesse";
    $dd_region_name[1] = "The Orchid Coast";
    $dd_region_name[2] = "The Sea of Skulls";
    $dd_region_name[3] = "The Shackled Lands";
    $dd_region_name[4] = "The Raven Isles";
    $dd_region_name[5] = "The Shattered Lands";
    $dd_region_name[6] = "The Shield Coast";
    $dd_region_name[7] = "The Shining Highland";
    $dd_region_name[8] = "The Valley of Twilight";
    $dd_region_name[9] = "The Emerald Plains";
    $dd_region_name[10] = "The Wolf Isles";
    $dd_region_name[11] = "The Misty Isles";
    $dd_region_name[12] = "The Palisade Coast";
    $dd_region_name[13] = "The Falcon Isles";
    $dd_region_name[14] = "The Frozen Lands";
    $dd_region_name[15] = "The Shadow Seas";
    $dd_region_name[16] = "The Twin Seas";
    $dd_region_name[17] = "";
    $dd_region_name[18] = "";

    $dd_title[1] = "World";
    $dd_scale[1] = "1500 miles";
    $dd_grids[1] = 0;
    $dd_title[2] = "Region";
    $dd_scale[2] = "150 miles";
    $dd_grids[2] = 10;
    $dd_title[3] = "Kingdom";
    $dd_scale[3] = "15 miles";
    $dd_grids[3] = 10;
    $dd_title[4] = "Campaign";
    $dd_scale[4] = "1 mile";
    $dd_grids[4] = 15;
    $dd_title[5] = "Area";
    $dd_scale[5] = "500 feet";
    $dd_grids[5] = 10;
    $dd_title[6] = "Site";
    $dd_scale[6] = "50 feet";
    $dd_grids[6] = 10;
    $dd_title[7] = "Battlemap";
    $dd_scale[7] = "15 feet";
    $dd_grids[7] = 3;

    $dd_region = (intval($dd_y / 120) * 6) + intval($dd_x / 120) + 1;

    $dd_im = ImageCreateFromPNG("images/world_terrain_data.png");

    // Load filename,trans, set, point, color, and alttext
    // for current, children, ip, primes, and history

    // Always load the first 16 prime terrain types and the terrain types for history
    $dd_branch = "0";
    if ($dd_terrain3 != '') {
        $dd_branch = $dd_branch . "," . $dd_terrain3;
    }
    if ($dd_terrain4 != '') {
        $dd_branch = $dd_branch . "," . $dd_terrain4;
    }
    if ($dd_terrain5 != '') {
        $dd_branch = $dd_branch . "," . $dd_terrain5;
    }
    if ($dd_terrain6 != '') {
        $dd_branch = $dd_branch . "," . $dd_terrain6;
    }
    if ($dd_terrain7 != '') {
        $dd_branch = $dd_branch . "," . $dd_terrain7;
    }

    // $result = $db->sql_query("SELECT * FROM dd_terrain WHERE idx < 16 OR idx IN (" . $dd_branch . ")");
    // while ($row = $db->sql_fetchrow($result)) {
    //     $dd_idx = $row['idx'];
    //     $dd_imgfilename[$dd_idx] = $row['filename'];
    //
    //     $dd_imgtrans[$dd_idx][0] = $row['t0'];
    //     $dd_imgtrans[$dd_idx][1] = $row['t1'];
    //     $dd_imgtrans[$dd_idx][2] = $row['t2'];
    //     $dd_imgtrans[$dd_idx][3] = $row['t3'];
    //     $dd_imgtrans[$dd_idx][4] = $row['t4'];
    //     $dd_imgtrans[$dd_idx][5] = $row['t5'];
    //     $dd_imgtrans[$dd_idx][6] = $row['t6'];
    //     $dd_imgtrans[$dd_idx][7] = $row['t7'];
    //     $dd_imgtrans[$dd_idx][8] = $row['t8'];
    //     $dd_imgtrans[$dd_idx][9] = $row['t9'];
    //
    //     $dd_imgset[$dd_idx] = $row['terrainset'];
    //     $dd_imgpoint[$dd_idx] = $row['interestpoint'];
    //
    //     $dd_imgcolor[$dd_idx] = $row['color'];
    //     $dd_imgalttext[$dd_idx] = $row['alttext'];
    //     $dd_imgkeytext[$dd_idx] = $row['keytext'];
    // }
    // Always load current terrain
    // $result = $db->sql_query("SELECT * FROM dd_terrain WHERE idx = " . $dd_terrain);
    // if ($row = $db->sql_fetchrow($result)) {
    //     $dd_idx = $row['idx'];
    //     $dd_imgfilename[$dd_idx] = $row['filename'];
    //
    //     $dd_imgtrans[$dd_idx][0] = $row['t0'];
    //     $dd_imgtrans[$dd_idx][1] = $row['t1'];
    //     $dd_imgtrans[$dd_idx][2] = $row['t2'];
    //     $dd_imgtrans[$dd_idx][3] = $row['t3'];
    //     $dd_imgtrans[$dd_idx][4] = $row['t4'];
    //     $dd_imgtrans[$dd_idx][5] = $row['t5'];
    //     $dd_imgtrans[$dd_idx][6] = $row['t6'];
    //     $dd_imgtrans[$dd_idx][7] = $row['t7'];
    //     $dd_imgtrans[$dd_idx][8] = $row['t8'];
    //     $dd_imgtrans[$dd_idx][9] = $row['t9'];
    //
    //     $dd_imgset[$dd_idx] = $row['terrainset'];
    //     $dd_imgpoint[$dd_idx] = $row['interestpoint'];
    //
    //     $dd_imgcolor[$dd_idx] = $row['color'];
    //     $dd_imgalttext[$dd_idx] = $row['alttext'];
    //     $dd_imgkeytext[$dd_idx] = $row['keytext'];
    //
    //     $dd_branch = $row['t0'] . "," . $row['t1'] . "," . $row['t2'] . "," . $row['t3'] . "," . $row['t4'] . ",500";
    //     if ($row['t5'] != '') {
    //         $dd_branch = $dd_branch . "," . $row['t5'];
    //     }
    //     if ($row['t6'] != '') {
    //         $dd_branch = $dd_branch . "," . $row['t6'];
    //     }
    //     if ($row['t7'] != '') {
    //         $dd_branch = $dd_branch . "," . $row['t7'];
    //     }
    //     if ($row['t8'] != '') {
    //         $dd_branch = $dd_branch . "," . $row['t8'];
    //     }
    //     if ($row['t9'] != '') {
    //         $dd_branch = $dd_branch . "," . $row['t9'];
    //     }
    //     if ($row['interestpoint'] != '') {
    //         $dd_branch = $dd_branch . "," . $row['interestpoint'];
    //     }
    // }
    // Always load children of current terrain
    // $result = $db->sql_query("SELECT * FROM dd_terrain WHERE idx IN (" . $dd_branch . ")");
    // while ($row = $db->sql_fetchrow($result)) {
    //     $dd_idx = $row['idx'];
    //     $dd_imgfilename[$dd_idx] = $row['filename'];
    //
    //     $dd_imgtrans[$dd_idx][0] = $row['t0'];
    //     $dd_imgtrans[$dd_idx][1] = $row['t1'];
    //     $dd_imgtrans[$dd_idx][2] = $row['t2'];
    //     $dd_imgtrans[$dd_idx][3] = $row['t3'];
    //     $dd_imgtrans[$dd_idx][4] = $row['t4'];
    //     $dd_imgtrans[$dd_idx][5] = $row['t5'];
    //     $dd_imgtrans[$dd_idx][6] = $row['t6'];
    //     $dd_imgtrans[$dd_idx][7] = $row['t7'];
    //     $dd_imgtrans[$dd_idx][8] = $row['t8'];
    //     $dd_imgtrans[$dd_idx][9] = $row['t9'];
    //
    //     $dd_imgset[$dd_idx] = $row['terrainset'];
    //     $dd_imgpoint[$dd_idx] = $row['interestpoint'];
    //
    //     $dd_imgcolor[$dd_idx] = $row['color'];
    //     $dd_imgalttext[$dd_idx] = $row['alttext'];
    //     $dd_imgkeytext[$dd_idx] = $row['keytext'];
    // }

    // Load TerrainData

    if ($dd_level == 2) {
        // Get Terrain Data from Imagemap
        for ($dd_countery = -12;$dd_countery < 12;$dd_countery++) {
            for ($dd_counterx = -12;$dd_counterx < 12;$dd_counterx++) {
                $dd_terraindata[($dd_counterx + 12)][($dd_countery + 12)] = ImageColorAt($dd_im, ($dd_x + $dd_counterx), ($dd_y + $dd_countery));
            }
        }
    } else {

        //Natural Patterns
$dd_details[1][0] = "1,0,0,1,1,0,1,0,1,1,0,0,0,0,0,0,0,0,0,1,1,1,0,0,1";
$dd_details[1][1] = "1,1,1,0,0,0,0,1,0,0,0,0,0,0,3,1,1,0,3,2,1,1,3,0,0";
$dd_details[1][2] = "0,0,3,0,1,0,3,0,1,0,3,0,0,0,0,0,0,0,1,0,1,1,1,1,0";
$dd_details[1][3] = "1,0,0,0,0,1,0,0,0,0,0,0,4,0,0,0,4,0,0,0,0,0,0,1,1";
$dd_details[1][4] = "1,1,0,0,1,1,0,0,1,1,0,0,0,1,3,0,2,0,3,0,0,0,3,0,0";
$dd_details[1][5] = "0,0,3,0,0,0,3,0,0,0,3,0,0,1,1,0,1,0,0,1,1,1,1,0,1";
$dd_details[1][6] = "0,0,3,1,1,0,3,1,1,0,3,0,0,0,0,0,0,0,1,0,0,0,0,1,1";
$dd_details[1][7] = "0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0,0";
$dd_details[1][8] = "1,1,3,0,2,1,1,0,3,0,3,0,3,0,3,0,3,0,3,1,0,0,3,1,1";
$dd_details[1][9] = "0,0,0,0,0,0,0,0,0,0,3,0,0,0,3,0,0,0,0,0,0,0,0,0,0";

        //Man-Made Patterns
$dd_details[2][0]="1,1,0,2,1,1,2,0,0,2,0,0,0,0,0,4,0,0,1,3,0,1,0,0,0,";
$dd_details[2][1]="1,0,0,0,1,1,0,0,1,1,0,0,0,0,0,1,2,0,0,1,1,1,0,0,0,";
$dd_details[2][2]="2,1,0,1,1,1,0,0,0,0,0,0,4,0,0,2,0,0,0,1,0,1,0,1,0,";
$dd_details[2][3]="2,1,0,1,0,1,1,0,0,1,0,2,0,0,0,0,0,0,0,1,1,1,0,2,1,";
$dd_details[2][4]="1,2,0,1,2,0,0,0,0,1,0,0,4,0,0,1,0,0,0,1,1,2,0,0,2,";
$dd_details[2][5]="2,0,0,0,1,1,0,2,0,2,0,0,0,0,0,1,2,0,0,0,2,0,0,2,2,";
$dd_details[2][6]="2,0,0,0,1,1,3,2,0,2,0,0,0,0,0,2,2,3,0,2,2,0,0,0,3,";
$dd_details[2][7]="0,2,0,2,1,2,1,0,0,2,0,2,0,0,0,0,0,0,1,2,2,2,0,2,2,";
$dd_details[2][8]="1,1,0,1,2,2,0,0,0,0,0,0,2,1,0,1,0,0,0,0,1,2,0,1,1,";
$dd_details[2][9]="1,0,2,0,3,0,0,0,0,0,2,0,4,0,3,0,0,0,0,0,1,3,0,2,1,";


        //Indoor Patterns
$dd_details[3][0]="5,1,6,4,1,7,4,5,4,7,5,3,3,7,8,0,2,5,2,0,4,8,4,8,8";
$dd_details[3][1]="1,7,2,6,1,0,7,8,6,1,3,3,5,6,6,2,2,1,5,3,3,3,7,0,2";
$dd_details[3][2]="7,1,6,3,8,3,1,3,7,7,5,2,8,4,7,8,7,1,4,6,3,3,1,6,4";
$dd_details[3][3]="9,1,6,5,8,3,7,9,3,7,1,0,7,0,6,1,5,2,2,7,2,6,8,0,9";
$dd_details[3][4]="1,8,5,2,8,9,1,2,4,4,3,0,8,0,2,6,9,0,0,1,2,2,7,7,1";
$dd_details[3][5]="8,7,2,9,2,5,0,5,5,8,5,3,2,5,8,3,6,1,5,7,6,9,2,5,7";
$dd_details[3][6]="4,7,3,6,5,8,7,2,3,0,3,5,4,6,0,1,6,0,7,6,6,6,2,4,7";
$dd_details[3][7]="8,1,0,8,5,1,5,0,7,5,3,4,5,2,1,7,6,5,5,8,8,8,5,0,4";
$dd_details[3][8]="0,2,4,4,0,1,0,1,6,8,9,1,4,5,3,8,8,0,1,2,9,4,6,3,8";
$dd_details[3][9]="1,0,1,5,4,0,2,6,3,2,8,5,7,5,2,9,2,9,7,7,4,3,3,6,7";


        $dd_x0 = bcmod(($dd_x + $dd_xx3 + $dd_xx4 + $dd_xx5 + $dd_xx6 + $dd_xx7-1), 10);
        $dd_x1 = intval(($dd_x + $dd_xx3 + $dd_xx4 + $dd_xx5 + $dd_xx6 + $dd_xx7) / 100);
        $dd_x2 = intval(bcmod(($dd_x + $dd_xx3 + $dd_xx4 + $dd_xx5 + $dd_xx6 + $dd_xx7), 100) / 10);
        $dd_x3 = bcmod(($dd_x + $dd_xx3 + $dd_xx4 + $dd_xx5 + $dd_xx6 + $dd_xx7), 10);
        $dd_x4 = bcmod(($dd_x + $dd_xx3 + $dd_xx4 + $dd_xx5 + $dd_xx6 + $dd_xx7 + 1), 10);

        $dd_y0 = bcmod(($dd_y + $dd_yy3 + $dd_yy4 + $dd_yy5 + $dd_yy6 + $dd_yy7-1), 10);
        $dd_y1 = intval(($dd_y + $dd_yy3 + $dd_yy4 + $dd_yy5 + $dd_yy6 + $dd_yy7) / 100);
        $dd_y2 = intval(bcmod(($dd_y + $dd_yy3 + $dd_yy4 + $dd_yy5 + $dd_yy6 + $dd_yy7), 100) / 10);
        $dd_y3 = bcmod(($dd_y + $dd_yy3 + $dd_yy4 + $dd_yy5 + $dd_yy6 + $dd_yy7), 10);
        $dd_y4 = bcmod(($dd_y + $dd_yy3 + $dd_yy4 + $dd_yy5 + $dd_yy6 + $dd_yy7 + 1), 10);

        $dd_tdetails[1] = $dd_x1 + $dd_x2 + $dd_x0 + $dd_y1 + $dd_y2 + $dd_y0 + $dd_x0 + $dd_y0;
        $dd_tdetails[2] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y0 + $dd_x1 + $dd_y0;
        $dd_tdetails[3] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y0 + $dd_x2 + $dd_y0;
        $dd_tdetails[4] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y0 + $dd_x3 + $dd_y0;
        $dd_tdetails[5] = $dd_x1 + $dd_x2 + $dd_x4 + $dd_y1 + $dd_y2 + $dd_y0 + $dd_x1 + $dd_y0;
        $dd_tdetails[6] = $dd_x1 + $dd_x2 + $dd_x0 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x0 + $dd_y1;
        $dd_tdetails[7] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x1 + $dd_y1;
        $dd_tdetails[8] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x2 + $dd_y1;
        $dd_tdetails[9] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x3 + $dd_y1;
        $dd_tdetails[10] = $dd_x1 + $dd_x2 + $dd_x4 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x1 + $dd_y1;
        $dd_tdetails[11] = $dd_x1 + $dd_x2 + $dd_x0 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x0 + $dd_y2;
        $dd_tdetails[12] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x1 + $dd_y2;
        $dd_tdetails[13] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x2 + $dd_y2;
        $dd_tdetails[14] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x3 + $dd_y2;
        $dd_tdetails[15] = $dd_x1 + $dd_x2 + $dd_x4 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x1 + $dd_y2;
        $dd_tdetails[16] = $dd_x1 + $dd_x2 + $dd_x0 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x0 + $dd_y3;
        $dd_tdetails[17] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x1 + $dd_y3;
        $dd_tdetails[18] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x2 + $dd_y3;
        $dd_tdetails[19] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x3 + $dd_y3;
        $dd_tdetails[20] = $dd_x1 + $dd_x2 + $dd_x4 + $dd_y1 + $dd_y2 + $dd_y3 + $dd_x1 + $dd_y3;
        $dd_tdetails[21] = $dd_x1 + $dd_x2 + $dd_x0 + $dd_y1 + $dd_y2 + $dd_y4 + $dd_x0 + $dd_y1;
        $dd_tdetails[22] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y4 + $dd_x1 + $dd_y1;
        $dd_tdetails[23] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y4 + $dd_x2 + $dd_y1;
        $dd_tdetails[24] = $dd_x1 + $dd_x2 + $dd_x3 + $dd_y1 + $dd_y2 + $dd_y4 + $dd_x3 + $dd_y1;
        $dd_tdetails[25] = $dd_x1 + $dd_x2 + $dd_x4 + $dd_y1 + $dd_y2 + $dd_y4 + $dd_x1 + $dd_y1;

        for ($dd_counter = 1;$dd_counter < 26;$dd_counter++) {
            $dd_tdetails[$dd_counter] = intval(substr($dd_tdetails[$dd_counter], strlen($dd_tdetails[$dd_counter])-1, 1));
        }

        $dd_interest_count = 0;
        $dd_offset = 0;

        for ($dd_countery = 0;$dd_countery < 25;$dd_countery++) {
            for ($dd_counterx = 0;$dd_counterx < 5;$dd_counterx++) {
                $dd_pointer = floor($dd_countery / 5) * 5 + $dd_counterx + 1;

                //
                // Do Deep Magic
                //

                $dd_temp = explode(",", $dd_details[($dd_imgset[$dd_terrain])][$dd_tdetails[$dd_pointer]]);

                // Switch 4s to 5-9 for Uncommon Terrains for Manmade Pattern Sets Half the Time
                // We just arbitrarily picked 1 and 10 for the indicators, they will have values 0 - 9



                for ($dd_counterm = 0;$dd_counterm < 25;$dd_counterm++) {
                    if ($dd_imgset[$dd_terrain]==2 && $dd_tdetails[1] > 4 && $dd_temp[$dd_counterm]==4) {
                	    $dd_temp[$dd_counterm] = $dd_imgtrans[$dd_terrain][(5+floor(($dd_tdetails[10]/2)))];
                    } else {
                		$dd_temp[$dd_counterm] = $dd_imgtrans[$dd_terrain][($dd_temp[$dd_counterm])];
                	}
                }
                for ($dd_counterv = 0;$dd_counterv < 5;$dd_counterv++) {
                    if ((($dd_counterx * 5) + $dd_counterv) == 13 && $dd_countery == 13 && $dd_imgpoint[$dd_terrain] != 0) {
                    	$dd_terraindata[(($dd_counterx * 5) + $dd_counterv)][$dd_countery] = $dd_imgpoint[$dd_terrain];
                    } else {
                    	$dd_terraindata[(($dd_counterx * 5) + $dd_counterv)][$dd_countery] = $dd_temp[($dd_offset + $dd_counterv)];
                    }
                }
            }

            $dd_offset = $dd_offset + 5;
            if ($dd_offset > 20) {
                $dd_offset = 0;
            }
        }
    }

    // Modify Terrain Data for Shrinking, Rounding, Buildings and Walls

    $dd_building = explode("_",$dd_imgfilename[$dd_terrain]);

    for ($dd_countery = 0;$dd_countery < 25;$dd_countery++) {
        for ($dd_counterx = 0;$dd_counterx < 25;$dd_counterx++) {
            $dd_modterrain = $dd_terraindata[$dd_counterx][$dd_countery];

            $dd_roundoff = "";
            $dd_shrink = "";
            // Shrink Rivers Start
            $dd_shrinkcount = 0;
            $dd_shrinkcount2 = 0;

            if ($dd_imgfilename[$dd_modterrain] == "rivers") {
                $dd_shrink = "_";

                for ($dd_counteru = 0;$dd_counteru < 9;$dd_counteru++) {
                    $dd_w = intval($dd_counteru / 3) + $dd_countery-1;
                    $dd_v = ($dd_counteru - (intval($dd_counteru / 3) * 3)) + $dd_counterx-1;

                    if ($dd_terraindata[$dd_v][$dd_w] == $dd_modterrain) {
                        if ($dd_counteru == 0 || $dd_counteru == 2 || $dd_counteru == 6 || $dd_counteru == 8) {
                            $dd_shrink = $dd_shrink . "1";
                            $dd_shrinkcount++;
                        }
                        if ($dd_counteru == 1 || $dd_counteru == 3 || $dd_counteru == 5 || $dd_counteru == 7) {
                            $dd_shrinkcount2++;
                            $dd_shrink = $dd_shrink . "0";
                        }

                        if ($dd_counteru == 4) {
                            $dd_shrink = $dd_shrink . "0";
                        }
                    } else {
                        $dd_shrink = $dd_shrink . "0";
                    }
                }
            }

            if ($dd_shrinkcount > 2 || $dd_shrinkcount == 0 || $dd_shrinkcount2 > 0) {
                $dd_shrink = "";

                // I must be a lake - round me instead of shrink me
            }
            // Shrink Rivers Done

            // Round Forests, Lakes, Hills, Mountains, Deserts Start

            // Forest have a 'sideness' for perspective

            if ($dd_imgfilename[$dd_modterrain] == "forest") {
                if ($dd_counterx < 13) {
                    $dd_roundoff = "_left_";
                } else {
                    $dd_roundoff = "_right_";
                }
            }
            // Lakes, Hills, Mountains, Deserts need a spacer
            if (($dd_imgfilename[$dd_modterrain] == "rivers" || $dd_imgfilename[$dd_modterrain] == "hills" || $dd_imgfilename[$dd_modterrain] == "mountains" || $dd_imgfilename[$dd_modterrain] == "desert") && $dd_shrink == "") {
                $dd_roundoff = "_";
            }

            if (($dd_imgfilename[$dd_modterrain] == "forest") || ($dd_imgfilename[$dd_modterrain] == "rivers" && $dd_shrink == "") || ($dd_imgfilename[$dd_modterrain] == "hills" && $dd_shrink == "") || ($dd_imgfilename[$dd_modterrain] == "mountains" && $dd_shrink == "") || ($dd_imgfilename[$dd_modterrain] == "desert" && $dd_shrink == "")) {
                for ($dd_counteru = 0;$dd_counteru < 9;$dd_counteru++) {
                    $dd_w = intval($dd_counteru / 3) + $dd_countery-1;
                    $dd_v = ($dd_counteru - (intval($dd_counteru / 3) * 3)) + $dd_counterx-1;

                    // Hills should never round with mountains or tundra
                    // to accomplish this, we will artifically force a match if we are currently looking at a hills and the near terrain is a mountain or tundra

                    $dd_mountainhill = 0;
                    if ($dd_imgfilename[$dd_modterrain] == "hills") {
                        if ($dd_imgfilename[($dd_terraindata[$dd_v][$dd_w])] == "mountains" || $dd_imgfilename[($dd_terraindata[$dd_v][$dd_w])] == "tundra") {
                            $dd_mountainhill = 1;
                        }
                    }

                    if (($dd_terraindata[$dd_v][$dd_w] == $dd_modterrain || $dd_mountainhill == 1) && ($dd_counteru == 1 || $dd_counteru == 3 || $dd_counteru == 5 || $dd_counteru == 7)) {
                        $dd_roundoff = $dd_roundoff . "1";
                    } else {
                        $dd_roundoff = $dd_roundoff . "0";
                    }
                }
            }
            // Round Forests, Lakes, Hills, Mountains, Deserts Done
            $dd_narrow[$dd_counterx][$dd_countery] = $dd_shrink;
            $dd_round[$dd_counterx][$dd_countery] = $dd_roundoff;

            // Wall Code Here

            //Building Code Here
            if ($dd_level == 7 && $dd_counterx > 11 && dd_counterx <15 && $dd_countery > 11 && dd_countery <15) {
            	$dd_buildpoint=($dd_countery-12)*3 + ($dd_counterx-12);
            	if (substr($dd_building[1],$dd_buildpoint,1) == 0) {
            	  $dd_terraindata[$dd_counterx][$dd_countery] = 500;
            	}

            }
        }
    }

    // Start Output

    // Header
    // if ($dd_level > 1) {
    //     title(($dd_title[$dd_level] . " Map: " . $dd_region_name[$dd_region]));
    // } else {
    //     title("World Map: The World of Infinesse");
    // }


    if ($dd_level < 7) {
        echo "<b>Click Anywhere</b> on the map below to zoom-in to a " . $dd_title[($dd_level + 1)] . " map.<br>";
    }
    if ($dd_level < 8) {
        echo "Each square in the map below is <b>" . $dd_scale[$dd_level] . "</b> across. <br>";
    }

    // Show Map

    if ($dd_level < 2) {
        echo "<form method=\"post\" action=\"index.php&op=view&dd_level=2\">";
        // Display Options Here
        echo "<table width=\"100%\" border=\"0\"><tr>";

        echo "<td>Block Colors: <select name=\"dd_ynfill\">";
        echo "<option value=\"N\">No</option>";
        echo "<option value=\"Y\">Yes</option>";
        echo "</select></td>";

        echo "<td>Grid Size (pixels): <select name=\"dd_gridpixels\">";
        echo "<option value=\"38\">Small</option>";
        echo "<option value=\"48\" selected=\"selected\">Medium</option>";
        echo "<option value=\"76\">Large</option>";
        echo "</select></td>";

        echo "<td>Show Gridlines: <select name=\"dd_linesize\">";
        echo "<option value=\"1\">Yes</option>";
        echo "<option value=\"0\">No</option>";
        echo "</select></td>";

        echo "</tr></table>";

        echo "<input type=\"image\" src=\"images/world.png\" name=\"dd\" border=\"0\">";
        echo "</form>";
        echo "<br><br>";
        echo "<h5>View VRML scenes of the World of Infinesse</h5><br>";
        echo "<table width=\"100%\"><tr>";
        echo "<td><b><a href=\"images/world_scene_region_west.jpg\">Infinesse West</a></b></td>";
        echo "<td><b><a href=\"images/world_scene_region_east.jpg\">Infinesse East</a></b></td>";
        echo "<td><b><a href=\"images/world_globe_spins.gif\">Spinning Globe</a></b></td>";
        echo "</tr></table><br><br>";

        for ($dd_counter = 1;$dd_counter < 19;$dd_counter++) {
            echo "<a href=\"images/world_scene_region";
            echo $dd_counter;
            echo ".jpg\">";
            echo $dd_region_name[$dd_counter];
            echo "</a><br>";
        }
    } else {
        // All other levels here
        $dd_gridstart = 13 - floor($dd_grids[$dd_level] / 2);
        $dd_gridstop = 12 + ceil($dd_grids[$dd_level] / 2);

        echo "<table style=\"background-color: gray\" border=\"5\" bordercolor=\"black\"><tr><td>";
        echo "<table style=\"background-color: ";
        if ($dd_level > 2) {
            echo $dd_imgcolor[$dd_terrain3];
        } else {
            echo "aquamarine";
        }
        echo "\" cellpadding=\"0\" cellspacing=\"0\"><tr><td>&nbsp;</td>";

        for ($dd_counterx = $dd_gridstart;$dd_counterx <= $dd_gridstop;$dd_counterx++) {
            echo "<td align=\"center\" style=\"color: black\"><b>";
            echo ($dd_counterx - $dd_gridstart + 1);
            echo "</b></td>";
        }
        echo "</tr><tr><td style=\"color: black\"><b>A</b></td>";
        $dd_counterk = 66;

        for ($dd_countery = $dd_gridstart;$dd_countery <= $dd_gridstop;$dd_countery++) {
            for ($dd_counterx = $dd_gridstart;$dd_counterx <= $dd_gridstop;$dd_counterx++) {
                $dd_temp = $dd_terraindata[$dd_counterx][$dd_countery];
                $dd_patternset = $dd_imgset[$dd_temp];

                if ($dd_ynfill == "Y" && $dd_imgfilename[$dd_temp] != "plains") {
                    echo "<td style=\"background-color: " . $dd_imgcolor[$dd_temp] . "; border-style: solid; border-color: black; border-width: ";
                    if ($dd_level<7) {
                    	echo $dd_linesize;
                    } else {
                    	echo "0";
                    }
                    echo "px\">";
                } else {
                    echo "<td style=\"border-style: solid; border-color: black; border-width: ";
                    if ($dd_level<7) {
                    	echo $dd_linesize;
                    } else {
                    	echo "0";
                    }
                    echo "px\">";
                }

                switch ($dd_level) {
                    case 2:
                        $dd_terrain3 = $dd_temp;
                        $dd_xx3 = $dd_counterx;
                        $dd_yy3 = $dd_countery;
                        break;
                    case 3:
                        $dd_terrain4 = $dd_temp;
                        $dd_xx4 = $dd_counterx;
                        $dd_yy4 = $dd_countery;
                        break;
                    case 4:
                        $dd_terrain5 = $dd_temp;
                        $dd_xx5 = $dd_counterx;
                        $dd_yy5 = $dd_countery;
                        break;
                    case 5:
                        $dd_terrain6 = $dd_temp;
                        $dd_xx6 = $dd_counterx;
                        $dd_yy6 = $dd_countery;
                        break;
                    case 6:
                        $dd_terrain7 = $dd_temp;
                        $dd_xx7 = $dd_counterx;
                        $dd_yy7 = $dd_countery;
                        break;
                }

                if (($dd_patternset != 0 || $dd_level < 3)  && $dd_level < 7) {
                    echo "<a href=\"index.php?op=view&dd_level=" . ($dd_level + 1) . "&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . ($dd_terraindata[$dd_counterx][$dd_countery]);
                    switch ($dd_level) {
                        case 2:
                            echo "&dd_terrain3=" . $dd_terrain3;
                            echo "&dd_xx3=" . $dd_xx3;
                            echo "&dd_yy3=" . $dd_yy3;
                            break;
                        case 3:
                            echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4;
                            echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4;
                            echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4;
                            break;
                        case 4:
                            echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4 . "&dd_terrain5=" . $dd_terrain5;
                            echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4 . "&dd_xx5=" . $dd_xx5;
                            echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4 . "&dd_yy5=" . $dd_yy5;
                            break;
                        case 5:
                            echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4 . "&dd_terrain5=" . $dd_terrain5 . "&dd_terrain6=" . $dd_terrain6;
                            echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4 . "&dd_xx5=" . $dd_xx5 . "&dd_xx6=" . $dd_xx6;
                            echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4 . "&dd_yy5=" . $dd_yy5 . "&dd_yy6=" . $dd_yy6;
                            break;
                        case 6:
                            echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4 . "&dd_terrain5=" . $dd_terrain5 . "&dd_terrain6=" . $dd_terrain6 . "&dd_terrain7=" . $dd_terrain7;
                            echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4 . "&dd_xx5=" . $dd_xx5 . "&dd_xx6=" . $dd_xx6 . "&dd_xx7=" . $dd_xx7;
                            echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4 . "&dd_yy5=" . $dd_yy5 . "&dd_yy6=" . $dd_yy6 . "&dd_yy7=" . $dd_yy7;
                            break;
                    }
                    echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
                    echo "\">";
                }



		if ($dd_level<7) {
                    echo "<img border=\"0\" width=\"" . $dd_gridpixels . "\" height=\"" . ($dd_gridpixels * 0.83) . "\" src=\"images/";
                } else {
                    echo "<img border=\"0\" width=\"200\" height=\"200\" src=\"images/";
                }
                echo $dd_imgfilename[$dd_temp];

                echo $dd_round[$dd_counterx][$dd_countery];
                echo $dd_narrow[$dd_counterx][$dd_countery];
                echo $dd_climate_suffix;

                echo ".gif\"";
                echo " alt=\"" . $dd_imgalttext[$dd_temp] . "\"";
                echo ">";

                if (($dd_patternset != 0 || $dd_level < 3) && $dd_level < 7) {
                    echo "</a>";
                }

                echo "</td>";
            }
            echo "</tr><tr>";
            if ($dd_countery < $dd_gridstop) {
                echo "<td style=\"color: black\">";
                echo "<b>" . chr(($dd_counterk)) . "</b>";
                $dd_counterk++;
                echo "</td>";
            }
        }

        echo "</tr></table></td>";

        // Map Key

        if ($dd_level < 7) {
        echo "<td style=\"vertical-align: text-top;color: black\"><b>";

        echo "Map Key<br><br><br>";

        for ($dd_countery = $dd_gridstart;$dd_countery <= $dd_gridstop;$dd_countery++) {
            for ($dd_counterx = $dd_gridstart;$dd_counterx <= $dd_gridstop;$dd_counterx++) {
                $dd_temp = $dd_terraindata[$dd_counterx][$dd_countery];
                $dd_key[$dd_temp] = 1;
            }
        }

        $dd_counterx=0;
        for ($dd_countery = (($dd_level-2) * 80);$dd_countery <= (($dd_level-1) * 80);$dd_countery++) {
            if ($dd_key[$dd_countery] == 1 && $dd_imgfilename[$dd_countery] != "plains" && $dd_imgfilename[$dd_countery] != "dirt") {
                echo "<img border=\"1\" width=\"76\" height=\"64\" src=\"images/";
                echo $dd_imgfilename[$dd_countery];
                echo ".gif\">";
                echo "<br>";
                echo $dd_imgkeytext[$dd_countery];
                echo "<br><br>";
                $dd_counterx=$dd_counterx+1;
            }
            if ($dd_counterx >4 ) {
                echo "</td><td style=\"vertical-align: text-top;color: black\"><b>";
                echo " <br><br><br>";
                $dd_counterx=0;
            }
        }

        echo "</b></td>";
        }
        echo "</tr></table><br>";
    }

    // History Key Start

    if ($dd_level > 1) {
        echo "<table border=\"0\" cellpadding=\"5\"><tr>";
        echo "<td><b>Map History: </b></td><td align=\"center\">";
        echo "<a href=\"index.php&op=view&dd_level=1\"><img border=\"1\" width=\"47\" height=\"40\" src=\"images/world_globe.gif\"></a><br>" . $dd_title[1] . "</td><td align=\"center\">";

        echo "<a href=\"index.php&op=view&dd_level=2&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . $dd_terrain2;
        echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
        echo "\">";
        echo "<img border=\"1\" width=\"48\" height=\"40\" src=\"images/region.gif\"><br>" . $dd_title[2] . "</td><td align=\"center\"></a>";
    }
    if ($dd_level > 2) {
        echo "<a href=\"index.php&op=view&dd_level=3&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . $dd_terrain3;
        echo "&dd_terrain3=" . $dd_terrain3;
        echo "&dd_xx3=" . $dd_xx3;
        echo "&dd_yy3=" . $dd_yy3;
        echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
        echo "\">";
        echo "<img border=\"1\" width=\"48\" height=\"40\" src=\"images/" . $dd_imgfilename[$dd_terrain3] . ".gif\"><br>" . $dd_title[3] . "</td><td align=\"center\"></a>";
    }
    if ($dd_level > 3) {
        echo "<a href=\"index.php&op=view&dd_level=4&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . $dd_terrain4;
        echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4;
        echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4;
        echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4;
        echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
        echo "\">";
        echo "<img border=\"1\" width=\"48\" height=\"40\" src=\"images/" . $dd_imgfilename[$dd_terrain4] . ".gif\"><br>" . $dd_title[4] . "</td><td align=\"center\"></a>";
    }
    if ($dd_level > 4) {
        echo "<a href=\"index.php&op=view&dd_level=5&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . $dd_terrain5;
        echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4 . "&dd_terrain5=" . $dd_terrain5;
        echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4 . "&dd_xx5=" . $dd_xx5;
        echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4 . "&dd_yy5=" . $dd_yy5;
        echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
        echo "\">";
        echo "<img border=\"1\" width=\"48\" height=\"40\" src=\"images/" . $dd_imgfilename[$dd_terrain5] . ".gif\"><br>" . $dd_title[5] . "</td><td align=\"center\"></a>";
    }
    if ($dd_level > 5) {
        echo "<a href=\"index.php&op=view&dd_level=6&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . $dd_terrain6;
        echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4 . "&dd_terrain5=" . $dd_terrain5 . "&dd_terrain6=" . $dd_terrain6;
        echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4 . "&dd_xx5=" . $dd_xx5 . "&dd_xx6=" . $dd_xx6;
        echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4 . "&dd_yy5=" . $dd_yy5 . "&dd_yy6=" . $dd_yy6;
        echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
        echo "\">";
        echo "<img border=\"1\" width=\"48\" height=\"40\" src=\"images/" . $dd_imgfilename[$dd_terrain6] . ".gif\"><br>" . $dd_title[6] . "</td><td align=\"center\"></a>";
    }
    if ($dd_level > 6) {
        echo "<a href=\"index.php&op=view&dd_level=7&dd_x=" . $dd_x . "&dd_y=" . $dd_y . "&dd_terrain=" . $dd_terrain7;
        echo "&dd_terrain3=" . $dd_terrain3 . "&dd_terrain4=" . $dd_terrain4 . "&dd_terrain5=" . $dd_terrain5 . "&dd_terrain6=" . $dd_terrain6 . "&dd_terrain7=" . $dd_terrain7;
        echo "&dd_xx3=" . $dd_xx3 . "&dd_xx4=" . $dd_xx4 . "&dd_xx5=" . $dd_xx5 . "&dd_xx6=" . $dd_xx6 . "&dd_xx7=" . $dd_xx7;
        echo "&dd_yy3=" . $dd_yy3 . "&dd_yy4=" . $dd_yy4 . "&dd_yy5=" . $dd_yy5 . "&dd_yy6=" . $dd_yy6 . "&dd_yy7=" . $dd_yy7;
        echo "&dd_gridpixels=" . $dd_gridpixels . "&dd_ynfill=" . $dd_ynfill . "&dd_linesize=" . $dd_linesize;
        echo "\">";
        echo "<img border=\"1\" width=\"48\" height=\"40\" src=\"images/" . $dd_imgfilename[$dd_terrain7] . ".gif\"><br>" . $dd_title[7] . "</td><td align=\"center\"></a>";
    }
    if ($dd_level > 1) {
        echo "</tr></table>";
    }

    // History Key End

    // Description Start

    if ($dd_level > 1) {
        echo "<b>Description: </b> You are currently viewing ";
        if ($dd_terrain7 != "") {
            echo $dd_imgalttext[$dd_terrain7] . " in ";
        }
        if ($dd_terrain6 != "") {
            echo $dd_imgalttext[$dd_terrain6] . " in ";
        }
        if ($dd_terrain5 != "") {
            echo $dd_imgalttext[$dd_terrain5] . " in ";
        }
        if ($dd_terrain4 != "") {
            echo $dd_imgalttext[$dd_terrain4] . " in ";
        }
        if ($dd_terrain3 != "") {
            echo $dd_imgalttext[$dd_terrain3] . " in ";
        }
        if ($dd_terrain2 != "") {
            echo $dd_imgalttext[$dd_terrain2] . " in ";
        }
        echo $dd_region_name[$dd_region] . " region ";
        echo " on the world of Infinesse.<br>";
    }

    //Description End


}

//
// MAIN
//
$op = $_GET['op'];
$dd_level = $_GET['dd_level'];
$dd_x = $_GET['dd_x'];
$dd_y = $_GET['dd_y'];
$dd_terrain = $_GET['dd_terrain'];

$dd_terrain3 = $_GET['dd_terrain3'];
$dd_terrain4 = $_GET['dd_terrain4'];
$dd_terrain5 = $_GET['dd_terrain5'];
$dd_terrain6 = $_GET['dd_terrain6'];
$dd_terrain7 = $_GET['dd_terrain7'];

$dd_xx3 = $_GET['dd_xx3'];
$dd_xx4 = $_GET['dd_xx4'];
$dd_xx5 = $_GET['dd_xx5'];
$dd_xx6 = $_GET['dd_xx6'];
$dd_xx7 = $_GET['dd_xx7'];

$dd_yy3 = $_GET['dd_yy3'];
$dd_yy4 = $_GET['dd_yy4'];
$dd_yy5 = $_GET['dd_yy5'];
$dd_yy6 = $_GET['dd_yy6'];
$dd_yy7 = $_GET['dd_yy7'];

$dd_gridpixels = $_GET['dd_gridpixels'];
$dd_ynfill = $_GET['dd_ynfill'];
$dd_linesize = $_GET['dd_linesize'];

view($dd_level, $dd_x, $dd_y, $dd_terrain, $dd_terrain3, $dd_terrain4, $dd_terrain5, $dd_terrain6, $dd_terrain7, $dd_xx3, $dd_xx4, $dd_xx5, $dd_xx6, $dd_xx7, $dd_yy3, $dd_yy4, $dd_yy5, $dd_yy6, $dd_yy7, $dd_gridpixels, $dd_ynfill, $dd_linesize);


?>
