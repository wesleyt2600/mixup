<?php

namespace UPFlex\MixUp\Core;

use UPFlex\MixUp\Core\Finder;

abstract class SelfInstance
{
    /**
     * @param string $namespace
     * @param string $parent_class
     * @param array $classes_array [variableNameInFunction => $class]
     * @return bool
     * @throws \ReflectionException
     */
    public static function run(string $namespace, string $parent_class, array $classes_array = []): bool
    {
        $classes = Finder::getClassesInNamespace($namespace);
        $class_child_params = [];

        if (!$classes) {
            return false;
        }

        foreach ($classes as $class) {
            if (is_subclass_of($class, $parent_class)) {
                if (call_user_func([$class, 'isSelfInstance'])) {

                    // Get info class
                    $reflection = new \ReflectionClass($class);
                    $constructor = $reflection->getConstructor();
                    $const_params = $constructor->getParameters();

                    // Define parameters
                    foreach ($const_params as $param) {
                        $class_child_params[] = $classes_array[$param->name] ?? null;
                    }

                    // Filter
                    $class_child_params = array_filter($class_child_params);

                    // Check parameters
                    if (count($const_params) <= count($class_child_params)) {
                        $child_class = new $class(...$class_child_params);
                        return $child_class->getInstance();
                    } elseif (defined('WP_DEBUG') && true === WP_DEBUG) { // Write log
                        error_log(sprintf('%s %s', __('Parameters were not set correctly. Class:'), $class));
                    }
                }
            }
        }

        return true;
    }
}