const fs = require('fs');
const path = require('path');

// Hard-coded configuration (no .env or setup.json)
const setup = {
    namespace: 'lh',
    'plugin-name': 'wp-lh-solutions-plugin',
    'theme-name': 'lh-theme'
};

// Generate unique ID
function uniqid(prefix = '') {
    return prefix + Date.now().toString(16) + Math.random().toString(16).slice(2);
}

// Main generation function
function generateBlock(block_name) {
    // Derive naming conventions
    const nice_name = block_name;
    const block_slug = block_name.toLowerCase().replace(/\s+/g, '-').replace(/-+/g, '-');
    const class_name = block_name.replace(/\s+/g, '_').replace(/(?:^\w|_\w)/g, m => m.toUpperCase());
    const time_stamp = Date.now();
    const group_name = uniqid('group_');

    // Paths based on setup
    const theme_path = path.join('public', 'wp-content', 'themes', setup['theme-name'], 'blocks');
    const block_path = path.join(theme_path, block_slug);
    const plugin_src = path.join('public', 'wp-content', 'plugins', setup['plugin-name'], 'src', 'ACF_Blocks');
    const plugin_config = path.join('public', 'wp-content', 'plugins', setup['plugin-name'], 'config', 'ACF_Blocks');
    const fields_config = path.join('public', 'wp-content', 'plugins', setup['plugin-name'], 'config', 'ACF_Fields');

    // Read templates
    const class_tpl = fs.readFileSync(path.join(__dirname, 'plugin-block-templates', 'BLOCK_CLASS_TEMPLATE.php'), 'utf8');
    const config_tpl = fs.readFileSync(path.join(__dirname, 'config-json-file', 'BLOCK_CONFIG-block.json'), 'utf8');
    const fields_tpl = fs.readFileSync(path.join(__dirname, 'config-json-file', 'FIELDS_GROUP.json'), 'utf8');
    const theme_php = fs.readFileSync(path.join(__dirname, 'theme-block-templates', 'BLANK_TEMPLATE.php'), 'utf8');
    const theme_js = fs.readFileSync(path.join(__dirname, 'theme-block-templates', 'BLANK_TEMPLATE.js'), 'utf8');
    const theme_js_editor = fs.readFileSync(path.join(__dirname, 'theme-block-templates', 'BLANK_TEMPLATE-editor.js'), 'utf8');
    const theme_scss = fs.readFileSync(path.join(__dirname, 'theme-block-templates', 'BLANK_TEMPLATE.scss'), 'utf8');
    const theme_scss_editor = fs.readFileSync(path.join(__dirname, 'theme-block-templates', 'BLANK_TEMPLATE-editor.scss'), 'utf8');

    // Helper to replace placeholders
    function replaceStrings(str) {
        return str
            .replace(/{{class-name}}/g, class_name)
            .replace(/{{group-name}}/g, group_name)
            .replace(/{{nice-name}}/g, nice_name)
            .replace(/{{time-stamp}}/g, time_stamp)
            .replace(/{{block-slug}}/g, block_slug)
            .replace(/{{LH_PLGSTR}}/g, setup.namespace.toUpperCase());
    }

    // Write files
    fs.writeFileSync(path.join(plugin_src, `${class_name}.php`), replaceStrings(class_tpl));
    fs.writeFileSync(path.join(plugin_config, `${block_slug}-block.json`), replaceStrings(config_tpl));
    fs.writeFileSync(path.join(fields_config, `${group_name}.json`), replaceStrings(fields_tpl));

    // Ensure block directory exists
    fs.mkdirSync(block_path, { recursive: true });

    // Write theme templates
    const files = [
        { content: theme_php, ext: '.php' },
        { content: theme_js, ext: '.js' },
        { content: theme_js_editor, ext: '-editor.js' },
        { content: theme_scss, ext: '.scss' },
        { content: theme_scss_editor, ext: '-editor.scss' }
    ];
    files.forEach(({ content, ext }) => {
        fs.writeFileSync(path.join(block_path, `${block_slug}${ext}`), replaceStrings(content));
    });

    console.log(`\nBlock '${nice_name}' generated successfully.`);
    updateAcfIntegration(class_name);
}

// Update ACF integration
function updateAcfIntegration(class_name) {
    const integrationPath = path.join(
        'public', 'wp-content', 'plugins', setup['plugin-name'], 'src', 'Plugins_Integrations',
        'Advanced_Custom_Fields_Integration.php'
    );
    let content = fs.readFileSync(integrationPath, 'utf8');
    const regex = /public function acf_blocks\(\) \{([\s\S]*?)\}/;
    const match = content.match(regex);
    if (!match) {
        console.error('Could not find acf_blocks method in Advanced_Custom_Fields_Integration.php');
        return;
    }
    const newLine = `    new \\${setup.namespace}\\ACF_Blocks\\${class_name}();\n`;
    const updated = match[0].replace(/}\s*$/, `${newLine}    }`);
    content = content.replace(regex, updated);
    fs.writeFileSync(integrationPath, content);
    console.log('Updated Advanced_Custom_Fields_Integration.php with new block registration.');
}

// Entry point
const blockName = process.argv[2];
if (!blockName) {
    console.error('Usage: node generateBlock.js <Block Name>');
    process.exit(1);
}

generateBlock(blockName);
