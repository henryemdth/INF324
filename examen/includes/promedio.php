<?php
include 'header.inc.php';
include '../services/conexion.inc.php';
?>
<div class="container">
    <h1>PROMEDIO DE NOTAS (QUERY)</h1>
    <div class=" shadow-sm banner_section p-4 my-4 bg-light rounded">
        <table class="table ">
            <thead class="table-dark">
                <tr>
                    <th scope="col">SIGLA</th>
                    <th scope="col">CHUQUISACA</th>
                    <th scope="col">LA PAZ</th>
                    <th scope="col">COCHABAMBA</th>
                    <th scope="col">ORURO</th>
                    <th scope="col">POTOSI</th>
                    <th scope="col">TARIJA</th>
                    <th scope="col">SANTA CRUZ</th>
                    <th scope="col">BENI</th>
                    <th scope="col">PANDO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                 $resultado = mysqli_query($con, "select resultado.sigla, 
                 IFNULL(sum(CH)/sum(case when CH<>0 then 1 end),0) CH,
                 IFNULL(sum(LP)/sum(case when LP<>0 then 1 end),0) LP,
                 IFNULL(sum(CB)/sum(case when CB<>0 then 1 end),0) CB,
                 IFNULL(sum('OR')/sum(case when 'OR'<>0 then 1 end),0) 'OR',
                 IFNULL(sum(PT)/sum(case when PT<>0 then 1 end),0) PT,
                 IFNULL(sum(TJ)/sum(case when TJ<>0 then 1 end),0) TJ,
                 IFNULL(sum(SC)/sum(case when SC<>0 then 1 end),0) SC,
                 IFNULL(sum(BE)/sum(case when BE<>0 then 1 end),0) BE,
                 IFNULL(sum(PD)/sum(case when PD<>0 then 1 end),0) PD
                 FROM (SELECT sigla, 
                     avg(case when departamento='01' then notafinal else 0 end) CH, 
                     avg(case when departamento='02' then notafinal else 0 end) LP,
                     avg(case when departamento='03' then notafinal else 0 end) CB,
                     avg(case when departamento='04' then notafinal else 0 end) 'OR',
                     avg(case when departamento='05' then notafinal else 0 end) PT,
                     avg(case when departamento='06' then notafinal else 0 end) TJ,
                     avg(case when departamento='07' then notafinal else 0 end) SC,
                     avg(case when departamento='08' then notafinal else 0 end) BE,
                     avg(case when departamento='09' then notafinal else 0 end) PD
                     FROM nota,persona 
                     WHERE nota.ci=persona.ci
                     group by sigla,departamento) as resultado
                 group by resultado.sigla;");
                 while ($fila = mysqli_fetch_array($resultado)){
                     echo mysqli_num_rows($resultado)==0;
                     echo "<tr>";
                     echo "<th scope='row'>$fila[sigla]</th>";
                     echo "<td>$fila[CH]</td>";
                     echo "<td>$fila[LP]</td>";
                     echo "<td>$fila[CB]</td>";
                     echo "<td>$fila[OR]</td>";
                     echo "<td>$fila[PT]</td>";
                     echo "<td>$fila[TJ]</td>";
                     echo "<td>$fila[SC]</td>";
                     echo "<td>$fila[BE]</td>";
                     echo "<td>$fila[PD]</td>";
                     //echo "<td><a href='editar.php?ci=$fila[ci]'>Editar</a></td>";
                     //echo "<td><a href='eliminar.php?ci=$fila[ci]'>Eliminar</a></td>";
                     echo "</tr>";
                 }
                
                //session_unset();
                ?>

            </tbody>
        </table>
    </div>
</div>
<div class="container">
    <h1>PROMEDIO DE NOTAS (PHP)</h1>
    <div class=" shadow-sm banner_section p-4 my-4 bg-light rounded">
        <table class="table ">
            <thead class="table-dark">
                <tr>
                    <th scope="col">SIGLA</th>
                    <th scope="col">CHUQUISACA</th>
                    <th scope="col">LA PAZ</th>
                    <th scope="col">COCHABAMBA</th>
                    <th scope="col">ORURO</th>
                    <th scope="col">POTOSI</th>
                    <th scope="col">TARIJA</th>
                    <th scope="col">SANTA CRUZ</th>
                    <th scope="col">BENI</th>
                    <th scope="col">PANDO</th>
                </tr>
            </thead>
            <tbody>
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

            </tbody>
        </table>
    </div>
</div>
<?php
include('footer.inc.php');
?>