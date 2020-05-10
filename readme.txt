=== McLuhan ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.4
Tested up to: 5.4.1
Stable tag: trunk
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

McLuhan WordPress Theme, Copyright 2018 Anders Norén
McLuhan is distributed under the terms of the GNU GPL


== Installation ==

1. Upload the theme
2. Activate the theme

All theme specific options are handled through the WordPress Customizer.


== Social Links ==

To add social links to the sidebar on desktop and menu area on mobile/tablet, follow the instructions below.

1. Go to Administration Panel > Appearance > Menus. 
2. Click on "Create a new menu". Give your menu a name, like "Social menu", and click the "Create Menu" button to the right.
3. Add a "Custom Link" for each social network link you want to display. The theme will select the appropriate icon for the link automatically, based on the URL.
4. Under the "Menu Settings" title, check the checkbox labelled "Social links". This will instruct the theme to display your links in the social menu area. Click the "Save Menu" button.
5. Your social menu should now be visible on the site.


== Full Width Page Template ==

1. Create a new page, or edit an existing one
2. Click the dropdown beneath "Template" in "Page Attributes", and select Full Width Template.


== Resume Page Template ==

1. Create a new page, or edit an existing one
2. Click the dropdown beneath "Template" in "Page Attributes", and select Resume Template.

In the resume page template, all titles span the entire width of the content, whereas all other elements are aligned to the right. This enables you to create sections in the resume content by simple adding another title. For instance, adding a title called "Education" and adding a paragraph of text beneath it will automatically create a section with the "Education" title to the left and the paragraph of text to the right.


== Customizer Settings ==

= Front Page Title =
The text entered into this textarea will be displayed on the page set to be used as your page for posts (or home page, if no such page has been set). 

= Hide social buttons =
By default, the social section and a search toggle, even if a menu has not been set for the social section. If you check this box, the social section will always be hidden (even if you create a social menu).

= Archive date format =
Here, you can choose how the post dates should be displayed in the post previews (the list format on archive pages). You can show the dates with month first (Jan 1) or day of month first (1 Jan), and select whether to display the date in lowercase or not.

= Colors =
In the colors tab, you can set the background color of the content and of the sidebar, and select whether the sidebar should have dark text or not.


== Licenses ==

Archivo font
License: SIL Open Font License, 1.1
Source: https://fonts.google.com/specimen/Archivo

FontAwesome font
License: SIL Open Font License, 1.1
Source: http://fontawesome.io/


== Changelog ==

Version 2.0.4 (2020-05-10)
-------------------------
- Updated the search button to be hidden on mobile if "Hide Social Buttons" is checked, as the desktop search is hidden when that option is checked.
- Updated the description of the "Hide Social Buttons" setting in the Customizer.

Version 2.0.3 (2020-05-10)
-------------------------
- If a posts page is set, and a "Front Page Title" hasn't been set, use the title of the posts page as the archive title when the posts page is displayed.

Version 2.0.2 (2020-05-08)
-------------------------
- Made the "Full Width Template" available to posts as well as pages.
- Fixed the default block appender in the block editor having the wrong font family.
- Added a Customizer option for hiding the "Related Posts" section on single posts.
- Updated Font Awesome, stripped out unused FontAwesome styles from `font-awesome.css`, and added support for a lot more icons.

Version 2.0.1 (2020-05-04)
-------------------------
- Fixed the McLuhan header/sidebar being displayed on top of the WordPress admin bar (thanks, @adamkheckler).

Version 2.0.0 (2020-04-30)
-------------------------
- Removed FontAwesome font files not needed to support modern browsers, reducing theme footprint.
- CSS: Updated targeting of the block editor colors and font sizes to work outside of the entry content.
- CSS: Added base margins for blocks, including the new social links and buttons block added in WordPress 5.4.
- CSS: Updated Firefox font antialiasing to match that of Safari and Chrome.
- CSS: Removed removal of outline from links and inputs, improving keyboard navigation.
- CSS: Combined the Archive Pagination and Archive sections.
- CSS: Added a new section for Element Base, including global styling previously in the Entry Content section.
- CSS: Added a new section for Blocks, including block styling previously in the Entry Content section.
- CSS: Updated the TOC to match the new CSS structure.
- CSS: Added more elements to the base input styles.
- CSS: Updated the CSS reset to make elements inherit styles instead of reset them.
- CSS: Updated list styles and heading styles to be global rather than entry content specific, and updated other styles accordingly.
- CSS: Removed vendor prefixes that are no longer needed.
- CSS: Updated base link styles to be less specific, and underlined by default.
- CSS: Added clearfix to the entry content.
- CSS: Adjusted blockquote styles.
- CSS: General cleanup (indentation, spacing, formatting, etc).
- Comments: Removed the "Comments are closed" message.
- Meta: Updated "Tested up to" to 5.4.1.
- Moved the Mcluhan_Customize class to its own file, made the class pluggable, and removed prefixes from class functions.
- Moved the "no-title" post-preview class from `content.php` to the `post_classes` function.
- Removed all occurances of the title attribute on `a` elements.
- Header: Updated the logic determining when to output the site title as a H1 heading (only on the front page).
- Archive: Updated the logic determining when to output the page title as a H1 heading (only when not on the front page).
- Restructured and simplified the archive header, and moved conditionals for archive title, description and type to corresponding functions.
- Added theme version to enqueues.
- Removed unneccessary `is_admin()` check from `wp_enqueue_scripts` function.
- Combined the two functions hooking into `wp_enqueue_scripts` into one.
- Block Editor: Renamed the "Regular" font size to "Normal", to match the expected naming in the block editor.
- Moved the editor styles to `/assets/css/` and renamed them.
- Added a missing `global $post` before use of `setup_postdata()` in `related-posts.php`.

