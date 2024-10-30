<?php 
include __DIR__ . '/header.php'; 
require __DIR__ . '/funciones.php';
?>

<div class="titulo">
    <h1> INTERÉS SIMPLE </h1>
</div>
<form method="post">
    <h3>Capital: <br> 
        <input class="input" name="capital" autocomplete="off" value="<?php echo isset($_POST['capital']) ? $_POST['capital'] : ''; ?>"><br>
    </h3>
    <h3>Periodo: <br> 
        <input class="input" name="tiempo" autocomplete="off" value="<?php echo isset($_POST['tiempo']) ? $_POST['tiempo'] : ''; ?>">
        <select class="input" name="tipo_periodo" id=combobox autocomplete="off">
            <option value="dias" <?php echo (isset($_POST['tipo_periodo']) && $_POST['tipo_periodo'] == 'dias') ? 'selected' : ''; ?>>Días</option>
            <option value="meses" <?php echo (isset($_POST['tipo_periodo']) && $_POST['tipo_periodo'] == 'meses') ? 'selected' : ''; ?>>Meses</option>
            <option value="años" <?php echo (isset($_POST['tipo_periodo']) && $_POST['tipo_periodo'] == 'años') ? 'selected' : ''; ?>>Años</option>
        </select>
        <br>
    </h3>
    <h3>Interés: <br> 
        <input class="input" name="interes" autocomplete="off" value="<?php echo isset($_POST['interes']) ? $_POST['interes'] : ''; ?>">
        <select class="input" name="frecuencia_interes" id=combobox autocomplete="off">
            <option value="diario" <?php echo (isset($_POST['frecuencia_interes']) && $_POST['frecuencia_interes'] == 'diario') ? 'selected' : ''; ?>>Diario</option>
            <option value="mensual" <?php echo (isset($_POST['frecuencia_interes']) && $_POST['frecuencia_interes'] == 'mensual') ? 'selected' : ''; ?>>Mensual</option>
            <option value="anual" <?php echo (isset($_POST['frecuencia_interes']) && $_POST['frecuencia_interes'] == 'anual') ? 'selected' : ''; ?>>Anual</option>
        </select>
        <br>
    </h3>
    <h3> 
        <input class="boton" type="submit" value="CALCULAR"> 
    </h3>  
</form>


<?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        interesSimple(floatval($_POST['tiempo']), floatval($_POST['capital']), floatval($_POST['interes']) / 100, $_POST['tipo_periodo'], $_POST['frecuencia_interes']);
    }
include __DIR__ . '/footer.php' ?>