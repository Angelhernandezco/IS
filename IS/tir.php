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
    <h1> TASA INTERNA DE RETORNO (TIR) </h1>
</div>

<div class="contenedor2">
    <form method="POST" action="">
        <h3>Inversión inicial: <br>
            <input type="text" class="input" name="inversion" autocomplete="off" value="<?= isset($_POST['inversion']) ? $_POST['inversion'] : '' ?>">
        </h3>
        <h3>Interés: <br>
            <input type="text" class="input" name="interes" autocomplete="off" value="<?= isset($_POST['interes']) ? $_POST['interes'] : '' ?>">
        </h3>
        <h3>Flujos de efectivo:</h3>
        <?php
        // Mostrar los flujos de efectivo según el número de años
        for ($i = 1; $i <= $numAnios; $i++) {
            $fe_value = isset($_POST['FE'][$i - 1]) ? $_POST['FE'][$i - 1] : '';
            ?>
            <div class='input-group'>
                <?php echo 'Año ' . $i . ':&nbsp;' ?>
                <input type='text' class="input" name='FE[]' value='<?= $fe_value ?>' placeholder='$' autocomplete="off">
            </div>
        <?php } ?>

        <input type="hidden" name="numAnios" value="<?= $numAnios ?>">
        <div class="agregarFE">
            <button type="submit" name="addYear" class="boton">Añadir año</button>
            <?php if ($numAnios > 1) { ?>
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
            <div class="tabla">
                <div class="tabla-header tabla-row">
                    <div>Año</div>
                    <div>Flujo de Efectivo (FE)</div>
                </div>
                <?php
                for ($i = 1; $i <= $numAnios; $i++) {
                    $fe_value = isset($_POST['FE'][$i - 1]) && is_numeric($_POST['FE'][$i - 1]) ? $_POST['FE'][$i - 1] :  '';
                    ?>
                    <div class="tabla-row">
                        <div>Año <?= $i ?></div>
                        <div>$<?= number_format($fe_value, 2) ?></div>
                    </div>
                <?php } ?>
            </div> <!-- Cierre de la tabla -->
            <br>
            <?php 
            $interes = floatval($_POST['interes']);
            $TIR = tanteo(floatval($_POST['inversion']), $_POST['FE'], 1);
            ?>
            <h3>El TIR es: <?= number_format($TIR, 3) ?>%</h3>
            <?php
            if ($TIR > $interes) {
                echo "<h3>El proyecto tendrá ganancias, porque el TIR es mayor que el interés propuesto</h3>";
            } else if ($TIR < $interes) {
                echo "<h3>El proyecto tendrá pérdidas, porque el TIR es menor que el interés propuesto</h3>";
            } else {
                echo "<h3>No habrá ganancias en el proyecto, porque el TIR es igual que el interés propuesto</h3>";
            } 
            ?> 
        </div> <!-- Cierre de la tabla-grid -->
    <?php } ?>
</div> <!-- Cierre de contenedor2 -->

<?php include __DIR__ . '/footer.php' ?>