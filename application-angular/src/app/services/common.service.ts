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
    let expires_in = Number(localStorage.getItem('expires_in'));
    console.log(123);
    
    if (expires_in < (Date.now() + 500000)) {
      this.httpClient
        .post(environment.url + 'api/refreshToken',
          {
            clientId: environment.client_id,
            clientSecret: environment.clientSecret,
            refreshToken: localStorage.getItem('refreshToken')
          },
          { headers: this.header }
        )
        .subscribe((resp) => {
          console.log('resp123: ', resp);
        });
    }
  }
}
