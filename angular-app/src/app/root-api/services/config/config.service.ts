import {Injectable} from "@angular/core";
import {BehaviorSubject, Subscription} from "rxjs/Rx";
import {Closure} from "@golden-codes/core";

@Injectable({
    providedIn: 'root'
})
export class ConfigService {

    protected config: {[key: string]: BehaviorSubject<any>} = {};

    constructor() {}

    getConfig(name?: string, $default: any = null): any {
        return this.config[name] ? this.config[name].getValue() : $default;
    }

    setConfig(name: string, value: any){
        if (!this.config[name]) {
            this.config[name] = new BehaviorSubject(value);

        } else {
            this.config[name].next(value);
        }
    }

    subscribe (name: string, fn:Closure): Subscription {
        if (!this.config[name]) {
            this.config[name] = new BehaviorSubject<any>(null);
        }
        return this.config[name].subscribe(fn);
    }
}