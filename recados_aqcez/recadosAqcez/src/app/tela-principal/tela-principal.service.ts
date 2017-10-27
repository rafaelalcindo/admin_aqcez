
import { Http,Response } from '@angular/http';

import { Injectable } from '@angular/core';

import 'rxjs/add/operator/map';


@Injectable()
export class TelaPrincipalService {

  constructor(private http: Http) { }

  getNoticiasGeral(){
    return [
      ['Feriado de Novembro','17/08/2017', 'teremos um feriando no dia 02 de novembro e todos podem descansar'],
      ['Salário','18/10/2017', 'Todos terão um almento de 20% no salário, aproveitem bem...'],
      ['Confraternização da empresa','15/10/2017', 'Teremos a nossa confratenização da empresa em breve...'],
      ['Código Alpha','25/10/2017', 'Todos aniversáriantes terão uma surpresa hoje depois do almoço.'],
    ];
  }

  getNoticiaDep(){
    return [
        ['Departamento de Marketing','13/10/2017','Não esqueçam de mandar os orçamentos para o novo sistema que estamos implantando...'],
        ['Orçamento de APP','12/10/2017','Precisamos fazer um orçamento sobre o app da empresa, pois precisamos gerenciar bem...'],
        ['Novo Sistema sendo implantado','07/10/2017','Estamos implantando um novo sistema para que todos os usuários possam usar...'],
      ];
  }

  getUserAuth(){
    return this.http.get('http://localhost/projeto_aqcez/login/controller.php?login=sessionUsuario')
          .map((res:Response ) => res)
          .subscribe(
            result => console.log(result)
          );
  }

}
