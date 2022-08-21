import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { environment } from '../../environments/environment';

@Injectable({
  providedIn: 'root',
})
export class CommonService {
  private header: HttpHeaders;
  constructor(private httpClient: HttpClient) {
    this.header = new HttpHeaders(environment.header);
  }

  checkAccessToken() {
    
    let expries_in = Number(localStorage.getItem('expries_in'));
    console.log()
    
    let accessToken = localStorage.getItem('accessToken')
    if(!accessToken) {
      window.location.replace(environment.url + 'login?clientId=' + environment.client_id + '&clientSecret=' + environment.clientSecret)
    }else if(expries_in && expries_in > Date.now()){      
      this.httpClient
          .post(environment.url + 'oauth/token',
            {
              'grant_type': 'refresh_token',
              'refresh_token': localStorage.getItem('refreshToken'),
              'client_id': environment.client_id,
              'client_secret': environment.clientSecret,
              'scope': '',
            }
          )
          .subscribe({
            next(value: any) {
               localStorage.setItem('accessToken', value.access_token)
               localStorage.setItem('refreshToken', value.refresh_token)
               localStorage.setItem('expries_in', String(Date.now() + (Number(expries_in) - 10) * 1000))
            },
            error(err: any) {
              localStorage.removeItem('accessToken')
              localStorage.removeItem('refreshToken')
              localStorage.removeItem('expries_in')
              window.location.replace(environment.url + 'login?clientId=' + environment.client_id + '&clientSecret=' + environment.clientSecret)
            }
          })
    }
    // if (expires_in < (Date.now() + 500000)) {
    //   this.httpClient
    //     .post(environment.url + 'api/refreshToken',
    //       {
    //         clientId: environment.client_id,
    //         clientSecret: environment.clientSecret,
    //         refreshToken: localStorage.getItem('refreshToken')
    //       },
    //       { headers: this.header }
    //     )
    //     .subscribe((resp) => {
    //       console.log('resp123: ', resp);
    //     });1662381789398
    //     });1661085863664
    // }
  }
}
