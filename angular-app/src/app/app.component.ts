import {Component} from '@angular/core';
import {AppLoaderService} from "./root-api/services/loader/app-loader.service";

@Component({
    selector: 'app-root',
    templateUrl: './app.component.html',
    styleUrls: ['./app.component.scss']
})
export class AppComponent {
    title = 'angular-app';

    isLoading: boolean;

    constructor(public appLoaderService: AppLoaderService) {
        appLoaderService.isLoading.subscribe((value) => {
            setTimeout(() => {
                this.isLoading = value;
            }, 100)
        });
    }
}
