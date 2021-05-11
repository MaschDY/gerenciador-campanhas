<?php

    class Participante
    {
        public static function selectAll()
        {
            $connection = Connection::getConnection(); 

            $sql = "SELECT * FROM participantes";
            $sql = $connection->prepare($sql);
            $sql->execute();

            $result = array();

            while ($row = $sql->fetchObject('Participante'))
            {
                $result[] = $row;
            }

            if (!$result)
            {
                throw new Exception("Não foi encontrado nenhum registro de participante.");
            }
            
            return $result;
        }

        public static function selectById($idParticipante)
        {
            $connection = Connection::getConnection();

            $sql = "SELECT * FROM participantes WHERE cpf = :id";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':id', $idParticipante, PDO::PARAM_STR);
            $sql->execute();

            $result = $sql->fetchObject('Participante');

            if (!$result)
            {
                throw new Exception("Não foi encontrado nenhum registro.");
            }

            return $result;
        }

        public static function insert($dataPost)
        {
            if (empty($dataPost['cpf']) || empty($dataPost['nome']) || empty($dataPost['email']) || empty($dataPost['data_nascimento']) || empty($dataPost['empresa_cnpj']))
            {
                throw new Exception("Preencha todos os campos.");

                return false;
            }

            $connection = Connection::getConnection();

            $sql = "INSERT INTO participantes (cpf, nome, email, data_nascimento, empresa_cnpj) VALUES (:d1, :d2, :d3, :d4, :d5)";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':d1', $dataPost['cpf']);
            $sql->bindValue(':d2', $dataPost['nome']);
            $sql->bindValue(':d3', $dataPost['email']);
            $sql->bindValue(':d4', $dataPost['data_nascimento']);
            $sql->bindValue(':d5', $dataPost['empresa_cnpj']);
            $result = $sql->execute();

            if ($result == 0)
            {
                throw new Exception("Falha ao cadastrar participante.");

                return false;
            }

            return 1;
        }

        public static function update($params)
        {
            $connection = Connection::getConnection();

            $sql = "UPDATE participantes SET cpf = :d1, nome = :d2, email = :d3, data_nascimento = :d4, empresa_cnpj = :d5 WHERE cpf = :d6";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':d1', $params['cpf']);
            $sql->bindValue(':d2', $params['nome']);
            $sql->bindValue(':d3', $params['email']);
            $sql->bindValue(':d4', $params['data_nascimento']);
            $sql->bindValue(':d5', $params['empresa_cnpj']);
            $sql->bindValue(':d6', $params['id']);
            $result = $sql->execute();

            if ($result == 0)
            {
                throw new Exception("Falha ao alterar dados do participante.");

                return false;
            }

            return 1;
        }

        public static function delete($id)
        {
            $connection = Connection::getConnection();

            $sql = "DELETE FROM participantes WHERE cpf = :d1";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':d1', $id);
            $result = $sql->execute();

            if ($result == 0)
            {
                throw new Exception("Falha ao deletar dados do participante.");

                return false;
            }

            return 1;
        }
    }
    