<?php
$title = "Problema 1";
include '../templates/layout.php';
?>

<h2>AOC 1.2 - Descripción</h2>
<p> <?php

echo "The Historians can't agree on which group made the mistakes or how to read most of the Chief's handwriting, <br>
 but in the commotion you notice an interesting detail: a lot of location IDs appear in both lists! Maybe the other numbers aren't location IDs at all but rather misinterpreted handwriting.<br><br>

This time, you'll need to figure out exactly how often each number from the left list appears in the right list. <br>
Calculate a total similarity score by adding up each number in the left list after multiplying it by the number of times that number appears in the right list.<br>

Here are the same example lists again:<br>

3   4
4   3
2   5
1   3
3   9
3   3<br>
For these example lists, here is the process of finding the similarity score:<br>

The first number in the left list is 3. It appears in the right list three times, so the similarity score increases by 3 * 3 = 9.<br>
The second number in the left list is 4. It appears in the right list once, so the similarity score increases by 4 * 1 = 4.<br>
The third number in the left list is 2. It does not appear in the right list, so the similarity score does not increase (2 * 0 = 0).<br>
The fourth number, 1, also does not appear in the right list.<br>
The fifth number, 3, appears in the right list three times; the similarity score increases by 9.<br>
The last number, 3, appears in the right list three times; the similarity score again increases by 9.<br>
So, for these example lists, the similarity score at the end of this process is 31 (9 + 4 + 0 + 0 + 9 + 9).<br><br>

Once again consider your left and right lists. What is their similarity score?<br><br><br>

Numeros :";

?><a href="https://adventofcode.com/2024/day/1/input">Enlace</a></p>

<?php





$url="https://adventofcode.com/2024/day/1/input";
$cookie="session=53616c7465645f5f7cfff1fff94a4dfee4c0f7fc8cf8b00c0d998aefb3b834a813098177191438ca19038aacff1990e93b7963e7a9cd3f498bb7f3c0678237b8"; //Reemplaza con tu cookie 


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url); //URL
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //ELEGIMOS DEVOLVER STRING
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Cookie: $cookie"]); //DAMOS COOKIE

$datos = curl_exec($ch); //EJECUTAMOS
curl_close($ch);

$lista = explode("\n", $datos);
$listaFinal = [];

foreach($lista as $i => $linea){
    if($linea != ""){
        $numeros = explode("   ", $linea);
        $listaFinal[0][$i]=(int)$numeros[0];
        $listaFinal[1][$i]=(int)$numeros[1];
    }
    
}

function resolver($lista1, $lista2){
    
    $total=0;
    foreach($lista1 as $numero){
        $veces=0;
        for($i=0; $i<count($lista1); $i++){
            if($numero == $lista2[$i]){
                $veces++;
            }
        }
        $total+=$numero*$veces;
        
    }
    echo "<BR> SOLUCION FINAL PROBLEMA 2 : ". $total;
    
}

resolver($listaFinal[0],$listaFinal[1]);







?>