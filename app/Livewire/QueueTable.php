<?php

namespace App\Livewire;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Queue;

class QueueTable extends DataTableComponent
{
    protected $model = Queue::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');

        $this->setTbodyAttributes([
            'default' => true,
            'class' => 'text-black',
          ]);

          $this->setTableAttributes([
            'default' => false,
            'class' => 'w-full',
          ]);

        $this->setTrAttributes(function($row, $index) {
            return [
                "default" => false,
                'class' => 'bg-gray-800',
              ];
        });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Nama", "patient.name")
                ->sortable()
                ->searchable(),
            Column::make("NIK", "patient_nik")
                ->sortable()
                ->searchable(),
            Column::make("Poli", "poly.name")
                ->sortable(),
            Column::make("Waktu Daftar", "created_at")
                ->sortable(),
        ];
    }
}
