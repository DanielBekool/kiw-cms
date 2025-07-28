<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Exports\PostExporter;
use App\Filament\Imports\PostImporter;
use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\ImportAction::make()
                ->importer(PostImporter::class),
            Actions\ExportAction::make()
                ->exporter(PostExporter::class),
            Actions\CreateAction::make(),
        ];
    }
}
