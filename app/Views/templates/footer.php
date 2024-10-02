        <footer>
            <section id="footer">
                <div class="container">
                    <div class="row text-center text-xs-center text-sm-left text-md-left">
                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <h5>RECURSOS</h5>
                            
                            <ul class="list-unstyled quick-links">
                                <li><a href="/"><i class="fa fa-angle-double-right"></i>Inicio</a></li>
                                <li><a href="/login"><i class="fa fa-angle-double-right"></i>Iniciar sesión</a></li>
                                <li><a href="/register"><i class="fa fa-angle-double-right"></i>Registrarse</a></li>
                                <li><a href="<?= base_url('/admin_list') ?>"><i class="fa fa-angle-double-right"></i>Opciones Administrador</a></li>
                                <li><a href="/categorias/categorias"><i class="fa fa-angle-double-right"></i>Explorar libros</a></li>
                            </ul>
                            
                            <div>
                                <a href="<?php echo filter_var('https://www.ujaen.es/', FILTER_VALIDATE_URL); ?>" class="btn btn-secundary" data-bs-toggle="tooltip" data-bs-placement="top"
                                    title="UJA" style="padding: 0;" target="_blank">
                                    <img src="/images/logo-uja.png" alt="UJA" width="130" height="100">
                                </a>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-4 col-md-4">
                            <h5>Booked</h5>

                            <a href="/inicio" class="btn btn-secundary" data-bs-toggle="tooltip" data-bs-placement="top"
                                title="Booked" style="padding: 0;" target="_blank">
                                <img src="/images/logo-transparente.png" alt="Booked" width="200" height="200">
                            </a>
                        </div>

                        <div class="col-xs-12 ">
                            <h5>Contacto</h5>

                            <ul style="color: white;">
                                <li>Fátima Sanz Baena-fatimasanz71@gmail.com</li>
                            </ul>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
                            <ul class="list-unstyled list-inline social text-center">
                                <li class="list-inline-item"><a href="https://gitlab.ujaen.es/Equipo4/TBW2223-Equipo4" target="_blank"><i class="fab fa-gitlab"></i></a></li>
                                <li class="list-inline-item"><a href="https://tbw2223-4-rsdfsb.oa.r.appspot.com/" target="_blank"><i class="fab fa-google-plus"></i></a></li>
                            </ul>
                        </div>
                        <hr>
                    </div>	

                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-2 text-center text-white">
                            <p>Trabajo final de la asignatura <strong>Tecnologías Basadas en la Web</strong> de la carrera de Ingeniería informática en la Universidad de Jaén</p>
                        </div>
                        <hr>
                    </div>	
                </div>
            </section>
        </footer>
    </body>
</html>
