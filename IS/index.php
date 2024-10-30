<?php include __DIR__ . '/header.php' ?>
<div class="titulo">
    <h1> BIENVENIDO, SELECCIONA UN METODO DE EVALUACION DE PROYECTO PARA CONTINUAR </h1>
</div>
<div class="contenedor">
<div class="section" id="section1">
    <h2>Método de evaluación de proyecto</h2>
    <p>
    Un método de evaluación de proyectos mide la viabilidad y rentabilidad de un proyecto. Algunos de los métodos más comunes son el VPN, TIR y PRI.
    </p>
</div>

<div class="section">
    <h2>Interés simple</h2>
    <p>
    El interés simple se calcula sobre el capital inicial sin reinversión de los intereses. Su crecimiento es lineal.
    </p>
    <p>Fórmula:</p>
    <p><code>I = P * r * t</code></p>
    <ul>
        <li><code>I</code>: Interés</li>
        <li><code>P</code>: Capital inicial</li>
        <li><code>r</code>: Tasa de interés</li>
        <li><code>t</code>: Tiempo</li>
    </ul>
</div>

<div class="section">
    <h2>Interés compuesto</h2>
    <p>
    El interés compuesto reinvierte los intereses, permitiendo un crecimiento exponencial.
    </p>
    <p>Fórmula:</p>
    <p><code>A = P * (1 + r/n)^(nt)</code></p>
    <ul>
        <li><code>A</code>: Monto total (capital + intereses)</li>
        <li><code>P</code>: Capital inicial</li>
        <li><code>r</code>: Tasa de interés anual</li>
        <li><code>n</code>: Número de periodos de capitalización por año</li>
        <li><code>t</code>: Tiempo en años</li>
    </ul>
</div>

<div class="section">
    <h2>Periodo de Recuperación de la Inversión (PRI)</h2>
    <p>
    El PRI es el tiempo necesario para recuperar la inversión inicial mediante los flujos de efectivo.
    </p>
    <p>Fórmula:</p>
    <p><code>PRI = Inversión inicial / Flujo de efectivo anual neto</code></p>
</div>

<div class="section">
    <h2>Valor Presente Neto (VPN)</h2>
    <p>
    El VPN es la diferencia entre el valor presente de los flujos de efectivo futuros y la inversión inicial. Un VPN positivo indica que el proyecto es rentable.
    </p>
    <p>Fórmula:</p>
    <p><code>VPN = ∑(F<sub>t</sub> / (1 + r)<sup>t</sup>) - I</code></p>
    <ul>
        <li><code>F<sub>t</sub></code>: Flujo de efectivo en el periodo <code>t</code></li>
        <li><code>r</code>: Tasa de descuento</li>
        <li><code>I</code>: Inversión inicial</li>
    </ul>
</div>

<div class="section">
    <h2>Valor Anual Equivalente (VAE)</h2>
    <p>
    El VAE convierte el VPN en una cantidad anualizada, facilitando la comparación de proyectos con diferentes duraciones.
    </p>
    <p>Fórmula:</p>
    <p><code>VAE = VPN * (r / (1 - (1 + r)<sup>-n</sup>))</code></p>
    <ul>
        <li><code>r</code>: Tasa de interés o descuento</li>
        <li><code>n</code>: Número de años</li>
    </ul>
</div>

<div class="section">
    <h2>Tasa Interna de Rendimiento (TIR)</h2>
    <p>
    La TIR es la tasa que hace que el VPN de un proyecto sea igual a cero.
    </p>
    <p>Fórmula: (se resuelve por iteración)</p>
    <p><code>0 = ∑(F<sub>t</sub> / (1 + TIR)<sup>t</sup>) - I</code></p>
    <ul>
        <li><code>F<sub>t</sub></code>: Flujo de efectivo en el periodo <code>t</code></li>
        <li><code>I</code>: Inversión inicial</li>
    </ul>
</div>
</div>
<?php include __DIR__ . '/footer.php' ?>