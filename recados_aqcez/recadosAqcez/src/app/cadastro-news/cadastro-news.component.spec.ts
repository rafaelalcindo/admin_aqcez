import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { CadastroNewsComponent } from './cadastro-news.component';

describe('CadastroNewsComponent', () => {
  let component: CadastroNewsComponent;
  let fixture: ComponentFixture<CadastroNewsComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ CadastroNewsComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(CadastroNewsComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
