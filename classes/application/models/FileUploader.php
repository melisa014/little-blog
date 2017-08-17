<?php

namespace application\models;

/**
 * Description of FileUploader
 *
 * @author qwe
 */
class FileUploader extends \core\mvc\Model
{
    /**
     * Права доступа к папкам по умолчанию
     * @var int 
     */
    public $defaultFolderPermitions = 0777;
     
    /**
     * массив с относительными именами файлов
     * 
     * @var type 
     */
    public $uploadedFileNames = []; 
 
    /**
     * Загрузит файлы в папку с адресом 
     * $basePath + $addtionalPath
     *  --  и вернёт массив путей к файлам, начинающийся с $addtionalPath
     * 
     * @param type $files         -- массив в файлов как в $_FILES
     * @param type $basePath      -- Базовый путь (до $addtionalPath)
     * @param type $addtionalPath -- без слэгэй в начале и конце. Пусть начаная с которого нужно вернуть путь к загруженному файлу
     * @return type
     * @throws \Exception
     */
    public function uploadToRelativePath($files, $basePath, $addtionalPath)
    {
//        \core\DebugPrinter::debug($files); die();
        
        $result = [];
        foreach ($files['imageFile']['tmp_name'] as $key => $tmpFileName)
        {
            
            if (!empty($tmpFileName)) {
                
                $fileName = $files['imageFile']['name'][$key];
                $path = $basePath . '/' . $addtionalPath . '/' . $fileName;
                 $this->uploadFile($tmpFileName, $fileName, 
                         $basePath . '/' . $addtionalPath);
                $result[] = [
                     'filepath' => $addtionalPath . '/' . $fileName,
                     'filename' => $fileName
                ];
//                \core\DebugPrinter::debug($result);
                
                
            } else {
                break;
            }
              
        }
    }
    
        /**
     * Загрузит один файл
     * 
     * @param type $tmpFileName
     * @param type $fileName
     * @param type $uploadDirPath
     * @throws \Exception
     */
    public function uploadFile($tmpFileName, $fileName, $uploadDirPath)
    {
        $this->createDirIfNotExists($uploadDirPath);
        $filePath = $uploadDirPath . '/' . $fileName;        
        if (!move_uploaded_file($tmpFileName, $filePath)) {
            throw new \Exception("Cannot upload file: " . $filePath);
        }
    }
     
     
    /**
     * Создаст папку и все подпапки, если конечной не существует
     * 
     * @param type $path
     */
    public function createDirIfNotExists($path)
    {
        //echo $path; die();
        if (!file_exists($path)) {
            mkdir($path, $this->defaultFolderPermitions, true); 
        }
    }
}
