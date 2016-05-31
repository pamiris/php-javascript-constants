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
    public static function getJavascriptConstants($classname, $constantObjectName = false)
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
    
    protected static function getClassConstants($classname)
    {
        $reflection = new \ReflectionClass($classname);
        $constants  = $reflection->getConstants();
        
        asort($constants);
        
        return $constants;
    }
    
    protected static function writeJavascriptConstantObject($objectName, $constants)
    {
        $definition = "const " . $objectName . " = "
            . json_encode($constants) . ";";
        
        return $definition;
    }
}
