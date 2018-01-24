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
			motivo_empresa 	= '%s',
			probabilidade_empresa = '%u',			
			sinal_empresa = '%s',
			projetos = '%s',
			turn_key = '%u',
			interiores = '%u',
			mobiliario = '%u',
			total = '%s',
			observacao_empresa = '%s',
			usuario_id = '%u'


			where 

			idcontatos_comercial = %u ", 
			$obj->getNomeEmpresa(), $obj->getNomeContato(), $obj->getEndContato(), $obj->getTelContato(),  $obj->getStatusContato(), $obj->getRetornoContato(), $obj->getMotivo(), $obj->getProbabilidade(), $obj->getSinalFechamento(), $obj->getProjetos(), $obj->getTurnKey(), $obj->getInteriores(), $obj->getMobiliario(), $obj->getTotal(), $obj->getObservacao(), $obj->getDonoContato(), $obj->getIdContato() );

		return $this->query;
	}

	protected function pegarDadosEditar($id_contato){
		$this->query = "
			select idcontatos_comercial as 'id_contatos', nome_empresa as 'empresa', contato_empresa as 'contato', telefone_empresa as 'tel', 			  endereco_empresa as 'end',
			status_empresa as 'status',  DATE_FORMAT(retorno_empresa,'%d/%m/%Y') as 'retorno', sinal_empresa as 'sinal',
			projetos as 'projetos', turn_key as 'turn_key', interiores as 'interiores', mobiliario as 'mobiliario', total as 'total',
			probabilidade_empresa as 'probabilidade', motivo_empresa as 'motivo', observacao_empresa as 'observacao'
			from contatos_comercial where idcontatos_comercial = '".$id_contato."' ";

		return $this->query;
	}

	protected function deletarContato($obj){
		$this->query = sprintf("delete from contatos_comercial where idcontatos_comercial = %u ",$obj->getIdContato() );
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
						where usuario_id = '".$id_user."' 
                        and retorno_empresa between '".$dataHoje."' and date_add(retorno_empresa, interval 10 day) 
                        order by retorno_empresa asc";
		return $this->query;
	}

	protected function filtroContatoQuery($id_user, $nome_contato, $dataHoje){
		$this->query = "select idcontatos_comercial as 'id_contatos', nome_empresa as 'empresa', contato_empresa as 'contato', telefone_empresa as 'tel', 			  endereco_empresa as 'end',
						status_empresa as 'status',  DATE_FORMAT(retorno_empresa,'%d/%m/%Y') as 'retorno', sinal_empresa as 'sinal',
						projetos as 'projetos', turn_key as 'turn_key', interiores as 'interiores', mobiliario as 'mobiliario', total as 'total',
						probabilidade_empresa as 'probabilidade', motivo_empresa as 'motivo', observacao_empresa as 'observacao'
						from contatos_comercial 					    
					where usuario_id = '".$id_user."' and ((contato_empresa like '".$nome_contato."%' and retorno_empresa >= '".$dataHoje."') )";
		return $this->query;
	}



	//========================================================= Query Gerais ==========================================================

	protected function pegarTodosContatosAdmin(){
		$this->query = "select cc.idcontatos_comercial as 'id_contatos', cc.nome_empresa as 'empresa', cc.contato_empresa as 'contato', cc.telefone_empresa as 'tel', 			  endereco_empresa as 'end',
			cc.status_empresa as 'status',  DATE_FORMAT(cc.retorno_empresa,'%d/%m/%Y') as 'retorno', cc.sinal_empresa as 'sinal',
			cc.projetos as 'projetos', cc.turn_key as 'turn_key', cc.interiores as 'interiores', cc.mobiliario as 'mobiliario', cc.total as 'total',
			cc.probabilidade_empresa as 'probabilidade', cc.motivo_empresa as 'motivo', cc.observacao_empresa as 'observacao', 
            usu.usuario_nome as 'dono_nome', usu.usuario_sobrenome as 'dono_sobrenome'
            
			from contatos_comercial cc, usuario usu
			where cc.usuario_id = usu.usuario_id order by idcontatos_comercial desc";

        return $this->query;
	}

	protected function pegarTodosContatosFiltroAdmin($filtro){
		$this->query = "select cc.idcontatos_comercial as 'id_contatos', cc.nome_empresa as 'empresa', cc.contato_empresa as 'contato', cc.telefone_empresa as 'tel', 			  endereco_empresa as 'end',
			cc.status_empresa as 'status',  DATE_FORMAT(cc.retorno_empresa,'%d/%m/%Y') as 'retorno', cc.sinal_empresa as 'sinal',
			cc.projetos as 'projetos', cc.turn_key as 'turn_key', cc.interiores as 'interiores', cc.mobiliario as 'mobiliario', cc.total as 'total',
			cc.probabilidade_empresa as 'probabilidade', cc.motivo_empresa as 'motivo', cc.observacao_empresa as 'observacao', 
            usu.usuario_nome as 'dono_nome', usu.usuario_sobrenome as 'dono_sobrenome'
            
			from contatos_comercial cc, usuario usu
			where cc.usuario_id = usu.usuario_id 
			and cc.contato_empresa like '".$filtro['filtro_nome']."%' order by idcontatos_comercial desc";

		return $this->query;
	}

	protected function pegarHojeContatoQueryAdmin($dataHoje){
		$this->query = "select cc.idcontatos_comercial as 'id_contatos', cc.nome_empresa as 'empresa', cc.contato_empresa as 'contato', cc.telefone_empresa as 'tel', 			  endereco_empresa as 'end',
					cc.status_empresa as 'status',  DATE_FORMAT(cc.retorno_empresa,'%d/%m/%Y') as 'retorno', cc.sinal_empresa as 'sinal',
					cc.projetos as 'projetos', cc.turn_key as 'turn_key', cc.interiores as 'interiores', cc.mobiliario as 'mobiliario', cc.total as 'total',
					cc.probabilidade_empresa as 'probabilidade', cc.motivo_empresa as 'motivo', cc.observacao_empresa as 'observacao', 
					usu.usuario_nome as 'dono_nome', usu.usuario_sobrenome as 'dono_sobrenome'            
					from contatos_comercial cc, usuario usu
					where cc.usuario_id = usu.usuario_id             
					and cc.retorno_empresa between '".$dataHoje."' and date_add(cc.retorno_empresa, interval 10 day) 
				order by cc.retorno_empresa asc";

		return $this->query;
	}

	protected function pegarNomesContatosPessoal($id_user){
		$this->query = "select cc.contato_empresa as 'contato' from contatos_comercial cc, usuario usu where cc.usuario_id = usu.usuario_id and usu.usuario_id = '".$id_user."' ";
		return $this->query;
	}

	protected function pegarNomesContatosAdmin(){
		$this->query = "select cc.contato_empresa as 'contato' from contatos_comercial cc, usuario usu where cc.usuario_id = usu.usuario_id";
		return $this->query;
	}















	// ================================================= Filtros Feito em importação de arquivo Excell ========================================


	protected function queryVerificaProjeto($projeto, $id_dono){
		$this->query = sprintf("select * from contatos_comercial where projetos = '%s' and usuario_id = '%u' ", $projeto, $id_dono);
		return $this->query;
	}

	protected function atualizarListaExcell($info, $id_dono){
		$dataUpdate = $info['ano']."-".$info['mes']."-".$info['dia'];

		$this->query =sprintf("
			update contatos_comercial set	
			
			status_empresa = '%s',
			retorno_empresa = '%s',
			motivo_empresa 	= '%s',
			probabilidade_empresa = '%u',	
			sinal_empresa = '%s',		
			projetos = '%s',
			turn_key = '%u',
			interiores = '%u',
			mobiliario = '%u',
			total = '%s',
			observacao_empresa = '%s'
			
			where 

			idcontatos_comercial = %u ", $info['situacao'], $dataUpdate, $info['motivo'], $info['probabilidade'], $info['sinal_empresa'], $info['projeto'], $info['turn_key'], $info['interiores'], $info['mobiliario'], $info['total'], $info['observacao'], $id_dono );

		return $this->query;

	}

	protected function cadastrarListaExcell($info, $id_dono){
		$dataUpdate = $info['ano']."-".$info['mes']."-".$info['dia'];

		$this->query = sprintf("
			insert into contatos_comercial
			( 
			    
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
		", $info['situacao'], $dataUpdate, $info['motivo'], $info['probabilidade'], $info['sinal_empresa'], $info['projeto'], $info['turn_key'], $info['interiores'], $info['mobiliario'], $info['total'], $info['observacao'], $id_dono );

		return $this->query;
	}


}