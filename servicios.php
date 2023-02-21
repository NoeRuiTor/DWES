<?php

include_once("funciones.php");

$titulo_pagina = "Electricidad FCV - Servicios";
$description = "Electricista en Castalla y toda la provincia de Alicante, instalaciones eléctricas, 
energias renovables, reformas de instalaciones, memoria técnica de diseño, presupuestos en general, tienda de iluminación led";
$keywords = "electricidad, electricista, iluminación, energías renovables, reformas electricas, Castalla";
$current_page = 'servicios.php';

include("cabecera.php");
?>
<main>
    <section class="banner1 banner1-servicios">
			<div class="banner1__background">		
				<div class="background__text-box">				
					<h1>tu electricista de <span>confianza</span></h1>
                    <p>Instalación y reformas electricas</p>					
				</div>	
			</div>
	</section>
    <section class="servicios"> 
      <div class="top">   
            <article>   		
                <img src="imgs/obra_nueva.png" alt="obra_nueva">
                <h3>Obra Nueva</h3>    	    			
                <p>Instalaciones eléctricas de obra nueva, tanto en viviendas, naves industriales, locales comerciales...etc.Adaptándolas a las exigencias reglamentarias. Memoria Técnica de Diseño (MTD) y Certificado de Instalación Eléctrica (CIE).</p>  		
            </article>
            <article>
                <img src="imgs/placas_solares.png" alt="placas_solares">
                <h3>Energías Renovables</h3>    	    			
                <p>Soluciones de auto-consumo tanto para empresas como para viviendas particulares. El autoconsumo puede ser integral si combinamos los aerogeneradores de minieolica con placas solares en instalaciones aisladas</p> 		
            </article>
      </div>
      <div class="bottom">
            <article> 
                <img src="imgs/punto_recarga.png" alt="punto_recarga">   		    		
                <h3>Punto de Recarga</h3>    	    			
                <p>En garajes privados o comunitarios nos encargamos de principio a fin para que la instalación del punto de recarga para tu coche eléctrico sea económica, rápida y eficiente. </p>  		
            </article>
            <article class="reforma"> 
                <img src="imgs/reforma_instalacion.png" alt="reforma_instalacion">  		   		
                <h3>Reforma de Instalaciones</h3>    	    			
                <p>La reforma del sistema eléctrico en cualquier vivienda consiste en revisar, analizar y cambiar todas las instalaciones anticuadas u obsoletas, por una nueva que se adapte a la legalidad vigente, cuyo funcionamiento será el más eficiente y adecuado.</p>  		
            </article>
      </div>
    </section>
</main>
    <?php
include("pie.php");

?>