Version 1.20 (2019-07-19)
-------------------------
- Added theme URI to style.css
- Updated "Tested up to"
- Added theme tags
- Added skip link
- Don't show comments if the post is password protected
- Don't show the post thumbnail if the post is password protected
- Fixed font issues in the block editor styles
- Updated social menu styling to handle wrapping better
- Updated resolution of screenshot.png to 1200x900 (same screenshot, different size)
- Compressed theme SVGs

Version 1.19 (2019-04-07)
-------------------------
- Added the new wp_body_open() function, along with a function_exists check

Version 1.18 (2019-03-22)
-------------------------
- Added margin to pingbacks
- Increased width of search field

Version 1.17 (2019-01-05)
-------------------------
- Changed the site title to be a paragraph on singular, and an h1 on other pages

Version 1.16 (2018-12-23)
-------------------------
- Fixed the min-width on button elements causing issues with the media player

Version 1.15 (2018-12-07)
-------------------------
- Fixed Gutenberg style changes required due to changes in the block editor CSS and classes
- Fixed the Classic Block TinyMCE buttons being set to the wrong font

Version 1.14 (2018-11-30)
-------------------------
- Fixed Gutenberg editor styles font being overwritten
- Fixed incorrect comment heading in Gutenberg editor stylesheet

Version 1.13 (2018-11-03)
-------------------------
- Updated with Gutenberg support
	- Gutenberg editor styles
	- Styling of Gutenberg blocks
	- Custom McLuhan Gutenberg palette
	- Custom McLuhan Gutenberg typography styles
- Added option to disable Google Fonts with a translateable string
- Updated theme description

Version 1.12 (2018-09-12)
-------------------------
- Updated screenshot.png to comply with new requirements

Version 1.11 (2018-05-24)
-------------------------
- Replaced strftime() with date_i18n()
- Improved styling of checkboxes in the comment form

Version 1.10 (2018-04-14)
-------------------------
- Fixed z-index issue with the header overlapping the WordPress admin bar dropdowns
- Made a couple of tweaks based on the Theme Sniffer results
- Made functions pluggable

Version 1.09 (2018-01-10)
-------------------------
- Style tweaks for the archive pagination
- Added an admin notice displayed on theme activation, letting users how to update the posts_per_page setting
- Removed $query->set() overriding the default posts_per_page option

Version 1.08 (2018-01-09)
-------------------------
- Removed override of $GLOBALS[’comment’]
- Replaced minified FontAwesome with non-minified version
- Escaped image url in related-posts.php
- Added copyright to readme
- Added escaping of $mod variable
- Escaped get_year_link()
- Added missing escape of home_url()
- Replaced wp_print_scripts with wp_enqueue scripts
- Tweaked untoggle-mobile-search position
- Hide site header bottom border on mobile when the mobile menu is visible
- Prefixed ajaxpagination with theme name
- Removed require of locale_file since it’s not needed
- Replaced locate_template() include with get_template_part()
- Changed date() to date_i18n() in footer
- Removed setlocale()

Version 1.07 (2017-12-23)
-------------------------
- Escaped output home_url() in the header
- Replaced include( locate_template() ) with locate_template() with the include argument set to true, to comply with WordPress.org theme requirements

Version 1.06 (2017-12-12)
-------------------------
- Fixed output of dates on the archive pages

Version 1.05 (2017-12-05)
-------------------------
- Fixed width issue for alignleft/-right elements in the post content

Version 1.04 (2017-11-29)
-------------------------
- Switched from wp_print_styles to wp_enqueue_scripts to enqueue scripts and styles

Version 1.03 (2017-10-14)
-------------------------
- Adjusted comment pagination margins (sorry for the update clogging, theme reviewers!)

Version 1.01 (2017-10-14)
-------------------------
- Updated style.css theme description
- Added missing styling for when replying to a comment

Version 1.00 (2017-10-14)
-------------------------