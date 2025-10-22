<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class IterativasController extends BaseController
{
    public function ejercicio3(): void
    {
        $data = array(
            'titulo' => 'Ejercicio 3',
            'breadcrumb' => ['Inicio', 'Iterativas', 'Ejercicio 3']
        );
        $this->view->
        showViews(array('templates/header.view.php', 'iterativas3.view.php', 'templates/footer.view.php'), $data);
    }

    public function doEjercicio3(): void
    {
        $erors = $this->checkErrorsEjercicio3($_POST);
    }

    public function checkErrorsEjercicio3(array $arr): array
    {
        $errores = array();
        if (empty($arr['matriz'])) {
            $errores['matriz'] = "Campo Matriz obligatorio";
        } else {
            $tmp = explode('|', $arr['matriz']);
            $procesada = array();
            foreach ($tmp as $item) {
                $procesada[] = explode(',', $item);
            }
            var_dump($procesada);
            //Comprobamos que todos los elementos son numeros
            $num_errors = array();
            foreach ($procesada as $item) {
                foreach ($item as $i) {
                    if (!is_numeric($i)) {
                        $num_errors[] = $i;
                    }
                }
            }
            if ($num_errors !== []) {
                $errores['matriz'] = "Los siguientes valores no son números" . implode(",", $num_errors);
            } else {
            //Comprobamos que todas las filas sean del mismo tamaño
                $tamanoInicial = count($procesada[0]);
                $errorTamano = false;
                $i = 1;
                while ($i < count($procesada) && !$errorTamano) {
                    $errorTamano = count($procesada[$i]) !== $tamanoInicial;
                }
                if ($errorTamano) {
                    $errores['matriz'] = "Las filas no son iguales";
                }
            }
        }
        return $errores;
    }
}
