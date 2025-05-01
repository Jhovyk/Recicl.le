<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <title>Blog Clássico | Ecofix | Modelo HTML de Reciclagem de Resíduos</title>

    <!--Favicon-->
    <link rel="icon" href="assets/img/favicon.png" type="image/jpg">
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <!-- Line Awesome CSS -->
    <link href="assets/css/line-awesome.min.css" rel="stylesheet">
    <!-- Animate CSS-->
    <link href="assets/css/animate.css" rel="stylesheet">
    <!-- Bar Filler CSS -->
    <link href="assets/css/barfiller.css" rel="stylesheet">
    <!-- Magnific Popup Video -->
    <link href="assets/css/magnific-popup.css" rel="stylesheet">
    <!-- Flaticon CSS -->
    <link href="assets/css/flaticon.css" rel="stylesheet">
    <!-- Owl Carousel CSS -->
    <link href="assets/css/owl.carousel.css" rel="stylesheet">
    <!-- Slick CSS -->
    <link href="assets/css/slick.css" rel="stylesheet">
    <!-- Nice Select  -->
    <link href="assets/css/nice-select.css" rel="stylesheet">
    <!-- Style CSS -->
    <link href="assets/css/style.css" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="assets/css/responsive.css" rel="stylesheet">

    <!-- jquery -->
    <script src="assets/js/jquery-1.12.4.min.js"></script>
</head>

