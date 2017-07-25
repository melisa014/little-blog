<?php
namespace application\controllers;
use \application\models\Category as Category;

class CategoryController extends \core\Controller
{ 
    /**
     * Выводит на экран страницу "Категория" для просмотра
     */
    public function indexAction()
    {

        $Category = new Category();

        $this->viewCategory = $Category->getById($_GET['id']);
        
        $this->view->addVar('viewCategory', $this->viewCategory);
        
        $this->view->render('category/index.php');
    }
    
    /**
     * Выводит на экран страницу "Категоия" для просмотра Администратору
     */
//    public function indexAdminAction()
//    {
//
//        $Category = new Category();
//
//        $this->viewCategory = $Category->getById($_GET['id']);
//        
//        $this->view->addVar('viewCategory', $this->viewCategory);
//        
//        $this->view->headerFilePath = 'headerAdmin.php';
//        $this->view->render('category/indexAdmin.php');
//    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAction()
    {
        if (!empty($_POST)) {
            if ($_POST['saveNewCategory'] == 'Сохранить') {
                $Category = new Category();
                $newCategory = $Category->loadFromPost();
                \DebugPrinter::debug($newCategory);
                $newCategory->insert();
                \DebugPrinter::debug($newCategory, 'после инсерта');
                $this->header(\Url::link("homepage/index"));
            
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header(\Url::link("homepage/index"));
            }
        }
        else {
            $this->addCategoryTitle = "Создание категории";
            $this->view->addVar('addCategoryTitle', $this->addCategoryTitle);
            
            $this->view->render('category/add.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAction()
    {
        $id = $_GET['id'];
        
//        \DebugPrinter::debug($_POST);
//        \DebugPrinter::debug($id);
        
        if (!empty($_POST)) {
            if ($_POST['saveChanges'] == 'Сохранить') {
                $Category = new Category();
                $newCategory = $Category->loadFromPost();
                $newCategory->update();
                $this->header(\Url::link("category/index&id=$id"));
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header(\Url::link("category/index&id=$id"));
            }
        }
        else {
            $Category = new Category();
            $this->viewCategory = $Category->getById($id);
            $this->editCategoryTitle = "Редактирование категории";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewCategory', $this->viewCategory);
            $this->view->addVar('editCategoryTitle', $this->editCategoryTitle);
            
            $this->view->render('category/edit.php');   
        }
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAction()
    {
        $id = $_GET['id'];
        
        if (!empty($_POST)) {
            if ($_POST['deleteCategory'] == 'Удалить') {
                $Category = new Category();
                $newCategory = $Category->loadFromPost();
                $newCategory->delete();
                $this->header(\Url::link("homepage/index"));
              
            }
            elseif ($_POST['cancel'] == 'Вернуться') {
                $this->header(\Url::link("category/edit&id=$id"));
            }
        }
        else {
            $this->deleteCategoryTitle = "Удаление категории";
            $this->view->addVar('deleteCategoryTitle', $this->deleteCategoryTitle);
            
            $this->view->render('category/delete.php');
        }
    }
}

