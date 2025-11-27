<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Barretos Pizza</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
  
  <style>
    /* --- ESTILO PERSONALIZADO PIZZARIA --- */
    
    /* Vermelho "Tomate" para o Menu */
    .bg-pizzaria {
        background-color: #ce2e2e !important;
    }
    
    /* Fundo creme suave */
    body {
        background-color: #f2f2f2;

    }
    
    /* Ajuste para o rodapé ficar menor e elegante */
    footer {
        background-color: #212529;
        font-size: 0.9rem;
    }
    
    /* Ícones do Dashboard com efeito ao passar o mouse */
    .card:hover {
        transform: scale(1.03);
        transition: 0.3s;
        box-shadow: 0 4px 8px rgba(0,0,0,0.2);
    }
    
    .navbar-brand {
        font-weight: bold;
        letter-spacing: 1px;
    }

    /* ===== SOMBRA NOS TEXTOS (PEDIDO) ===== */
    h1, h5, .navbar-brand, .nav-link, .card-title, .lead {
        text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
    }
  </style>
</head>

<body class="d-flex flex-column min-vh-100">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-pizzaria">
  <div class="container-fluid">
    <a class="navbar-brand" href="index.php">
        <i class="fas fa-pizza-slice me-2"></i>Barretos Pizza
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">

      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>

        <!-- Entregadores -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Entregadores
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-entregador">Cadastrar</a></li>
            <li><a class="dropdown-item" href="?page=listar-entregador">Lista</a></li>
          </ul>
        </li>

        <!-- Clientes -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cliente
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-cliente">Cadastrar</a></li>
            <li><a class="dropdown-item" href="?page=listar-cliente">Lista</a></li>
          </ul>
        </li>

        <!-- Ingredientes -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Ingredientes
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-ingrediente">Cadastrar</a></li>
            <li><a class="dropdown-item" href="?page=listar-ingrediente">Lista</a></li>
          </ul>
        </li>

        <!-- Pizzas -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Cardápio
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-pizza">Cadastrar Pizza</a></li>
            <li><a class="dropdown-item" href="?page=listar-pizza">Ver Cardápio</a></li>
          </ul>
        </li>

        <!-- Pedidos -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Pedidos
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="?page=cadastrar-pedido">Novo Pedido</a></li>
            <li><a class="dropdown-item" href="?page=listar-pedido">Histórico</a></li>
          </ul>
        </li>

      </ul>
      <form class="d-flex" role="search">
        <input class="form-control me-2" type="search" placeholder="Buscar..." aria-label="Search"/>
        <button class="btn btn-outline-light" type="submit">Buscar</button>
      </form>
    </div>
  </div>
</nav>

  <div class="container mt-4 flex-grow-1">
    <div class="row">
      <div class="col">
        <?php
           include('config.php');

           switch (@$_REQUEST['page']) {
            
            // ENTREGADOR
            case 'cadastrar-entregador': include("cadastrar-entregador.php"); break;
            case 'listar-entregador': include("listar-entregador.php"); break;
            case 'editar-entregador': include("editar-entregador.php"); break;
            case 'salvar-entregador': include("salvar-entregador.php"); break;

            // CLIENTE
            case 'cadastrar-cliente': include("cadastrar-cliente.php"); break;
            case 'listar-cliente': include("listar-cliente.php"); break;
            case 'editar-cliente': include("editar-cliente.php"); break;
            case 'salvar-cliente': include("salvar-cliente.php"); break;

            // INGREDIENTE
            case 'cadastrar-ingrediente': include("cadastrar-ingrediente.php"); break;
            case 'listar-ingrediente': include("listar-ingrediente.php"); break;
            case 'editar-ingrediente': include("editar-ingrediente.php"); break;
            case 'salvar-ingrediente': include("salvar-ingrediente.php"); break;

            // PIZZA
            case 'cadastrar-pizza': include("cadastrar-pizza.php"); break;
            case 'listar-pizza': include("listar-pizza.php"); break;
            case 'editar-pizza': include("editar-pizza.php"); break;
            case 'salvar-pizza': include("salvar-pizza.php"); break;

            // PEDIDO
            case 'cadastrar-pedido': include("cadastrar-pedido.php"); break;
            case 'listar-pedido': include("listar-pedido.php"); break;
            case 'editar-pedido': include("editar-pedido.php"); break;
            case 'salvar-pedido': include("salvar-pedido.php"); break;
            
            default:
print "
    <div class='text-center mb-5'>
        <h1 class='display-4 text-danger fw-bold'>Barretos Pizza</h1>
        <p class='lead text-muted'>O melhor sabor da região no seu sistema.</p>
    </div>

    <div class='container'>

        <!-- CARDÁPIO CENTRALIZADO -->
        <div class='row justify-content-center mb-4'>
            <div class='col-10 col-md-6 col-lg-4'>
                <div class='card text-center h-100 border-danger shadow-lg' style='transform: scale(1.05);'>
                    <div class='card-body d-flex flex-column justify-content-center'>
                        <i class='fas fa-pizza-slice fa-5x text-danger mb-3'></i>
                        <h5 class='card-title fw-bold'>Cardápio</h5>
                        <a href='?page=listar-pizza' class='btn btn-danger mt-auto'>Ver Pizzas</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- LINHA DE 4 CARDS (GERA SIMETRIA) -->
        <div class='row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4'>

            <!-- Pedidos -->
            <div class='col'>
                <div class='card text-center h-100 border-warning'>
                    <div class='card-body d-flex flex-column justify-content-center'>
                        <i class='fas fa-receipt fa-4x text-warning mb-3'></i>
                        <h5 class='card-title'>Pedidos</h5>
                        <a href='?page=listar-pedido' class='btn btn-warning mt-auto'><b>Gerenciar</b></a>
                    </div>
                </div>
            </div>

            <!-- Clientes -->
            <div class='col'>
                <div class='card text-center h-100 border-success'>
                    <div class='card-body d-flex flex-column justify-content-center'>
                        <i class='fas fa-users fa-4x text-success mb-3'></i>
                        <h5 class='card-title'>Clientes</h5>
                        <a href='?page=listar-cliente' class='btn btn-success mt-auto'>Listar</a>
                    </div>
                </div>
            </div>

            <!-- Estoque (ícone caixa) -->
            <div class='col'>
                <div class='card text-center h-100 border-info'>
                    <div class='card-body d-flex flex-column justify-content-center'>
                        <i class='fas fa-box fa-4x text-info mb-3'></i>
                        <h5 class='card-title'>Estoque</h5>
                        <a href='?page=listar-ingrediente' class='btn btn-info text-white mt-auto'>Ingredientes</a>
                    </div>
                </div>
            </div>

            <!-- Entregadores -->
            <div class='col'>
                <div class='card text-center h-100 border-secondary'>
                    <div class='card-body d-flex flex-column justify-content-center'>
                        <i class='fas fa-motorcycle fa-4x text-secondary mb-3'></i>
                        <h5 class='card-title'>Entregadores</h5>
                        <a href='?page=listar-entregador' class='btn btn-secondary mt-auto'>Equipe</a>
                    </div>
                </div>
            </div>

        </div>
    </div>
";
}
?>




      </div>
    </div>
  </div>

