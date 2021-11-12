<?php

namespace UPFlex\MixUp\Core;

use UPFlex\MixUp\Core\Interfaces\IPostTypes;

abstract class PostType extends Base implements IPostTypes
{
    private array $args = [];
    private string $icon = '';
    private bool $male = true;
    private string $name;
    private string $plural;
    private string $singular;
    private string $slug = '';
    private array $supports = ["title", "thumbnail"];

    /**
     * @return array
     */
    public function getArgs(): array
    {
        return $this->args;
    }

    /**
     * @return string
     */
    public function getIcon(): string
    {
        return $this->icon;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getPlural(): string
    {
        return $this->plural;
    }

    /**
     * @return string
     */
    public function getSingular(): string
    {
        return $this->singular;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @return array
     */
    public function getSupports(): array
    {
        return $this->supports;
    }

    /**
     * @return bool
     */
    public function isMale(): bool
    {
        return $this->male;
    }

    /**
     * @param array $args
     */
    public function setArgs(array $args): void
    {
        $this->args = $args;
    }

    /**
     * @param string $icon
     */
    public function setIcon(string $icon): void
    {
        $this->icon = $icon;
    }

    /**
     * @param bool $male
     */
    public function setMale(bool $male): void
    {
        $this->male = $male;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $plural
     */
    public function setPlural(string $plural): void
    {
        $this->plural = $plural;
    }

    /**
     * @param string $singular
     */
    public function setSingular(string $singular): void
    {
        $this->singular = $singular;
    }

    /**
     * @param string $slug
     */
    public function setSlug(string $slug): void
    {
        $this->slug = $slug;
    }

    /**
     * @param array $supports
     */
    public function setSupports(array $supports): void
    {
        $this->supports = $supports;
    }

    public function register(): void
    {
        $labels = [
            "name" => $this->getPlural(),
            "singular_name" => $this->getSingular(),
            "menu_name" => $this->getPlural(),
            "all_items" => $this->isMale() ? "Todos os {$this->getPlural()}" : "Todos as {$this->getPlural()}",
            "add_new" => $this->isMale() ? 'Adicionar novo' : 'Adicionar nova',
            "add_new_item" => $this->isMale() ? "Adicionar novo {$this->getSingular()}" : "Adicionar nova {$this->getSingular()}",
            "edit_item" => "Editar {$this->getSingular()}",
            "new_item" => $this->isMale() ? "Novo {$this->getSingular()}" : "Nova {$this->getSingular()}",
            "view_item" => "Ver {$this->getSingular()}",
            "view_items" => "Ver {$this->getPlural()}",
            "search_items" => "Pesquisar {$this->getPlural()}",
            "not_found" => $this->isMale() ? "Nenhum {$this->getSingular()} encontrado" : "Nenhuma {$this->getSingular()} encontrada",
            "not_found_in_trash" => $this->isMale() ? "Nenhum {$this->getSingular()} encontrado na lixeira" : "Nenhuma {$this->getSingular()} encontrada na lixeira",
            "parent" => "{$this->getSingular()} ascendente",
            "featured_image" => $this->isMale() ? "Imagem destacada para esse {$this->getSingular()}" : "Imagem destacada para essa {$this->getSingular()}",
            "set_featured_image" => $this->isMale() ? "Definir imagem destacada para esse {$this->getSingular()}" : "Definir imagem destacada para essa {$this->getSingular()}",
            "remove_featured_image" => $this->isMale() ? "Remover imagem destacada para esse {$this->getSingular()}" : "Remover imagem destacada para essa {$this->getSingular()}",
            "use_featured_image" => $this->isMale() ? "Usar como imagem destacada para esse {$this->getSingular()}" : "Usar como imagem destacada para essa {$this->getSingular()}",
            "archives" => $this->isMale() ? "Arquivos do {$this->getSingular()}" : "Arquivos da {$this->getSingular()}",
            "insert_into_item" => $this->isMale() ? "Inserir no {$this->getSingular()}" : "Inserir na {$this->getSingular()}",
            "uploaded_to_this_item" => $this->isMale() ? "Enviar para esse {$this->getSingular()}" : "Enviar para essa {$this->getSingular()}",
            "filter_items_list" => "Filtrar lista de {$this->getPlural()}",
            "items_list_navigation" => "Navegação na lista de {$this->getPlural()}",
            "items_list" => "Lista de {$this->getPlural()}",
            "attributes" => "Atributos de {$this->getPlural()}",
            "name_admin_bar" => $this->getSingular(),
            "item_published" => $this->isMale() ? "{$this->getSingular()} publicado" : "{$this->getSingular()} publicada",
            "item_published_privately" => $this->isMale() ? "{$this->getSingular()} publicado de forma privada." : "{$this->getSingular()} publicada de forma privada.",
            "item_reverted_to_draft" => $this->isMale() ? "{$this->getSingular()} revertido para rascunho." : "{$this->getSingular()} revertida para rascunho.",
            "item_scheduled" => $this->isMale() ? "{$this->getSingular()} agendado" : "{$this->getSingular()} agendada",
            "item_updated" => $this->isMale() ? "{$this->getSingular()} atualizado." : "{$this->getSingular()} atualizada.",
            "parent_item_colon" => "{$this->getSingular()} ascendente:",
        ];

        $args = [
            "label" => $this->getPlural(),
            "labels" => $labels,
            "description" => "",
            "public" => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => true,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "has_archive" => false,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "delete_with_user" => false,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => ["slug" => strlen($this->getSlug()) > 0 ? $this->getSlug() : $this->getName(), "with_front" => true],
            "query_var" => true,
            "menu_icon" => $this->getIcon(),
            "supports" => $this->getSupports(),
            "show_in_graphql" => false,
        ];

        register_post_type($this->getName(), array_merge($args, array_filter($this->getArgs())));
    }
}