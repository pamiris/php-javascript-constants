<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace Pamiris\JavascriptConstants;

/**
 * Description of Mapper
 *
 * @author bryanagee
 */
class Mapper
{
    /**
     * 
     * @param string $classname
     * @param string $constantObjectName
     * @return string
     * @throws \Exception
     */
    public static function getJavascriptObject($classname, $constantObjectName = false)
    {
        if (!class_exists($classname)) {
            throw new \Exception(sprintf("JavascriptConstants: We can't seem to find a definition for %s;"
                    . " is your autoloader configured? ", $classname));
        }
        
        if (!$constantObjectName) {
            $classnameParts = explode("\\", $classname);
            $constantObjectName = end($classnameParts);
        }
        
        return self::writeJavascriptConstantObject($constantObjectName, self::getClassConstants($classname));
    }
    
    /**
     * 
     * @param string $classname
     * @return array
     */
    protected static function getClassConstants($classname)
    {
        $reflection = new \ReflectionClass($classname);
        $constants  = $reflection->getConstants();
        
        asort($constants);
        
        return $constants;
    }
    
    /**
     * 
     * @param string $objectName
     * @param array $constants
     * @return string
     */
    protected static function writeJavascriptConstantObject($objectName, $constants)
    {
        $definition = "const " . $objectName . " = "
            . json_encode($constants) . ";";
        
        return $definition;
    }
}
