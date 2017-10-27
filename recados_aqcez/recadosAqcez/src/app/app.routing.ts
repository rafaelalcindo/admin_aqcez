import { RouterModule, Routes } from '@angular/router';
import { ModuleWithProviders } from '@angular/core';
import { TelaPrincipalComponent } from './tela-principal/tela-principal.component';
import { LoginComponent } from './login/login.component';



const APP_ROUTES: Routes =[
  { path: '', component: LoginComponent },
  { path: 'tela', component: TelaPrincipalComponent }
];

export const routing: ModuleWithProviders = RouterModule.forRoot(APP_ROUTES);
