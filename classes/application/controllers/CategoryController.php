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
    public function indexAdminAction()
    {

        $Category = new Category();

        $this->viewCategory = $Category->getById($_GET['id']);
        
        $this->view->addVar('viewCategory', $this->viewCategory);
        
        $this->view->render('category/indexAdmin.php');
    }
    
    /**
     * Выводит на экран форму для создания новой статьи (только для Администратора)
     */
    public function addAdminAction()
    {
        if (!empty($_POST)) {
            if ($_POST['saveNewCategory'] == 'Сохранить') {
                $Category = new Category();
                $newCategory = $Category->loadFromPost();
                \DebugPrinter::debug($newCategory);
                $newCategory->insert();
                \DebugPrinter::debug($newCategory, 'после инсерта');
                $this->header('/index.php?action=homepage/index');
            
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header("/index.php?action=homepage/index");
            }
        }
        else {
            $this->addCategoryTitle = "Создание категории";
            $this->view->addVar('addCategoryTitle', $this->addCategoryTitle);
            
            $this->view->render('category/addAdmin.php');
        }
    }
    
    /**
     * Выводит на экран форму для редактирования статьи (только для Администратора)
     */
    public function editAdminAction()
    {
        $id = $_GET['id'];
        
//        \DebugPrinter::debug($_POST);
//        \DebugPrinter::debug($id);
        
        if (!empty($_POST)) {
            if ($_POST['saveChanges'] == 'Сохранить') {
                $Category = new Category();
                $newCategory = $Category->loadFromPost();
                $newCategory->update();
                $this->header("index.php?action=category/index&id=$id");
            } 
            elseif ($_POST['cancel'] == 'Назад') {
                $this->header("index.php?action=category/index&id=$id");
            }
        }
        else {
            $Category = new Category();
            $this->viewCategory = $Category->getById($id);
            $this->editCategoryTitle = "Редактирование категории";
//            \DebugPrinter::debug($this->viewArticle);
            
            $this->view->addVar('viewCategory', $this->viewCategory);
            $this->view->addVar('editCategoryTitle', $this->editCategoryTitle);
            
            $this->view->render('category/editAdmin.php');   
        }
    }
    
    /**
     * Выводит на экран предупреждение об удалении данных (только для Администратора)
     */
    public function deleteAdminAction()
    {
        $id = $_GET['id'];
        
        if (!empty($_POST)) {
            if ($_POST['deleteCategory'] == 'Удалить') {
                $Category = new Category();
                $newCategory = $Category->loadFromPost();
                $newCategory->delete();
                $this->header('index.php?action=homepage/index');
              
            }
            elseif ($_POST['cancel'] == 'Вернуться') {
                $this->header("index.php?action=category/edit&id=$id");
            }
        }
        else {
            $this->deleteCategoryTitle = "Удаление категории";
            $this->view->addVar('deleteCategoryTitle', $this->deleteCategoryTitle);
            
            $this->view->render('category/deleteAdmin.php');
        }
    }
}

