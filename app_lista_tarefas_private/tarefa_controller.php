<?php

require "../app_lista_tarefas_private/tarefa.model.php";
require "../app_lista_tarefas_private/tarefa.service.php";
require "../app_lista_tarefas_private/conexao.php";

$tarefa = new Tarefa();
$tarefa->__set('tarefa', $_POST['tarefa']);

$conexao = new Conexao();

$tarefaService = new TarefaService($conexao, $tarefa);
$tarefaService->create();

header('Location: nova_tarefa.php?inclusao=1');

