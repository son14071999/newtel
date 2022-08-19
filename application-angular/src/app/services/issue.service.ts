import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { CommonService } from './common.service';

@Injectable({
  providedIn: 'root',
})
export class IssueService {
  constructor(
    private httpClient: HttpClient,
    private commonService: CommonService
  ) {}
  private header = new HttpHeaders(environment.header);

  getAll() {
    this.commonService.checkAccessToken();
    console.log(456);

    return this.httpClient.get(environment.url + 'api/listIssue', {
      headers: this.header,
    });
  }
}
