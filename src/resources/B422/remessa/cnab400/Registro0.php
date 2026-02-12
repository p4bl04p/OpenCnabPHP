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

use CnabPHP\resources\generico\remessa\cnab400\Generico0;

/**
 * Classe Registro0 - Header do arquivo de remessa CNAB 400 do Banco Safra (422)
 *
 * Layout baseado na documentação oficial do Banco Safra
 */
class Registro0 extends Generico0
{
    protected $meta = array(
        'tipo_registro' => array( // Pos: 001-001
            'tamanho' => 1, 'default' => '0', 'tipo' => 'int', 'required' => true
        ),
        'operacao' => array( // Pos: 002-002
            'tamanho' => 1, 'default' => '1', 'tipo' => 'int', 'required' => true
        ),
        'literal_remessa' => array( // Pos: 003-009
            'tamanho' => 7, 'default' => 'REMESSA', 'tipo' => 'alfa', 'required' => true
        ),
        'tipo_servico' => array( // Pos: 010-011
            'tamanho' => 2, 'default' => '01', 'tipo' => 'int', 'required' => true
        ),
        'literal_servico' => array( // Pos: 012-019
            'tamanho' => 8, 'default' => 'COBRANCA', 'tipo' => 'alfa', 'required' => true
        ),
        'brancos1' => array( // Pos: 020-026 (7 brancos)
            'tamanho' => 7, 'default' => ' ', 'tipo' => 'alfa', 'required' => false
        ),
        'codigo_cedente' => array( // Pos: 027-040 (AGÊNCIA 5 + CONTA 9 = 14)
            'tamanho' => 14, 'default' => '', 'tipo' => 'int', 'required' => true
        ),
        'brancos2' => array( // Pos: 041-046 (6 brancos)
            'tamanho' => 6, 'default' => ' ', 'tipo' => 'alfa', 'required' => false
        ),
        'nome_empresa' => array( // Pos: 047-076
            'tamanho' => 30, 'default' => '', 'tipo' => 'alfa', 'required' => true
        ),
        'codigo_banco' => array( // Pos: 077-079
            'tamanho' => 3, 'default' => '422', 'tipo' => 'int', 'required' => true
        ),
        'nome_banco' => array( // Pos: 080-090
            'tamanho' => 11, 'default' => 'BANCO SAFRA', 'tipo' => 'alfa', 'required' => true
        ),
        'brancos3' => array( // Pos: 091-094 (4 brancos)
            'tamanho' => 4, 'default' => ' ', 'tipo' => 'alfa', 'required' => false
        ),
        'data_gravacao' => array( // Pos: 095-100 (DDMMAA)
            'tamanho' => 6, 'default' => '', 'tipo' => 'date', 'required' => true
        ),
        'brancos4' => array( // Pos: 101-391 (291 brancos)
            'tamanho' => 291, 'default' => ' ', 'tipo' => 'alfa', 'required' => false
        ),
        'numero_sequencial_arquivo' => array( // Pos: 392-394
            'tamanho' => 3, 'default' => '001', 'tipo' => 'int', 'required' => true
        ),
        'sequencial_registro' => array( // Pos: 395-400
            'tamanho' => 6, 'default' => '000001', 'tipo' => 'int', 'required' => true
        ),
    );

    protected function set_codigo_banco($value) {
        $this->data['codigo_banco'] = '422';
    }

    protected function set_nome_banco($value) {
        $this->data['nome_banco'] = 'BANCO SAFRA';
    }

    protected function set_data_gravacao($value) {
        $this->data['data_gravacao'] = date('dmy');
    }

    protected function set_numero_sequencial_arquivo($value) {
        $valor = str_pad($value, 3, '0', STR_PAD_LEFT);
        $this->data['numero_sequencial_arquivo'] = substr($valor, 0, 3);
    }

    protected function set_sequencial_registro($value) {
        $this->data['sequencial_registro'] = '000001';
    }
}
