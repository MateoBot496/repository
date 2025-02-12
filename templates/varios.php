<?php

    $title = "Puzzle";
    include __DIR__ . "/layout.php";


    $capitales = array("Andalucia" => "Sevilla","Pais vasco" => "Bilbao");


    if($_POST){
        if(isset($_POST["quantity"]) && $_POST["quantity"]!= null){
            $price = 5.99;
            $item = "Pizza";
            $quantity = $_POST["quantity"];
            $finalPrice = $price*$quantity;
            echo "The selected item is : $item . The quantity is $quantity . The final price is : $finalPrice"; echo "<br>";
        }

        if(isset($_POST["com"])  && $_POST["com"]!= null){
            echo "Has escrito : {$_POST["com"]}"; echo "<br>";

            foreach($capitales as $key => $value){

                if($_POST["com"] == $key){
                    $flipped = array_flip( $capitales);
                    foreach($flipped as $key2 => $value2){
                        echo $key2 . " -----" . $value2 ."<br>";
                    }
                    break;
                }

                else{
                    echo "".$key . ">>>" . $value; echo "<br>";
                }

            }

        }    
    }
    
?>
<body>
    
    <h1>
        EJERCICIO 1 ----------- <BR></BR>
    </h1>

    <form action="index.php" method="POST">
        <label> Nº of pizzas: (5.99€) </label><br>
        <input type="number" name="quantity"><br>
        <button type="submit"> Submit </button>
    </form>

    <h1>
        EJERCICIO 2 Arrays asociativos Flipper----------- <BR></BR>
    </h1>

    <?php
    

    foreach($capitales as $key => $value){
        echo "".$key; echo "<br>";
    }
    ?>

    <form action="index.php" method="POST">
        <label> Comunidad autonoma to flip </label><br>
        <input type="text" name="com"><br>
        <button type="submit"> Submit </button>
    </form>
    
    <h1>
        EJERCICIO 3 RECURSION FIBONACHI <BR></BR>
    </h1>
    <div>
            <?php
                
                $num1=0;
                $num2=1;
                $count = 2;
                echo $num1 . " " . $num2 . "<br>";
                function fib(int $num1, int $num2){

                    global $count;
                    if($count<19){
                        $num3=$num1+$num2;
                        echo "Cuenta = ".$count." : ". $num3 . "<br>";
                        $count+=1;
                        fib($num2, $num3);
                    }

                    else{
                        return;
                    }
                }

                fib($num1, $num2);


            ?>
    </div>
    <h1>
        EJERCICIO 4 puzle <BR></BR>
    </h1>       
    <div>
        <?php
        $todasPiezas = "4 4
                        1 4 3 5
                        0 5 3 5
                        1 5 3 0
                        5 4 5 2
                        1 5 0 0
                        0 5 2 1
                        1 0 4 4
                        2 4 4 2
                        4 5 0 5
                        3 2 1 0
                        4 0 0 3
                        3 0 0 1
                        5 5 1 0
                        5 0 0 1
                        0 4 2 4
                        4 5 1 4
                        ";
        
        

        $lineas = explode("\n", trim($todasPiezas));

        


        
        $numLados=$lineas[0][0];
        $numPiezas = $numLados*$numLados;
        $pieza = array_fill(0, ($numLados*$numLados)-1, false); //iniciamos array de piezas
        $usadas = array_fill(0, ($numLados*$numLados)-1 , false);
        $piezaEncontrada[]=null;
        $tablero = array_fill(0, $numLados-1, array_fill(0, $numLados-1, null));
        $solucion = array_fill(0, $numLados-1, array_fill(0, $numLados-1, null));
        $totalSoluciones = [];
        $numSoluciones=0;


        foreach($lineas as $i => $linea){
            if($i == 0){continue;}
            $linea = str_replace(' ', '', $linea);
            $pieza[$i-1] = trim($linea); //quitamos espacios del final de la linea
            
        }   
        
        



        function rotar($string): string{ //ESTA FUNCION ROTA LOS NÚMEROS COMO SI MOVIERAS LA PIEZA 90* EN SENTIDO DE LAS AGUJAS DEL RELOJ

            $valueArray = str_split($string);

            $lastValue = array_pop($valueArray);

            array_unshift($valueArray, $lastValue);
            
            return implode($valueArray);


        }

        //Encontramos TODAS LAS pieza que entren y las almacenamos en $solucion[$x]
            //Funcion encontrar piezas encuentra todas las piezas que entran en UNA CASILLA COORDENADAS X,Y
            //un hueco es una var que tiene datos de la pieza que buscamos
        //Probamos 1 de esas piezas.
            // BUCLE: Encontramos TODAS LAS pieza que entren y las almacenamos en $solucion[$y]
            // Si ninguna entra borramos esta pieza de $solucion[$x]
            // Si llegamos al final tenemos una solucion. 

        function solucionarPuzle(&$tablero, &$solucion , $piezas, $usadas, $numLados ,$row = 0, $col = 0, $esquinaColocada=false){
            global $totalSoluciones;
            global $numSoluciones;
            $nextRow = $col == $numLados - 1 ? $row + 1 : $row;
            $nextCol = $col == $numLados - 1 ? 0 : $col + 1;

            if ($row == $numLados) {

                if (is_array($solucion)) {

                    
                    $totalSoluciones[$numSoluciones] = $solucion;
                    $numSoluciones++;
                    return;
                
                }

                
            }

            foreach ($piezas as $i => $pieza) {
                if($usadas[$i]) continue; //pasa a i++ sin usar esta pieza
                //probamos todas las rotaciones de la pieza
                for ($n = 0 ; $n<4 ; $n++){
                    $pieza = rotar($pieza);
                    //echo "La pieza es: " . $pieza . "  -  ".$i ."<br>";
                    
                    if(isValid($tablero, $row,$col,$pieza, $numLados)){
                        $usadas[$i]=true;
                        $tablero[$row][$col]=$pieza;
                        $solucion[$row][$col]=$i;
                        
                        

                        if($esquinaColocada && $row == 0 && $col == 0){ //ESTO EVITA PROBAR EL RESTO DE ESQUINAS UNA VEZ ENCONTRADA LA PRIMERA
                            continue;
                        }
                        if(!$esquinaColocada && $row == 0 && $col == 0){
                            $esquinaColocada=true;
                        }//ESTO EVITA PROBAR EL RESTO DE ESQUINAS UNA VEZ ENCONTRADA LA PRIMERA

                        if(solucionarPuzle($tablero,$solucion,$piezas, $usadas, $numLados, $nextRow,$nextCol, $esquinaColocada)){
                            return true;
                        }else{
                            $usadas[$i]=false;
                            $tablero[$row][$col]=null;
                            $solucion[$row][$col]=null;
                        }

                        

                    }

                }
            }   

            
        }        
        
        
        function isValid($tablero, $x, $y, $pieza, $numLados){
            
            if($x==0){
                $up=0;
            }elseif($x==$numLados-1){
                $up=$tablero[$x-1][$y][3];
                $down=0;
            }else{
                $up=$tablero[$x-1][$y][3];
            }

            if($y==0){
                $left=0;
            }elseif($y==$numLados-1){
                $left=$tablero[$x][$y-1][2];
                $right=0;
            }else{
                $left=$tablero[$x][$y-1][2];
            }



            if ($up == $pieza[1] && $left == $pieza[0] && $x != $numLados-1 && $y!=$numLados-1){
                return true;
            }
            if($x == $numLados-1 && $up == $pieza[1] && $left == $pieza[0] && $down==$pieza[3]){
                return true;
            }
            if($y == $numLados-1 && $up == $pieza[1] && $left == $pieza[0] && $right==$pieza[2]){
                return true;
            }
            if($y == $numLados-1 && $x == $numLados-1 && $up == $pieza[1] && $left == $pieza[0] && $right==$pieza[2] && $down==$pieza[3]){
                return true;
            }
            
            return false;
        }
          //******* */
        $usadas = array_fill(0, count($pieza), false);
        solucionarPuzle($tablero,$solucion, $pieza, $usadas, $numLados);
        if ($numSoluciones>0) {
            echo "NUMERO DE SOLUCIONES $numSoluciones <br>";
            
            foreach($totalSoluciones as $i => $solucion){

                echo "<br> ---------------- SOLUCION :" . $i+1 . "<br>";

                
                foreach($solucion as $linea){
                    foreach($linea as $pieza){
                        echo $pieza +1 . " ";
                    }
                    echo "<br>";
                }
            }
        } else {
            echo "No se encontró solución. ";
        }

        ?>
     </div>            



    
</body>

<h1>
    

    <?php
        
    //echo $var1 . "Poasbdfo" . $var2;

    ?>

</h1>    

