<?php

$templateAllType = ["header", "footer", "single"];
// Liste des types possibles
if ($_SERVER['REQUEST_METHOD'] === 'POST' && check_admin_referer('xstudioapp_save_widgets', 'xstudioapp_nonce')) {

    // Si le bouton Add new est cliqué
    if (isset($_POST['add_template'])) {
        $templateName = sanitize_text_field($_POST['templateName'] ?? '');
        $templateType = sanitize_text_field($_POST['templateType'] ?? '');
        if (!empty($templateName) && !empty($templateType)) {
            Template::createTemplate($templateName, $templateType);
        }
    }

    // Sauvegarde des toggles
    if (isset($_POST['save_toggle'])) {
        $activeWidgets = $_POST['active_widgets'] ?? [];

        // Réinitialiser tous les statuts
         Template::handleActivationToggle(array_keys($_POST['active_template'] ?? []));

        // Compter les activés par type
        $activatedPerType = [];

        foreach ($activeWidgets as $templateId => $type) {
            $templateId = intval($templateId);
            if (!isset($activatedPerType[$type])) {
                $activatedPerType[$type] = [];
            }
            $activatedPerType[$type][] = $templateId;
        }

        foreach ($activatedPerType as $type => $ids) {
            if (count($ids) === 1) {
                update_post_meta($ids[0], '_xsa_is_active', '1');
                update_option("xsa_active_{$type}_template", $ids[0]);
            } else {
                // Si plusieurs ou aucun => use default WordPress
                update_option("xsa_active_{$type}_template", null);
            }
        }
    }
}

 $allTemplate = Template::allTemplateList();







?>


<style>
/* === STYLES GÉNÉRAUX === */
.wrap {
    padding: 20px;
    background: #fff;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0,0,0,0.05);
    font-family: sans-serif;
}

h1 {
    font-size: 24px;
    margin-bottom: 5px;
}

p {
    margin-bottom: 20px;
    color: #666;
}

/* === EN-TÊTE DU FORMULAIRE === */
header.plugin-header {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
    margin-bottom: 20px;
    align-items: center;
}

header.plugin-header input[type="search"],
header.plugin-header select {
    padding: 6px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
}

header.plugin-header button.save-button {
    background-color: #007cba;
    color: white;
    border: none;
    padding: 8px 16px;
    border-radius: 4px;
    font-size: 14px;
    cursor: pointer;
    transition: background-color 0.2s ease-in-out;
}

header.plugin-header button.save-button:hover {
    background-color: #005a8c;
}

/* === TABLE === */
table.wp-list-table {
    width: 100%;
    border-collapse: collapse;
}

table.wp-list-table th,
table.wp-list-table td {
    padding: 10px;
    border-bottom: 1px solid #e5e5e5;
    text-align: left;
}

table.wp-list-table th {
    background-color: #f8f8f8;
    font-weight: 600;
}

/* === TOGGLE SWITCH === */
.switch {
    position: relative;
    display: inline-block;
    width: 40px;
    height: 20px;
}

.switch input {
    opacity: 0;
    width: 0;
    height: 0;
}

.slider {
    position: absolute;
    cursor: pointer;
    top: 0; left: 0; right: 0; bottom: 0;
    background-color: #ccc;
    transition: .4s;
    border-radius: 34px;
}

.slider:before {
    position: absolute;
    content: "";
    height: 16px;
    width: 16px;
    left: 2px;
    bottom: 2px;
    background-color: white;
    transition: .4s;
    border-radius: 50%;
}

input:checked + .slider {
    background-color: #007cba;
}

input:checked + .slider:before {
    transform: translateX(20px);
}

/* === BOUTONS ACTIONS === */
.button {
    display: inline-block;
    padding: 6px 10px;
    background: #eee;
    color: #333;
    border-radius: 4px;
    text-decoration: none;
    font-size: 13px;
}

.button:hover {
    background: #ddd;
}

.button-danger {
    background: #dc3232;
    color: #fff;
}

.button-danger:hover {
    background: #a00;
}
</style>

<div class="wrap">
    <h1>Add new template</h1>
    <p>Create custom header, footer, or single templates.</p>
<form method="post">
    <?php wp_nonce_field('xstudioapp_save_widgets', 'xstudioapp_nonce'); ?>

    <header class="plugin-header">
        <input type="search" name="templateName" placeholder="Template name" required />
        <select name="templateType" required>
            <?php foreach ($templateAllType as $type): ?>
                <option value="<?= esc_attr($type); ?>"><?= esc_html(ucfirst($type)); ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit" class="save-button" name="add_template">Add new</button>
    </header>
 </form>
<form method="post">
    <?php wp_nonce_field('xstudioapp_save_widgets', 'xstudioapp_nonce'); ?>
    <table class="wp-list-table widefat fixed striped">
        <thead>
            <tr>
                <th>Name</th>
                <th>Type</th>
                <th>Status</th>
                <th>Toggle</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($allTemplate)) : ?>
                <?php foreach ($allTemplate as $template): ?>
                    <?php $isActive = get_post_meta($template['ID'], '_xsa_is_active', true) === '1'; ?>
                    <tr>
                        <td><?= esc_html($template['title']); ?></td>
                        <td><?= esc_html($template['type']); ?></td>
                        <td><?= esc_html($template['status']); ?></td>
                        <td>
                            <label class="switch">
                                <input type="checkbox"
                                       name="active_widgets[<?= esc_attr($template['ID']); ?>]"
                                       value="<?= esc_attr($template['type']); ?>"
                                       <?= $isActive ? 'checked' : ''; ?> />
                                <span class="slider round"></span>
                            </label>
                        </td>
                        <td>
                            <a href="<?= esc_url(admin_url('post.php?post=' . $template['ID'] . '&action=elementor')); ?>"
                               class="button" target="_blank">Éditer avec Elementor</a>
                        </td>
                        <td>
                         

                            <a href="<?= add_query_arg([
                                    'action' => 'xsa_delete_template',
                                    'template_id' => $template['ID'],
                                    '_wpnonce' => wp_create_nonce('xsa_delete_template_action')
                                ], admin_url('admin-post.php')); ?>" 
                                class="button button-danger"
                                onclick="return confirm('Are you sure to delete this template?')">
                                Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
                <tr><td colspan="6">No templates found.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p><button type="submit" class="save-button" name="save_toggle">Sauver les changements</button></p>
</form>

</div>

