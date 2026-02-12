<?php
/*
 * CnabPHP - Geração de arquivos de remessa e retorno em PHP
 *
 * LICENSE: The MIT License (MIT)
 *
 * Copyright (C) 2013 Ciatec.net
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this
 * software and associated documentation files (the "Software"), to deal in the Software
 * without restriction, including without limitation the rights to use, copy, modify,
 * merge, publish, distribute, sublicense, and/or sell copies of the Software, and to
 * permit persons to whom the Software is furnished to do so, subject to the following
 * conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies
 * or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED,
 * INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A
 * PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
 * HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
 * OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE
 * SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */

namespace CnabPHP\resources\B422\remessa\cnab400;

use CnabPHP\RegistroRemAbstract;
use CnabPHP\RemessaAbstract;
use CnabPHP\resources\generico\remessa\cnab400\Generico9;

/**
 * Classe Registro9 - Trailer do arquivo CNAB 400 do Banco Safra (422)
 */
class Registro9 extends Generico9
{
    protected $meta = array(
        'tipo_registro' => array(
            'tamanho' => 1, 'default' => '9', 'tipo' => 'int', 'required' => true
        ),
        'brancos1' => array(
            'tamanho' => 367, 'default' => ' ', 'tipo' => 'alfa', 'required' => true
        ),
        'qtde_titulos' => array(
            'tamanho' => 8, 'default' => '00000000', 'tipo' => 'int', 'required' => true
        ),
        'valor_total' => array(
            'tamanho' => 15, 'default' => '000000000000000', 'tipo' => 'int', 'required' => true
        ),
        'sequencial_arquivo' => array(
            'tamanho' => 3, 'default' => '001', 'tipo' => 'int', 'required' => true
        ),
        'sequencial_registro' => array(
            'tamanho' => 6, 'default' => '000003', 'tipo' => 'int', 'required' => true
        ),
    );

    public function __construct($data = null)
    {
        parent::__construct($data);
    }

    /**
     * Override getText para calcular totalizadores antes da geração
     */
    public function getText()
    {
        $this->set_qtde_titulos(null);
        $this->set_valor_total(null);
        $this->set_sequencial_arquivo(null);
        $this->set_sequencial_registro(null);

        return parent::getText();
    }

    protected function set_qtde_titulos($value)
    {
        $lote = RemessaAbstract::getLote(0);
        $qtde = 0;

        if ($lote && isset($lote->children) && is_array($lote->children)) {
            foreach ($lote->children as $registro) {
                if (isset($registro->data['tipo_registro']) && $registro->data['tipo_registro'] == '1') {
                    $qtde++;
                }
            }
        }

        $this->data['qtde_titulos'] = str_pad($qtde, 8, '0', STR_PAD_LEFT);
    }

    protected function set_valor_total($value)
    {
        $lote = RemessaAbstract::getLote(0);
        $total = 0;

        if ($lote && isset($lote->children) && is_array($lote->children)) {
            foreach ($lote->children as $registro) {
                if (isset($registro->data['tipo_registro']) && $registro->data['tipo_registro'] == '1') {
                    $valor = isset($registro->data['valor']) ? (int)$registro->data['valor'] : 0;
                    $total += $valor;
                }
            }
        }

        $this->data['valor_total'] = str_pad($total, 15, '0', STR_PAD_LEFT);
    }

    protected function set_sequencial_registro($value)
    {
        $lote = RemessaAbstract::getLote(0);
        $sequencial = 1;

        if ($lote && isset($lote->children)) {
            foreach ($lote->children as $child) {
                if (isset($child->data['tipo_registro']) && $child->data['tipo_registro'] == '1') {
                    $sequencial++;
                }
            }
        }

        $sequencial++;
        $this->data['sequencial_registro'] = str_pad($sequencial, 6, '0', STR_PAD_LEFT);
    }

    protected function set_sequencial_arquivo($value)
    {
        $lote = RemessaAbstract::getLote(0);
        if ($lote && isset($lote->data['numero_sequencial_arquivo'])) {
            $this->data['sequencial_arquivo'] = substr($lote->data['numero_sequencial_arquivo'], 0, 3);
        } else {
            $this->data['sequencial_arquivo'] = '001';
        }
    }
}
