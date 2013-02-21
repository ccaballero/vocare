<?php

class FormDecoratorDefault extends sfWidgetFormSchemaFormatter
{
    protected $rowFormat = '<p>%label%%error%%field%%help%%hidden_fields%</p>';
    protected $helpFormat = '<br />%help%';
    protected $errorRowFormat = "<tr><td colspan=\"2\">%errors%</td></tr>";
    protected $errorListFormatInARow = "<ul class=\"error_list\">%errors%</ul>";
    protected $errorRowFormatInARow = "<li>%error%</li>";
    protected $namedErrorRowFormatInARow = "<li>%name%: %error%</li>";
    protected $decoratorFormat = '%content%';
}
