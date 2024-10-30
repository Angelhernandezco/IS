<?php  
include __DIR__ . '/header.php'; 
require __DIR__ . '/funciones.php';

// Inicializar el número de años
$numAnios = isset($_POST['numAnios']) ? $_POST['numAnios'] : 3;
// Si se añade un año
if (isset($_POST['addYear'])) {
    $numAnios++;
}
// Si se elimina un año
if (isset($_POST['removeYear']) && $numAnios > 1) {
    $numAnios--;
} 
?>

<div class="titulo">
    <h1> PERIODO DE RECUPERACIÓN DE INVERSION (PRI) </h1>
</div>

<div class="contenedor2">
    <form method="POST" action="">
        <h3>Inversión inicial: <br>
            <input type="text" class="input" name="inversion" autocomplete="off" value="<?= isset($_POST['inversion']) ? $_POST['inversion'] : '' ?>">
        </h3>
        <h3>Flujos de efectivo:</h3>
        <?php
        $FEA = [];
        $FEA[] = 0;
        // Mostrar los flujos de efectivo según el número de años
        for ($i = 1; $i <= $numAnios; $i++) {
            $fe_value = isset($_POST['FE'][$i - 1]) && is_numeric($_POST['FE'][$i - 1]) ? $_POST['FE'][$i - 1] : 0;
            $FEA[] = $FEA[$i - 1] + $fe_value;
            ?>
            <div class='input-group'>
                <?php echo 'Año ' . $i . ':&nbsp;' ?>
                <input type='text' class="input" name='FE[]' value='<?= htmlspecialchars($fe_value) ?>' placeholder='$' autocomplete="off">
            </div>
        <?php } ;?>

        <input type="hidden" name="numAnios" value="<?= $numAnios ?>">
        <div class="agregarFE">
            <button type="submit" name="addYear" class="boton">Añadir año</button>
            <?php if ($numAnios > 1){ ?>
                <button type="submit" name="removeYear" class="boton">Eliminar año</button>
            <?php } ?>
        </div>
        <div class="calcu">
            <input type="submit" name='submit' class="boton" value="CALCULAR">
        </div>
    </form>
            
<?php
    if (isset($_POST['submit'])) { ?>
    <div class="tabla-grid">
        <h3>Resultados</h3><br>
        <div class="tabla" id ="pri">
            <div class="tabla-header tabla-row">
                <div>Año</div>
                <div>Flujo de Efectivo (FE)</div>
                <div>Flujo de Efectivo Acumulado (FEA)</div>
            </div>
    <?php
    for ($i = 1; $i <= $numAnios; $i++) {
        $fe_value = isset($_POST['FE'][$i - 1]) && is_numeric($_POST['FE'][$i - 1]) ? $_POST['FE'][$i - 1] : 0;
        $fea_value = $FEA[$i];
        ?>
        <div class="tabla-row">
            <div>Año <?= $i ?></div>
            <div>$<?= number_format($fe_value, 2) ?></div>
            <div>$<?= number_format($fea_value, 2) ?></div>
        </div>
    <?php } 
        ?> </div><br>
        <?php 
        $PRI = PRI(floatval($_POST['inversion']), $_POST['FE'], $FEA);
        $años = floor($PRI);
        $mesesDecimal = ($PRI - $años) * 12 ;
        $meses = floor($mesesDecimal);
        $diasDecimal = ($mesesDecimal - $meses) * 30;
        $dias = round($diasDecimal); 

        echo "<h3>El PRI es: " . number_format($PRI, 3) . "<br>" . 'Lo que equivale a '. $años . ' años, ' . $meses . ' meses y ' . $dias . " días</h3>";
        ?>
    </div>
    <?php
}
?>
</div>

<?php include __DIR__ . '/footer.php' ?>
