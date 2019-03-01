import {Component, OnInit} from "@angular/core";
import {GcRouteService} from "@golden-codes/core";
import {UserLayoutService} from "./user-layout-service";
import {ConfigService} from "../../root-api/services/config/config.service";
import {GuardUserService} from "../panel-api/auth/guard-user.service";

@Component({
    selector: 'app-panel-layout',
    templateUrl: './layout.component.html',
    styleUrls: ['./layout.component.scss'],
    providers: [
        UserLayoutService
    ]
})

export class LayoutComponent implements OnInit {

    isLoading: boolean = false;

    mainMenu = [
        {
            icon: 'local_offer',
            name: 'Produtos',
            code: 'products',
            route: 'panel.products'
        }
    ];

    constructor(
        private userLayoutService: UserLayoutService,
        private router: GcRouteService,
        private config: ConfigService,
        private guard: GuardUserService
    ) {

        userLayoutService.isLoading.subscribe((value) => {
            setTimeout(() => {
                this.isLoading = value;
            }, 100)
        });
    }

    ngOnInit() {}

    isActive(menu): boolean {
        return this.userLayoutService.isActiveMenu(menu);
    }

    navigateToProfile(): void {
        this.router.navigate('panel.user');
    }

    logout(): void {
        this.guard.logout();
    }
}