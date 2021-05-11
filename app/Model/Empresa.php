<?php

    class Empresa
    {
        public static function selectAll()
        {
            $connection = Connection::getConnection(); 

            $sql = "SELECT * FROM empresas";
            $sql = $connection->prepare($sql);
            $sql->execute();

            $result = array();

            while ($row = $sql->fetchObject('Empresa'))
            {
                $result[] = $row;
            }

            if (!$result)
            {
                throw new Exception("Não foi encontrado nenhum registro de empresa.");
            }
            
            return $result;
        }

        public static function selectById($idEmpresa)
        {
            $connection = Connection::getConnection();

            $sql = "SELECT * FROM empresas WHERE cnpj = :d1";
            $sql = $connection->prepare($sql);
			$sql->bindValue(':d1', $idEmpresa, PDO::PARAM_STR);
            $sql->execute();

            $result = $sql->fetchObject('Empresa');

            if (!$result)
            {
                throw new Exception("Não foi encontrado nenhum registro.");
            }

            return $result;
        }

        public static function insert($dataPost)
        {
            if (empty($dataPost['cnpj']) || empty($dataPost['razao_social']))
            {
                throw new Exception("Preencha todos os campos.");

                return false;
            }

            $connection = Connection::getConnection();

            $sql = "INSERT INTO empresas (cnpj, razao_social) VALUES (:d1, :d2)";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':d1', $dataPost['cnpj']);
            $sql->bindValue(':d2', $dataPost['razao_social']);
            $result = $sql->execute();

            if ($result == 0)
            {
                throw new Exception("Falha ao cadastrar empresa.");

                return false;
            }

            return 1;
        }

        public static function update($params)
        {
            $connection = Connection::getConnection();

            $sql = "UPDATE empresas SET cnpj = :d1, razao_social = :d2 WHERE cnpj = :d3";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':d1', $params['cnpj']);
            $sql->bindValue(':d2', $params['razao_social']);
            $sql->bindValue(':d3', $params['id']);
            $result = $sql->execute();

            if ($result == 0)
            {
                throw new Exception("Falha ao alterar dados da empresa.");

                return false;
            }

            return 1;
        }

        public static function delete($id)
        {
            $connection = Connection::getConnection();

            $sql = "DELETE FROM empresas WHERE cnpj = :d1";
            $sql = $connection->prepare($sql);
            $sql->bindValue(':d1', $id);
            $result = $sql->execute();

            if ($result == 0)
            {
                throw new Exception("Falha ao deletar dados da empresa.");

                return false;
            }

            return 1;
        }
    }