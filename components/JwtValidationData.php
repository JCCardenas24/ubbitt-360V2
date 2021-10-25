<?php

namespace app\components;

class JwtValidationData extends \sizeg\jwt\JwtValidationData
{

    /**
     * @inheritdoc
     */
    public function init()
    {
        $this->validationData->setIssuer('http://ubbitt360.com');
        $this->validationData->setAudience('*');
        $this->validationData->setId('5c6fg4aad3d');

        parent::init();
    }
}