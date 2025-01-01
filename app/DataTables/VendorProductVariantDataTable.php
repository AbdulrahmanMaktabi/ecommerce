<?php

namespace App\DataTables;

use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductVariantDataTable extends DataTable
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
                $editUrl = route('vendor.product-variant.edit', ['product_variant' => $query->id]);
                $destroyUrl = route('vendor.product-variant.destroy', $query->id);
                $itemsUrl = route('admin.variant.items.index', ['product_id' => $query->product_id, 'variant_id' => $query->id]);
                return "                        
            <a href='{$editUrl}' class='btn btn-info btn-sm'>Edit</a>
            <a href='{$itemsUrl}' class='btn btn-primary btn-sm'>Variants Items</a>
            <a href='{$destroyUrl}' 
               class='btn btn-danger btn-sm delete-item'>
               Delete
            </a>                                
        ";
            })
            ->addColumn('status', function ($query) {
                $checked = $query->status == '1' ? 'checked' : '';
                return
                    "<div class='form-check form-switch'>
                    <input class='form-check-input custom-switch-input' type='checkbox' role='switch' $checked data-id='{$query->id}' name='custom-switch-checkbox' id='flexSwitchCheckDefault'>
                </div>";
            })
            ->rawColumns(['status', 'action'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ProductVariant $model): QueryBuilder
    {
        return $model->where('product_id', request()->product)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('vendorproductvariant-table')
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
            Column::make('id')
                ->width(20),
            Column::make('name')->width(950),
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
        return 'VendorProductVariant_' . date('YmdHis');
    }
}
