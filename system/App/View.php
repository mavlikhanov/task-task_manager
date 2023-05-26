<?php
declare(strict_types=1);

namespace system\App;

use Exception;
use system\File;

class View
{
    public function render(Page $page): string
    {
        $content = $this->renderTemplate($page);
        return $this->renderLayout($page, $content);
    }

    private function renderLayout(Page $page, string $content): string
    {
        $absolutePathToLayout = sprintf('resources/views/layouts/%s', $page->getLayout());
        if (!File::exist($absolutePathToLayout)) {
            throw new Exception("Layout: {$page->getLayoutName()} not found");
        }
        ob_start();
        include basePath($absolutePathToLayout);
        return ob_get_clean();
    }

    private function renderTemplate(Page $page): string
    {
        $absolutePathToTemplate = sprintf('resources/views/%s', $page->getTemplate());
        if (!File::exist($absolutePathToTemplate)) {
            throw new Exception("Layout: {$page->getTemplateName()} not found");
        }
        ob_start();
        extract($page->getData());
        include basePath($absolutePathToTemplate);
        return ob_get_clean();
    }
}
