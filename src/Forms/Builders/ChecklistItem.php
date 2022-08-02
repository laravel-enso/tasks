<?php

namespace LaravelEnso\Tasks\Forms\Builders;

use LaravelEnso\Tasks\Models\ChecklistItem as Model;
use LaravelEnso\Forms\Services\Form;

class ChecklistItem
{
    private const TemplatePath = __DIR__.'/../Templates/checklistItem.json';

    protected Form $form;

    public function __construct()
    {
        $this->form = new Form($this->templatePath());
    }

    public function create()
    {
        return $this->form->create();
    }

    public function edit(Model $checklist)
    {
        return $this->form->edit($checklist);
    }

    protected function templatePath(): string
    {
        return self::TemplatePath;
    }
}
