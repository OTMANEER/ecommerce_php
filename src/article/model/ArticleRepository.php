<?php
interface ArticleRepository{

    public function getArticles($begin);
    public function getTotalPages();
    public function getCategories();
}