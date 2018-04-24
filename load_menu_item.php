<?php
include "config.php";

$menu_catgory = array('lunch','dinner', 'drinks', 'weekends');
$repsonse = array();

foreach($menu_catgory as $category) {
    $sql = "SELECT * FROM menuitems where category= '$category'";

    $result = mysqli_query($con, $sql);
    $sub_categories = array();
    if (mysqli_num_rows($result) > 0) {
    // output data of each row
        while($row = mysqli_fetch_assoc($result)) {
            $current_subcategory = $row['subcategory'];

            if (array_key_exists($current_subcategory,$sub_categories)){ 
                $new_element = array('name'=>$row['name'], 'description'=> $row['description'], 'cost'=> $row['cost']);
                array_push($sub_categories[$current_subcategory], $new_element);
            }
            else{
                $sub_categories[$current_subcategory] = array();
                $new_element = array('name'=>$row['name'], 'description'=> $row['description'], 'cost'=> $row['cost']);
                array_push($sub_categories[$current_subcategory], $new_element);
            }

        }

        //$category_items = array($category => $sub_categories);
        //array_push($repsonse, ($category => $sub_categories);
        $repsonse[$category] = $sub_categories;

    } 
}

echo json_encode($repsonse);

mysqli_close($con);
?>