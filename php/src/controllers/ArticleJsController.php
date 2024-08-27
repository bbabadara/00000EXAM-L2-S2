<?php

namespace  Boutik\Controllers;

use Boutik\Core\Controller\CoreController;
use Boutik\Models\ArticleModel;

class ArticleJsController  extends CoreController
{
    private ArticleModel $articleModel;
    public function __construct()
    {
        parent::__construct();
        $this->articleModel = new ArticleModel();
    }
    public function load()
    {
        echo "Article from";
        parent::loadview("articles/liste");

    }
}
