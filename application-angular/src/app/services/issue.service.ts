import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { environment } from '../../environments/environment';
import { CommonService } from './common.service';
import { Issue } from '../common/issue';

@Injectable({
  providedIn: 'root',
})
export class IssueService {
  constructor(
    private httpClient: HttpClient,
    private commonService: CommonService
  ) { }
  private header = new HttpHeaders(environment.header);

  getAll() {
    this.commonService.checkAccessToken();
    console.log(23456);
    
    console.log('header: ', this.header);
    
    return this.httpClient.get(environment.url + 'api/listIssue', {
      headers: this.header,
    });
  }

  getListUser() {
    this.commonService.checkAccessToken();
    return this.httpClient.get(environment.url + 'api/getAllUser', {
      headers: this.header,
    })
  }

  deleteIssue(id: Number) {
    this.commonService.checkAccessToken();
    return this.httpClient.delete(environment.url + 'api/deleteIssue/' + id, {
      headers: this.header,
    })
  }

  getListStatus() {
    return this.httpClient.get(environment.url + 'api/getListStatus/1', {
      headers: this.header
    })
  }

  getIssue(id: Number) {
    return this.httpClient.get(environment.url + 'api/getIssue/' + id, {
      headers: this.header
    })
  }


  saveIssue(id: Number, issue: Issue) {
    let deadline = (new Date()).getTime()
    if(issue.deadline) {
      let d = issue.deadline.split('-')
      deadline = (new Date(d[1] + '/' + d[2] + '/' + d[0])).getTime()
    }
    let data = {
      'descripttion': issue.descripttion,
      'executor_id' : issue.executor_id,
      'jobAssignor_id': issue.jobAssignor_id,
      'name': issue.name,
      'status_id': issue.status_id,
      'deadline': deadline
    }
    if(id){
      return this.httpClient.post(environment.url + 'api/editIssue/' + id, data, {
        headers: this.header
      })
    }else{
      return this.httpClient.post(environment.url + 'api/addIssue', data, {
        headers: this.header
      })
    }
  }
}
