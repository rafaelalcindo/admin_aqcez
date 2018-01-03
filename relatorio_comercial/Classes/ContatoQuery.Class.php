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
			    sinal_empresa,
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
			    '%u'    
			)
		", $obj->getNomeEmpresa(), $obj->getNomeContato(), $obj->getTelContato(), $obj->getEndContato(), $obj->getStatusContato(), $obj->getRetornoContato(), $obj->getSinalFechamento(), $obj->getDonoContato() );
		

		return $this->query;
	}




	protected function pegarTodosContatosQuery($id_user){
		$this->query = sprintf("select nome_empresa as 'empresa', contato_empresa as 'contato', telefone_empresa as 'tel', endereco_empresa as 'end',
									status_empresa as 'status', retorno_empresa as 'retorno', sinal_empresa as 'sinal' 
									from contatos_comercial
									where usuario_id = '%u' ", $id_user);
		return $this->query;
	}

	protected function pegarHojeContatoQuery($id_user, $dataHoje){
		$this->query = sprintf("select nome_empresa as 'empresa', contato_empresa as 'contato', telefone_empresa as 'tel', endereco_empresa as 'end',
									status_empresa as 'status', retorno_empresa as 'retorno', sinal_empresa as 'sinal' 
									from contatos_comercial
									where usuario_id = '%u' and retorno_empresa = '%s' ",$id_user, $dataHoje);
		return $this->query;
	}

	



}