<?php

namespace App\Presenters;

use App\Model,
        Nette,
        Nette\Application\UI;

use Ciconia\Ciconia;
use Ciconia\Extension\Gfm;


class PostsPresenter extends Nette\Application\UI\Presenter
{
        private $ciconia;
        private $posts;

        public function __construct(Model\Posts $posts)
        {
                $this->posts = $posts;
                $this->ciconia = new Ciconia();
                $this->ciconia->addExtension(new Gfm\FencedCodeBlockExtension());
                $this->ciconia->addExtension(new Gfm\TaskListExtension());
                $this->ciconia->addExtension(new Gfm\InlineStyleExtension());
                $this->ciconia->addExtension(new Gfm\WhiteSpaceExtension());
                $this->ciconia->addExtension(new Gfm\TableExtension());
                $this->ciconia->addExtension(new Gfm\UrlAutoLinkExtension());
        }


        public function renderList($id)
        {
                $raw_article = $this->posts->findByName($id);
                $this->template->article = @$this->ciconia->render($raw_article);
        }

}
