<?php

	
	function GravarPedido($con, $pedido){

		/*echo "Pedido Descricao: ".$pedido->getDescricao()."<br/>";
		echo "Pedido Servico: ".$pedido->getServico()."<br/>";
		echo "Pedido Data Comeco Servico: ".$pedido->getDataComecoServico()."<br/>";
		echo "Pedido Data cad Pedido: ".$pedido->getDataCadPedido()."<br/>";
		echo "Pedido Vagas: ".$pedido->getVagasPedido()."<br/>";

		echo "Pedido Local: ".$pedido->exibe(); */

		

		
		$sql_pedido = sprintf("insert into pedido (descri_pedido, servi_pedido, data_pedido, vagas_pedido, data_cad_pedido) value ('%s', '%s', '%s', '%u', '%s')",$pedido->getDescricao(), $pedido->getServico(), $pedido->getDataComecoServico(), $pedido->getVagasPedido(), 
			$pedido->getDataCadPedido() );

		$gravar_insert = mysqli_query($con, $sql_pedido) or die(mysql_error($con)."<br/>".$sql_pedido);
		$last_id = mysqli_insert_id($con);

		$sql_local = sprintf("insert into localiza_pedido (end_loca_pedi, num_loca_pedi, comple_local_pedi, estado_loca_pedi, cidade_loca_pedi, cep_loca_pedi, pedido_id_pedido )
				values
			('%s', '%u', '%s', '%s', '%s', '%s', '%u')",
			$pedido->local->getEndereco(),
			$pedido->local->getNumero(),
			$pedido->local->getComplementar(), 
			$pedido->local->getEstado(), 
			$pedido->local->getCidade(),
			$pedido->local->getCep(), 
			$last_id );
		$gravar_local = mysqli_query($con, $sql_local) or die(mysql_error($con)."<br/>".$sql_local);

		if($gravar_insert){
			if($gravar_local){
				return true;
			}else{ return false; }
		}else{ return false; }
		
	}


	function PegarListaPedidos($con){


		$sql_lista_pedido = "select 
			pedi.servi_pedido as 'servico', pedi.descri_pedido as 'descricao',   
			        DATE_FORMAT(pedi.data_pedido, '%d/%m/%Y') as 'data_pedido', pedi.vagas_pedido as 'vagas',
					loca_pedi.end_loca_pedi as 'endereco', loca_pedi.num_loca_pedi 'numero', loca_pedi.comple_local_pedi as 'complementar',
					es.nome as 'estado', cid.nome as 'cidade', loca_pedi.cep_loca_pedi as 'cep'
					from pedido pedi, localiza_pedido loca_pedi, estado es, cidade cid where
					pedi.id_pedido = loca_pedi.pedido_id_pedido and
					es.id  = loca_pedi.estado_loca_pedi and
					cid.id = loca_pedi.cidade_loca_pedi";


		$seleciona_pedido = mysqli_query($con, $sql_lista_pedido) or die(mysql_error($con)."<br/>".$sql_lista_pedido);
		$num_count = mysqli_num_rows($seleciona_pedido);
		//echo "<br/>resul consulta: ".print_r($seleciona_pedido);	

		if($num_count > 0){
			
			return $seleciona_pedido;
		}else{ return false; }
	}

