import {Injectable} from "@angular/core";
import {BehaviorSubject} from "rxjs/Rx";

@Injectable()
export class UserLayoutService {

    protected _activeMenu: string;

    isLoading: BehaviorSubject<boolean> = new BehaviorSubject<boolean>(false);

    /**
     * Define o menu ativo.
     * */
    setActiveMenu(value: string): void {
        if (this._activeMenu !== value) {
            setTimeout(() => { this._activeMenu = value; }, 0);
        }
    }

    /**
     * Verifica se o menu está ativo
     */
    isActiveMenu(menu): boolean {
        return this.getActiveMenu() === menu;
    }

    /**
     * Retorna o código do menu ativo
     */
    getActiveMenu(): string {
        return this._activeMenu;
    }

    startLoading(): void {
        this.isLoading.next(true);
    }

    stopLoading(): void {
        this.isLoading.next(false);
    }
}