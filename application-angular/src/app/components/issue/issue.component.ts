import { Component, OnInit } from '@angular/core';
import { Issue } from 'src/app/common/issue';
import { IssueService } from 'src/app/services/issue.service';
import { General } from 'src/app/handler/general';

@Component({
  selector: 'app-issue',
  templateUrl: './issue.component.html',
  styleUrls: ['./issue.component.sass']
})
export class IssueComponent implements OnInit {
  issues: Issue[] = []
  handlerGeneral: General = new General
  display: boolean = false;
  title: String = ''
  itemId: Number = 0
  currentIssue: Issue = new Issue 
  listUser: any
  constructor(private issueService: IssueService) { }


  ngOnInit() {
    this.getListIssue()
    this.getListUser()

  }


  getListIssue() {
    this.issueService.getAll()
    .subscribe(
      (res) => {
        this.issues = res as Issue[]
        this.issues = this.handlerGeneral.indexing(this.issues)

      },
      (err) => {
        console.log(err)

      }
    )
  }

  getListUser() {
    this.issueService.getListUser()
    .subscribe(
      (res) => {
        console.log(res)
      },
      (err) => {
        console.log(err)
        
      }
    )
  }


  showDialog(itemId: Number, title: String) {
    this.itemId = itemId
    this.title = title
    this.display = true
  }


  save() {
    this.display = false
  }
 

  edit(id: any) {
    console.log('id: ', id)
  }

}
