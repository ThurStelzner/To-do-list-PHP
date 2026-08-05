<?php
    class Tarefa implements JsonSerializable {
        private $id;
        private $nome;
        private $descricao;
        private $tipo;
        private $dataTermino;
        private $dataCriado;

        public function __construct($nome, $descricao, $tipo, $dataTermino, $dataCriado, $id=null){
            $this->setNome($nome);
            $this->setDescrição($descricao);
            $this->setTipo($tipo);
            $this->setDataTermino($dataTermino);
            $this->setDataCriado($dataCriado);
            $this->setId($id);
        }

        public function setId($id) {
            $this->id = $id;
        }

        public function setNome($nome) {
            $this->nome = $nome;
        }

        public function setDescrição($descricao) {
            $this->descricao = $descricao;
        }

        public function setTipo($tipo) {
            $this->tipo = $tipo;
        }

        public function setDataTermino($dataTermino) {
            $this->dataTermino = $dataTermino;
        }

        public function setDataCriado($dataCriado) {
            $this->dataCriado = $dataCriado;
        }

        public function getId() {
            return $this->id;
        }

        public function getNome() {
            return $this->nome;
        }

        public function getDescricao() {
            return $this->descricao;
        }

        public function getTipo() {
            return $this->tipo;
        }

        public function getDataTermino() {
            return $this->dataTermino;
        }

        public function getDataCriado() {
            return $this->dataCriado;
        }

        public function jsonSerialize(): array {
            return [
                'id' => $this->id,
                'nome' => $this->nome,
                'descricao' => $this->descricao,
                'tipo' => $this->tipo,
                'dataTermino' => $this->dataTermino,
                'dataCriado' => $this->dataCriado
            ];
        }
    }