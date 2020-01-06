# g5-plugin
[https://developer.wordpress.org/plugins/](https://developer.wordpress.org/plugins/)

Build a WordPress plugin that includes custom post types and advanced custom fields to create pages and sections (using shortcodes) for these items:

List of             | Custom Post Types
------------------- | --------------------
Staff               | Treatment
Locations           | Equipment
Review              | FAQ
Workshops/Event     | Medical Library Topic Condition
News                | Newsletter
Service             |

**Special link CPT** - takes two items and establishes a relationship 
Examples:
- Staff and Location
- Service and Location
- Services and Staff

## Requirements
- Uses classes from G5 theme (later G6)
- Yoast SEO compatible
- ACF
- Hide ACF [Link to including ACF within a plugin](https://www.advancedcustomfields.com/resources/including-acf-within-a-plugin-or-theme/)
- Hide taxonomy/CPT
- Shortcode autocomplete in editor
- URL per item
- Themes have pages that us G5plus
	- Pages can be added to G5 theme
	- G6 will have lots of these pages
- HTML hidden by default
- Debug option
- Multisite compatbile - per customer settings
- Filtering inside CPT
- Linking between items (ex. **STAFF** and **LOCATION**)
- Reusable components for items
	- Gallery 
	- HTML
	- Tabs

## Page Template Guidelines
Templates and parts will be put in the g5_parts to be copied into a child, with a single base file in the g5 parent directory

### Single Pages
- Many customers and Custom Types will NOT NEED a single page, only the archive (FAQ is a good example)
- Make sure that form fields are shown only if filled out or template reads from Plugin Settings to skip fields that are turned off
- Base version can be used without modification for most situations
- Repository for base versions (mostly alternate layouts, not extra fields)
- Adding Extra Fields are to be avoided since you can not do it per customer (only if you think multiple customers will want it sooner or later do you add more fields to the Plugin)


### Archive Pages (List All)
- A few customers and hardly and Custom Types will not need an Archive Page (one workshop will not need an archive) - more will need
- Same guidelines as single pages for not using fields


### Sub Page Part
This is special, basically like a row, but used for shortcodes and includes on other pages (STaff on the Location page, services listed in a sidebar, etc...)
- Called by shortcodes or get_template part from liked CPT page template

## Staff
Fields |
--------------
- Name | - Credentials
- Role (PT, PTA, Office, ) - **Category** | - Bio
- Title | - Featured Image
- Quote | - Specialties
- Clinics (from Locations?) Advanced | - Extra Photos (repeater)
- Education (repeater) 
	- Name
	- Place 
| - Professional Affiliations (repeater)
- Community Service (repeater) | - Patient Testimonials (repeater)
	- Name
	- Quote

## Resources
- [Google Doc of requirements for G5 plugin](https://docs.google.com/document/d/1-60UjbCogUZewWsdGaM_1SLtLe6mua6BCpnWS4jskP4/edit?ts=5de6d85c#)
- [https://developer.wordpress.org/plugins/](https://developer.wordpress.org/plugins/)