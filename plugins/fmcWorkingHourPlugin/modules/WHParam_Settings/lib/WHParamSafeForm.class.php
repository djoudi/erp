<?php

class WHParamSafeForm extends WorkingHourParameterForm
{
    public function configure()
    {
        unset($this['param']);
    }
}
