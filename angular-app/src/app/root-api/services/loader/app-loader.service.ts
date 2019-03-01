import {Injectable} from "@angular/core";
import {BehaviorSubject} from "rxjs/Rx";

@Injectable({
    providedIn: 'root'
})
export class AppLoaderService {

    isLoading: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

    startLoading(): void {
        this.isLoading.next(true);
    }

    stopLoading(): void {
        this.isLoading.next(false);
    }
}
