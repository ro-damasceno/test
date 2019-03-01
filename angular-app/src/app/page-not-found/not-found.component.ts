import {Component} from "@angular/core";
import {GcRouteService} from "@golden-codes/core";

@Component({
    selector: 'app-page-not-found',
    templateUrl: './not-found.component.html',
    styleUrls: ['./not-found.component.scss']
})

export class NotFoundComponent {
    constructor(
        private router: GcRouteService
    ) {}

    backToHome(): void {
        this.router.navigate('panel');
    }
}