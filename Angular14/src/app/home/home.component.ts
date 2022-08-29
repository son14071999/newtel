import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-home',
  templateUrl: './home.component.html',
  styleUrls: ['./home.component.sass']
})
export class HomeComponent implements OnInit {

  public name = 'Son'
  public age = 18
  constructor() { }

  ngOnInit(): void {
  }

}
