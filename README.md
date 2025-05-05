# 🧱 WP Assessment Setup & Development Guide

This guide provides instructions to set up the project and create custom Gutenberg blocks using the Lemon Hive block scaffolding system.

---

## 🔧 Project Setup

Follow the steps below to get started:

1. **Clone the repository:**

   ```bash
   git clone https://github.com/lemon-hive/wp-assessment.git
   ```

2. **Copy `wp-content` folder:**

   Paste it into your local WordPress installation directory (e.g., `app/wp-content` if using Local by Flywheel or similar).

3. **Copy `Makefile` and `lh-block-scaffolding`:**

   Paste both into the **root directory** of your local environment (e.g., the `app` directory in Local).

4. **Install theme dependencies:**

   Navigate to the theme directory and run:

   ```bash
   cd wp-assessment/wp-content/themes/lh-theme
   npm install
   ```

---

## 🧱 How to Create a Block

1. **Generate a new block:**

   From your **app root directory** (where `Makefile` is located), run:

   ```bash
   make block
   ```

   > 🔍 You can refer to the sample "Title" block included in the repo for an example.

2. **Control block logic and data:**

   Edit your block’s logic and conditional structure in:

   ```
   wp-content/plugins/wp-lh-solutions-plugin/config/ACF_Blocks/your-block.php
   ```

3. **Manage ACF fields:**

   - Fields are managed in:

     ```
     wp-content/plugins/wp-lh-solutions-plugin/config/ACF_Fields/group-auto-id-*.json
     ```

   - Ensure your field group is **auto-saved** and correctly **assigned** to the block.
   - Do **not** duplicate files; use the auto-generated JSON created via the `make block` command.

4. **Block styling and markup:**

   Handle your block’s frontend structure and styles here:

   ```
   wp-content/themes/lh-theme/blocks/your-block/
   ```

5. **Start development server:**

   Make sure to keep running:

   ```bash
   npm run dev
   ```

   > ❗ Resolve any terminal errors **before** committing code.

---

## 🎨 Frontend Guidelines

- ✅ Use **SCSS** for styling.
- ✅ Prefix classes with `lh-`, e.g., `lh-hero-banner`.
- ✅ Design using a **mobile-first** approach.
- ✅ Ensure **cross-browser compatibility**.
- ✅ Use **semantic HTML** elements.
- ✅ Apply **ARIA properties** where necessary.
- ✅ Follow the **DRY (Don’t Repeat Yourself)** principle.

---

## 🧠 Function Usage Guidelines

1. **Check `utils.php`** for reusable functions:

   - Render simple ACF elements:

     ```php
     lh_print_simple_acf_element()
     ```

   - Render images:

     ```php
     lh_wp_get_attachment_image_by_sizes()
     ```

   - Render links:

     ```php
     wak_print_acf_link_as_html()
     ```

2. **Add custom functions:**

   - Place them in:

     ```
     wp-assessment/wp-content/themes/lh-theme/src/alias_functions.php
     ```

   - Also duplicate them in the plugin, while respecting the theme/plugin namespace.

3. **Using images in a block:**

   - Register image sizes inside:

     ```
     wp-content/plugins/wp-lh-solutions-plugin/config/ACF_Blocks/your-block.php
     ```

   - Example:

     ```php
     static $image_sizes = [
         'mobile' => ['width' => 40, 'height' => 40, 'crop' => true],
         'mobile_2x' => ['width' => 80, 'height' => 80, 'crop' => true],
         'tablet' => ['width' => 40, 'height' => 40, 'crop' => true],
         'tablet_2x' => ['width' => 80, 'height' => 80, 'crop' => true],
         'desktop' => ['width' => 40, 'height' => 40, 'crop' => true],
         'desktop_2x' => ['width' => 80, 'height' => 80, 'crop' => true],
     ];
     ```

   - Pass these sizes to `lh_wp_get_attachment_image_by_sizes()` when rendering.

---

## 📂 Project Structure Overview

```
wp-assessment/
├── wp-content/
│   ├── themes/
│   │   └── lh-theme/
│   └── plugins/
│       └── wp-lh-solutions-plugin/
├── Makefile
└── lh-block-scaffolding/
```

---

## 📝 Notes

- Always commit clean and tested code.
- Make sure all ACF JSON files are updated and not duplicated.
- Follow naming conventions and Lemon Hive development standards.
