<?php

namespace App\Model;

use Nette;


class Posts extends Nette\Object
{
        public function __construct()
        {
        }

        public function findByName($name)
        {
                if (!preg_match('/[a-zA-Z\-\_]+/', $name)) {
                        return null;
                }

                $path = __DIR__ . '/../../data/posts/' . $name . '.md';

                if (!file_exists($path)) {
                        return null;
                } else {
                        return file_get_contents($path);
                }
        }

        public function findAll()
        {
                return array_map(function($val){
                        return str_replace('.md', '', basename($val));
                }, glob($path = __DIR__ . '/../../data/posts/*.md'));
        }
}
