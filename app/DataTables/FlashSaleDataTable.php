<?php

namespace App\DataTables;

use App\Models\FlashSale;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class FlashSaleDataTable extends DataTable
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
                $editUrl = route('admin.flashSale.edit', ['flashSaleID' => $query->id]);
                $destroyUrl = route('admin.flashSale.destroy', ['flashSaleID' => $query->id]);
                $destroyUrl = route('admin.flashSale.destroy', ['flashSaleID' => $query->id]);
                return "                        
                <a href='{$editUrl}' class='btn btn-info btn-sm'>Edit</a>
                <a href='{$editUrl}' class='btn btn-warning btn-sm'>Add Products</a>               
                <a href='{$destroyUrl}' 
                   class='btn btn-danger btn-sm delete-item'>
                   Delete
                </a>   
            ";
            })
            ->addColumn('status', function ($query) {
                $checked = $query->status == '1' ? 'checked' : '';
                return "<label class='custom-switch mt-2'>
                        <input type='checkbox' data-id='{$query->id}' $checked name='custom-switch-checkbox' class='custom-switch-input'>
                        <span class='custom-switch-indicator'></span>                        
                    </label>";
            })
            ->rawColumns(['action', 'status'])
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(FlashSale $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('flashsale-table')
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
                ->addClass('text-left'),
            Column::make('name'),
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
        return 'FlashSale_' . date('YmdHis');
    }
}
