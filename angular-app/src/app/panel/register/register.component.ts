import {Component, OnInit} from '@angular/core';
import {GuardUserService} from "../panel-api/auth/guard-user.service";
import {UserModel} from "../../_models/user.model";
import {GcRouteService} from "@golden-codes/core";

@Component({
    selector: 'app-user-register',
    templateUrl: './register.component.html',
    styleUrls: ['./register.component.scss']
})
export class RegisterComponent implements OnInit {

    isLoading: boolean = false;

    user: UserModel;

    c_password:string;

    constructor(
        private guard: GuardUserService,
        private route: GcRouteService
    ) {}

    ngOnInit() {
       this.user = new UserModel();
    }

    navToLogin(): void {
        this.route.navigate('panel.login');
    }

    register(): void {

        this.isLoading = true;
        this.guard
            .create({...this.user.all(), ...{ c_password: this.c_password }})
            .error(() => {
                this.isLoading = false;
            })
            .success(() => {
                setTimeout(() => {
                    this.isLoading = false;
                }, 2000);
            });
    }
}
