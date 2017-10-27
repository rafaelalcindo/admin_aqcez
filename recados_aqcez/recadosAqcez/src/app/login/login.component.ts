import { Component, OnInit } from '@angular/core';
import { Login } from './login';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  usuario: any = {
    usuario: 'Jenivaldo',
    senha: 'matilda'
  };



  constructor() { }

  ngOnInit() {
  }

  fazerLogin(form) {
    console.log(form.value);

    let usuario01 = new Login();
    usuario01.setUsuario(form.value.usuario);
    usuario01.setSenha(form.value.senha);

    if ( usuario01.verificaLoginSenha(usuario01.getUsuario, usuario01.getSenha) ) {



    }else { console.log(false); }

  }

}
