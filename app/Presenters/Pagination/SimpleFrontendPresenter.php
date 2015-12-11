<?php

namespace Vain\Presenters\Pagination;

use Illuminate\Pagination\SimpleBootstrapThreePresenter;

class SimpleFrontendPresenter extends SimpleBootstrapThreePresenter
{
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<div class="paging clearfix">%s %s</div>',
                $this->getPreviousButton(trans('pagination.newer')),
                $this->getNextButton(trans('pagination.older'))
            );
        }

        return '';
    }

    public function getPreviousButton($text = '&laquo;')
    {
        // If the current page is less than or equal to one, it means we can't go any
        // further back in the pages, so we will render a disabled previous button
        // when that is the case. Otherwise, we will give it an active "status".
        if ($this->paginator->currentPage() <= 1) {
            return '';
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() - 1
        );

        $markup = '<a class="btn pull-left" href="%s">
            <i class="icon-arrow-left2 left"></i>
            <span>%s</span><span class="hidden-xs"> %s</span>
            </a>';

        return sprintf($markup, $url, $text, trans('pagination.entries'));
    }

    public function getNextButton($text = '&raquo;')
    {
        // If the current page is greater than or equal to the last page, it means we
        // can't go any further into the pages, as we're already on this last page
        // that is available, so we will make it the "next" link style disabled.
        if (!$this->paginator->hasMorePages()) {
            return '';
        }

        $url = $this->paginator->url(
            $this->paginator->currentPage() + 1
        );

        $markup = '<a class="btn pull-right" href="%s">
            <span>%s</span><span class="hidden-xs"> %s</span>
            <i class="icon-arrow-right2 right"></i>
            </a>';

        return sprintf($markup, $url, $text, trans('pagination.entries'));
    }
}
