<?php

    class Core
    {
        public function start($urlGet)
        {
            if (isset($urlGet['method'])) {
                $action = $urlGet['method'];
            }
            else
            {
                $action = 'index';
            }

            if (isset($urlGet['page']))
            {
                $controller = ucfirst($urlGet['page'].'Controller');
            }
            else
            {
                $controller = 'HomeController';
            }

            if (!class_exists($controller))
            {
                $controller = 'ErrorController';
            }

			if (isset($urlGet['cnpj']) && ($urlGet['cnpj'] != null))
            {
				$id = $urlGet['cnpj'];
			}
            else if (isset($urlGet['cpf']) && ($urlGet['cpf'] != null))
            {
				$id = $urlGet['cpf'];
			}
            else
            {
                $id = null;
            }

            call_user_func_array(array(new $controller, $action), array('id' => $id));
        }
    }