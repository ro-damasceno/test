import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import {NotFoundComponent} from "./page-not-found/not-found.component";

const routes: Routes = [
    {
        path: '',
        pathMatch: 'full',
        redirectTo: 'panel'
    },
    {
        path: 'panel',
        loadChildren: './panel/panel.module#PanelModule',
    },
    {
        path: '**',
        component: NotFoundComponent,
    }
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
