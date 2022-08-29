import { Component, OnInit } from '@angular/core';
import { environment } from 'src/environments/environment';
import { CommonService } from './services/common.service';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.sass'],
})
export class AppComponent implements OnInit {
  title = 'application-angular';

  constructor(private commonService: CommonService) {

  }

  ngOnInit() {
    this.start()
    this.commonService.checkAccessToken();
  }

  start() {
    let url = new URL(window.location.href)
    let accessToken = url.searchParams.get('accessToken')
    let refreshToken = url.searchParams.get('refreshToken')
    let expries_in = url.searchParams.get('expires_in')
    if (accessToken && refreshToken && expries_in) {
      localStorage.setItem('accessToken', accessToken)
      localStorage.setItem('refreshToken', refreshToken)
      localStorage.setItem('expries_in', String(Date.now() + (Number(expries_in) - 10) * 1000))
      environment.header.Authorization =  'Bearer ' + accessToken
    }
  }
  
  logout() {
    this.commonService.logout()
  }
}
