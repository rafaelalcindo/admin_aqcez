
import { FormsModule } from '@angular/forms';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from '@angular/http';

import { AppComponent } from './app.component';
import { HeaderComponent } from './header/header.component';
import { FooterComponent } from './footer/footer.component';
import { TelaPrincipalComponent } from './tela-principal/tela-principal.component';
import { CadastroNewsComponent } from './cadastro-news/cadastro-news.component';
import { routing } from './app.routing';
import { TelaPrincipalService } from './tela-principal/tela-principal.service';
import { LoginService } from './login/login.service';
import { LoginComponent } from './login/login.component';

@NgModule({
  declarations: [
    AppComponent,
    HeaderComponent,
    FooterComponent,
    TelaPrincipalComponent,
    CadastroNewsComponent,
    LoginComponent
  ],
  imports: [
    BrowserModule,
    routing,
    HttpModule,
    FormsModule
  ],
  providers: [TelaPrincipalService, LoginService],
  bootstrap: [AppComponent]
})
export class AppModule { }
