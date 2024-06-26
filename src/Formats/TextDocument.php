<?php

namespace Pforret\PfArticleExtractor\Formats;

final class TextDocument
{
    // TextDocument is an array of TextBlocks
    private string $title = '';

    private string $date = '';

    private int $offset = 0;

    /**
     * @var TextBlock[]
     */
    private array $textBlocks;

    public function __construct(array $textBlocks = [])
    {
        $this->textBlocks = $textBlocks;
    }

    public function setTitle(string $title): self
    {
        $this->title = trim($title);

        return $this;
    }

    public function setDate(string $date): self
    {
        $this->date = trim($date);

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getDate(): string
    {
        return $this->date;
    }

    public function getTextBlocks(): array
    {
        return $this->textBlocks;
    }

    public function getContent(): string
    {
        return $this->getText(true, false);
    }

    public function getImages(bool $includeContent = true, bool $includeNonContent = false): array
    {
        $imageUrls = [];
        foreach ($this->textBlocks as $block) {
            if ($block->isContent() && ! $includeContent) {
                continue;
            }
            if (! $block->isContent() && ! $includeNonContent) {
                continue;
            }
            $imageUrls = array_merge($imageUrls, $block->getImages());
        }

        return $imageUrls;
    }

    public function getLinks(bool $includeContent = true, bool $includeNonContent = false): array
    {
        $linkUrls = [];
        foreach ($this->textBlocks as $block) {
            if ($block->isContent() && ! $includeContent) {
                continue;
            }
            if (! $block->isContent() && ! $includeNonContent) {
                continue;
            }
            $linkUrls = array_merge($linkUrls, $block->getLinks());
        }

        return $linkUrls;
    }

    public function addTextBlock(TextBlock $block): self
    {
        if (! $block->isEmpty()) {
            $block->setStartOffset($this->offset);
            $block->setEndOffset($this->offset);
            $this->textBlocks[] = $block;
            $this->offset++;
        }

        return $this;
    }

    public function removeTextBlock(TextBlock $block): self
    {
        $index = array_search($block, $this->textBlocks);
        array_splice($this->textBlocks, $index, 1);

        return $this;
    }

    public function getText(bool $includeContent, bool $includeNonContent): string
    {
        $result = '';
        foreach ($this->textBlocks as $block) {
            if ($block->isContent() && ! $includeContent) {
                continue;
            }
            if (! $block->isContent() && ! $includeNonContent) {
                continue;
            }
            $result .= $block->getText()."\n";
        }

        return $result;
    }

    public function __toString(): string
    {
        $result = trim($this->getTitle())."\n";
        foreach ($this->textBlocks as $block) {
            $result .= trim($block)."\n";
        }

        return $result;
    }
}
