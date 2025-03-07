<!DOCTYPE html>
<html lang="es">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Página con Navbar y Footer</title>
    <link rel="stylesheet" href="styles.css" />
  </head>
  <body>
    <header>
    <nav>
        <ul class="navbar">
          <li><h1>DANI</h1></li>
          <li><a href="#index.php">Inicio</a></li>
          <li><a href="#servicios">Servicios</a></li>
          <li><a href="#acerca-de">Acerca de</a></li>
          <li><a href="#contacto">Contacto</a></li>
          <li><a href="login.php">Iniciar Sesion</a></li>
          <li><a href="registro.php">Registrarse</a></li>
        </ul>
      </nav>
    </header>

    <main>
      <section id="inicio">
        <div class="inicioBoxImg cereza">
          
        </div>
        <div class="inicioBoxImgcentro">
          <h1>Licoreria <h2>DANI</h2></h1>
        </div>
        <div class="inicioBoxImg copa">
          
        </div>
      </section>

      <section id="servicios">
        <div class="box boxsercf">Todas las bebidas a tu alcance</div>
        <div class="box"><img src="./img/romero.jpg" alt=""></div>
        <div class="box boxsercr">"¡Tu bar en casa! Equipa tu hogar con todo lo necesario para tus reuniones y celebraciones. Encontrarás una gran variedad de bebidas alcohólicas y no alcohólicas, así como todo tipo de accesorios para preparar tus cócteles favoritos." </div>
      </section>

      <section id="acerca-de">
        <div class="acerca-de-contend">
          "La bodega más completa de la ciudad. Una amplia selección de vinos tintos, blancos y rosados, para todos los gustos y ocasiones. Déjate asesorar por nuestros sommeliers y encuentra el vino perfecto para maridar con tus platos favoritos."
        </div>
      </section>

      <section id="contacto">
        <div class="box">"Haz tu pedido online y recíbelo en la comodidad de tu hogar.".
          2do anillo bazer # 4355</div>
        <div class="box"><img src="./img/repartidor.jpg" alt=""></div>
        <div class="box boxsercr"><h1>Contactanos</h1>
          <br>
          Telefono:   +591 72498493
          WhatsApp: +591 68023024</div>
      </section>
    </main>
    <footer>
      <p>&copy; 2024 Tu Licoreria Dani Todos los derechos reservados. Prohibida su reproducción total o parcial sin autorización.</p>
    </footer>
  </body>
</html>
