import {Component, OnInit, ViewChild} from "@angular/core";
import {MatPaginator, MatSort} from "@angular/material";
import {GcBaseRestfulRepository, GcDialogService, GcRouteService} from "@golden-codes/core";
import {UserLayoutService} from "../../layout/user-layout-service";
import {_baseListComponent, CanList, mixinList} from "../../../_core/mixins/list.mixin";
import {Constructor} from "../../../_core/types/constructor.type";
import {ProductRepositoryService} from "../product-api/services/product.repository";
import {ProductModel} from "../models/product.model";

export const _mixinBaseComponent = <Constructor<CanList>>mixinList(_baseListComponent);

@Component({
    selector: 'app-panel-products',
    templateUrl: './product.component.html',
    styleUrls: ['./product.component.scss']
})
export class ProductComponent extends _mixinBaseComponent implements OnInit{

    @ViewChild(MatPaginator) paginator: MatPaginator;
    @ViewChild(MatSort) sort: MatSort;

    displayedColumns = ['sku', 'name', 'price', 'updated_at', 'actions'];

    paginate = true;

    constructor(
        private userLayoutService: UserLayoutService,
        private route: GcRouteService,
        private productRepo: ProductRepositoryService,
        private dialog: GcDialogService
    ) {
        super();
    }

    ngOnInit() {
        this.userLayoutService.setActiveMenu('products');
        this.initList(this.paginator, this.sort);
    }

    getRepository(): GcBaseRestfulRepository {
        return this.productRepo;
    }

    editProduct(product: ProductModel): void {
        this.route.navigate(['panel.products-edit', {id: product.getKey()}]);
    }

    newProduct() {
        this.route.navigate('panel.products-create');
    }

    makeFakeItems() {

        this.userLayoutService.startLoading();

        this.productRepo.makeFakeItems()
            .success(() => {
                this.dialog.success('Success', 'Products successfully created.');
                this.filterValue = '';
                this.filter();
            })
            .complete(() => {
                this.userLayoutService.stopLoading();
            });
    }
}