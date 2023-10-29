<?php
$array1 = array("a" => "green", "ared", "blue");
$array2 = array("b" => "green", "yellow", "red");
$result = array_intersect($array1, $array2);
print_r($result);
if(empty($result) == 1){
    echo "Vazio";
}
if(empty($result) == 0){
    echo "Não Vazio";
}
echo "\n";
?>