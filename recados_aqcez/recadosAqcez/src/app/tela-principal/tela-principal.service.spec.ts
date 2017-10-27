import { TestBed, inject } from '@angular/core/testing';

import { TelaPrincipalService } from './tela-principal.service';

describe('TelaPrincipalService', () => {
  beforeEach(() => {
    TestBed.configureTestingModule({
      providers: [TelaPrincipalService]
    });
  });

  it('should be created', inject([TelaPrincipalService], (service: TelaPrincipalService) => {
    expect(service).toBeTruthy();
  }));
});
