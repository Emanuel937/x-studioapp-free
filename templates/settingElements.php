<?php
/**
 * Elementor Widget Admin List with Save Functionality
 *
 * Lists custom Elementor widgets, allows enabling/disabling them via toggles,
 * saves the state in WordPress options and reloads the saved state.
 */

// 1. Fetch Elementor widget manager and widgets
$widget_manager = \Elementor\Plugin::$instance->widgets_manager;
$widgets = $widget_manager->get_widget_types();

// 2. Fetch categories (slug => ['title' => '...'])
$category_manager = \Elementor\Plugin::$instance->elements_manager->get_categories();

// 3. Prepare arrays to store widget info and category list for filter dropdown
$xstudioappAllWidget = [];
$categories = [];

// 4. Get saved active widgets from DB (option)
$active_widgets = get_option('xstudioapp_active_widgets', []);

// 5. Process form submission for saving active widgets
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Verify nonce for security
    if (
        isset($_POST['xstudioapp_nonce']) &&
        wp_verify_nonce($_POST['xstudioapp_nonce'], 'xstudioapp_save_widgets')
    ) {
        $posted_active_widgets = $_POST['active_widgets'] ?? [];

        // Ensure it's an array and sanitize input
        if (is_array($posted_active_widgets)) {
            $posted_active_widgets = array_map('sanitize_text_field', $posted_active_widgets);
            // Save updated active widgets list in options
            update_option('xstudioapp_active_widgets', $posted_active_widgets);
            $active_widgets = $posted_active_widgets;

            // Show success notice
            echo '<div class="notice notice-success is-dismissible"><p>Settings saved successfully!</p></div>';
        }
    } else {
        // Show error notice on nonce failure
        echo '<div class="notice notice-error"><p>Security check failed. Please try again.</p></div>';
    }
}

// 6. Filter and collect custom widgets info
foreach ($widgets as $widget) {
    if (strpos(get_class($widget), 'XStudioApp\\Widgets\\') === 0) {
        $cat_slugs = $widget->get_categories();
        $cat_titles = [];

        foreach ($cat_slugs as $slug) {
            if (isset($category_manager[$slug])) {
                $cat_titles[] = $category_manager[$slug]['title'];
                $categories[$slug] = $category_manager[$slug]['title'];
            } else {
                $cat_titles[] = $slug;
                if (!isset($categories[$slug])) {
                    $categories[$slug] = $slug;
                }
            }
        }

        $xstudioappAllWidget[] = [
            'name' => $widget->get_name(),
            'title' => $widget->get_title(),
            'icon' => $widget->get_icon(),
            'categories_slugs' => $cat_slugs,
            'category' => implode(', ', $cat_titles),
        ];
    }
}

// 7. Sort categories by display title for dropdown
asort($categories);
?>

<style>
    /* Toggle Switch Styles */
    .switch {
        position: relative;
        display: inline-block;
        width: 40px;
        height: 20px;
    }
    .switch input {
        opacity: 0;
        width: 0; height: 0;
    }
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0; left: 0; right: 0; bottom: 0;
        background-color: #ccc;
        transition: 0.4s;
        border-radius: 34px;
    }
    .slider:before {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        left: 2px; bottom: 2px;
        background-color: white;
        transition: 0.4s;
        border-radius: 50%;
    }
    input:checked + .slider {
        background-color: #007cba;
    }
    input:checked + .slider:before {
        transform: translateX(20px);
    }
    /* Header Layout */
    header.plugin-header {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
        margin-bottom: 20px;
        align-items: center;
    }
    header.plugin-header input[type="search"],
    header.plugin-header select {
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        font-size: 14px;
        transition: border-color 0.3s ease;
    }
    header.plugin-header input[type="search"]:focus,
    header.plugin-header select:focus {
        border-color: #007cba;
        outline: none;
        box-shadow: 0 0 5px rgba(0, 124, 186, 0.5);
    }
    header.plugin-header button.save-button {
        background-color: #007cba;
        color: white;
        border: none;
        padding: 6px 15px;
        border-radius: 3px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    header.plugin-header button.save-button:hover {
        background-color: #005a8c;
    }
</style>

<div class="wrap">
    <h1>Welcome to My Plugin</h1>
    <p>This is the admin page for managing your Elementor widgets.</p>

    <!-- Form wrapping inputs to submit widget states -->
    <form method="post" action="">
        <?php wp_nonce_field('xstudioapp_save_widgets', 'xstudioapp_nonce'); ?>

        <header class="plugin-header" role="search">
            <input
                id="searchInput"
                type="search"
                placeholder="Search elements..."
                aria-label="Search Elementor widgets"
                autocomplete="off"
            />

            <select id="categoryFilter" aria-label="Filter widgets by category">
                <option value="">All Categories</option>
                <?php foreach ($categories as $slug => $title): ?>
                    <option value="<?= esc_attr($slug) ?>"><?= esc_html($title) ?></option>
                <?php endforeach; ?>
            </select>

            <button type="submit" class="save-button" aria-label="Save widget settings">Save</button>
        </header>

        <table id="elementsTable" class="wp-list-table widefat fixed striped" aria-describedby="widgetTableDescription">
            <caption id="widgetTableDescription" class="screen-reader-text">List of Elementor widgets with filtering options</caption>
            <thead>
                <tr>
                    <th scope="col">Element</th>
                    <th scope="col">Category</th>
                    <th scope="col">Status</th>
                    <th scope="col">Usage</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($xstudioappAllWidget as $widget): ?>
                    <tr data-categories="<?= esc_attr(implode(' ', $widget['categories_slugs'])) ?>">
                        <td>
                            <?php if (!empty($widget['icon'])): ?>
                                <i class="<?= esc_attr($widget['icon']) ?>" style="margin-right:8px; vertical-align:middle;" aria-hidden="true"></i>
                            <?php endif; ?>
                            <?= esc_html($widget['title'] ?? $widget['name']) ?>
                        </td>
                        <td><?= esc_html($widget['category']) ?></td>
                        <td>
                            <label class="switch" title="Toggle widget activation">
                                <input
                                    type="checkbox"
                                    name="active_widgets[]"
                                    value="<?= esc_attr($widget['name']) ?>"
                                    aria-checked="<?= in_array($widget['name'], $active_widgets) ? 'true' : 'false' ?>"
                                    role="switch"
                                    <?= in_array($widget['name'], $active_widgets) ? 'checked' : '' ?>
                                />
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>—</td> <!-- Placeholder for usage -->
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>

<script>
(function() {
    const searchInput = document.getElementById('searchInput');
    const categoryFilter = document.getElementById('categoryFilter');
    const tableBody = document.querySelector('#elementsTable tbody');
    const rows = tableBody.getElementsByTagName('tr');

    // Filter table rows based on search term and selected category
    function filterTable() {
        const searchTerm = searchInput.value.toLowerCase().trim();
        const selectedCategory = categoryFilter.value.toLowerCase();

        Array.from(rows).forEach(row => {
            const titleCell = row.cells[0];
            const categoryData = row.getAttribute('data-categories').toLowerCase();

            const matchesSearch = titleCell.textContent.toLowerCase().includes(searchTerm);
            const matchesCategory = selectedCategory === '' || categoryData.includes(selectedCategory);

            row.style.display = (matchesSearch && matchesCategory) ? '' : 'none';
        });
    }

    searchInput.addEventListener('input', filterTable);
    categoryFilter.addEventListener('change', filterTable);
})();
</script>
