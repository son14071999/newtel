import { Component, OnInit } from '@angular/core';
import { IssueService } from 'src/app/services/issue.service';

@Component({
  selector: 'app-issue',
  templateUrl: './issue.component.html',
  styleUrls: ['./issue.component.css']
})
export class IssueComponent implements OnInit {

  constructor(private issueService: IssueService) { }
 
  ngOnInit() {
    this.issueService.getAll()
    .subscribe(resp => {
      console.log('resp: ', resp)
      
    })
  }

}
