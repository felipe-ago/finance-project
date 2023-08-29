<?php
include_once('assets/php/includes_php/validate_session.php');
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/index.css">
    <link rel="shortcut icon" href="assets/img/Logo.png" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <title>Fluxo Grana</title>
</head>
<body>
    <header class="header">
        <nav class="menu">
            <div class="logo">
                <a href="#">
                    <img src="assets/img/Logo.png">
                    <h1>FLUXO GRANA</h1>
                </a>
            </div>
            <div>
                <a href="login.php" style="color:white;">Tela de Login</a>
                <span style="color:white">|</span>
                <a href="signup.php" style="color:white;">Tela de Cadastro</a>
            </div>
            <div class="links">
                <div class="nav-item">
                    <a href="#">
                        <span class="user"><?php echo $_SESSION['usuario'] ?></span>
                        <img src="assets/img/usuario_icon.png">
                    </a>                    
                    <div class="drop_menu">
                        <a href="assets/php/action_php/logout.php" class="logout">Sair</a>
                    </div>
                </div>
            </div>
            <div class="mobile-menu-icon">
                <button><img class="icon" src="assets/img/menu_white_36dp.svg" alt=""></button>
            </div>
        </nav>
        <div class="mobile-menu">
            <div class="nav-item">
                <a href="" class="logout links">Sair</a>
            </div>
        </div>
    </header>

    <section class="body">
        <div class="options">
            <div class="ref-month"></div>
            <div class="cont-form">
                <div class="select-control">
                    <select name="select" required id="month" name="month">
                        <option value="00" disabled selected>Filtrar por Mês</option>
                    </select>
                </div>
            </div>
            <div class="search">
                <i class="bi bi-search" aria-hidden="true"></i>
                <input type="text" placeholder="Procure pela Descrição" autocomplete="off" class="search-input">
            </div>
            <button class="btn-open">+ Novo Lançamento</button>
        </div>
        
        <div class="modal-container">
            <div class="modal-body">
                <div class="header-modal">
                    <h2>Detalhe o Registro</h2>
                    <span class="close-modal">x</span>
                </div>

                <hr>

                <div class="modal-content">
                    <form action="" method="post" id="form-reg">
                        <div class="form-body">                            
                            <label class="form-label" for="dateInput">Data do Lançamento</label>
                            <input type="date" name="date" id="dateInput" required>
                            <small class="msgErro"></small>

                            <p class="space"></p>

                            <label for="select">Tipo</label>
                            <div class="select-control">
                                <select name="select" required id="type">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="renda">Renda</option>
                                    <option value="despesa">Despesa</option>
                                </select>
                            </div>

                            <p class="space"></p>

                            <label for="sub-tipo">Subtipo</label>
                            <div class="select-control">
                                <select name="select-sub" required id="subtype">
                                    <option value="" disabled selected>Selecione</option>
                                    <option value="previsto">Previsto</option>
                                    <option value="extra">Extra</option>
                                </select>
                            </div>

                            <p class="space"></p>

                            <label class="form-label" for="desc">Descrição Breve do Lançamento</label>
                            <input type="text" name="desc" placeholder="Um título para identificar o registro" id="desc" required>

                            <p class="space"></p>

                            <div class="form-body-selects">
                                <label class="form-label" for="longDesc">Descrição Longa do Lançamento</label>
                                <input type="text" name="desc-long" placeholder="Descrição detelhada (Opcional)" id="long-desc">
                            </div>

                            <p class="space"></p>

                            <div class="form-body-selects">
                                <label class="form-label" for="value">Valor</label>
                                <input type="text" id="value" name="value" placeholder="Digite um valor R$" max="9" required>
                            </div>

                            <p class="space"></p>

                            <div class="popup-success">
                                <div class="popup-success-content">
                                    <p class="popup">Registro adicionado com sucesso!</p>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>

                <hr>
                
                <div class="btns">
                    <button class="close-modal" id="button-close" >Cancelar</button>
                    <button id="button-ok" form="form-reg">Salvar</button>
                </div>

            </div>

        </div>

        <div class="resume">
            <div class="resume-cards" style="color:red; font-weight: bold;">
                <p class="header-resume" style="color:red; font-weight: bold;">Despesas</p>
                <div class="resume-body">
                    <i class="bi bi-box-arrow-right"></i>
                    <span>&nbsp;R$</span>
                    <p class="expenses">0,00</p>
                </div>
            </div>
            
            <div class="resume-cards" style="color:green; font-weight: bold;">
                <p class="header-resume" style="color:green; font-weight: bold;">Lucro</p>
                <div class="resume-body">
                    <i class="bi bi-coin"></i>
                    <span>&nbsp;R$</span>
                    <p class="income">0,00</p>
                </div>
            </div>

            <div class="resume-cards">
                <p class="header-resume">Balanço</p>
                <div class="resume-body">
                    <i class="bi bi-bar-chart-line-fill"></i>
                    <span>&nbsp;R$</span>
                    <p class="profit">0,00</p>
                </div>
            </div>
        </div>

        <div class="table" style="overflow-x:auto;">
            <table class="table-reg">
                <thead>
                    <tr>
                        <th>DATA DO LANÇAMENTO</th>
                        <th>TIPO</th>
                        <th>SUBTIPO</th>
                        <th>DESCRIÇÃO</th>
                        <th>VALOR DE LANÇAMENTO</th>
                    </tr>
                </thead>

                <tbody class="table-info" id="table-body">
                    <?php 
                        include_once('assets/php/crud_php/read.php');
                    ?>
                    <button class="btn-more detail" id="btn-detail">
                        Relatório
                    </button>
                </tbody>

                <div class="modal-reading modal-icones" id="modal-read">
                    <div class="modal-content-read">
                        <div class="header-modal-table">
                            <h2>Detalhes dos Lançamentos</h2>
                            <span class="close-modal-read">&times;</span>
                        </div>
                        <div class="modal-read-body">
                            <p class="long-description"></p>
                        </div>
                        <div class="modal-read-footer">
                            <button class="btn-cancel close-modal-read">OK</button>
                        </div>
                    </div> 
                </div>

                <div class="modal-update modal-icones" id="modal-update">
                    <div class="modal-content-update">
                        <div class="header-modal-table">
                            <h2>Alterar Lançamento</h2>
                            <span class="close-modal-update">&times;</span>
                        </div>

                        <hr>

                        <div class="modal-update-body">
                            <form id="form-update">
                                <div class="form-body-selects">
                                    <label class="form-label" for="dateInput-update">Data do lançamento</label>
                                    <input type="date" name="date-update" id="dateInput-update" required>
                                    <small class="msgErro-update">Erro</small>
                                </div>
                                <div class="form-body">
                                    <label for="select-update">Tipo</label>
                                    <div class="select-control">
                                        <select name="select-update" id="type" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="renda">Renda</option>
                                            <option value="despesa">Despesa</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <label for="subtype-update">Sub Tipo</label>
                                    <div class="select-control">
                                        <select name="subtype-update" id="subtype" required>
                                            <option value="" disabled selected>Selecione</option>
                                            <option value="previsto">Previsto</option>
                                            <option value="extra">Extra</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-body">
                                    <label for="desc-update">Descrição Breve</label>
                                    <input type="text" name="desc-update" placeholder="Descrição breve do registro" id="desc-update" required>
                                </div>

                                <div class="form-body">
                                    <label class="form-label" for="longDesc-update">Descrição Longa</label>
                                    <input type="text" name="desc-detailed-update" id="long-desc-update" placeholder="Descrição detalhada do registro [opcional]">
                                </div>

                                <div class="form-body">
                                    <label class="form-label" for="value-update">Valor</label>
                                    <input type="text" id="value-update" name="value-update" placeholder="Digite o valor R$" max="9">
                                </div>

                                <div class="success-update">
                                    <div class="success-update-content">
                                        <p class="success-update">Registro Alterado</p>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <hr>

                        <div class="btns btns-footer">
                            <button id="button-close" class="btn-cancel close-modal-delete">Cancelar</button>
                            <button id="button-ok" class="btn-update-conf" form="form-update">Salvar</button>
                        </div>
                    </div>
                </div>

                <div class="modal-delete modal-icones" id="modal-delete">
                    <div class="modal-content-delete">
                        <div class="header-modal-table">
                            <h2>Excluir Lançamento</h2>
                            <span class="close-modal-delete">&times;</span>
                        </div>
                        <div class="modal-delete-body">
                            <p>Tem certeza que dejesa deletar este lançamento?</p>
                        </div>
                        <div class="modal-delete-footer">
                            <button class="btn-delete-conf">SIM</button>
                            <button class="btn-cancel close-modal-delete">NÃO</button>
                        </div>
                    </div>
                </div>

                <div class="modal-detail modal-icones" id="modal-detail">
                    <div class="modal-content-detail">
                        <div class="modal-header-table">
                            <h2>Relatorio</h2>
                            <span class="close-modal-detail">&times;</span>
                        </div>

                        <div class="modal-body-detail">
                            <div id="content-modal-detail"></div>
                        </div>

                        <div class="modal-footer-detail">
                            <button class="btn-cancel close-modal-detail">Fechar</button>
                            <button id="gerar-PDF">Gerar PDF</button>
                        </div>
                    </div>
                </div>

            </table>
        </div>
        
        <!--
        <div class="modal-detail">
            <div class="modal-content-detail">
                <div class="header-modal-detail">
                    <h2>Detalhamento dos Lançamentos</h2>
                    <span class="close-modal-detail">&times;</span>
                </div>
                <div class="modal-detail-body">
                    <div class="grafico">
                        <canvas id="detailing"></canvas>
                    </div>
                    <div class="resume-details">
                        <div class="details-header">Total</div>
                        <div class="cards-details">
                            <p class="header-cards-details">Despesas</p>
                            <div class="resume-cards-details">
                                <span>R$</span>
                                <p class="expense-details">0,00</p>
                            </div>
                        </div>
                        <div class="cards-details">
                            <p class="header-cards-details">Lucro</p>
                            <div class="resume-cards-details">
                                <span>R$</span>
                                <p class="profit-details">0,00</p>
                            </div>
                        </div>
                        <div class="cards-details">
                            <p class="header-cards-details">Balanço</p>
                            <div class="resume-cards-details">
                                <span>R$</span>
                                <p class="balance-details">0,00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-detail-footer">
                    <button class="close-modal-detail btn-detail">FECHAR</button>
                </div>
            </div>
        </div>
        -->
    </section>

    <script src="assets/js/index.js"></script>
    
</body>
</html>