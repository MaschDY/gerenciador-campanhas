<?php

    class ParticipanteController
    {
        public function index($params)
        {
            try
            {
                $participante = Participante::selectById($params);

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('singleParticipante.html');

                $parameters = array();
                $parameters['nome'] = $participante->nome;
                $parameters['cpf'] = $participante->cpf;
                $parameters['email'] = $participante->email;
                $parameters['data_nascimento'] = $participante->data_nascimento;
                $parameters['empresa_cnpj'] = $participante->empresa_cnpj;
                
                $content = $template->render($parameters);
                
                echo $content;
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function create()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('createParticipante.html');

            $content = $template->render();
            
            echo $content;
        }

        public function insert()
        {
            try
            {
                Participante::insert($_POST);

                echo '<script>alert("Cadastro realizado com sucesso!");</script>';
                echo '<script>location.href="/"</script>';
            }
            catch(Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=participante&method=create"</script>';
            }
        }

        public function change($paramId)
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('changeParticipante.html');

            $participante = Participante::selectById($paramId);

            $parameters = array();
            $parameters['cpf'] = $participante->cpf;
            $parameters['nome'] = $participante->nome;
            $parameters['email'] = $participante->email;
            $parameters['data_nascimento'] = $participante->data_nascimento;
            $parameters['empresa_cnpj'] = $participante->empresa_cnpj;

            $content = $template->render($parameters);
            
            echo $content;
        }

        public function update()
        {
            try
            {
                Participante::update($_POST);

                echo '<script>alert("Alteração realizada com sucesso!");</script>';
                echo '<script>location.href="/"</script>';
            }
            catch(Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=participante&method=change&cpf='.$_POST['id'].'"</script>';
            }
        }

        public function delete($paramId)
        {
            try
            {
                Participante::delete($paramId);

                echo '<script>alert("Deleção realizada com sucesso!");</script>';
                echo '<script>location.href="/"</script>';
            }
            catch(Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="/"</script>';
            }
        }
    }