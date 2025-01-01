<?php

namespace App\DataTables;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;


class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function ($query) {
                $editUrl = route('vendor.product.edit', $query->id);
                $destroyUrl = route('vendor.product.destroy', $query->id);
                return "                        
                <a href='{$editUrl}' class='btn btn-info btn-sm'>Edit</a>
                <a href='{$destroyUrl}' 
                   class='btn btn-danger btn-sm delete-item'>
                   Delete
                </a>    
               <div class='btn-group dropstart'>
                    <button type='button' class='btn btn-primary  btn-sm dropdown-toggle'
                        data-bs-toggle='dropdown' aria-expanded='false'>
                        <i class='fas fa-cogs'></i>
                    </button>
                    <ul class='dropdown-menu'>
                        <li><a class='dropdown-item' href='" . route('vendor.product-image-gallery.index', ['product' => $query->id]) . "'>Image Gallery</a></li>
                        <li><a class='dropdown-item' href='" . route('vendor.product-variant.index', ['product' => $query->id]) . "'>Variant</a></li>                        
                    </ul>
                </div>
            ";
            })
            ->addColumn('status', function ($query) {
                $checked = $query->status == '1' ? 'checked' : '';
                return
                    "<div class='form-check form-switch'>
                    <input class='form-check-input custom-switch-input' type='checkbox' role='switch' $checked data-name='{$query->slug}' name='custom-switch-checkbox' id='flexSwitchCheckDefault'>
                </div>";
            })
            ->addColumn('thumb image', function ($query) {
                return "<img src='{$query->thumb_image}' width='120px'></img>";
            })
            ->addColumn('vendor', function ($query) {
                $vendor = Vendor::findOrFail($query->vendor_id);
                return "<p>" . $vendor->store_name . "</p>";
            })
            ->addColumn('category', function ($query) {
                $category = Category::findOrFail($query->category_id);
                return "<p>" . $category->name . "</p>";
            })
            ->addColumn('sub category', function ($query) {
                $subcategory = SubCategory::findOrFail($query->subCategory_id);
                return "<p>" . $subcategory->name . "</p>";
            })
            ->addColumn('child category', function ($query) {
                $childcategory = ChildCategory::findOrFail($query->childCategory_id);
                return "<p>" . $childcategory->name . "</p>";
            })
            ->rawColumns(['action', 'status', 'thumb image', 'vendor', 'category', 'child category', 'sub category'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproduct-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            //->dom('Bfrtip')
            ->orderBy(1)
            ->selectStyleSingle()
            ->buttons([
                Button::make('excel'),
                Button::make('csv'),
                Button::make('pdf'),
                Button::make('print'),
                Button::make('reset'),
                Button::make('reload')
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id'),
            Column::make('name'),
            Column::make('thumb image'),
            Column::make('sku'),
            Column::make('vendor'),
            Column::make('category'),
            Column::make('sub category'),
            Column::make('child category'),
            Column::make('status'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}
