<?php

    class HomeController
    {
        public function index()
        {
            try
            {
                try
                {
                    $collecEmpresas = Empresa::selectAll();
                    $collecParticipantes = Participante::selectAll();
                }
                catch (Exception $e)
                {
                    echo $e->getMessage();
                }

                $loader = new \Twig\Loader\FilesystemLoader('app/View');
                $twig = new \Twig\Environment($loader);
                $template = $twig->load('home.html');

                $parameters = array();

                $parameters['empresas'] = $collecEmpresas;
                $parameters['participantes'] = $collecParticipantes;
                
                $content = $template->render($parameters);
                
                echo $content;
            }
            catch (Exception $e)
            {
                echo $e->getMessage();
            }
        }
    }