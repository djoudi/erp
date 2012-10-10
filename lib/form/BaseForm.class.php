<?php

class BaseForm extends sfFormSymfony {
    
    public function setup() {
        
        unset($this['created_at']);
        unset($this['updated_at']);
        unset($this['deleted_at']);
        unset($this['version']);
        unset($this['creater_id']);
        unset($this['updater_id']);
        
    }
    
}
