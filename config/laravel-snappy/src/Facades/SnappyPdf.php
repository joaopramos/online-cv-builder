<?php
namespace Barryvdh\Snappy\Facades;

use Illuminate\Support\Facades\Facade as BaseFacade;

class SnappyPdf extends BaseFacade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'snappy.pdf.wrapper'; }


}