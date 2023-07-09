<?php 

namespace src\reports;

use src\reports\RelatoriosDao;
use src\interfaces\RelatoriosDaoInterface;


class RelatoriosDaoMySql implements RelatoriosDaoInterface
{
    private $pdo;

    public function __construct(\PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function gerarRelatorioAtestados($idCurso, $idTurma, $dataCadastrada, $dataCadastradaLimite)
    {
        
        $sql = $this->pdo->prepare(
                "SELECT 
                    p.nome AS 'nome', 
                    a.motivo AS 'motivo', 
                    c.nome AS 'curso', 
                    t.nome AS 'turma', 
                    a.data_inicio AS 'data_inicio', 
                    a.data_final AS 'data_final'
                FROM atestados AS a
                    LEFT JOIN pacientes AS p
                        ON a.id_paciente = p.id
                    LEFT JOIN cursos AS c
                        ON p.id_curso = c.id
                    LEFT JOIN turmas AS t
                        ON p.id_turma = t.id
                        WHERE p.id_curso = :id_curso 
                            AND p.id_turma = :id_turma
                            AND a.data_cadastrada
                            BETWEEN :data_cadastrada AND :data_cadastrada_limite
                            ORDER BY a.data_cadastrada DESC 
                            LIMIT 20");
        $sql->bindValue(':id_curso', $idCurso);
        $sql->bindValue(':id_turma', $idTurma);
        $sql->bindValue(':data_cadastrada', $dataCadastrada);
        $sql->bindValue(':data_cadastrada_limite', $dataCadastradaLimite);
        $sql->execute();

        if($sql->rowCount() > 0){
            $relatorioAtestados = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $relatorioAtestados;
        } else {
            $_SESSION['flash'] = '<div class="alert alert-danger" role="alert">
                                    Nenhum registro com as condições solicitadas foi encontrado.
                                  </div>';
            return [];
        }

    }

    public function gerarRelatorioVacinas($idCurso, $idTurma)
    {
        $queryVacina = "SELECT 
        v.nome_vacina AS 'VACINA',
        pv.dose AS 'DOSE', 
        pv.data_vacina 'DATA_VACINACAO',
        p.nome AS 'PACIENTE',
        p.matricula AS 'MATRICULA',
        c.nome AS 'CURSO',
        t.nome AS 'TURMA'
        FROM pacientes_vacinas AS pv
            INNER JOIN vacinas AS v
                ON pv.id_vacina = v.id
            INNER JOIN pacientes AS p
                ON pv.id_paciente = p.id
            INNER JOIN cursos AS c
                ON p.id_curso = c.id
            INNER JOIN turmas AS t
                ON p.id_turma = t.id
            WHERE p.id_curso = :id_curso
                AND p.id_turma = :id_turma
                ORDER BY p.nome ASC";
        $sql = $this->pdo->prepare($queryVacina);
        $sql->bindValue(':id_curso', $idCurso);
        $sql->bindValue(':id_turma', $idTurma);
        $sql->execute();

        if($sql->rowCount() > 0){
            $relatorioVacinas = $sql->fetchAll(\PDO::FETCH_ASSOC);
            return $relatorioVacinas;
        } else {
            $_SESSION['flash'] = '<div class="alert alert-danger" role="alert">
                                    Nenhum registro com as condições solicitadas foi encontrado.
                                  </div>';
            return [];
        }
    }

}