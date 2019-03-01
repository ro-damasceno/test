import {Component, OnInit} from '@angular/core';
import {GuardUserService} from "../panel-api/auth/guard-user.service";
import {GcRouteService} from "@golden-codes/core";

@Component({
    selector: 'app-user-login',
    templateUrl: './login.component.html',
    styleUrls: ['./login.component.scss']
})
export class LoginComponent implements OnInit {

    isLoading: boolean = false;

    email: string;

    password: string;

    constructor(
        private guard: GuardUserService,
        private route: GcRouteService
    ) {}

    ngOnInit() {
        this.email = '';
        this.password = '';
    }

    navToLogin(): void {
        this.route.navigate('panel.register');
    }

    login(): void {

        this.isLoading = true;
        this.guard
            .login({
                email: this.email,
                password: this.password
            })
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