<!-- FOOTER -->
<footer class="text-light py-5 mt-5" style="background-color: #202020;">
    <div class="container">

        <!-- LINHA PRINCIPAL -->
        <div class="row gy-4">

            <!-- COLUNA 1 — Marca + descrição -->
            <div class="col-md-4 text-center text-md-start">
                <h3 class="fw-bold text-danger">Barretos Pizza</h3>
                <p class="mt-2" style="font-size: 0.95rem;">
                    “O sabor que conquista desde a primeira fatia.”
                </p>
                <p class="mb-2" style="font-size: 0.9rem; color:#bbbbbb;">
                    Pizzas artesanais assadas no forno na hora, com ingredientes selecionados.
                </p>

                <!-- Formas de pagamento -->
                <h6 class="fw-bold text-uppercase text-danger mt-3 mb-2">Formas de Pagamento</h6>
                <p class="mb-1" style="font-size: 0.9rem; color:#bbbbbb;">
                    Pix • Crédito • Débito • Vale-Refeição
                </p>
            </div>

            
            <!-- COLUNA 2 — Endereço + horário + áreas atendidas (CENTRALIZADO) -->
            <div class="col-md-4 text-center">

                <h5 class="fw-bold text-uppercase text-danger mb-3">Onde Estamos</h5>

                <p class="mb-1" style="font-size: 0.9rem;">Asa Sul – Brasília, DF</p>
                <p class="mb-3" style="font-size: 0.9rem;">CLS 308 Bloco B – Loja 12</p>

                <h6 class="fw-bold text-uppercase text-danger mb-2">Horário</h6>
                <p class="mb-1" style="font-size: 0.9rem;">Seg a Sex — 18h às 23h</p>
                <p class="mb-1" style="font-size: 0.9rem;">Sáb e Dom — 17h às 00h</p>
                <p class="mb-3" style="font-size: 0.9rem;">Delivery até 23h50</p>

                <h6 class="fw-bold text-uppercase text-danger mb-2">Áreas de Entrega</h6>
                <p class="mb-0" style="font-size: 0.9rem; color:#bbbbbb;">
                    Asa Sul • Asa Norte • Sudoeste • Octogonal
                </p>

            </div>


            
            <!-- COLUNA 3 — Contato + redes (CENTRALIZADO) -->
            <div class="col-md-4 text-center">

                <h5 class="fw-bold text-uppercase text-danger mb-3">Contato</h5>

                <p class="mb-2" style="font-size: 0.9rem;">
                    <i class="fas fa-phone-alt text-danger me-2"></i>
                    (61) 9 9999-0000
                </p>

                <p class="mb-3" style="font-size: 0.9rem;">
                    <i class="fas fa-envelope text-danger me-2"></i>
                    atendimento@barretospizza.com
                </p>

                <h6 class="fw-bold text-uppercase text-danger mb-2">Siga-nos</h6>

                <div class="d-flex justify-content-center align-items-center">
                    <i class="fab fa-instagram fa-lg mx-3" style="color:#E4405F;"></i>
                    <i class="fab fa-whatsapp fa-lg mx-3" style="color:#25D366;"></i>
                    <i class="fab fa-facebook fa-lg mx-3" style="color:#1877F2;"></i>
                </div>

            </div>


                <!-- Redes sociais -->
                <h6 class="fw-bold text-uppercase text-danger mb-2">Siga-nos</h6>
                <div>
                    <i class="fab fa-instagram fa-lg me-3" style="color:#E4405F;"></i>
                    <i class="fab fa-whatsapp fa-lg" style="color:#25D366;"></i>
                    <i class="fab fa-facebook fa-lg ms-3" style="color:#1877F2;"></i>
                </div>
            </div>

        </div>

        <!-- LINHA FINAL -->
        <hr class="border-secondary mt-4">

        <div class="text-center mt-3">
            <small class="text-secondary">
                © 2025 Barretos Pizza — Sabores que aproximam você de casa.
            </small>
        </div>

    </div>
</footer>



  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
</body>
</html>
