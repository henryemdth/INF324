<?php
include 'header.inc.php';
include '../services/conexion.inc.php';
?>
<div class="container">
    <div class=" shadow-sm banner_section p-4 my-4 bg-light rounded">
        <table class="table ">
            <thead class="table-dark">
                <tr>
                    <th scope="col">SIGLA</th>
                    <th scope="col">NOTA 1</th>
                    <th scope="col">NOTA 2</th>
                    <th scope="col">NOTA 3</th>
                    <th scope="col">NOTA FINAL</th>
                    <th scope="col">PROMEDIO</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $resultado = mysqli_query($con, "select sigla, nota1,nota2,nota3,notafinal, (nota1+nota2+nota3+notafinal)/4 as promedio from nota where ci='".$ci."';");
                while ($fila = mysqli_fetch_array($resultado)){
                    echo mysqli_num_rows($resultado)==0;
                    echo "<tr>";
                    echo "<th scope='row'>$fila[sigla]</th>";
                    echo "<td>".$fila["nota1"]."</td>";
                    echo "<td>$fila[nota2]</td>";
                    echo "<td>$fila[nota3]</td>";
                    echo "<td>$fila[notafinal]</td>";
                    echo "<td>$fila[promedio]</td>";               
                    echo "</tr>";
                }
                //session_unset();
                ?>

            </tbody>
        </table>
    </div>
</div>
<?php
include('footer.inc.php');
?>