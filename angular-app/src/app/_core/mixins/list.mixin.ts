import {Constructor} from "../types/constructor.type";
import {MatPaginator, MatSort, SortDirection} from "@angular/material";
import {merge} from "rxjs";
import {
    CommonOptionsType, GcBaseRestfulRepository, GcCollection, GcPaginator,
    GcRequestHandler
} from "@golden-codes/core";
import * as _ from 'lodash';

export type RequestOptions = {
    [key:string]: any;
    sortActive?: string;
    sortDirection?: SortDirection;
    page?:number;
    q?:string;
    paginate?:string;
}

export interface CanList{

    isLoading: boolean;
    paginate: boolean;
    results: any;
    source: Array<any>;
    filterValue: string;
    requestHandler: GcRequestHandler<any>;

    /**
     * Retorna o Service Repository para efetuar a chamada na API
     * */
    getRepository(): GcBaseRestfulRepository | undefined;

    /**
     * Subscribe no sort e paginator para detectar mudança e iniciar nova busca
     * */
    initList(paginator?: MatPaginator | null, sort?: MatSort | null): void;

    /**
     * Ao paginar ou ordenar efetua uma nova busca
     * */
    loadItems?(args: RequestOptions): void;

    /**
     * Filtra os resultados de acordo com o valor em filterValue
     * */
    filter?(): void;

    /**
    * Options que serão enviados como params
    * */
    mapRequestOptions?(args: RequestOptions): any;

    /**
     * Custom Options adicionais que serão enviados como params
     * */
    withRequestOptions(args: any): any;

    /**
     * Intercepta o valor de requisição antes de atribuí-lo a variável source.
     * */
    withResponse(source: any): any;

    /**
     * Options de url - CommonOptionsType
     * */
    setCommonOptions(args: CommonOptionsType): void;

    /**
     * Retorna options
     * */
    getCommonOptions(): any;
}

/** Mixin to augment list onto the given base */
export function mixinList<T extends Constructor<CanList>>( base: T ): Constructor<CanList> & T {
    return class extends base implements CanList {

        source: Array<any> = [];
        commonOptions: any = {};
        paginate: boolean = true;
        filterValue: string = '';
        requestHandler: GcRequestHandler<any>;

        results: any = new GcPaginator({ total: 0 });

        initList(paginator?: MatPaginator | null, sort?: MatSort | null): void {

            let subject = null;
            let optParams = {page: 1};

            if (sort && paginator) {
                subject = merge(sort.sortChange, paginator.page);

            } else if (sort) {
                subject = sort.sortChange;
                _.set(optParams, 'sortActive', sort.active);
                _.set(optParams, 'sortDirection', sort.direction);

            } else if (paginator) {
                subject = paginator.page;
            }

            if (subject) {
                if (sort && paginator) {
                    sort.sortChange.subscribe(() => paginator.pageIndex = 0);
                }
                subject.subscribe(() => {
                    this.loadItems({
                        sortActive    : sort ? sort.active : null,
                        sortDirection : sort ? sort.direction : null,
                        page          : paginator ? paginator.pageIndex + 1 : null,
                        filter        : this.filterValue
                    });
                });
            }

            this.loadItems(optParams);
        }

        mapRequestOptions(args: RequestOptions) {

            let options = {
                paginate: 'false'
            };

            if (this.paginate) {
                options.paginate = 'true';
                options['page']  = args.page ? args.page : 1;
            }
            if (args.sortActive) {
                options['sort'] = args.sortActive;
            }
            if (args.sortDirection) {
                options['sort_direction'] = args.sortDirection;
            }
            if (args.q) {
                options['q'] = args.q;
            }

            return this.withRequestOptions(options);
        }

        withRequestOptions(args: any): any {
            return args;
        }

        filter(): void {
            this.loadItems(this.mapRequestOptions({
                page: 1,
                q : this.filterValue
            }));
        }

        loadItems(args: RequestOptions = {}) {

            if (this.requestHandler) {
                this.requestHandler.cancel();
            }

            let repo: GcBaseRestfulRepository;

            if (typeof this.getRepository == 'function' && (repo = this.getRepository())) {
                this.isLoading = true;
                this.requestHandler = repo.find(this.getCommonOptions(), {params: this.mapRequestOptions(args)})
                    .success(res => {
                        this.results = res;

                        let data:any;
                        if (this.results instanceof GcPaginator) {
                            data  = res.getCollection().getItems();

                        } else if (this.results instanceof GcCollection) {
                            data = res.getItems();
                        } else {
                            data = res.data;
                        }

                        this.source = this.withResponse(data);
                    })
                    .error(error => {
                        console.log(error);
                    })
                    .complete(() => {
                        this.isLoading = false;
                        this.requestHandler = null;
                    });
            }
        }

        withResponse (source: any) {
            return source;
        }

        setCommonOptions(args: CommonOptionsType): void {
            this.commonOptions = args;
        }

        getCommonOptions(): any {
            return this.commonOptions;
        }
    }
}

export class _baseListComponent implements CanList{
    isLoading: boolean;
    requestHandler: GcRequestHandler<any>;
    results: any;
    filterValue: string;
    paginate: boolean;
    source: Array<any>;
    getRepository(): GcBaseRestfulRepository {
        return undefined;
    };
    initList(paginator: MatPaginator, sort: MatSort): void {}
    loadItems(args: RequestOptions): void {}
    mapRequestOptions(args: RequestOptions): any {}
    withRequestOptions(args: any): any {}
    withResponse(source: any): any {}
    filter(): void {}
    setCommonOptions(args: CommonOptionsType): void {}
    getCommonOptions(): any {}
}