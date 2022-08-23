import { Component, OnInit } from '@angular/core';
import { Issue } from 'src/app/common/issue';
import { IssueService } from 'src/app/services/issue.service';
import { General } from 'src/app/handler/general';

@Component({
  selector: 'app-issue',
  templateUrl: './issue.component.html',
  styleUrls: ['./issue.component.sass'],
})
export class IssueComponent implements OnInit {
  // issues hien thi
  issues: Issue[] = [];
  // tat ca issue thoa man dk
  issuesTemp: Issue[] = []
  // tat ca issue cua respon
  issuesDefault: Issue[] = []
  handlerGeneral: General = new General();
  display: boolean = false;
  title: String = '';
  itemId: Number = 0;
  currentIssue: Issue = new Issue();
  listUser: any;
  users: any;
  statuses: any;
  // id user hiện tại
  userId: Number = 0;
  dataConfig: any;
  constructor(private issueService: IssueService) {
    this.dataConfig = {
      itemPerpage: 3,
      pageCurrent: 1,
      pages: Array.from({length: 1}, (_, i) => i + 1),
    };
  }

  ngOnInit() {
    this.getListIssue();
    this.getListUser();
    this.getListStatus();
  }

  getListIssue() {
    this.issueService.getAll().subscribe(
      (res) => {
        this.issues = res as Issue[];
        this.issues = this.handlerGeneral.indexing(this.issues)
        this.issuesTemp = res as Issue[]
        this.getConfig()
      },
      (err) => {
        console.log(err);
      }
    );
  }

  getListUser() {
    this.issueService.getListUser().subscribe(
      (res) => {
        this.users = res;
      },
      (err) => {
        console.log(err);
      }
    );
  }

  getListStatus() {
    this.issueService.getListStatus().subscribe(
      (res) => {
        this.statuses = res;
      },
      (err) => {
        console.log(err);
      }
    );
  }

  showDialog(itemId: Number, title: String) {
    this.itemId = itemId;
    this.currentIssue = new Issue();
    if (itemId) {
      this.issueService.getIssue(itemId).subscribe(
        (res: any) => {
          this.currentIssue = res.info;
          console.log('res: ', res.info);
        },
        (err) => {
          console.log(err);
        }
      );
    }
    this.title = title;
    this.display = true;
  }

  getConfig () {
    this.issues = this.issuesTemp
    console.log('2: ', this.issues)
    this.issues.splice(this.dataConfig.itemPerpage * (this.dataConfig.pageCurrent - 1), this.dataConfig.itemPerpage)
    console.log('2: ', this.issuesTemp)
    
    let p = Math.ceil(Number(this.issuesTemp.length) / Number(this.dataConfig.itemPerpage))
    this.dataConfig.pages =  Array.from({length: p}, (_, i) => i + 1)
  }

  changePage(p: Number) {
    this.dataConfig.currentIssue = p
    this.getConfig()
  }

  save() {
    this.display = false;
    this.issueService.saveIssue(this.itemId, this.currentIssue).subscribe(
      (res: any) => {
        alert(res);
        this.getListIssue();
      },
      (err: any) => {
        console.log(err);
      }
    );
    console.log('currentIssue: ', this.currentIssue);
    console.log('this.itemId: ', this.itemId);
  }
}
