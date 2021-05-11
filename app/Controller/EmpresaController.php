<?php

    class EmpresaController
    {
        public function index($params)
        {
            try
            {
                $empresa = Empresa::selectById($params);
                
                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('singleEmpresa.html');

                $parameters = array();
                $parameters['razao_social'] = $empresa->razao_social;
                $parameters['cnpj'] = $empresa->cnpj;
                
                $content = $template->render($parameters);
                
                echo $content;
            }
            catch(Exception $e)
            {
                echo $e->getMessage();
            }
        }

        public function create()
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('createEmpresa.html');

            $content = $template->render();
            
            echo $content;
        }

        public function insert()
        {
            try
            {
                Empresa::insert($_POST);

                echo '<script>alert("Cadastro realizado com sucesso!");</script>';
                echo '<script>location.href="/"</script>';
            }
            catch(Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="?page=empresa&method=create"</script>';
            }
        }

        public function change($paramId)
        {
            $loader = new \Twig\Loader\FilesystemLoader('app/View');
            $twig = new \Twig\Environment($loader);
            $template = $twig->load('changeEmpresa.html');

            $empresa = Empresa::selectById($paramId);

            $parameters = array();
            $parameters['cnpj'] = $empresa->cnpj;
            $parameters['razao_social'] = $empresa->razao_social;

            $content = $template->render($parameters);
            
            echo $content;
        }

        public function update()
        {
            try
            {
                Empresa::update($_POST);

                echo '<script>alert("Alteração realizada com sucesso!");</script>';
                echo '<script>location.href="/"</script>';
            }
            catch(Exception $e)
            {
                echo '<script>alert("'.$e->getMessage().'");</script>';
                echo '<script>location.href="/"</script>';
            }
        }

        public function delete($paramId)
        {
            try
            {
                Empresa::delete($paramId);

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