<?php

namespace core;

/**
 * Класс для загрузки файлов
 */
class FileUploader
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
     * Путь к корневой директории
     */
    public $basePath = null;
 
    /**
     * Загрузит файлы в папку с адресом 
     * $this->basePath + $addtionalPath
     *  --  и вернёт массив путей к файлам, начинающийся с $addtionalPath
     * 
     * @param type $files         -- массив в файлов как в $_FILES
     * @param type $this->basePath      -- Базовый путь (до $addtionalPath)
     * @param type $addtionalPath -- без слэгэй в начале и конце. Пусть начаная с которого нужно вернуть путь к загруженному файлу
     * @return type
     * @throws \Exception
     */
    public function uploadToRelativePath($files, $addtionalPath)
    {
//        \core\DebugPrinter::debug($files); die();
        $this->basePath = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'uploads';
        
        $result = [];
        foreach ($files['imageFile']['tmp_name'] as $key => $tmpFileName)
        {
            
            if (!empty($tmpFileName)) {
                
                $fileName = $files['imageFile']['name'][$key];
                $path = $this->basePath . '/' . $addtionalPath . '/' . $fileName;
                 $this->uploadFile($tmpFileName, $fileName, 
                         $this->basePath . '/' . $addtionalPath);
                $result[] = [
                     'filepath' => $addtionalPath . '/' . $fileName,
                     'filename' => $fileName
                ];
//                \core\DebugPrinter::debug($result);
            } else {
                break;
            }
        }
        return $result;
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
