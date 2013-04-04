<?php

class FormDecoratorDefault extends sfWidgetFormSchemaFormatter
{
    protected $rowFormat = '<p>%label%%field%%hidden_fields%</p>%help%%error%';
    protected $helpFormat = '%help%';
    protected $errorListFormatInARow = '<ul class="error_list">%errors%</ul>';
    protected $errorRowFormatInARow = '<li>%error%</li>';
//    protected $errorRowFormat = '[%errors%]';
//    protected $namedErrorRowFormatInARow = '%name%: %error%';
    protected $decoratorFormat = '%content%';
}
