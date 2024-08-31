<?php

class TarefaService
{

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
        $query = 
        'SELECT 
            t.id, s.status, t.tarefa
         FROM
           tb_tarefas AS t
         LEFT JOIN tb_status s ON t.id_status = s.id';
         
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function update() {

        $query = 'UPDATE tb_tarefas SET tarefa = ? WHERE id = ?';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindValue(1, $this->tarefa->__get('tarefa'));
        $stmt->bindValue(2, $this->tarefa->__get('id'));
        return $stmt->execute();
    }

    public function delete() {
        $query = 'DELETE FROM tb_tarefas WHERE id = ?';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id'));
		$stmt->execute();
    }

    public function marcarRealizada() { 

		$query = "UPDATE tb_tarefas SET id_status = ? WHERE id = ?";
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(1, $this->tarefa->__get('id_status'));
		$stmt->bindValue(2, $this->tarefa->__get('id'));
		return $stmt->execute(); 
	}

    public function recuperarTarefasPendentes() {
		$query = '
			SELECT 
				t.id, s.status, t.tarefa 
			FROM 
				tb_tarefas as t
				left join tb_status as s on (t.id_status = s.id)
			WHERE
				t.id_status = :id_status
		';
		$stmt = $this->conexao->prepare($query);
		$stmt->bindValue(':id_status', $this->tarefa->__get('id_status'));
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
}
