<?php
function find_common_elements($array1, $array2) {
    return array_values(array_intersect($array1, $array2));
}

$arr1 = [1, 2, 3, 4, 5, 6];
$arr2 = [4, 5, 6, 7, 8, 9];

$result = find_common_elements($arr1, $arr2);
echo json_encode($result);
?>
