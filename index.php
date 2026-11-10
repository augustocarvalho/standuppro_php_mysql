<?php
require_once "config.php";
$titulo = "StandupPRO";
require_once "menu.php";
?>

<style>
    body {
        background-color: #f4f7fa;
    }
    .home {
        margin-top: 60px;
    }
    .home-hero {
        background: #ffffff;
        border: 1px solid #e1e6ec;
        border-radius: 8px;
        padding: 45px 40px;
        text-align: center;
    }
    .home-hero h1 {
        font-size: 42px;
        line-height: 1.1;
        margin-bottom: 15px;
    }
    .home-hero .lead {
        max-width: 720px;
        margin: 0 auto 20px;
        font-size: 16px;
        line-height: 24px;
        color: #5a6470;
    }
    .home-footer {
        padding: 25px 0 35px;
        color: #8a94a0;
        text-align: center;
    }
</style>

<div class="container home">
    <div class="home-hero">
        <h1>StandupPRO</h1>
        <p class="lead">
            Sistema para gerenciar eventos de standup paddle: cadastre atletas, inscreva-os nas etapas,
            registre os tempos de chegada, apure os resultados e gere o ranking.
        </p>
        <a class="btn btn-large btn-primary" href="listar_atleta.php">Começar</a>
    </div>

    <div class="home-footer">
        StandupPRO &middot; Desenvolvido por Augusto Carvalho
    </div>
</div>
