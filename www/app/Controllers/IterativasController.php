<?php

declare(strict_types=1);

namespace Com\Daw2\Controllers;

use Com\Daw2\Core\BaseController;

class IterativasController extends BaseController
{
    public function iterativas3(array $input = [], array $errors = []): void
    {
        $data = array(
            'titulo' => 'Iterativas 3',
            'breadcrumb' => ['Inicio', 'Iterativas', 'Iterativas 3'],
            'errors' => $errors,
            'input' => $input
        );
        $this->view->showViews(
            array('templates/header.view.php', 'iterativas3.view.php', 'templates/footer.view.php'),
            $data
        );
    }

    public function doIterativas3(): void
    {
        $errors = $this->checkErrorsIterativas3($_POST);
        $input = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($errors !== []) {
            $this->iterativas3($input, $errors);
        } else {
            $input['resultado'] = $this->resultadoIterativas3($input['matriz']);
            $this->iterativas3($input);
        }
    }

    private function checkErrorsIterativas3(array $data): array
    {
        $errors = array();
        if (empty($data['matriz'])) {
            $errors['matriz'] = 'Inserte una matriz';
        } else {
            $tmp = explode('|', $data['matriz']);
            $procesada = array();
            foreach ($tmp as $item) {
                $procesada[] = explode(',', $item);
            }
            //Comprobamos si son números todos los elementos de la matriz
            $noNumeros = [];
            foreach ($procesada as $lista) {
                foreach ($lista as $num) {
                    if (!is_numeric($num)) {
                        $noNumeros[] = $num;
                    }
                }
            }
            if ($noNumeros !== []) {
                $noNumeros = filter_var_array($noNumeros, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $errors['matriz'] = 'Los siguientes elementos no son números: ' . implode(', ', $noNumeros);
            } else {
                //Comprobamos si todas las filas de la matriz tienen el mismo tamaño
                $tamanoInicial = count($procesada[0]);
                $errorTamano = false;
                $i = 1;
                while ($i < count($procesada) && !$errorTamano) {
                    $errorTamano = count($procesada[$i]) !== $tamanoInicial;
                    $i++;
                }
                if ($errorTamano) {
                    $errors['matriz'] = 'Las filas no tienen el mismo tamaño';
                }
            }
        }
        return $errors;
    }

    ///\p{L}/u Letras regexp

    private function resultadoIterativas3(string $matriz): string
    {
        $arr_s = explode('|', $matriz);
        $m_tmp = array();
        foreach ($arr_s as $item) {
            $m_tmp[] = explode(',', $item);
        }
        $filas_count = count($m_tmp[0]);
        $tmp = array_merge(...$m_tmp);
        sort($tmp);
        $a_anidado = array_chunk($tmp, $filas_count);
        $a_ordenado = array();
        for ($i = 0; $i < count($a_anidado); $i++) {
            $a_ordenado[$i] = implode(',', $a_anidado[$i]);
        }
        return implode('|', $a_ordenado);
    }

    /**
     * Ejercicio 4
     * @param array $input
     * @param array $errors
     * @return void
     * @throws \Exception
     */
    public function iterativas4(array $input = [], array $errors = []): void
    {
        $data = array(
            'titulo' => 'Iterativas 4',
            'breadcrumb' => ['Inicio', 'Iterativas', 'Iterativas 4'],
            'errors' => $errors,
            'input' => $input
        );
        $this->view->showViews(
            array('templates/header.view.php', 'iterativas4.view.php', 'templates/footer.view.php'),
            $data
        );
    }

    public function doIterativas4(): void
    {
        $errors = $this->checkErrorsIterativas4($_POST);
        $input = filter_var_array($_POST, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if ($errors !== []) {
            $this->iterativas4($input, $errors);
        } else {
            $input['resultado'] = $this->resultadoIterativas4($_POST['texto']);
            $this->iterativas4($input);
        }
    }

    private function resultadoIterativas4(mixed $texto)
    {
        $clean_text = mb_strtolower(preg_replace('/\P{L}/u', '', $texto));
        $txt_arr = mb_str_split($clean_text);
        $resultado_arr = [];
        foreach ($txt_arr as $letter) {
            if (isset($resultado_arr[$letter])) {
                $resultado_arr[$letter]++;
            } else {
                $resultado_arr[$letter] = 1;
            }
        }
        $resultado = "";
        foreach ($resultado_arr as $letter => $value) {
            $resultado .= $letter . "=>" . $value . ", ";
        }
        return "Las letras son: " . rtrim($resultado, ", ");
    }

    private function checkErrorsIterativas4(array $data): array
    {
        $errors = array();
        if ($data['texto'] === '') {
            $errors['texto'] = 'Inserte un texto';
        } else {
            $texto = preg_replace('/\P{L}/u', '', $data['texto']);
            if ($texto === '') {
                $errors['texto'] = 'El texto no contiene ninguna letras';
            }
        }

        return $errors;
    }
}
