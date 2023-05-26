<?php
declare(strict_types=1);

namespace system\App;

class Page
{
    public function __construct(
        private readonly string $layout,
        private readonly string $template,
        private readonly array $data = []
    ) {}

    /**
     * @return string
     */
    public function getLayout(): string
    {
        return $this->layout . '.php';
    }

    /**
     * @return string
     */
    public function getLayoutName(): string
    {
        return $this->layout;
    }

    /**
     * @return string
     */
    public function getTemplate(): string
    {
        return $this->template . '.php';
    }

    /**
     * @return string
     */
    public function getTemplateName(): string
    {
        return $this->template;
    }

    /**
     * @return array
     */
    public function getData(): array
    {
        return $this->data;
    }
}
