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
use CnabPHP\resources\generico\remessa\cnab400\Generico1;

/**
 * Classe Registro1 - Detalhe do título CNAB 400 do Banco Safra (422)
 *
 * Layout baseado na documentação oficial do Banco Safra
 */
class Registro1 extends Generico1
{
    protected $meta = array(
        'tipo_registro' => array( // 001-001
            'tamanho' => 1, 'default' => '1', 'tipo' => 'int', 'required' => true
        ),
        'tipo_inscricao' => array( // 002-003
            'tamanho' => 2, 'default' => '', 'tipo' => 'int', 'required' => true
        ),
        'numero_inscricao' => array( // 004-017
            'tamanho' => 14, 'default' => '', 'tipo' => 'int', 'required' => true
        ),
        'empresa_banco' => array( // 018-031
            'tamanho' => 14, 'default' => '', 'tipo' => 'alfa', 'required' => true
        ),
        'filler1' => array( // 032-037
            'tamanho' => 6, 'default' => ' ', 'tipo' => 'alfa', 'required' => true
        ),
        'uso_empresa' => array( // 038-062
            'tamanho' => 25, 'default' => ' ', 'tipo' => 'alfa', 'required' => true
        ),
        'nosso_numero' => array( // 063-071
            'tamanho' => 9, 'default' => '000000000', 'tipo' => 'int', 'required' => true
        ),
        'brancos_pos072_101' => array(
            'tamanho' => 30, 'default' => ' ', 'tipo' => 'alfa', 'required' => true
        ),
        'codigo_iof' => array( // 102-102
            'tamanho' => 1, 'default' => '0', 'tipo' => 'int', 'required' => true
        ),
        'identificacao_moeda' => array( // 103-104
            'tamanho' => 2, 'default' => '00', 'tipo' => 'int', 'required' => true
        ),
        'brancos_pos105' => array( // 105-105
            'tamanho' => 1, 'default' => ' ', 'tipo' => 'alfa', 'required' => true
        ),
        'terceira_instrucao' => array( // 106-107
            'tamanho' => 2, 'default' => '00', 'tipo' => 'int', 'required' => true
        ),
        'identificacao_carteira' => array( // Posição 108 (1=Simples, 2=Vinculada)
            'tamanho' => 1,
            'default' => '1',
            'tipo' => 'int',
            'required' => true
        ),
        'identificacao_ocorrencia' => array( // Posições 109-110
            'tamanho' => 2,
            'default' => '01',     // 01 = entrada de títulos
            'tipo' => 'int',
            'required' => true
        ),
        'identificacao_titulo_empresa' => array( // 111-120 Seu número
            'tamanho' => 10,
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'data_vencimento' => array( // 121-126
            'tamanho' => 6,
            'default' => '',
            'tipo' => 'alfa',
            'required' => true
        ),
        'valor' => array(          // 127-139 13 dígitos (valor em centavos)
            'tamanho' => 13,
            'default' => '0',
            'tipo' => 'int',       // Usar int em vez de decimal para controlar tamanho
            'required' => true
        ),
        'codigo_banco_cobrador' => array( //140-147 Posições 140-142
            'tamanho' => 3,
            'default' => '422',
            'tipo' => 'int',
            'required' => true
        ),
        'agencia_cobradora' => array( // Posições 143-147
            'tamanho' => 5,
            'default' => '0',
            'tipo' => 'int',
            'required' => true
        ),
        'especie_titulo' => array( // Posições 148-149
            'tamanho' => 2,
            'default' => '01',     // 01=Duplicata Mercantil
            'tipo' => 'int',
            'required' => true
        ),
        'aceite' => array(         // Posição 150
            'tamanho' => 1,
            'default' => 'N',
            'tipo' => 'alfa',
            'required' => true
        ),
        'data_emissao' => array(   // Posições 151-156
            'tamanho' => 6,
            'default' => '',
            'tipo' => 'alfa',
            'required' => true
        ),
        'primeira_instrucao' => array( // Posições 157-158
            'tamanho' => 2,
            'default' => '00',
            'tipo' => 'int',
            'required' => true
        ),
        'segunda_instrucao' => array( // Posições 159-160
            'tamanho' => 2,
            'default' => '00',
            'tipo' => 'int',
            'required' => true
        ),
        'juros_mora_dia' => array( // 13 dígitos
            'tamanho' => 13,
            'default' => '0',
            'tipo' => 'int',
            'required' => true
        ),
        'data_limite_desconto' => array( // Posições 174-179
            'tamanho' => 6,
            'default' => '000000',
            'tipo' => 'alfa',
            'required' => true
        ),
        'valor_desconto' => array( // Posições 180-192 (13 dígitos)
            'tamanho' => 13,
            'default' => '0',
            'tipo' => 'int',
            'required' => true
        ),
        'valor_iof' => array(      // Posições 193-205 (13 dígitos)
            'tamanho' => 13,
            'default' => '0',
            'tipo' => 'int',
            'required' => true
        ),
        'valor_abatimento_multas' => array( // Posições 206-218 (13 dígitos)
            'tamanho' => 13,
            'default' => '0',
            'tipo' => 'int',
            'required' => true
        ),
        'tipo_inscricao_pagador' => array( // Posições 219-220
            'tamanho' => 2,
            'default' => '',
            'tipo' => 'int',
            'required' => true
        ),
        'numero_inscricao_pagador' => array( // Posições 221-234 (14 dígitos)
            'tamanho' => 14,
            'default' => '',
            'tipo' => 'int',
            'required' => true
        ),
        'nome_pagador' => array(   // Posições 235-274 (40 chars)
            'tamanho' => 40,
            'default' => '',
            'tipo' => 'alfa',
            'required' => true
        ),
        'endereco_pagador' => array( // Posições 275-314
            'tamanho' => 40,
            'default' => '',
            'tipo' => 'alfa',
            'required' => true
        ),
        'bairro_pagador' => array( // Posições 315-324
            'tamanho' => 10,
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'filler4' => array(        // Posições 325-326
            'tamanho' => 2,
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'cep_pagador' => array(    // Posições 327-334
            'tamanho' => 8,
            'default' => '',
            'tipo' => 'int',
            'required' => true
        ),
        'cidade_pagador' => array( // Posições 335-349
            'tamanho' => 15,
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'uf_pagador' => array(     // Posições 350-351
            'tamanho' => 2,
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'nome_sacador_avalista' => array( // Posições 352-381
            'tamanho' => 30,
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'filler5' => array(        // Posições 382-386
            'tamanho' => 6,    // Ajustado para totalizar 400 chars
            'default' => ' ',
            'tipo' => 'alfa',
            'required' => true
        ),
        'indicador_tipo_desconto' => array(  // Posições 387-388
            'tamanho' => 1,
            'default' => '0',
            'tipo' => 'alfa',
            'required' => true
        ),
        'banco_emitente' => array( // Posições 389-391
            'tamanho' => 3,
            'default' => '422',
            'tipo' => 'int',
            'required' => true
        ),
        'sequencial_arquivo' => array( // Posições 392-394
            'tamanho' => 3,
            'default' => '001',
            'tipo' => 'int',
            'required' => true
        ),
        'sequencial_registro' => array( // Posições 395-400
            'tamanho' => 6,
            'default' => '000002',
            'tipo' => 'int',
            'required' => true
        ),
    );

    public function __construct($data = null)
    {
        parent::__construct($data);
        $this->set_numero_sequencial(null);
    }

    protected function set_codigo_banco_cobrador($value) {
        $this->data['codigo_banco_cobrador'] = '422';
    }

    protected function set_banco_emitente($value) {
        $this->data['banco_emitente'] = '422';
    }

    protected function set_identificacao_carteira($value)
    {
        $value = strval($value);
        if (!in_array($value, ['1', '2'])) {
            $value = '1';
        }

        $this->data['identificacao_carteira'] = $value;
    }

    protected function set_indicador_tipo_desconto($value)
    {
        $validos = ['0', '1', '2', '3', '5'];
        $value = strval($value);

        if (!in_array($value, $validos)) {
            $value = '0';
        }

        $this->data['indicador_tipo_desconto'] = $value;
    }

    protected function set_data_emissao($value) {
        if ($value instanceof \DateTime) {
            $this->data['data_emissao'] = $value->format('dmy');

            return;
        }

        if (empty($value)) {
            if (isset($this->data['data_vencimento'])) {
                $this->data['data_emissao'] = $this->data['data_vencimento'];
                return;
            }
        }

        if (is_string($value) && preg_match('/^\d{6}$/', $value)) {
            $this->data['data_emissao'] = $value;
            return;
        }

        if (is_string($value)) {
            try {
                $date = new \DateTime($value);
                $this->data['data_emissao'] = $date->format('dmy');
                return;
            } catch (\Exception $e) {}
        }
    }

    protected function set_data_vencimento($value) {
        if (is_string($value) && preg_match('/^\d{6}$/', $value)) {
            $this->data['data_vencimento'] = $value;
            return;
        }

        if ($value instanceof \DateTime) {
            $this->data['data_vencimento'] = $value->format('dmy');
            return;
        }

        if (is_string($value) && preg_match('/^\d{2}\/\d{2}\/\d{4}/', $value)) {
            $date = \DateTime::createFromFormat('d/m/Y', $value);
            if ($date) {
                $this->data['data_vencimento'] = $date->format('dmy');
                return;
            }
        }

        if (is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}/', $value)) {
            $date = \DateTime::createFromFormat('Y-m-d', $value);
            if ($date) {
                $this->data['data_vencimento'] = $date->format('dmy');
                return;
            }
        }

        if (is_numeric($value)) {
            $date = new \DateTime();
            $date->setTimestamp($value);
            $this->data['data_vencimento'] = $date->format('dmy');
            return;
        }
    }

    protected function set_numero_sequencial($value) {
        if (!isset($this->data['numero_sequencial']) || $this->data['numero_sequencial'] == 0) {
            static $contadorDetalhe = 2;
            $this->data['numero_sequencial'] = $contadorDetalhe++;
        }
    }

    protected function set_sequencial_arquivo($value) {
        $lote = RemessaAbstract::getLote(0);
        if ($lote && isset($lote->data['numero_sequencial_arquivo'])) {
            $headerSequencial = $lote->data['numero_sequencial_arquivo'];
            $this->data['sequencial_arquivo'] = str_pad($headerSequencial, 3, '0', STR_PAD_LEFT);
        } else {
            $this->data['sequencial_arquivo'] = str_pad($value, 3, '0', STR_PAD_LEFT);
        }
    }

    protected function set_empresa_banco($value)
    {
        $lote = RemessaAbstract::getLote(0);
        if ($lote && isset($lote->data['codigo_cedente'])) {
            $codigoCedenteHeader = $lote->data['codigo_cedente'];
            $this->data['empresa_banco'] = str_pad($codigoCedenteHeader, 14, '0', STR_PAD_LEFT);
        } else {
            $this->data['empresa_banco'] = str_pad($value, 14, '0', STR_PAD_LEFT);
        }
    }

    protected function set_sequencial_registro($value) {
        $lote = RemessaAbstract::getLote(0);
        $sequencial = 2;

        if ($lote && isset($lote->children)) {
            $count = 0;
            foreach ($lote->children as $child) {
                if ($child !== $this && isset($child->data['tipo_registro']) && $child->data['tipo_registro'] == '1') {
                    $count++;
                }
            }
            $sequencial = 2 + $count;
        }

        $this->data['sequencial_registro'] = str_pad($sequencial, 6, '0', STR_PAD_LEFT);
    }

    protected function set_data_limite_desconto($value)
    {
        if ($value === '000000' || $value === '0' || empty($value)) {
            $this->data['data_limite_desconto'] = '000000';
            return;
        }

        if (preg_match('/^\d{6}$/', $value)) {
            $this->data['data_limite_desconto'] = $value;
            return;
        }

        if (preg_match('/^\d{2}\/\d{2}\/\d{4}/', $value)) {
            $date = \DateTime::createFromFormat('d/m/Y', $value);
            if ($date) {
                $this->data['data_limite_desconto'] = $date->format('dmy');
                return;
            }
        }

        if (preg_match('/^\d{4}-\d{2}-\d{2}/', $value)) {
            $date = \DateTime::createFromFormat('Y-m-d', $value);
            if ($date) {
                $this->data['data_limite_desconto'] = $date->format('dmy');
                return;
            }
        }

        $this->data['data_limite_desconto'] = '000000';
    }
}
