<?php
    $resultado = mysqli_query($con, "select departamento, notafinal,sigla from persona,nota where persona.ci=nota.ci;");
    echo "<br>";
    
    $Asigla = array();
    while($fila = mysqli_fetch_array($resultado)){
    if(!in_array($fila['sigla'],$Asigla)){
        array_push($Asigla,$fila['sigla']);
    }
}

$Apro = array();
foreach ($Asigla as &$valor) {
    array_push($Apro,array($valor,array(),array(),array(),array(),array(),array(),array(),array(),array()));
}
$resultado2 = mysqli_query($con, "select departamento, notafinal,sigla from persona,nota where persona.ci=nota.ci;");
while($fila = mysqli_fetch_array($resultado2)){
    foreach ($Apro as &$valor) {
            if($valor[0]==$fila['sigla']){
                array_push($valor[(int)$fila['departamento']],$fila['notafinal']);
            }
    }
}


foreach ($Apro as &$valor) {
    for ($i = 1; $i <10; $i++) {
        $sum=0;
        $cantidad=0;
        foreach($valor[$i] as &$notas){
            $sum=$sum+(int)$notas;
            $cantidad=$cantidad+1;
        }
        if($cantidad>0)
            $valor[$i]=$sum/(float)$cantidad;
        else
            $valor[$i]=$sum;
    }
}
foreach($Apro as &$valor){
    echo "<tr>";
    echo "<th scope='row'>$valor[0]</th>";
    echo "<td>$valor[1]</td>";
    echo "<td>$valor[2]</td>";
    echo "<td>$valor[3]</td>";
    echo "<td>$valor[4]</td>";
    echo "<td>$valor[5]</td>";
    echo "<td>$valor[6]</td>";
    echo "<td>$valor[7]</td>";
    echo "<td>$valor[8]</td>";
    echo "<td>$valor[9]</td>";
    echo "</tr>";
}
?>