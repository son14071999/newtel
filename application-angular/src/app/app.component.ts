import { Component, OnInit } from '@angular/core';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass'],
})
export class AppComponent implements OnInit {
  title = 'application-angular';

  ngOnInit() {
    this.start()
  }

  start() {
    let url = new URL(window.location.href)
    let accessToken = url.searchParams.get('accessToken')
    let refreshToken = url.searchParams.get('refreshToken')
    let expries_in = url.searchParams.get('expires_in')
    if(accessToken && refreshToken && expries_in) {
      localStorage.setItem('accessToken', accessToken)
      localStorage.setItem('refreshToken', refreshToken)
      localStorage.setItem('expries_in', String(Date.now() + (Number(expries_in) - 10) * 1000))
    }
  }
}
