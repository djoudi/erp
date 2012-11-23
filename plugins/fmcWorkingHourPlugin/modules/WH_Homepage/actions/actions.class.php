<?php

class WH_HomepageActions extends sfActions
{
    public function executeIndex (sfWebRequest $request)
    {
        $date = date ("Y-m-d");
        $url = $this->getController()->genUrl('@wh_my_day?date='.$date);
        $this->redirect ($url);
    }
}
