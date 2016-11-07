 <?php
 require_once(ROOT . DS . 'config' . DS . 'functions.php');
 require_once(ROOT . DS . 'config' . DS . 'config.php');

 function __autoload($class_name)
 {
     $className = ucfirst(strtolower($class_name)); // normalize className
     $controllerClassName = str_replace('controller', '', $className) . 'Controller';
     $ext = '.php';
     $libPath = LIB_PATH . $className . '.lib' . $ext;
     $modelsPath = MODELS_PATH . $className . $ext;
     $controllersPath = CONTROLLERS_PATH . $controllerClassName . $ext;

     foreach([$libPath, $modelsPath, $controllersPath] as $path)
     {
         if(file_exists($path)) {
             require_once($path);
             return;
         }
     }
     throw new Exception( 'Filed to include class' . $className);
 }
