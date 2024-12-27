<?php
class HeroCreation {
    public static $classes;

    public function __construct() {
        $this->classes = self::getAllClasses();
    }

    public static function getAllClasses() {
        require_once '../base/Database.php';
        $base = $GLOBALS["base"];
        $result = $base->request("SELECT * FROM Class");
        return $result;
    }

    public static function printClassesTemplate($classes) {
        $templatePath = "../template/classTemplate.php";

        if (!file_exists($templatePath)) {
            throw new Exception("Le template n'existe pas (c'est un bug).");
        }

        foreach ($classes as $class) {
            extract($class);
            ob_start();
            include $templatePath;
            echo ob_get_clean();
        }
    }
}
?>
