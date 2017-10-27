
import { Component, OnInit } from '@angular/core';
import { TelaPrincipalService } from './tela-principal.service';



@Component({
  selector: 'app-tela-principal',
  templateUrl: './tela-principal.component.html',
  styleUrls: ['./tela-principal.component.css']
})
export class TelaPrincipalComponent implements OnInit {

  news: any[];

  noticia_dep: any[];
  resul_auth: any;

  constructor(noticiaService: TelaPrincipalService) {
      this.news        =  noticiaService.getNoticiasGeral();
      this.noticia_dep =  noticiaService.getNoticiaDep();
      this.resul_auth  =  noticiaService.getUserAuth();
      console.log(this.resul_auth);
  }

  ngOnInit() {
  }


}
