# Changelog

## [1.1.4]
- Added filter `hogan/module/content_grid/load_args_from_layout_content/before`.

## [1.1.3]
- Removed sanitize function `wp_kses_post` from Text content provider template.

## [1.1.2]
- Added filter `hogan/module/content_grid/template/inner_classes`
- Added filter `hogan/module/content_grid/template/item_classes`

## [1.1.1]
- Fixed php notice that showed up when label field was not enabled.

## [1.1]
- Added filter `hogan/module/content_grid/template/outer_classes`
- Added optional field for label with filter `hogan/module/content_grid/standard/label/enabled`

## [1.0.3]
- Fixed bug where image/link from previous item in the grid was shown on items wihtout link/image.

## [1.0.2]
- Update module to new registration method introduced in [Hogan Core 1.1.7](https://github.com/DekodeInteraktiv/hogan-core/releases/tag/1.1.7)
- Set hogan-core dependency `"dekodeinteraktiv/hogan-core": ">=1.1.7"`
- Add Dekode Coding Standards

## [1.0.1]
- Added optional link to image layout

## [1.0.0]
- First release
