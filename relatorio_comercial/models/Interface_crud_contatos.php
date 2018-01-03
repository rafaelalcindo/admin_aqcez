<?php

interface ContatosInterface{
	public function Inserir($sql);
	public function Consultar($sql);
	public function Editar($sql);
	public function Excluir($sql);
}