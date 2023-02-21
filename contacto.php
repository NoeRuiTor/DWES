<?php

include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Contacto";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";
$current_page = 'contacto.php';

include("cabecera.php");
?>
<main>
  <section class="localizacion">
    <div class="mapa">
    <iframe  src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6419.76334463789!2d-0.6765269830433929!3d38.591299282444645!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xad73dc4a1b00ba1d%3A0xfc789b4b44a4bb48!2sElectricidad%20FCV!5e0!3m2!1ses!2ses!4v1675718077867!5m2!1ses!2ses" 
        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div> 
    <h3>Contacto</h3>
    <div class="localizacion-info">
       <div class="contacto">
          <i class="fas fa-phone"></i>666194313
       </div>
       <div class="contacto">
          <i class="fas fa-map"></i>C/Senieta l'auelet, 53, Castalla (Alicante)
       </div>
       <div class="contacto">
       <i class="fas fa-envelope"></i>info@electricidadfcv.com
       </div>
    </div>
    </section>
</main>
<?php
include("pie.php");

?>