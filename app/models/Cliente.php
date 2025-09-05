<?php
    namespace App\models;

    use App\models\Model;

    class Cliente extends Model {

        protected $table = "clientes";
        protected $primaryKey = "codigo";

        protected $fields = [
            'codigo' => null,
            'nome' => null,
            'data_nascimento' => null,
            'cpf' => null,
            'rg' => null,
            'telefone' => null,
            'ativo' => null,
        ];


        public function setNome($nome)
        {
            $this->fields['nome'] = $nome;
        }

        public function setDataNascimento($data_nascimento)
        {

            if (preg_match('/^\d{4}-\d{2}-\d{2}$/', $data_nascimento)) {
                $this->fields['data_nascimento'] = $data_nascimento;
                return;
            }

            if (preg_match('/^\d{2}\/\d{2}\/\d{4}$/', $data_nascimento)) {
                $partes = explode('/', $data_nascimento);
                $data_nascimento = $partes[2] . '-' . $partes[1] . '-' . $partes[0];
            }

            $this->fields['data_nascimento'] = $data_nascimento;
        }

        public function setRg($rg)
        {
            $this->fields['rg'] = $rg;
        }

        public function setCpf($cpf)
        {
            $this->fields['cpf'] = $cpf;
        }

        public function setTelefone($telefone)
        {
            $this->fields['telefone'] = $telefone;
        }

        public function getCodigo()
        {
            return intval($this->fields['codigo']);
        }

        public function setCodigo($codigo)
        {
            $this->fields['codigo'] = $codigo;
        }

        public function setAtivo($ativo)
        {
            $this->fields['ativo'] = $ativo;
        }


}
