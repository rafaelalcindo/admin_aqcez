<?php

/**
* 
*/
abstract class ContatoQuery 
{
	private $query;

	function __construct()
	{
		
	}

	function __destruct(){
		
	}

	protected function savarContatoQuery($obj){
		
		$this->query = sprintf("
		insert into contatos_comercial
			(
				nome_empresa,
			    contato_empresa,
			    telefone_empresa,
			    endereco_empresa,
			    status_empresa,
			    retorno_empresa,
			    motivo_empresa,
			    probabilidade_empresa,
			    sinal_empresa,
			    projetos,
			    turn_key,
			    interiores,
			    mobiliario,
			    total,
			    observacao_empresa,
			    usuario_id
			)
			values
			(
				'%s',    
			    '%s',
			    '%s',
			    '%s',
			    '%s',
			    '%s',
			    '%s',
			    '%u',
			    '%s',
			    '%s',
			    '%u',
			    '%u',
			    '%u',
			    '%u',
			    '%s',
			    '%u'

			)
		", $obj->getNomeEmpresa(), $obj->getNomeContato(), $obj->getTelContato(), $obj->getEndContato(), $obj->getStatusContato(), $obj->getRetornoContato(), $obj->getMotivo(), $obj->getProbabilidade(), $obj->getSinalFechamento(), $obj->getProjetos(), $obj->getTurnKey(), $obj->getInteriores(), $obj->getMobiliario(), $obj->getTotal() , $obj->getObservacao() , $obj->getDonoContato() );
		

		return $this->query;
	}

	protected function editarContato($obj){


		$this->query = sprintf("update contatos_comercial set
			nome_empresa = '%s',
			contato_empresa = '%s',
			endereco_empresa = '%s',
			telefone_empresa = '%s',
			status_empresa = '%s',
			retorno_empresa = '%s',
			sinal_empresa = '%s'

			where 

			idcontatos_comercial = %u ", 
			$obj->getNomeEmpresa(), $obj->getNomeContato(), $obj->getEndContato(), $obj->getTelContato(),  $obj->getStatusContato(), $obj->getRetornoContato(), $obj->getSinalFechamento(), $obj->getIdContato() );

		return $this->query;
	}




	protected function pegarTodosContatosQuery($id_user){
		$this->query = "select idcontatos_comercial as 'id_contatos', nome_empresa as 'empresa', contato_empresa as 'contato', telefone_empresa as 'tel', 			  endereco_empresa as 'end',
						status_empresa as 'status',  DATE_FORMAT(retorno_empresa,'%d/%m/%Y') as 'retorno', sinal_empresa as 'sinal',
						projetos as 'projetos', turn_key as 'turn_key', interiores as 'interiores', mobiliario as 'mobiliario', total as 'total',
						probabilidade_empresa as 'probabilidade', motivo_empresa as 'motivo', observacao_empresa as 'observacao'
						from contatos_comercial 
									where usuario_id = '".$id_user."' ";
		return $this->query;
	}

	protected function pegarHojeContatoQuery($id_user, $dataHoje){
		$this->query = "select idcontatos_comercial as 'id_contatos', nome_empresa as 'empresa', contato_empresa as 'contato', telefone_empresa as 'tel', 			  endereco_empresa as 'end',
						status_empresa as 'status',  DATE_FORMAT(retorno_empresa,'%d/%m/%Y') as 'retorno', sinal_empresa as 'sinal',
						projetos as 'projetos', turn_key as 'turn_key', interiores as 'interiores', mobiliario as 'mobiliario', total as 'total',
						probabilidade_empresa as 'probabilidade', motivo_empresa as 'motivo', observacao_empresa as 'observacao'
						from contatos_comercial 
									where usuario_id = '".$id_user."' and retorno_empresa = '".$dataHoje."' ";
		return $this->query;
	}

	protected function deletarContato($obj){
		$this->query = sprintf("delete from contatos_comercial where idcontatos_comercial = %u ",$obj->getIdContato() );
		return $this->query;
	}

	



}