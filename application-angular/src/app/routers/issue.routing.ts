import { Routes, RouterModule } from '@angular/router';
import { IssueComponent } from '../components/issue/issue.component';

const routes: Routes = [
  { path: 'listIssue', component: IssueComponent },
];

export const IssueRoutes = RouterModule.forChild(routes);
