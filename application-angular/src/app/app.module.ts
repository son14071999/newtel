import { HttpClientModule } from '@angular/common/http';
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppRoutingModule } from './app-routing.module';
import { AppComponent } from './app.component';
import { IssueComponent } from './components/issue/issue.component';
import { IssueRoutes } from './routers/issue.routing';
import { CommonService } from './services/common.service';
import { IssueService } from './services/issue.service';

@NgModule({
  declarations: [
    AppComponent,
    IssueComponent,
  ],
  imports: [
    BrowserModule,
    AppRoutingModule,
    IssueRoutes,
    HttpClientModule
  ],
  providers: [
    IssueService,
    CommonService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
