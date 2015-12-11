<?php

namespace Vain\Presenters\Pagination;

use Illuminate\Pagination\BootstrapThreePresenter;

class BackendPresenter extends BootstrapThreePresenter
{
    /**
     * basicly an bootstrap presenter with small
     * pagination class, commonly used in admin lte.
     *
     * @return string
     */
    public function render()
    {
        if ($this->hasPages()) {
            return sprintf(
                '<ul class="pagination no-margin">%s %s %s</ul>',
                $this->getPreviousButton(),
                $this->getLinks(),
                $this->getNextButton()
            );
        }

        return '';
    }
}
