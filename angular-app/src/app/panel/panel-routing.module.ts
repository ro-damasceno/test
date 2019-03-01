import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import {UserResolver} from "./panel-api/resolver/user.resolver";
import {GuardUserService} from "./panel-api/auth/guard-user.service";
import {LoginComponent} from "./login/login.component";
import {PanelComponent} from "./panel.component";
import {RegisterComponent} from "./register/register.component";

let routes = [
    {
        path: 'login',
        component: LoginComponent,
        canActivate: [GuardUserService],
    },
    {
        path: 'register',
        component: RegisterComponent,
        canActivate: [GuardUserService],
    },
    {
        path: '',
        canActivate: [GuardUserService],
        component: PanelComponent,
        resolve: {
            user: UserResolver
        },
        children: [
            {
                path: 'products',
                loadChildren: './product/product.module#ProductModule',
            }
        ]
    }
];

@NgModule({
    imports: [RouterModule.forChild(routes)],
    exports: [RouterModule],
    providers: []
})
export class PanelRoutingModule {}
