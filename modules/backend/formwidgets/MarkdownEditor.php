<?php namespace Backend\FormWidgets;

use BackendAuth;
use Markdown;
use Request;
use Backend\Classes\FormWidgetBase;

/**
 * Code Editor
 * Renders a code editor field.
 *
 * @package october\backend
 * @author Alexey Bobkov, Samuel Georges
 */
class MarkdownEditor extends FormWidgetBase
{
    //
    // Configurable properties
    //

    /**
     * @var string Display mode: split, tab.
     */
    public $mode = 'tab';

    /**
     * @var bool Render preview with safe markdown.
     */
    public $safe = false;

    /**
     * @var bool The Legacy mode disables the Vue integration.
     */
    public $legacyMode = false;

    //
    // Object properties
    //

    /**
     * @inheritDoc
     */
    protected $defaultAlias = 'markdown';

    /**
     * @inheritDoc
     */
    public function init()
    {
        $this->fillFromConfig([
            'mode',
            'safe',
            'legacyMode'
        ]);

        $this->controller->registerVueComponent(\Backend\VueComponents\DocumentMarkdownEditor::class);
    }

    /**
     * @inheritDoc
     */
    public function render()
    {
        $this->prepareVars();
        return $this->makePartial('markdowneditor');
    }

    /**
     * Prepares the widget data
     */
    public function prepareVars()
    {
        $this->vars['mode'] = $this->mode;
        $this->vars['legacyMode'] = $this->legacyMode;
        $this->vars['stretch'] = $this->formField->stretch;
        $this->vars['size'] = $this->formField->size;
        $this->vars['name'] = $this->getFieldName();
        $this->vars['value'] = $this->getLoadValue();
        $this->vars['useMediaManager'] = BackendAuth::getUser()->hasAccess('media.manage_media');

        $this->vars['isAjax'] = Request::ajax();
    }

    /**
     * @inheritDoc
     */
    protected function loadAssets()
    {
        $this->addCss('css/markdowneditor.css', 'core');
        $this->addJs('js/markdowneditor.js', 'core');
        $this->addJs('/modules/backend/formwidgets/codeeditor/assets/js/build-min.js', 'core');
    }

    public function onRefresh()
    {
        $value = post($this->getFieldName());
        $previewHtml = $this->safe
            ? Markdown::parseSafe($value)
            : Markdown::parse($value);

        return [
            'preview' => $previewHtml
        ];
    }
}
