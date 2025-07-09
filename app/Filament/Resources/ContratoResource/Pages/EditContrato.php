<?php

namespace App\Filament\Resources\ContratoResource\Pages;

use App\Filament\Resources\ContratoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\Action;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpWord\TemplateProcessor;

class EditContrato extends EditRecord
{
    protected static string $resource = ContratoResource::class;

protected function getHeaderActions(): array
{
    return [
        Actions\DeleteAction::make(),
        Action::make('emitir_contrato')
            ->label('Emitir Contrato')
            ->icon('heroicon-o-document-text')
            ->action(function () {
                $contrato = $this->record;

                $templatePath = storage_path('app/modelos/contrato-modelo.docx');
                $docxPath = storage_path("app/temp/contrato-{$contrato->id}.docx");
                $pdfPath = storage_path("app/temp/contrato-{$contrato->id}.pdf");

                $template = new \PhpOffice\PhpWord\TemplateProcessor($templatePath);

                // Substituição de variáveis
                $template->setValue('numero_contrato', $contrato->numero_contrato);
                $template->setValue('data_contrato', $contrato->data_contrato?->format('d/m/Y'));
                $template->setValue('inicio_locacao', $contrato->inicio_locacao?->format('d/m/Y'));
                $template->setValue('tipo_faturamento', $contrato->tipo_faturamento);
                $template->setValue('forma_pagamento', $contrato->forma_pagamento);
                $template->setValue('valor_mensal', number_format($contrato->valor_mensal, 2, ',', '.'));
                $template->setValue('horas_mensais', $contrato->horas_mensais);
                $template->setValue('taxa_kit_capa', number_format($contrato->taxa_kit_capa, 2, ',', '.'));
                $template->setValue('descricao_equipamento', $contrato->descricao_equipamento);
                $template->setValue('dados_bancarios', $contrato->dados_bancarios);
                $template->setValue('prestador_nome', $contrato->prestador->nome);
                $template->setValue('obra_nome', optional($contrato->obra)->nome ?? 'N/A');

                $template->saveAs($docxPath);

                // Geração do PDF
                exec("libreoffice --headless --convert-to pdf --outdir " . dirname($pdfPath) . " $docxPath");

                return response()->download($pdfPath)->deleteFileAfterSend();
            }),
    ];
}

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
