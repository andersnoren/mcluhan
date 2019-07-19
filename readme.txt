=== McLuhan ===
Contributors: Anlino
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=anders%40andersnoren%2ese&lc=US&item_name=Free%20WordPress%20Themes%20from%20Anders%20Noren&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Requires at least: 4.4
Tested up to: 5.2
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
As default, the social section and a search toggle, even if a menu has not been set for the social section. If you check this box, the social section will always be hidden (even if you create a social menu).

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