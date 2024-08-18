<?php

class TarefaService {

    private $conexao;
    private $tarefa;

    public function __construct(Conexao $conexao, Tarefa $tarefa)
    {
        $this->conexao = $conexao->conectar();
        $this->tarefa = $tarefa;
    }

    public function create() 
    {
        $query = 'INSERT INTO tb_tarefas(tarefa)VALUES(:tarefa)';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(':tarefa', $this->tarefa->__get('tarefa'));
        $stmt->execute();
    }

    public function read()
    {
        
    }

    public function update() 
    {
        
    }

    public function delete() 
    {
        
    }
}