<body>
    <!-- Área de Cabeçalho -->

    <div class="header-area">
        <div class="sticky-area">
            <div class="navigation">
                <div class="container">

                    <div class="header-inner-box">
                        <div class="logo">
                            <a class="navbar-brand" href="index.html"><img src="assets/img/logo.png" alt=""></a>
                        </div>

                        <div class="main-menu">
                            <nav class="navbar navbar-expand-lg">
                                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                    <span class="navbar-toggler-icon"></span>
                                    <span class="navbar-toggler-icon"></span>
                                    <span class="navbar-toggler-icon"></span>
                                </button>

                                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                                    <ul class="navbar-nav m-auto">
                                        <li class="nav-item">
                                           <a class="nav-link active" href="index.html">Início</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="#">Páginas
                                                <span class="sub-nav-toggler"> </span>
                                            </a>
                                            <ul class="sub-menu">
                                                <li><a href="about.html">Sobre Nós</a></li>
                                                <li><a href="electronics_recycle.html">Nosso Trabalho</a></li>
                                                <li><a href="faq.html">FAQ Útil</a></li>
                                                <li><a href="quotation.html">Solicitar Coleta</a></li>
                                            </ul>
                                        </li>
											<li class="nav-item">
												<a class="nav-link" href="electronics_recycle.html">Serviço</a>
											</li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="blog-classic.php">Blog</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="contact.html">Contato</a>
                                        </li>
                                    </ul>
                                </div>
                            </nav>
                        </div>

                        <div class="phone-number-box">
                            <div class="icon">
                                <i class="las la-phone-volume"></i>
                            </div>
                            <div class="phone">
                                <p>Tem alguma pergunta?</p>
                                <a href="tel:926668880000">+92 666 888 0000</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Área de Breadcrumb -->

    <div class="breadcroumb-area blog-bg">
        <div class="overlay-2"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcroumb-title text-center">
                        <h1>Blog - Clássico</h1>
                        <h6><a href="index.html">Início</a> / Blog</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Blog content start -->
    <section class="blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <!-- PHP code to dynamically load blog posts from MySQL database -->
                    <?php
                    require 'db_connect.php'; // Conecta ao banco de dados

                    // Recupera as postagens do banco de dados
                    $stmt = $pdo->query("SELECT * FROM postagens ORDER BY data DESC");

                    // Exibe as postagens no site
                    while ($postagem = $stmt->fetch(PDO::FETCH_ASSOC)) {
                        echo '<div class="blog-post">';
                        echo '<h2 class="post-title">' . htmlspecialchars($postagem['titulo']) . '</h2>';
                        
                        // Exibe a imagem, se houver
                        if (!empty($postagem['imagem'])) {
                            echo '<div class="post-image">';
                            echo '<img src="' . htmlspecialchars($postagem['imagem']) . '" alt="' . htmlspecialchars($postagem['titulo']) . '" style="max-width:100%;">';
                            echo '</div>';
                        }

                        echo '<p>' . htmlspecialchars($postagem['conteudo']) . '</p>';
                        echo '<small>Publicado em: ' . $postagem['data'] . '</small><hr>';
                        echo '</div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog content end -->

    <!-- Área de Rodapé -->

    <footer class="footer-area">
        <div class="container">
            <div class="footer-up">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-sm-12">
                        <div class="logo">
                            <img src="assets/img/logo-white.png" alt="ecofix-logo">
                        </div>
                        <div class="contact-info">
                            <p><b>Localização:</b> 123, Rua Broklyn, Nova York</p>
                            <p><b>Telefone:</b> +99 268 827 2500</p>
                            <p><b>E-mail:</b> info@ecofix.com</p>
                            <p><b>Horário de Funcionamento:</b> 08:00 AM - 09:00 PM</p>
                        </div>
                    </div>
                    <div class="col-lg-5 col-md-6 com-sm-12">

                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-12">
                                <h6>Empresa</h6>
                                <ul>
                                    <li>
                                        <a href="about.html">Sobre Nós</a>
                                        <a href="team.html">Conheça Nossa Equipe</a>
                                        <a href="blog.html">Notícias e Mídia</a>
                                        <a href="project.html">Nossos Projetos</a>
                                        <a href="contact.html">Contato</a>
										<li><a href="electronics_recycle.html">Reciclagem de Eletrônicos</a></li>
                                    </li>
                                </ul>
                            </div>

                        </div>
                    </div>

                    <div class="col-lg-3 col-md-6">
                        <div class="subscribe-form">
                            <h6>Newsletter</h6>
                            <form action="index.html">
                                <input type="email" placeholder="Seu e-mail">
                                <button type="submit"><i class="las la-envelope"></i></button>
                            </form>
                            <p>Fique por dentro das nossas últimas notícias</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Área Inferior do Rodapé -->

    <div class="footer-bottom">
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-3 col-12">
                    <div class="copyright-area">
                        <p class="copyright-line">© 2024 Ecofix. Todos os direitos reservados.</p>
                    </div>
                </div>
                <div class="col-lg-6 col-12">
                    <p class="privacy"><a href="#">Termos e Condições</a> <a href="#">Política de Privacidade</a> <a href="#">Dicas de Reciclagem</a></p>
                </div>
                <div class="col-lg-3 col-12 text-end">
                    <div class="social-area">
                        <a href=""><i class="lab la-facebook-f"></i></a>
                        <a href=""><i class="lab la-youtube"></i></a>
                        <a href=""><i class="lab la-twitter"></i></a>
                        <a href=""><i class="lab la-instagram"></i></a>
                        <a href=""><i class="lab la-linkedin"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Área de Scroll Top -->
    <a href="#top" class="go-top"><i class="las la-angle-up"></i></a>

    <!-- Popper JS -->
    <script src="assets/js/popper.min.js"></script>
    <!-- Bootstrap JS -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Wow JS -->
    <script src="assets/js/wow.min.js"></script>
    <!-- Way Points JS -->
    <script src="assets/js/jquery.waypoints.min.js"></script>
    <!-- Counter Up JS -->
    <script src="assets/js/jquery.counterup.min.js"></script>
    <!-- Owl Carousel JS -->
    <script src="assets/js/owl.carousel.min.js"></script>
    <!-- Slick JS -->
    <script src="assets/js/slick.js"></script>
    <!-- Magnific Popup JS -->
    <script src="assets/js/magnific-popup.min.js"></script>
    <!-- Sticky JS -->
    <script src="assets/js/jquery.sticky.js"></script>
    <!-- Nice Select JS -->
    <script src="assets/js/jquery.nice-select.min.js"></script>
    <!-- Progress Bar JS -->
    <script src="assets/js/jquery.barfiller.js"></script>
    <!-- Main JS -->
    <script src="assets/js/main.js"></script>

</body>

</html>
