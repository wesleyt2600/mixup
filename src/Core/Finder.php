<?php

namespace UPFlex\MixUp\Core;

abstract class  Finder
{
    // Directory that contains composer.json
    const APP_ROOT = __DIR__ . '/../../';
    const SEPARATOR = '\\';

    /**
     * @param $namespace
     * @return array
     */
    public static function getClassesInNamespace($namespace): array
    {
        $namespace_dir = self::getNamespaceDirectory($namespace);

        if ($namespace_dir) {

            $files = scandir($namespace_dir);

            $classes = array_map(function ($file) use ($namespace) {
                return $namespace . self::SEPARATOR . str_replace('.php', '', $file);
            }, $files);

            return array_filter($classes, fn($possibleClass) => class_exists($possibleClass));
        }

        return [];
    }

    /**
     * @return array
     */
    private static function getDefinedNamespaces(): array
    {
        $composerJsonPath = self::APP_ROOT . 'composer.json';
        $composerConfig = json_decode(file_get_contents($composerJsonPath), true);

        return $composerConfig['autoload']['psr-4'] ?? [];
    }

    /**
     * @param $namespace
     * @return string
     */
    private static function getNamespaceDirectory($namespace): string
    {
        $composerNamespaces = self::getDefinedNamespaces();

        if ($composerNamespaces) {

            $namespaceFragments = explode(self::SEPARATOR, $namespace);
            $undefinedNamespaceFragments = [];

            while ($namespaceFragments) {
                $possibleNamespace = implode(self::SEPARATOR, $namespaceFragments) . self::SEPARATOR;

                if (array_key_exists($possibleNamespace, $composerNamespaces)) {
                    return realpath(self::APP_ROOT . $composerNamespaces[$possibleNamespace] . implode('/', $undefinedNamespaceFragments));
                }

                array_unshift($undefinedNamespaceFragments, array_pop($namespaceFragments));
            }

        }

        return false;
    }
}