<?php

namespace Vain\Presenters\Menu;

use Knp\Menu\ItemInterface;
use Knp\Menu\Matcher\Matcher;
use Knp\Menu\Matcher\Voter\UriVoter;
use Knp\Menu\Renderer\ListRenderer;
use Vain\Packages\Menu\Matcher\RouteVoter;

abstract class VainPresenter extends ListRenderer
{
    /**
     * inject our config and custom matcher.
     */
    public function __construct()
    {
        $matcher = new Matcher();
        $matcher->addVoter(new UriVoter(app('url')->current()));
        $matcher->addVoter(new RouteVoter(app('request')));

        $options = config('menu.render');

        parent::__construct($matcher, $options);
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    abstract protected function renderIconElement(ItemInterface $item, array $options = []);

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    abstract protected function renderFoldingElement(ItemInterface $item, array $options = []);

    /**
     * @param ItemInterface $item
     * @param array         $options
     */
    protected function renderRootElement(ItemInterface $item, array $options = [])
    {
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    public function render(ItemInterface $item, array $options = [])
    {
        $this->renderRootElement($item, $options);

        return parent::render($item, $options);
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderIcon(ItemInterface $item, array $options = [])
    {
        if ($item->getExtra('icon', null) !== null) {
            return $this->renderIconElement($item, $options);
        }

        return '';
    }

    /**
     * unless 'raw' extra isn't set to true, we try to translate the label.
     *
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderLabel(ItemInterface $item, array $options)
    {
        if ($options['allow_safe_labels'] && $item->getExtra('safe_label', false)) {
            return $item->getLabel();
        }

        if ($item->getExtra('raw', false) !== false) {
            return $this->escape($item->getLabel());
        }

        return $this->escape(trans($item->getLabel()));
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderFolding(ItemInterface $item, array $options = [])
    {
        if ($item->hasChildren()) {
            return $this->renderFoldingElement($item, $options);
        }

        return '';
    }
}
