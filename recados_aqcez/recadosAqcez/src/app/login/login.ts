export class Login {

  private usuario: any;
  private senha: any;

  constructor(){

  }

  public setUsuario(usuario:any){
    this.usuario = usuario;
  }

  public getUsuario(){
    return this.usuario;
  }

  public setSenha(senha:any){
    this.senha = senha;
  }

  public getSenha() {
    return this.senha;
  }

public verificaLoginSenha(usuario: any, senha: any ){
      if (usuario != '' && senha != '') {
        return true;
      }
  }

public logar(usuario: any, senha: any){

  }

}
