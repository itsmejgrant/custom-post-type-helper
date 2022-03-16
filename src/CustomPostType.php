<?php

namespace Itsmejgrant\CustomPostTypeHelper;

/**
 * A tidy helper class for cleanly creating custom post types
 *
 * @param string $name
 * @param array $labels
 * @param array $args
 */
class CustomPostType {
    protected string $name;
    protected array $labels;
    protected array $args;

    /**
     * Load everything
     *
     * @param String $name
     * @param Array $labels
     * @param Array $args
     */
    public function __construct(String $name = '', array $labels = [], array $args = []) {
        // Bind variables
        $this->name = $name;
        $this->labels = $labels;
        $this->args = $args;

        if (empty($this->name)) {
            throw new Exception('A name for the post type is required.');
        }

        // Set defaults if none are passed
        if (empty($this->labels) || !$this->__is_associative_array($this->labels)) {
            $this->__set_default_labels();
        }

        if (empty($this->args) || !$this->__is_associative_array($this->args)) {
            $this->__set_default_args();
        }

        $this->__register_post($this->name);
    }

    /**
     * Update the labels for post type
     *
     * @throws Exception if the arguments are not valid or the array key does not exist
     *
     * @return void
     */
    public function set_labels(array $labels = []): void {
        // Not valid, throw an error
        if (empty($labels) || !$this->__is_associative_array($labels)) {
            throw new Exception('Please provide a valid list arguments');
        }

        foreach ($labels as $key => $label) {
            if (!array_key_exists($key, $this->labels)) {
                throw new Exception('Array key does not exist. Please check you are using a valid key');
            }
        }

        $updated_labels = array_replace($this->labels, $labels);
        $this->set_args(['labels' => $updated_labels]);
    }

    /**
     * If no labels are passed in, set some defaults based on the name
     *
     * @return void
     */
    protected function __set_default_labels(): void {
        $this->labels = array(
            "name" => _x("$this->name", "Post Type General Name"),
            "singular_name" => _x(rtrim($this->name, "s"), "Post Type Singular Name"),
            "menu_name" => __("$this->name"),
            "parent_item_colon" => __("Parent $this->name"),
            "all_items" => __("All Items"),
            "view_item" => __("View $this->name"),
            "add_new_item" => __("Add New $this->name"),
            "add_new" => __("Add New"),
            "edit_item" => __("Edit $this->name"),
            "update_item" => __("Update $this->name"),
            "search_items" => __("Search $this->name"),
            "not_found" => __("Not Found"),
            "not_found_in_trash" => __("Not found in Trash"),
        );
    }

    /**
     * Update the arguments for the post type
     *
     * @throws Exception if the arguments are not valid or the array key does not exist
     *
     * @return void
     */
    public function set_args(array $args = []): void {
        // Not valid, throw an error
        if (empty($args) || !$this->__is_associative_array($args)) {
            throw new Exception('Please provide a valid list arguments');
        }

        foreach ($args as $key => $arg) {
            if (!array_key_exists($key, $this->args)) {
                throw new Exception('Array key does not exist. Please check you are using a valid key');
            }
        }

        // Replace and re-register
        $this->args = array_replace($this->args, $args);
        register_post_type($this->name, $this->args);
    }

    /**
     * If no args are passed in, set some defaults
     *
     * @return void
     */
    protected function __set_default_args(): void {
        $this->args = array(
            "label" => __($this->name),
            "labels" => $this->labels,
            "supports" => array("title", "editor", "excerpt", "author", "thumbnail", "comments", "revisions", "custom-fields"),
            "taxonomies" => array("categories"),
            "hierarchical" => false,
            "public" => true,
            "show_ui" => true,
            "show_in_menu" => true,
            "show_in_nav_menus" => true,
            "show_in_admin_bar" => true,
            "menu_position" => 5,
            "can_export" => true,
            "has_archive" => true,
            "exclude_from_search" => false,
            "publicly_queryable" => true,
            "capability_type" => "page",
            "show_in_rest" => true,
            "rewrite" => true,
        );
    }

    /**
     * Register the custom post type
     *
     * @return void
     */
    protected function __register_post(): void {
        register_post_type($this->name, $this->args);
    }

    /**
     * Checks if an array is associative. Return value of 'False' indicates a sequential array.
     *
     * @param array $input_array
     * @return bool
     */
    protected function __is_associative_array(array $input_array = null): bool {
        // An empty array is in theory a valid associative array
        // so we return 'true' for empty.
        if ($input_array === []) {
            return true;
        }

        $array_count = count($input_array);
        for ($i = 0; $i < $array_count; $i++) {
            if (!array_key_exists($i, $input_array)) {
                return true;
            }
        }

        // Dealing with a Sequential array
        return false;
    }
}
