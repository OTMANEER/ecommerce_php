<?php

interface AdminRepository{
    public function addArticle($article);
    public function addCategory($category);
    public function getCategories();
}