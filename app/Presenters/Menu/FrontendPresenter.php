<?php

namespace Vain\Presenters\Menu;

use Knp\Menu\ItemInterface;

class FrontendPresenter extends VainPresenter
{
    protected function renderList(ItemInterface $item, array $attributes, array $options)
    {
        /*
         * Return an empty string if any of the following are true:
         *   a) The menu has no children eligible to be displayed
         *   b) The depth is 0
         *   c) This menu item has been explicitly set to hide its children
         */
        if (!$item->hasChildren() || 0 === $options['depth'] || !$item->getDisplayChildren()) {
            return '';
        }

        if ($item->getLevel() === 0) {
            // in the first level we do not need a wrapping ul-tag
            return $this->renderChildren($item, $options);
        }

        // for all deeper levels render list normally
        return parent::renderList($item, $attributes, $options);
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderItem(ItemInterface $item, array $options)
    {
        // if we don't have access or this item is marked to not be shown
        if (!$item->isDisplayed()) {
            return '';
        }

        // create an array than can be imploded as a class list
        $class = (array) $item->getAttribute('class');

        if ($this->matcher->isCurrent($item)
            || $this->matcher->isAncestor($item, $options['matchingDepth'])
        ) {
            $class[] = $options['currentClass'];
        }

        if ($item->hasChildren()) {
            $class[] = 'submenu';
        }

        // retrieve the attributes and put the final class string back on it
        $attributes = $item->getAttributes();
        if (!empty($class)) {
            $attributes['class'] = implode(' ', $class);
        }

        // opening li tag
        $html = $this->format(
            '<li'.$this->renderHtmlAttributes($attributes).'>',
            'li',
            $item->getLevel(),
            $options
        );

        // render the text/link inside the li tag
        $html .= $this->renderLink($item, $options);

        // renders the embedded ul
        $childrenClass = (array) $item->getChildrenAttribute('class');
        $childrenClass[] = 'submenu-list';

        $childrenAttributes = $item->getChildrenAttributes();
        $childrenAttributes['class'] = implode(' ', $childrenClass);

        $html .= $this->renderList($item, $childrenAttributes, $options);

        // closing li tag
        $html .= $this->format('</li>', 'li', $item->getLevel(), $options);

        return $html;
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderLinkElement(ItemInterface $item, array $options)
    {
        return sprintf(
            '<a href="%s"%s>%s%s%s</a>',
            $this->escape($item->getUri()),
            $this->renderHtmlAttributes($item->getLinkAttributes()),
            $this->renderIcon($item, $options),
            $this->renderLabel($item, $options),
            $this->renderFolding($item, $options)
        );
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

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderIconElement(ItemInterface $item, array $options = [])
    {
        return sprintf('<i class="fa fa-%s"></i>', $item->getExtra('icon'));
    }

    /**
     * @param ItemInterface $item
     * @param array         $options
     *
     * @return string
     */
    protected function renderFoldingElement(ItemInterface $item, array $options = [])
    {
        return '<b class="caret"></b>';
    }
}
