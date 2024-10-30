<?php

function conversionPeriodos($interes, $tipo_periodo, $frecuencia_interes){
    switch ($tipo_periodo) {
        case 'dias':
            // Ajustar la tasa de interés según la frecuencia seleccionada
            switch ($frecuencia_interes) {
                case 'diario':
                    $interes = $interes;
                    break;
                case 'mensual':
                    $interes = $interes / 30;
                    break;
                case 'anual':
                    $interes = $interes / 360;
                    break;
            }
            break;
        case 'meses':
            switch ($frecuencia_interes) {
                case 'diario':
                    $interes = $interes * 30;
                    break;
                case 'mensual':
                    $interes = $interes;
                    break;
                case 'anual':
                    $interes = $interes / 12;
                    break;
            }
            break;
        case 'años':
            switch ($frecuencia_interes) {
                case 'diario':
                    $interes = $interes * 360;
                    break;
                case 'mensual':
                    $interes = $interes * 12;
                    break;
                case 'anual':
                    $interes = $interes;
                    break;
            }
            break;
    }

    return $interes;
}

function interesSimple($tiempo, $capital, $interes, $tipo_periodo, $frecuencia_interes){       
    $interes_ajustado = conversionPeriodos($interes, $tipo_periodo, $frecuencia_interes);
    
    // Cálculo del interés simple
    $monto = $capital * (1 + $interes_ajustado * $tiempo);

    // Mostrar el resultado
    echo "<div class='resultado'><h3>El monto final es: $" . number_format($monto, 3) . "</h3></div>";
}

function interesCompuesto($tiempo, $capital, $interes, $tipo_periodo, $frecuencia_interes){       
    $interes_ajustado = conversionPeriodos($interes, $tipo_periodo, $frecuencia_interes);
    
    // Cálculo del interés simple
    $monto = $capital * pow((1 + $interes_ajustado), $tiempo);

    // Mostrar el resultado
    echo "<div class='resultado'><h3>El monto final es: $" . number_format($monto, 3) . "</h3></div>";
}

function VPN($inversion_inicial, $interes, $FE){
    $vpn = -$inversion_inicial;
    foreach ($FE as $anio => $flujo) {
        $flujo = floatval($flujo);
        $vpn += ($flujo/(pow((1 + $interes), ($anio+1))));
    }
    return $vpn;    
}

function PRI($inversion_inicial, $FE, $FEA){
    $D = 0;
    $i = 0;

    while ($FEA[$i] < $inversion_inicial) { 
        $i++;
    }

    $A = $i-1;
    $B = $inversion_inicial;
    $C = $FEA[$i-1];
    $D = $FE[$i-1];

    $PRI = $A + (($B-$C)/$D);
    return $PRI;
}

function tanteo($inversion_inicial, $FE) {
    $incremento = 1;  // Initial increment
    $x = 0.01;  // Starting guess for the rate, in percentage terms (1% as 0.01)
    $y = -$inversion_inicial;  // Initial NPV
    
    while (abs($y) > 0.0001) {  // Continue while NPV is not close enough to zero
        $y = -$inversion_inicial;  // Reset NPV for each iteration
        foreach ($FE as $i => $flujo) {
            $y += $flujo / pow(1 + $x, $i + 1);  // Calculate NPV for the current rate
        }

        if ($y > 0) {
            $x += $incremento;  // Increase rate if NPV is positive
        } else {
            $x -= $incremento;  // Decrease rate if NPV is negative
            $incremento /= 10;  // Reduce increment for finer adjustments
        }
    }

    return $x * 100;  // Return IRR as a percentage
}
